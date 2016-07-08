<?php

 class Site_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function dlr() 
      {
		$com=$this->db->query("select * from dealer_info");
		return $com->result_array();
	  }	
	
	public function get_row($start){
		//$start=0;
		$limit=10;
		
 $query=$this->db->query("select * from site_info as s JOIN dealer_info as p where s.d_id=p.dealer_id 
 limit ".$start.",".$limit."");
 $row[]=$query->result_array();
 
	return $row;
		
	}
	
	
 public function insert_row()
	  {
	 // echo "<pre>"; print_r($_POST); die;
 $data_insert = array(
's_name' => $_POST['sname'],
's_address' => $_POST['address'],
's_city' => $_POST['city'],
's_state' => $_POST['state'],
'd_id' => $_POST['dname']
);
$this->db->insert('site_info', $data_insert);
		
		redirect('admin/site');
	  }
	  
 public function delete_row()
	  { 
	  $id=$id =$this->input->get('id', TRUE); 
	 // echo $id; die;
	  $this->db->where('id',$id);
      $this->db->delete('site_info');
	  redirect('admin/site'); 
	 
	  }
	
 }