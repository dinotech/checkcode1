<?php

 class Editsite_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row(){
		
		$id=$id =$this->input->get('id', TRUE); 
		
   $query=$this->db->query("select * from site_info where id='".$id."'");
   $row=$query->result_array();
   return $row;
		
	}
	
	 public function dlr() 
      {
		$com=$this->db->query("select * from dealer_info");
		return $com->result_array();
	  }
	  
 public function update_row()
	  { 
	  //echo "<pre>"; print_r($_POST); die;
	  $id=$id =$this->input->get('id', TRUE); 

$data = array(
's_name' => $_POST['sname'],
's_address' => $_POST['address'],
's_city' => $_POST['city'],
's_state' => $_POST['state'],
'd_id' => $_POST['dname']
);
$this->db->where('id',$id);
$this->db->update('site_info',$data);

	    redirect('admin/site');
	  }
	  
 }