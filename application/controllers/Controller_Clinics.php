<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Clinics extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Clinics';

		$this->load->model('model_clinics','clinics');
	}

	/* 
	* redirect to the index page 
	*/
	public function index()
	{
		if(!in_array('viewAttribute', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('clinics/index', $this->data);	
	}

	/* 
	* fetch the attribute data through attribute id 
	*/
	public function fetchClinicDataById($id) 
	{
		if($id) {
			$data = $this->clinics->getClinicData($id);
			echo json_encode($data);
		}
	}

	/* 
	* gets the attribute data from data and returns the attribute 
	*/
	public function fetchClinicsData()
	{
		$result = array('data' => array());

		$data = $this->clinics->getClinicData();

		foreach ($data as $key => $value) {

		//	$count_attribute_value = $this->clinics->countAttributeValue($value['id']);

			// button
			$buttons = ' 
			<button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
			';

			//$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['clinic_name'],
				$value['clinic_address'],
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

		$this->form_validation->set_rules('clinic_name', 'Clinic name', 'trim|required');
	

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'clinic_name' => $this->input->post('clinic_name'),
        		'clinic_address' => $this->input->post('clinic_address'),	
        	);

        	$create = $this->clinics->create($data);
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
			$this->form_validation->set_rules('edit_clinic_name', 'Clinic name', 'trim|required');
			$this->form_validation->set_rules('edit_clinic_address', 'Clinic address', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'clinic_name' => $this->input->post('edit_clinic_name'),
	        		'clinic_address' => $this->input->post('edit_clinic_address'),	
	        	);

	        	$update = $this->clinics->update($data, $id);
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

		$clinic_id = $this->input->post('clinic_id');

		$response = array();
		if($clinic_id) {
			$delete = $this->clinics->remove($clinic_id);
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