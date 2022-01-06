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
	//	$sql = "SELECT V.*, VD.total_quantity as available_quantity  FROM vaccines as V LEFT JOIN (SELECT SUM(quantity) as total_quantity,vaccine_id FROM vaccines_received WHERE quantity <> 0 GROUP by vaccine_id) as VD ON VD.vaccine_id = V.id";
		$sql = "SELECT * FROM vaccines";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	/*get vaccine data per location */
	public function fetch_issued_vaccine($id = null)
	{		
			$sql = "SELECT V.*, C.clinic_name FROM vaccines_issued as V
					LEFT JOIN clinics as C ON V.clinic_id = C.id
			 where V.vaccine_id = '$id'";
			$query = $this->db->query($sql);
			return $query->result_array();
	}

	public function fetch_vaccine_data_byid($table, $id = null)
	{		
		switch($table){
			case 'vaccines_issued':
				$sql ="SELECT V.*, C.clinic_name FROM $table as V
						LEFT JOIN clinics as C ON V.clinic_id = C.id
					where V.vaccine_id = '$id'";
			break;

			case 'vaccines_received':
				$sql ="SELECT VR.*, V.description FROM $table as VR LEFT JOIN vaccines as V ON V.id = VR.vaccine_id
				where VR.vaccine_id = '$id'  AND quantity <> 0 ORDER BY expiration_date ASC";
			break;
		}
			
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
		$query = "SELECT SUM(quantity) as total_issued FROM vaccines_issued WHERE vaccine_id = '$vaccine_id'";
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

	public function update_quantity($data, $action){
	//	print_r($data);
		switch($action){
			case "add":
			$operator = "+";
			break;

			case "subtract":
			$operator = "-";
			break;
		}

		$vaccine_id = $data['vaccine_id'];
		$quantity = $data['quantity'];
		$query = "UPDATE vaccines SET total_quantity = total_quantity $operator $quantity WHERE id = '$vaccine_id'";
		$this->db->query($query);
		return $this->db->affected_rows();
	}

	public function update_available_quantity($data, $table_name, $column, $id){
		$vaccine_id = $data['vaccine_id'];
		$quantity_issued = $data['quantity']; 
		$query = "UPDATE $table_name SET $column = $column - $quantity_issued WHERE id = '$id'";
		$this->db->query($query);
		return $this->db->affected_rows();

	}

	public function get_table_data_byid($table,$column,$id){
		$query = "SELECT * FROM $table WHERE $column = '$id'";
		return $this->db->query($query)->result_array();
	}

	public function count_total_vaccines(){
		$query = "SELECT * FROM vaccines";
		return $this->db->query($query)->num_rows();
	}

}