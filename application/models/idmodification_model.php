<?php

 class Idmodification_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	public function get_modify()
	{
		$sql = $this->db->query("select * from id_modify where status=0");
		$result= $sql->result_array();
		return $result;
		
		}
	
 }