<?php

 class Subscribers_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function abttoexpire(){
		
	$sql=$this->db->query("select * from subscription as s join user as u on u.user_id=s.user_id where u.role='subscriber' ");
	$result=$sql->result_array();
//	echo "<pre>"; print_r($result);die;
	return $result;
		
	}

	public function expire(){
	$sql=$this->db->query("select * from subscription as s join user as u on s.user_id=u.user_id where u.role='subscriber' && s.status=2 && s.end_time<'".date('Y-m-d')."' order by s.end_time DESC ");
	$result=$sql->result_array();
	return $result;
	}

	public function allsubs(){
//		print_r("select * from subscription as s join user as u on s.user_id=u.user_id where u.role='subscriber' order by s.sub_id Desc ");die;

	$sql=$this->db->query("select * from subscription as s join user as u on s.user_id=u.user_id where u.role='subscriber' order by s.sub_id Desc ");
	$result=$sql->result_array();
	return $result;
    }
	public function get_magbyid($id) {
	$row = $this->db->query("select * from  magazine where mag_id =  ".$id. " and status='1'");
	$row_data =$row->result_array(); 
	return @$row_data[0];	 
    }
	 public function get_edibyid($id)
	 {
	  $row = $this->db->query("select * from  magazine_sub where parentid ='".$id."'");
	  $row_data =$row->result_array(); 
	  return $row_data;
	 }
	
 }