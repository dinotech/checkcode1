<?php

 class Dealer_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row($start){
		//echo '<pre>';print_r($start);die;
		
		//$start=0;
		$limit=10;
		
 $query=$this->db->query("select * from dealer_info limit ".$start.",".$limit."");
 $row[]=$query->result_array();
 
   return $row;
		
	}
	
	
 public function insert_row()
	  { 
	 $data_insert = array(
'd_name' => $_POST['dname'],
'd_address' => $_POST['address'],
'phone' => $_POST['phone'],
'mobile' => $_POST['mobile']
);
$this->db->insert('dealer_info', $data_insert);
	 
	    redirect('admin/dealer');
	  }
	  
 public function delete_row()
	  {  $id=$id =$this->input->get('id', TRUE); 
	  
	  $this->db->where('dealer_id',$id);
      $this->db->delete('dealer_info');
	  redirect('admin/dealer'); 
	 
	  }
	
 }