<?php

 class Editgodown_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row(){
		
		$id=$id =$this->input->get('id', TRUE); 
		
   $query=$this->db->query("select * from godown_info where g_id='".$id."'");
   $row=$query->result_array();
   return $row;
		
	}
	
	
 public function update_row()
	  { //echo "<pre>"; print_r($_POST); die;
	  $id=$id =$this->input->get('id', TRUE); 

$data = array(
'g_name' => $_POST['gname'],
'g_address' => $_POST['address'],
'ph_no' => $_POST['phone'],
'mob' => $_POST['mobile'],
'city' => $_POST['city'],
'state' => $_POST['state'],
);
$this->db->where('g_id',$id);

$this->db->update('godown_info',$data);

	    redirect('admin/godown');
	  }
	  
 }