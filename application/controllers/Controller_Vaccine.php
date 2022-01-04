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

	public function vaccines_issued($vaccine_id){
		if(!in_array('viewAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->data['vaccine'] =  $this->vaccines->getVaccinesData($vaccine_id);
		//print_r($this->data['vaccine'] );
		$this->render_template('vaccines/vaccines_issued', $this->data);	
	}

	public function vaccines_received($vaccine_id){
		if(!in_array('viewAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->data['vaccine'] =  $this->vaccines->getVaccinesData($vaccine_id);
		//print_r($this->data['vaccine'] );
		$this->render_template('vaccines/vaccines_received', $this->data);	
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
			//date("d-m-Y", strtotime($originalDate)
			$expiration_date = $value['expiration_date']?date("d-M-Y", strtotime($value['expiration_date'])):'No Expiration';
			
			//date checker
			$badge = "";
			if($value['expiration_date']){
				$date_now = date("Y-m-d");
				$expiration_date = date("Y-m-d", strtotime($expiration_date));
				$date_diff = strtotime($expiration_date) - strtotime($date_now);
				$total_diff = round($date_diff / (60 * 60 * 24));
				if($total_diff > 0) {
					if($total_diff < 11){
						$badge = '<span class="label label-warning" title="Number of Days Until Expiration">'.$total_diff.'</span>';
					} 
				}else{
					$badge = '<span class="label label-danger">Expired</span>';
				}
			}
			

		 	$countTotalVaccinesIssued = $this->vaccines->countTotalVaccineIssued($value['id']);
			if(!$countTotalVaccinesIssued){
				$countTotalVaccinesIssued = 0;
			}

			$quantity_issued = '<a href="'.base_url('Controller_Vaccine/vaccines_issued/'.$value['id'].'').'">'.$countTotalVaccinesIssued.'</a>';
			$quantity_received = '<a href="'.base_url('Controller_Vaccine/vaccines_received/'.$value['id'].'').'">'.$value['total_quantity'].'</a>';
			// button
			$buttons = '
			<button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
			<button class="btn btn-default" data-toggle="modal" onclick="createDropdown()" data-target="#receiveModal">Receive Vaccine</button>';
			

			$buttons = '<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			  <i class="fa fa-cog"></i>
			  
			</button>
			<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
			  <li><a href="#" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal">Edit</a></li>
			  <li><a href="#" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal">Delete</a></li>
			  <li><a href="#" data-toggle="modal" onclick="createDropdown('.$value['id'].')" data-target="#receiveModal">Receive Vaccine</a></li>
			</ul>
		  </div>';
			$vaccine_name = $value['sub_description']?'<b>'.$value['description'].'</b><br><p style="font-size:11px">'.$value['sub_description'].'</p>':'<b>'.$value['description'].'</b>';
	
			$result['data'][$key] = array(
				$vaccine_name,
				$quantity_received,
				$quantity_issued,
				//$expiration_date.''.$badge,
                $value['remarks'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetch_issued_vaccine($vaccine_id){

		$result = array('data' => array());

		$data = $this->vaccines->fetch_vaccine_data_byid("vaccines_issued",$vaccine_id);
		//print_r($data);
		foreach ($data as $key => $value) {
			
			// button
			$buttons = '<button type="button" class="btn btn-warning btn-sm" onclick="editFunc2('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
			
			';
			
			$result['data'][$key] = array(
				$value['clinic_name'],
				$value['quantity'],
				date_format(date_create($value['issued_date']),"Y-M-d h:i:s a"),
				$value['issued_by']
				
			);
		} // /foreach

		echo json_encode($result);

	}

	public function fetch_received_vaccine($vaccine_id){

		$result = array('data' => array());

		$data = $this->vaccines->fetch_vaccine_data_byid("vaccines_received",$vaccine_id);
		//print_r($data);
		foreach ($data as $key => $value) {
			//check if there are available quantity
			
				
			

			$issueBtn = '<a href="#" class="btn btn-primary" data-toggle="modal" onclick="initIssueVaccineModal('.$value['vaccine_id'].',\''.$value['description'].'\', '.$value['quantity'].', '.$value['id'].')" data-target="#issueVaccineModal">Issue Vaccine</a>';
			$expiration_date =  ($value['expiration_date'] && $value['expiration_date'] != '0000-00-00')? date_format(date_create($value['expiration_date']),"Y-M-d h:i:s a"):'-';

			//date checker
			$badge = "";
			if($expiration_date != '-'){
				$date_now = date("Y-m-d");
				$expiration_date = date("Y-m-d", strtotime($expiration_date));
				$date_diff = strtotime($expiration_date) - strtotime($date_now);
				$total_diff = round($date_diff / (60 * 60 * 24));
				if($total_diff > 0) {
					if($total_diff < 11){
						$badge = '<span class="label label-warning" title="Number of Days Until Expiration">'.$total_diff.'</span>';
					} 
				}else{
					$badge = '<span class="label label-danger">Expired</span>';
					$issueBtn = '<a href="#" class="btn btn-danger" data-toggle="modal" onclick="initDisposeVaccineModal('.$value['vaccine_id'].',\''.$value['description'].'\', '.$value['quantity'].', '.$value['id'].')" data-target="#disposeVaccineModal">Dispose Vaccine</a>';
				}
			}

			$result['data'][$key] = array(
				//$value['clinic_name'],
				$value['quantity'],
				date_format(date_create($value['receive_date']),"Y-M-d h:i:s a"),
				$value['received_by'],
				$expiration_date.''.$badge,
				$issueBtn
				
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
				'sub_description' => $this->input->post('vaccine_description'),
				'expiration_date' => $this->input->post('vaccine_exp_date'),	
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
					'sub_description' => $this->input->post('edit_vaccine_description'),	
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
			$delete = $this->vaccines->remove($attribute_id);
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


	public function createDropdown($data){
	
	  $result = array();
	  switch($data){
		  
		  case 'vaccine':
		  $result = $this->vaccines->get_table_data('vaccines');

		  $dropdown = "<select class='form-control' name='receive_vaccine_name' id='receive_vaccine_name'>";
			
		  foreach($result as $val){
			$vaccine = $val['description'];
			$vacc_id = $val['id'];
			$dropdown .= "<option value='$vacc_id'>$vaccine</option>";
		  }
		

		  break;

		  case 'clinics':
		  $result = $this->vaccines->get_table_data('clinics');

		  $dropdown = "<select class='form-control' name='issue_clinic_name' id='issue_clinic_name'>";
			
		  foreach($result as $val){
			$clinic = $val['clinic_name'];
			$clinic_id = $val['id'];
			$dropdown .= "<option value='$clinic_id'>$clinic</option>";
		  }

		  break;
		
		 
	  }

	  $dropdown .="</select>";
	

 	  echo json_encode(array("data" => $dropdown));
	}

	


	public function receive_vaccine($vaccine_id){
	
		$data = array(
			'vaccine_id' => $vaccine_id,	
			'quantity' => $this->input->post('receive_vaccine_quantity'),
			'quantity_received' => $this->input->post('receive_vaccine_quantity'),
			'received_by' => $this->session->userdata('fullname'),
			'remarks' => $this->input->post('receive_vaccine_remarks'),
			'expiration_date' => $this->input->post('rec_vaccine_exp_date')
		);
		$receive = $this->vaccines->insert_data("vaccines_received",$data);
		$response = "";
		if($receive){
			/*Update total quantity*/
			$update_quantity = $this->vaccines->update_quantity($data, "add");
			$response = "success";
		}

		echo json_encode(array("response" => $response));
	}

	public function proccessIssueVaccine(){
		$data = array(
			'vaccine_id' => $this->input->post('issue_vaccine_name'),	
			'clinic_id' => $this->input->post('issue_clinic_name'),
			'issued_by' => $this->session->userdata('fullname'),
			'remarks' => $this->input->post('issue_vaccine_remarks'),
			'quantity' => $this->input->post('issue_quantity')
		);

		$issueNow = $this->vaccines->insert_data("vaccines_issued",$data);
		$response = "";
		if($issueNow){
			$update_quantity = $this->vaccines->update_quantity($data, "subtract");
			$update_avail_quantity = $this->vaccines->update_available_quantity($data, "vaccines_received", "quantity", $this->input->post('received_column_id'));
			if($update_avail_quantity){
				$response = "success";
			}else{
				$response = "updateqtyfailed";
			}
			
		}

		echo json_encode(array("response" => $response));
	}

	public function processDisposeVaccine(){
		$data = array(
			'vaccine_id' => $this->input->post('dispose_vaccine_name'),	
			'disposed_by' => $this->session->userdata('fullname'),
			'remarks' => $this->input->post('dispose_vaccine_remarks'),
			'quantity' => $this->input->post('dispose_quantity')
		);

		$issueNow = $this->vaccines->insert_data("vaccines_disposed",$data);
		$response = "";
		if($issueNow){
			$update_quantity = $this->vaccines->update_quantity($data, "subtract");
			$update_avail_quantity = $this->vaccines->update_available_quantity($data, "vaccines_received", "quantity", $this->input->post('received_column_id'));
			if($update_avail_quantity){
				$response = "success";
			}else{
				$response = "updateqtyfailed";
			}
			
		}

		echo json_encode(array("response" => $response));
	}



}