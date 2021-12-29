<?php 

class Model_vaccines extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// get the active atttributes data 
	public function getActiveAttributeData()
	{
		$sql = "SELECT * FROM attributes WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the attribute data */
	public function getVaccinesData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM vaccines where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM vaccines";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	/*get vaccine data per location */
	public function getVaccinesDataPerLocation($id = null)
	{	
		
			$sql = "SELECT * FROM vaccines_per_location where vaccine_id = '$id'";
			$query = $this->db->query($sql);
			return $query->result_array();
		
	
	}

	public function getVaccinesData2($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM vaccines_per_location where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM vaccines_per_location";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function countTotalVaccineIssued($vaccine_id){
		$query = "SELECT SUM(quantity) as total_issued FROM vaccines_per_location WHERE vaccine_id = '$vaccine_id'";
		$result = $this->db->query($query)->result_array();
		if($result){
			return $result[0]['total_issued'];
		} else {
			return 0;
		}
	}

	public function countAttributeValue($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM attribute_value WHERE attribute_parent_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->num_rows();
		}
	}

	/* get the attribute value data */
	// $id = attribute_parent_id
	public function getAttributeValueData($id = null)
	{
		$sql = "SELECT * FROM attribute_value WHERE attribute_parent_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function getAttributeValueById($id = null)
	{
		$sql = "SELECT * FROM attribute_value WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('vaccines', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function insert_data($table_name,$data)
	{
		if($data) {
			$insert = $this->db->insert($table_name, $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('vaccines', $data);
			return ($update == true) ? true : false;
		}
	}

	public function update_table($table_name, $data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update($table_name, $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('vaccines');
			return ($delete == true) ? true : false;
		}
	}

	public function createValue($data)
	{
		if($data) {
			$insert = $this->db->insert('attribute_value', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function updateValue($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('attribute_value', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removeValue($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('attribute_value');
			return ($delete == true) ? true : false;
		}
	}

	public function get_table_data($table_name){
		$query = "SELECT * FROM $table_name";
		return $this->db->query($query)->result_array();
	}

}