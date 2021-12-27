<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Vaccine extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Vaccines';

		$this->load->model('model_vaccines', 'vaccines');
	}

	/* 
	* redirect to the index page 
	*/
	public function index()
	{
		if(!in_array('viewAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('vaccines/index', $this->data);	
	}

	public function vaccines_per_location($vaccine_id){
		if(!in_array('viewAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->data['vaccine'] =  $this->vaccines->getVaccinesData($vaccine_id);
		//print_r($this->data['vaccine'] );
		$this->render_template('vaccines/vaccines_per_location', $this->data);	
	}

	/* 
	* fetch the attribute data through attribute id 
	*/
	public function fetchVaccineDataById($id) 
	{
		if($id) {
			$data = $this->vaccines->getVaccinesData($id);
			echo json_encode($data);
		}
	}

	public function fetchVaccineDataPerLocationById($id) 
	{
	
		if($id) {
			$data = $this->vaccines->getVaccinesData2($id);
			echo json_encode($data);
		}
	}

	/* 
	* gets the attribute data from data and returns the attribute 
	*/
	public function fetchVaccinesData()
	{
		$result = array('data' => array());

		$data = $this->vaccines->getVaccinesData();

		foreach ($data as $key => $value) {

		//	$count_attribute_value = $this->model_attributes->countAttributeValue($value['id']);
		 	$countTotalVaccinesIssued = $this->vaccines->countTotalVaccineIssued($value['id']);
			if(!$countTotalVaccinesIssued){
				$countTotalVaccinesIssued = 0;
			}
			$quantity_issued = '<a href="'.base_url('Controller_Vaccine/vaccines_per_location/'.$value['id'].'').'">'.$countTotalVaccinesIssued.'</a>';
			// button
			$buttons = '
			<button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
			';

			//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['description'],
				$value['qty_onhand'],
				$quantity_issued,
                $value['remarks'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchVaccinesDataPerLocation($vaccine_id){

		$result = array('data' => array());

		$data = $this->vaccines->getVaccinesDataPerLocation($vaccine_id);
		//print_r($data);
		foreach ($data as $key => $value) {
			
		//	$count_attribute_value = $this->model_attributes->countAttributeValue($value['id']);
			$quantity_issued = '<a href="'.base_url('Controller_Vaccine/vaccines_per_location').'">1</a>';
			// button
			$buttons = '<button type="button" class="btn btn-warning btn-sm" onclick="editFunc2('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
			
			';

			//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			
			$result['data'][$key] = array(
				$value['location'],
				$value['quantity'],
                $value['address'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);

	}

	/* 
	* create the new attribute value 
	*/
	public function create()
	{
		if(!in_array('createAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('vaccine_name', 'Vaccine name', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'description' => $this->input->post('vaccine_name'),
        		'qty_onhand' => $this->input->post('vaccine_onhand'),	
				'qty_requested' => $this->input->post('vaccine_requested'),	
				'qty_issued' => $this->input->post('vaccine_issued'),	
				'remarks' => $this->input->post('vaccine_remarks'),	
        	);

        	$create = $this->vaccines->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	public function createVaccinePerLocation()
	{
		if(!in_array('createAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('clinic_name', 'Clinic Name', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'vaccine_id' => $this->input->post('vaccine_id'),
        		'location' => $this->input->post('clinic_name'),	
				'quantity' => $this->input->post('quantity'),	
				'address' => $this->input->post('clinic_location')
        	);

        	$create = $this->vaccines->insert_data('vaccines_per_location',$data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}


	

	/* 
	* update the attribute value via attribute id 
	*/
	public function update($id)
	{
		if(!in_array('updateAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_vaccine_name', 'Vaccine name', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
					'description' => $this->input->post('edit_vaccine_name'),
					'qty_onhand' => $this->input->post('edit_vaccine_onhand'),	
					'qty_requested' => $this->input->post('edit_vaccine_requested'),	
					'qty_issued' => $this->input->post('edit_vaccine_issued'),	
					'remarks' => $this->input->post('edit_vaccine_remarks'),	
				);

	        	$update = $this->vaccines->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}


	public function updateVaccinePerLocation($id)
	{
		if(!in_array('updateAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_clinic_name', 'Clinic name', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
					'location' => $this->input->post('edit_clinic_name'),
					'quantity' => $this->input->post('edit_quantity'),	
					'address' => $this->input->post('edit_clinic_location'),	
						
				);

	        	$update = $this->vaccines->update_table("vaccines_per_location", $data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/* 
	* remove the attribute value via attribute id 
	*/
	public function remove()
	{
		if(!in_array('deleteAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$attribute_id = $this->input->post('attribute_id');

		$response = array();
		if($attribute_id) {
			$delete = $this->model_attributes->remove($attribute_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

	/* ATTRIBUTE VALUE SECTION */

	/* 
	* this function redirects to the addvalue page with the parent attribute id 
	*/
	public function addvalue($attribute_id = null)
	{
		if(!$attribute_id) {
			redirect('dashboard', 'refersh');
		}

		$this->data['attribute_data'] = $this->model_attributes->getAttributeData($attribute_id);

		$this->render_template('Vaccines/addvalue', $this->data);	
	}


	/* 
	* fetch the attribute value based on the attribute parent id 
	*/
	public function fetchAttributeValueData($attribute_parent_id)
	{
		$result = array('data' => array());

		$data = $this->model_attributes->getAttributeValueData($attribute_parent_id);

		foreach ($data as $key => $value) {

			// button
			$buttons = '
			<button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
			';

			$result['data'][$key] = array(
				$value['value'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/* 
	* fetch the attribute value by the attritute value id  
	*/
	public function fetchAttributeValueById($id) 
	{
		if($id) {
			$data = $this->model_attributes->getAttributeValueById($id);
			echo json_encode($data);
		}
	}

	/* 
	* this function only creates the value 
	*/ 
	public function createValue()
	{
		$response = array();

		$this->form_validation->set_rules('attribute_value_name', 'Vaccine value', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$attribute_parent_id = $this->input->post('attribute_parent_id');

        	$data = array(
        		'value' => $this->input->post('attribute_value_name'),
        		'attribute_parent_id' => $attribute_parent_id
        	);

        	$create = $this->model_attributes->createValue($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	/* 
	* It updates the attribute value based on the attribute value id 
	*/
	public function updateValue($id)
	{

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_attribute_value_name', 'Vaccine value', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$attribute_parent_id = $this->input->post('attribute_parent_id');
	        	$data = array(
	        		'value' => $this->input->post('edit_attribute_value_name'),
		    		'attribute_parent_id' => $attribute_parent_id
	        	);

	        	$update = $this->model_attributes->updateValue($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/* 
	* it removes the attribute value id based on the attribute value id 
	*/
	public function removeValue()
	{

		$attribute_value_id = $this->input->post('attribute_value_id');

		$response = array();
		if($attribute_value_id) {
			$delete = $this->model_attributes->removeValue($attribute_value_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}