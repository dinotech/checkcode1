<?php

 class editMag_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row($id){
		//$start=0;
		//$limit=10;
		
 $query=$this->db->query("select * from magazine where mag_id='".$id."'");
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
'name' => $_POST['name'],
'description' => $_POST['description'],
'status' => $_POST['status']




);

$this->db->where('mag_id', $_POST['mag_id']);
$this->db->update('magazine', $data_insert);
	 
	    redirect('admin/magazine');
	  }
	  
	  public function add_mag_new()
	  { 
	/*  $odate=$_POST['cdate'];
	  if(empty($_POST['cdate'])){
		  $odate=date('Y-m-d');
		  }*/
	  
	 $data_insert = array(
'name' => $_POST['name'],
'description' => $_POST['description'],
'status' => $_POST['status']




);


$this->db->insert('magazine', $data_insert);
	 
	    redirect('admin/magazine');
	  }

	
 }
 