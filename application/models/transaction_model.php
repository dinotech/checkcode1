<?php
class Transaction_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	public function get_row(){
		$sql = $this->db->query("select * from transaction_register");
		$result = $sql->result_array();
		return $result;
	}
}