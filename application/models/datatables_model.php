<?php

 class Datatables_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row($start){
		//$start=0;
		$limit=10;
		
 $query=$this->db->query("select * from user order by user_id asc    ");
 $row[]=$query->result_array();
 
 
   return $row;
		
	}
	
	
 public function insert_row()
	  { 
	  $odate=$_POST['cdate'];
	  if(empty($_POST['cdate'])){
		  $odate=date('Y-m-d');
		  }
	  
	 $data_insert = array(
'd_name' => $_POST['dname'],
'd_address' => $_POST['address'],
'phone' => $_POST['phone'],
'mobile' => $_POST['mobile'],
'cur_date' => $odate//$_POST['cdate']
);
$this->db->insert('party', $data_insert);
	 /* dealer_info redirect('admin/dealer');*/
	    redirect('admin/party');
	  }
	  
 public function delete_row()
	  {  $id=$id =$this->input->get('id', TRUE); 
	  
	  $this->db->where('dealer_id',$id);
	  /* $this->db->delete('dealer_info');  */
      $this->db->delete('party');
	  redirect('admin/party'); 
	 
	  }
	  
	   public function get_subs($user)	   
	  {  
	     $sql = "Select * from user where role = '".$user."'";
                $val = $this->db->query($sql);
				$row[]= $val->result_array();
                 return $row;				
         //redirect('admin/datatables'); 	 
	  }
	  
	  
	   public function searching()	   
	  {
		  if($_POST['obj']=='Co')
		  {
			  	$sql = "Select user_id,code,name,city,status from user where country LIKE '%".$_POST['item']."%' && role='".$_POST['user']."'";
                $val = $this->db->query($sql);
		  }
		  if($_POST['obj']=='St')
		  {
			  	$sql = "Select user_id,code,name,city,status from user where state LIKE '%".$_POST['item']."%' && role = '".$_POST['user']."'";
                $val = $this->db->query($sql);
		  }
		  if($_POST['obj']=='Ci')
		  {
			  	$sql = "Select user_id,code,name,city,status from user where  city LIKE '%".$_POST['item']."%' && role = '".$_POST['user']."'";
                $val = $this->db->query($sql);
		  }
		  if($_POST['obj']=='Ac')
		  {
			  	$sql = "Select user_id,code,name,city,status from user where  status='1' && role = '".$_POST['user']."'";
                $val = $this->db->query($sql);
		  }
		  if($_POST['obj']=='In')
		  {
			  	$sql = "Select user_id,code,name,city,status from user where  status='3' && role = '".$_POST['user']."'";
                $val = $this->db->query($sql);
		  }
 				$row= $val->result_array();
			//	echo'<pre>';print_r($row);
               echo json_encode($row)			;
	  }
	   public function get_french($user)	   
	  {  
	     $sql = "Select * from user where role = '".$_POST['user']."'";
                $val = $this->db->query($sql);
				$row[]= $val->result_array();
                 return $row;				
         //redirect('admin/datatables'); 	 
	  }
	
	public function editinguser()
	{
			$sql = $this->db->query("update user set status = 3 where user_id = ".$_POST["exeid"]);
			redirect('admin/createlogin/manage_users?user=franchise');
	}
 }