<?php

 class Editstockinrent_model extends CI_Model {

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
		 
   $query=$this->db->query("select * from stoct_in_rent where sr_id='".$id."'");
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
	   /*echo $dt.$id; die;*/
	 $this->db->query("update stoct_in_rent set d_id='".$_POST['dname']."',r_price='".$_POST['price']."',no_of_begs='".$_POST['bags']."',opc_ppc='".$_POST['opc_ppc']."',t_nt='".$_POST['t_nt']."',g_id='".$_POST['gd']."',date='".$dt."',new_date='".$ndt."' where sr_id=".$id);

	 redirect('admin/stockinrent');
	  }
	  
 }