<?php

 class Editdealer_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row(){
		
		$id=$id =$this->input->get('id', TRUE); 
		
   $query=$this->db->query("select * from dealer_info where dealer_id='".$id."'");
   $row=$query->result_array();
   return $row;
		
	}
	
	
 public function update_row()
	  { 
	  $id=$id =$this->input->get('id', TRUE); 
	 
$data = array(
'd_name' => $_POST['dname'],
'd_address' => $_POST['address'],
'phone' => $_POST['phone'],
'mobile' => $_POST['mobile']
);
$this->db->where('dealer_id',$id);
$this->db->update('dealer_info',$data);

	    redirect('admin/dealer');
	  }
	  
 }