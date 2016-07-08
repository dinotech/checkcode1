<?php

 class Payouts_model extends CI_Model {

	public function __construct()
	{
		
			$this->load->database();
	}
	public function get_data()
	{
       $sql= $this->db->query("select * from payouts ");
	   $result=$sql->result_array();
	   return $result;

	}
	public function get_franchise()
	{
       $sql= $this->db->query("select * from user where role='franchise'");
	   $result=$sql->result_array();
	   return $result;

	}
	public function insert_data($data){
	$sql= $this->db->query("select name from user where code='".$data['f_code']."' and role='franchise'");
	$result = $sql->result_array();
	$data['f_name'] = $result[0]['name'];
	
       $sql= $this->db->query("INSERT INTO `payouts`(`date`, `f_code`, `f_name`, `payid` , `tid`, `amount`) VALUES ('".$data['date']."','".$data['f_code']."','".$data['f_name']."','".$data['pay_id']."','".$data['transid']."','".$data['amount']."')");
	  
      redirect('admin/payouts');
	}
	
	public function get_payid(){
    
	$sql= $this->db->query("select payment_id from subscription as s join user u on s.user_id=u.user_id  where u.code='".$_POST['fc']."' and role='franchise' and s.status=2");
	$result = $sql->result_array();
	return $result;
	}
	
	
 }
 