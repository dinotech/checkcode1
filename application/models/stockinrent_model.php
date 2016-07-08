<?php

 class Stockinrent_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
  
  public function gb() 
      {
		$com=$this->db->query("select * from godown_info");
		return $com->result_array();
		
	  }
 
  public function dlr() 
      {
		$com=$this->db->query("select * from dealer_info");
		return $com->result_array();
	  }	  
	
    public function get_row($start){
		//echo '<pre>';print_r($start);die;
		
		//$start=0;
		$limit=10;

 /*$query=$this->db->query("select * from stock_purchase sp join godown_info gi on gi.g_id=sp.g_id join dealer_info p on p.dealer_id = sp.d_id limit ".$start.",".$limit."");
 $row[]=$query->result_array();*/
 
 
            $this->db->from('stoct_in_rent sp'); 
            $this->db->join('godown_info gi', 'gi.g_id=sp.g_id');
            $this->db->join('dealer_info p', 'p.dealer_id = sp.d_id');
			$this->db->limit($limit, $start);
            //$this->db->where('p.album_id',$id);
            //$this->db->order_by('p.date_time','asc');         
            $query = $this->db->get(); 
			$row[]=$query->result_array();
	return $row;
		
	}
	
	
 public function insert_row()
	  { //echo "<pre>"; print_r($_POST); die;
	   date_default_timezone_set('Asia/Calcutta'); 
	   $date = new \Datetime('now');
      // var_dump($date); die;
	  $dt= date('Y-m-d g:i a'); 
      $ndt= date('Y-m-d');
	  
	 $data_insert = array(
'd_id' => $_POST['dname'],
'r_price' => $_POST['price'],
'no_of_begs' => $_POST['bags'],
'opc_ppc' => $_POST['opc_ppc'],
't_nt' => $_POST['t_nt'],
'new_date' => $ndt,
'g_id' => $_POST['gd'],
'date' => $dt,


);
$this->db->insert('stoct_in_rent', $data_insert);

	    redirect('admin/stockinrent');
	  }
	  
 public function delete_row()
	  { 
	  $id=$id =$this->input->get('id', TRUE); 
	  $this->db->where('sr_id',$id);
      $this->db->delete('stoct_in_rent');
	  redirect('admin/stockinrent'); 
	 // redirect('admin/stockpurchase', 'refresh'); 
	 
	  }
	
 }