<?php 

class Model_clinics extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	

	/* get the attribute data */
	public function getClinicData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM clinics where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM clinics";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('clinics', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('clinics', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('clinics');
			return ($delete == true) ? true : false;
		}
	}

	public function get_total_clinics(){
		$query = "SELECT * FROM clinics";
		return $this->db->query($query)->num_rows();
	}

	

}