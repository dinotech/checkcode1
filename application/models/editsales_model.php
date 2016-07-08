<?php

 class Editsales_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function gbq() 
      {
		$com=$this->db->query("select * from godown_info");
		return $com->result_array();
	  }
   
    public function dlr() 
      {
		$com=$this->db->query("select * from dealer_info");
		return $com->result_array();
	  }
	  
   public function get_row(){
		
   $id=$id =$this->input->get('id', TRUE); 
		 
   $query=$this->db->query("select * from sales where sales_id='".$id."'");
   $row=$query->result_array();
   
   return $row;
	
  }
	
public function update_row()
	  {// echo "<pre>"; print_r($_POST);
	  date_default_timezone_set('Asia/Calcutta'); 
	  $date = new \Datetime('now');
      // var_dump($date); die;
	  $dt= date('Y-m-d g:i a'); 
	  $ndt= date('Y-m-d'); 
	  //echo "update function call"; die;
	  $id=$id =$this->input->get('id', TRUE); 
	 
	
$data = array(
'd_id' => $_POST['dname'],
'prices' => $_POST['price'],
'no_of_bags' => $_POST['bags'],
'opc_ppc' => $_POST['opc_ppc'],
't_nt' => $_POST['t_nt'],
'date' => $dt,
'new_date' => $ndt,
'g_id' => $_POST['gd']
);
$this->db->where('sales_id',$id);
$this->db->update('sales',$data);


	 redirect('admin/sales');
	  }
	  
 }