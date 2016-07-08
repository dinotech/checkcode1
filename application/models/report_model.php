<?php

 class Report_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function dlr() 
      {
		$com=$this->db->query("select * from dealer_info");
		return $com->result_array();
	  }	
	
	public function get_row(){
		
 $query=$this->db->query("select * from godown_info");
 $row[]=$query->result_array();
 
	return $row;
	}
  
  public function sales() 
      { 
	 // echo "select * from sales sp join godown_info gi join dealer_info p where new_date BETWEEN '".$_POST['startdate']."' AND '".$_POST['enddate']."' and gi.g_id=sp.g_id and p.dealer_id = sp.d_id"; die;
	  $com=$this->db->query("select * from sales sp join godown_info gi join dealer_info p where new_date BETWEEN '".$_POST['startdate']."' AND '".$_POST['enddate']."' and gi.g_id=sp.g_id and p.dealer_id = sp.d_id");
		return $com->result_array();
	  }	
	
  public function stock_purchase() 
      {
		$com=$this->db->query("select * from stock_purchase sp join godown_info gi join dealer_info p where new_date BETWEEN '".$_POST['startdate']."' AND '".$_POST['enddate']."' and gi.g_id=sp.g_id and p.dealer_id = sp.d_id");
		return $com->result_array();
	  }	
	  
  public function stock_rent() 
      {
		$com=$this->db->query("select * from stoct_in_rent sp join godown_info gi join dealer_info p where new_date BETWEEN '".$_POST['startdate']."' AND '".$_POST['enddate']."' and gi.g_id=sp.g_id and p.dealer_id = sp.d_id");
		return $com->result_array();
	  }		
	
 public function insert_row()
	  {
	/* echo "insert function"; die;
 $data_insert = array(
's_name' => $_POST['sname'],
's_address' => $_POST['address'],
's_city' => $_POST['city'],
's_state' => $_POST['state'],
'd_id' => $_POST['dname']
);
$this->db->insert('site_info', $data_insert);*/
		
		redirect('admin/report');
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