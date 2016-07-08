<?php

 class Online_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	public function online_subscription()
	{
		$sql = $this->db->query("select * from payments as p join user as u on p.user_id=u.user_id  where  p.paym='online'");
		 
		$result= $sql->result_array();
		
		return $result;
		
		}
		public function getmagbyid($id){
		
		
		$sql = $this->db->query("select * from magazine where mag_id = '".$id."'");
		 
		$result= $sql->result_array();
		
		return $result[0];
		
			
			}
	
 }