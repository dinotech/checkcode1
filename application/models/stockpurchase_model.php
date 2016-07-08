<?php

 class Stockpurchase_model extends CI_Model {

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
 
 
            $this->db->from('stock_purchase sp'); 
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
	/*  $this->db->query("insert into stock_purchase(d_id,price,no_of_begs,opc_ppc,t_nt,date_time,g_id) values
	  ('".$_POST['dname']."','".$_POST['price']."','".$_POST['bags']."','".$_POST['opc_ppc']."','".$_POST['t_nt']."','".$dt."','".$_POST['gd']."')");
	  */
	  
	  $data_insert = array(
'd_id' => $_POST['dname'],
'price' => $_POST['price'],
'no_of_begs' => $_POST['bags'],
'opc_ppc' => $_POST['opc_ppc'],
't_nt' => $_POST['t_nt'],
'date_time' => $dt,
'new_date' => $ndt,
'g_id' => $_POST['gd'],

);
$this->db->insert('stock_purchase', $data_insert);

	    redirect('admin/stockpurchase');
	  }
	  
 public function delete_row()
	  { 
	  $id=$id =$this->input->get('id', TRUE); 
	  $this->db->where('source_id',$id);
      $this->db->delete('stock_purchase');
	  redirect('admin/stockpurchase'); 
	 
	 
	  }
	
 }