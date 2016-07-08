<?php

 class Admin_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function allowuser(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Direct_Payment']==0)
			{
				redirect('admin');
			}
			}
	}
	public function dofindall()
	 {
		 $row = $this->db->query("select * from payments where newcomings = 0");    	     
		 $row_result['payments'] = $row->num_rows();
		 $row = $this->db->query("select * from user where newcomings = 0");    	     
		 $row_result['users'] = $row->num_rows();
		 $row = $this->db->query("select * from subscription where newcomings = 0");    	     
		 $row_result['subs'] = $row->num_rows();
		 /*$row = $this->db->query("select * from online where newcomings = 0");    	     
		 $row_result['online'] = $row->num_rows();*/
		 
	  	 return $row_result; 
	 }
	 public function allowuserdsubs(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Direct_Subscription']==0)
			{
				redirect('admin');
			}
			}
	}
	public function allowuserfsubs(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Franchise_Subscription']==0)
			{
				redirect('admin');
			}
			}
	}
	public function allowuseresubs(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Executive_Subscription']==0)
			{
				redirect('admin');
			}
			}
	}
	public function allowuserd(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Manage_Subscriber']==0)
			{
				redirect('admin');
			}
			}
	}
	public function allowuserf(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Manage_Franchise']==0)
			{
				redirect('admin');
			}
			}
	}
	public function allowusere(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Manage_Executive']==0)
			{
				redirect('admin');
			}
			}
	}
	public function allowuseraddmagz(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Publish_magazine']==0)
			{
				redirect('admin');
			}
			}
	}
	public function allowuserstopmagz(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Stop_publishing']==0)
			{
				redirect('admin');
			}
			}
	}
	public function allowusercadmin(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Admin_Create']==0)
			{
				redirect('admin');
			}
			}
	}
	public function allowusermadmin(){		
			$query=$this->db->query("select * from super_admin where role = 'superadmin' ");
			$row1 = $query->result_array();
			if(isset($row1[0]['email']) && $row1[0]['email']==$this->session->userdata('a_email')){  }
			else{
			$query=$this->db->query("select * from access_control where name = '".$this->session->userdata['admin_name']."' && email = '".$this->session->userdata['a_email']."'");
			$row = $query->result_array();
			if($row[0]['Admin_Manage']==0)
			{
				redirect('admin');
			}
			}
	}
	 
public function get_row(){
		$query=$this->db->query("select * from admin_user order by id asc ");
		$row[]=$query->result_array();
		return $row;		
}
public function manage_account(){
		$query=$this->db->query("select * from admin_user order by id asc ");
		$row[]=$query->result_array();
		return $row;		
}
	
	
		public function edit_row()
		{
				$query=$this->db->query("select * from admin_user where id=".$_GET['id']);
				$row[]=$query->result_array();
				return $row;			
		}
	
	public function edit_account($id)
	{
		 $query=$this->db->query("select * from admin_user where id='".$id."'");
		 $row[]=$query->result_array();
		 $data=$this->db->query("select * from access_control where name = '".$row[0][0]['username']."' && email = '".$row[0][0]['email']."'");
		 $row[]=$data->result_array();
//echo'<pre>';print_r($row);die;
foreach($row[0][0]  as $k=>$v) {
if($k=='sno' || $k=='name' || $k=='email'){
	 continue;
	 }
else{
	$row[0][1][$k]=$v;
}
}
//echo'<pre>';print_r($row);die;
 return $row;
		
	}
	
	public function access_control(){
		
		$id = $_GET['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$Direct_Payment = 0;$Franchise_Payments = 0;$Executive_Payments = 0;
		$Direct_Subscription = 0;$Franchise_Subscription = 0;$Executive_Subscription = 0;
		$Manage_Subscriber = 0;$Manage_Franchise = 0;$Manage_Executive = 0;$Payment_Upload = 0;
		$Pay_Outs = 0;$Publish_magazine = 0;$Stop_publishing = 0;
		$Archived_publications = 0;$Admin_Create = 0;$Admin_Manage = 0;
		$Act_reg_View = 0;$Act_reg_Edit = 0;
		
		
		for($i=0;$i<count($_POST['checkbox']);$i++){
			
if($_POST['checkbox'][$i] == "Direct_Payment"){$Direct_Payment = 1;}
elseif($_POST['checkbox'][$i] == "Franchise_Payments"){$Franchise_Payments = 1;}
elseif($_POST['checkbox'][$i] == "Executive_Payments"){$Executive_Payments = 1;}
elseif($_POST['checkbox'][$i] == "Direct_Subscription"){$Direct_Subscription = 1;}
elseif($_POST['checkbox'][$i] == "Franchise_Subscription"){$Franchise_Subscription = 1;}
elseif($_POST['checkbox'][$i] == "Executive_Subscription"){$Executive_Subscription = 1;}
elseif($_POST['checkbox'][$i] == "Manage_Subscriber"){$Manage_Subscriber = 1;}
elseif($_POST['checkbox'][$i] == "Manage_Franchise"){$Manage_Franchise = 1;}
elseif($_POST['checkbox'][$i] == "Manage_Executive"){$Manage_Executive = 1;}
elseif($_POST['checkbox'][$i] == "Payment_Upload"){$Payment_Upload = 1;}
elseif($_POST['checkbox'][$i] == "Pay_Outs"){$Pay_Outs = 1;}
elseif($_POST['checkbox'][$i] == "Publish_magazine"){$Publish_magazine = 1;}
elseif($_POST['checkbox'][$i] == "Stop_publishing"){$Stop_publishing = 1;}
elseif($_POST['checkbox'][$i] == "Archived_publications"){$Archived_publications = 1;}
elseif($_POST['checkbox'][$i] == "Admin_Create"){$Admin_Create = 1;}
elseif($_POST['checkbox'][$i] == "Admin_Manage"){$Admin_Manage = 1;}
elseif($_POST['checkbox'][$i] == "Act_reg_View"){$Act_reg_View = 1;}
elseif($_POST['checkbox'][$i] == "Act_reg_Edit"){$Act_reg_Edit = 1;}
else{;}

		}


 $query=$this->db->query("select email from access_control where email='".$email."'");
 //$row[]=$query->result_array();
 if($query->num_rows)
 {
	$query=$this->db->query("UPDATE access_control
SET Direct_Payment='".$Direct_Payment."', Franchise_Payments='".$Franchise_Payments."', Executive_Payments='".$Executive_Payments."', Direct_Subscription='".$Direct_Subscription."', 
Franchise_Subscription='".$Franchise_Subscription."', Executive_Subscription='".$Executive_Subscription."', 
Manage_Subscriber='".$Manage_Subscriber."', Manage_Franchise='".$Manage_Franchise."', 
Manage_Executive='".$Manage_Executive."', Payment_Upload='".$Payment_Upload."', 
Pay_Outs='".$Pay_Outs."', Publish_magazine='".$Publish_magazine."', 
Stop_publishing='".$Stop_publishing."', Archived_publications='".$Archived_publications."', 
Admin_Create='".$Admin_Create."', Admin_Manage='".$Admin_Manage."', 
Act_reg_View='".$Act_reg_View."', Act_reg_Edit='".$Act_reg_Edit."'
WHERE email='".$email."';");

 }else{
	 
	 $query=$this->db->query("INSERT INTO `access_control`(`name`, `email`, `Direct_Payment`, `Franchise_Payments`, `Executive_Payments`, `Direct_Subscription`, `Franchise_Subscription`, `Executive_Subscription`, `Manage_Subscriber`, `Manage_Franchise`, `Manage_Executive`, `Payment_Upload`, `Pay_Outs`, `Publish_magazine`, `Stop_publishing`, `Archived_publications`, `Admin_Create`, `Admin_Manage`, `Act_reg_View`, `Act_reg_Edit`) VALUES ('".$name."','".$email."','".$Direct_Payment."','".$Franchise_Payments."','".$Executive_Payments."','".$Direct_Subscription."','".$Franchise_Subscription."','".$Executive_Subscription."','".$Manage_Subscriber."','".$Manage_Franchise."','".$Manage_Executive."','".$Payment_Upload."','".$Pay_Outs."','".$Publish_magazine."','".$Stop_publishing."','".$Archived_publications."','".$Admin_Create."','".$Admin_Manage."','".$Act_reg_View."','".$Act_reg_Edit."')");
	 }
 
  
   //return $row;
   redirect('admin/admin_profile/manage_account');
		
	}
	
	
 public function update_row()
	  {   
	
	  if(isset($_POST['new_pass'])){
		 
		  $password = $_POST['new_pass'];
		  
		  }else{
			  $password = $_POST['password'];
			
			   }
	  
	 $data_insert = array(
'username' => $_POST['username'],
'email' => $_POST['email'],
'mobile_no' => $_POST['mobile_no'],
'address' => $_POST['address'],
'city' => $_POST['city'],
'district' => $_POST['district'],
'state' => $_POST['state'],
'password' => md5($password),
'role' => $_POST['role'],
'status' => $_POST['status']
);

$this->db->where('id', $_POST['id']);
$this->db->update('admin_user', $data_insert);




 if(isset($_POST['new_pass'])){
		 
$to = $_POST['email'];
$subject = "Your Login Password is reset.";

$txt = '<html><body>Hello dear! Your Login details are changed now. <br />
<h5>
Username: '.$_POST['username'].'</h5><br />
<h5>New Password: '.$password.'<h5><br />
</body></html>';
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: E-magazine@emithra.com"  ;

mail($to,$subject,$txt,$headers);
		  
		  }



	    redirect('admin/admin_profile');
	  }
	  
 public function delete_row()
	  {  $id=$id =$this->input->get('id', TRUE); 
	  
	  $this->db->where('dealer_id',$id);
	  /* $this->db->delete('dealer_info');  */
      $this->db->delete('party');
	  redirect('admin/party'); 
	 
	  }
	  
	   public function add_admin()
	  { 
  	   $country = $_POST['country'];
       $state = $_POST['state'];
	   $cc = substr($country, 0, 2);
	   $sc = substr($state, 0, 2);

	   $regiid=strtoupper($cc." ".$sc." ".uniqid());
	   $password = md5($_POST['password']);
		
	 $data_insert = array(
'email' => $_POST['email'],
'username' => $_POST['name'],
'password' => $password,
'mobile_no' => $_POST['mob_no'],
'country' => $_POST['country'],
'state' => $_POST['state'],

'city' => $_POST['city'],
'pincode' => $_POST['pincode'],
'address' => $_POST['address'],
'regiid' => $regiid,
'role' => $_POST['role'],
'status' => $_POST['status']
);
$this->db->insert('admin_user', $data_insert);

$data_insert = array(
'email' => $_POST['email'],
'name' => $_POST['name'],
);
$this->db->insert('access_control', $data_insert);
	 /* dealer_info redirect('admin/dealer');*/
	    redirect('admin/admin_profile?action=useradded');
	  }
	  
	  
public function uniquemailm(){
		$query=$this->db->query("select id from admin_user where email = '".$_POST['email']."'");
		$row = $query->num_rows;
		echo $row;
	}
public function useraccessmod(){
	$this->db->query("update access_control set Direct_Payment = '0',Franchise_Payments = '0',Executive_Payments = '0',Direct_Subscription = '0',Online_Subscription = '0',Franchise_Subscription = '0',Executive_Subscription = '0',Manage_Subscriber = '0',Manage_Franchise = '0',Manage_Executive = '0',Payment_Upload = '0',Pay_Outs = '0',Publish_magazine = '0',Stop_publishing = '0',Archived_publications = '0',Admin_Create = '0',Admin_Manage = '0',Act_reg_View = '0',Act_reg_Edit = '0' where name = '".trim($_POST['name'])."' && email = '".trim($_POST['email'])."'");
			foreach($_POST['checkbox'] as $data)
			{				
				$this->db->query("update access_control set $data = '1' where name = '".trim($_POST['name'])."' && email = '".trim($_POST['email'])."'");		
			}
	redirect('admin/admin_profile/manage_account?action=accupd');
}	
public function totals(){

$sql1=$this->db->query("select Count(*) as subs from user where role='subscriber' && status=1");
$row['subs'] = $sql1->result_array();
$sql2=$this->db->query("select Count(*) as frnc from user where role='franchise' && status=1");
$row['frnc'] = $sql2->result_array();
$sql3=$this->db->query("select Count(*) as exec from user where role='executive' && status=1");
$row['exec']  = $sql3->result_array();
$sql3=$this->db->query("select Count(*) as mag from magazine where status=1");
$row['mag']  = $sql3->result_array();
return $row;
}
 }