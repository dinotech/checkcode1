<?php

 class editSubs_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row($id){
		//$start=0;
		//$limit=10;
		
 $query=$this->db->query("select * from subscription where sub_id='".$id."'");
 $row[]=$query->result_array();
 
  
   return $row;
		
	}
	
	
 public function insert_row($id)
	  { 
	/*  $odate=$_POST['cdate'];
	  if(empty($_POST['cdate'])){
		  $odate=date('Y-m-d');
		  }*/
	  
	 $data_insert = array(
'user_id' => $_POST['user_id'],
'mag_id' => $_POST['mag_id'],
'edition_id' => $_POST['edition_id'],
'start_time' => $_POST['start_time'],
'end_time' => $_POST['end_time'],
'duration' => $_POST['duration'],
'status' => $_POST['status']



);

$this->db->where('sub_id', $_POST['sub_id']);
$this->db->update('subscription', $data_insert);
	 
	    redirect('admin/subscription');
	  }
	  
	  public function add_subs_new()
	  { 
	/*  $odate=$_POST['cdate'];
	  if(empty($_POST['cdate'])){
		  $odate=date('Y-m-d');
		  }*/
	  
	 $data_insert = array(
'user_id' => $_POST['user_id'],
'mag_id' => $_POST['mag_id'],
'edition_id' => $_POST['edition_id'],
'start_time' => $_POST['start_time'],
'end_time' => $_POST['end_time'],
'duration' => $_POST['duration'],
'status' => $_POST['status']



);


$this->db->insert('subscription', $data_insert);
	 
	    redirect('admin/subscription');
	  }

	
 }
 