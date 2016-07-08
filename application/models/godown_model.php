<?php

 class Godown_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row($start){
		//echo '<pre>';print_r($start);die;
		
		//$start=0;
		$limit=10;
		
 $query=$this->db->query("select * from godown_info limit ".$start.",".$limit."");
 $row[]=$query->result_array();
 
   /* foreach ($query->result_array() as $key=>$row1)
     {
	  $rows= $this->db->query("select dealer_id from dealer_info where dealer_id='".$row1['dealer_id']."'");
	  $r=$rows->num_rows;
	 }*/
	
	return $row;
		
	}
	
	
 public function insert_row()
	  { 
	
 $data_insert = array(
'g_name' => $_POST['gname'],
'g_address' => $_POST['address'],
'ph_no' => $_POST['phone'],
'mob' => $_POST['mobile'],
'city' => $_POST['city'],
'state' => $_POST['state']
);
$this->db->insert('godown_info', $data_insert);
	 
	    redirect('admin/godown');
	  }
	  
 public function delete_row()
	  { 
	  $id=$id =$this->input->get('id', TRUE); 
	  
	  $this->db->where('g_id',$id);
      $this->db->delete('godown_info');
	  redirect('admin/godown'); 
	 
	  }
	
 }