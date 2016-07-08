<?php

 class EditUser_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row($id){
 		$query=$this->db->query("select * from user AS u LEFT JOIN fredetail AS f on u.code = f.fr_code where u.user_id='".$id."'");
		$row[]=$query->result_array();		
   		return $row;
	}
	
	
 public function insert_row()
	  { 
	/*  $odate=$_POST['cdate'];
	  if(empty($_POST['cdate'])){
		  $odate=date('Y-m-d');
		  }*/
	  
	 $data_insert = array(
'name' => $_POST['name'],
'password' => $_POST['password'],
'email_id' => $_POST['emailid'],
'subscription' => $_POST['subscription'],
'duration' => $_POST['duration'],
'city' => $_POST['city'],
'payment_method' => $_POST['paymethod'],
'regiid' => $_POST['regid'],
'payid' => $_POST['paymentid'],
'role' => $_POST['role'],
'status' => $_POST['status']


);

$this->db->where('user_id', $_POST['user_id']);
$this->db->update('user', $data_insert);
	 
	    redirect('admin/datatables');
	  }
	  
	  public function add_user_new()
	  { 
	  
	  if($_POST['role']=='franchise'){ $code="F_".uniqid();  }
	  else if($_POST['role']=='executive'){ $code="E_".uniqid();  }
	  
	//  print_r($_POST); die;
	  
	    $country = $_POST['country'];
		$state  = $_POST['state'];
		
	        $cc = substr($country, 0, 2);
			$sc = substr($state, 0, 2);

	      $regiid=strtoupper($cc." ".$sc." ".uniqid());
		  $payid = uniqid();
	  
	  
	  
	 $data_insert = array(
'name' => $_POST['name'],
'password' => md5($_POST['password']),
'email_id' => $_POST['emailid'],
/*'subscription' => $_POST['subscription'],
'duration' => $_POST['duration'],
*/'city' => $_POST['city'],
'payment_method' => $_POST['paymethod'],
'regiid' =>  $regiid,
'payid' => $payid ,
'role' => $_POST['role'],
'code' => $code, 
'status' => $_POST['status']
);


$this->db->insert('user', $data_insert);
	 
	    redirect('admin/datatables');
	  }

 public function add_franchisenew()
	  { 
		//echo'<pre>';print_r($_POST); die;
		  $regi_id = $this->home_model->last_regi_id();
		$pre = substr($regi_id,-8);
		$cur = $pre+1;
		  
		$country = $_POST['country'];
		$state  = $_POST['state'];
		$cc = substr($country, 0, 2);
		$sc = substr($state, 0, 2);
		$regiid=strtoupper($cc." ".$sc." ".$cur);
		$payid = uniqid();
		$pass = uniqid();
		if($_POST['rolename']=='franchise')
		{
	 	$data_insert = array(
				'name' => $_POST['fname'],
				'password' => md5($pass),
				'email_id' => $_POST['emailid1'],
				/*'subscription' => $_POST['subscription'],
				'duration' => $_POST['duration'],
				*/
                                'city' => $_POST['city'],
                                'address' => $_POST['addr1'],
                                'pincode' => 0,
                                'district' => 0,
                                'contect_mail' => $_POST['femailid2'],
                                'state' => $_POST['state'],
                                'mobile' => $_POST['fmob1'],
                                'country' => $_POST['country'],
				'payment_method' => 0,
				'regiid' =>  $regiid,
				'payid' => $payid ,
				'role' => 'franchise',
				'code' => $_POST['fcode'], 
				'status' => 1
				);
				$this->db->insert('user', $data_insert);	 			
				$data_insert1 = array(
				'fr_code' => $_POST['fcode'],
				'fr_Name' => $_POST['fname2'],
				'fr_mobile' => $_POST['fmob2'],
				'fr_email' => $_POST['femailid2'],
				'fr_address' => $_POST['faddr2'],
				'fr_accname' => $_POST['faccname'],
				'fr_accno' => $_POST['faccno'],
				'fr_bankname' => $_POST['fbankname'],
				'fr_branch' => $_POST['fbbranch'],
				'fr_ifsc' => $_POST['fifsc'],
				);
				$this->db->insert('fredetail', $data_insert1);				
				
		}
		else if($_POST['rolename']=='executive')
		{
			$data_insert = array(
				'name' => $_POST['fname'],
				'password' => md5($pass),
				'email_id' => $_POST['emailid1'],
				/*'subscription' => $_POST['subscription'],
				'duration' => $_POST['duration'],
				*/'city' => $_POST['city'],
                                'address' => $_POST['addr1'],
                                'pincode' => 0,
                                'district' => 0,
                                
                                'state' => $_POST['state'],
                                'mobile' => $_POST['fmob1'],
                                'country' => $_POST['country'],				
				'payment_method' => 0,
				'regiid' =>  $regiid,
				'payid' => $payid ,
				'role' => 'executive',
				'code' => $_POST['fcode'], 
				'status' => 1,
				'Altnum' => $_POST['fmob3']
				);
				$this->db->insert('user', $data_insert);	 											
		}
				$to = $_POST['emailid1'];
				$subject = "Welcome Mail";				
				$message = "
				<html>
				<body>
					<table>
							<tr>
								<p>Welcome ".$_POST['fname']." to the family of E-Magazine</p><br/>
								<p>your <strong>Usename</strong> is ".$_POST['emailid1'].
								"<p><strong>Password</strong> is ".$pass."</p>
								<h5>CLICK HERE TO GO TO SITE <a href=".BASE_URL." >Emagazine</a></h5>
							</tr>
					</table>
				</body>
				</html>
				";				
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";				
				// More headers
				$headers .= 'From: <e-magazine@itrportfolio.com>' . "\r\n";
				$headers .= 'Cc:'.$_POST['femailid2']. "\r\n";				
				if(mail($to,$subject,$message,$headers)){
				if($_POST['rolename']=='franchise')
				{
				    redirect('admin/createlogin/franchise?action=fr');
				}
				else if($_POST['rolename']=='executive')
				{
					   redirect('admin/createlogin/executive?action=ex');
				}}
	  }
	
	public function allfrench($id){
		
			$query=$this->db->query("select name,user_id from user where role = '".$id."'");
			$row[]=$query->result_array();		
			
   			return $row;	
	}
	
	public function updatedetails()
		{
			$query = $this->db->query("insert into temp set temp_code='".$_POST['idf']."',
																					 temp_name='".$_POST['namef']."',
																					 temp_accname='".$_POST['nameofacc']."',
																					 temp_accno='".$_POST['acno']."',
																					 temp_bankname='".$_POST['bank']."',
																					 temp_bankbranch='".$_POST['branch']."',
																					 temp_bankifsc='".$_POST['ifsc']."'");

				redirect('myaccount?act=acupd');

		}
		public function seedetail()
		{
				$query = $this->db->query("select temp_code, temp_name,date from temp");	
				$row=$query->result_array();	
				//print_r($row);
   			    return $row;	
		}
		public function see_detail()
		{
				$query = $this->db->query("select * from fredetail as f LEFT JOIN temp as t on f.fr_code = t.temp_code where t.temp_code = '".$_GET['fcode']."'");
				$query1 = $this->db->query("select * from user where code = '".$_GET['fcode']."'");	
				$row[]=$query->result_array();$row[]=$query1->result_array();	
   			    return $row;	
				
		}
		public function newupd()
		{
			if($_POST['action']=='Approve')
			{
					$this->db->query("update fredetail set fr_accname ='".$_POST['newaccname']."',
																			  fr_accno ='".$_POST['newaccno']."',
																			  fr_bankname ='".$_POST['newbnkname']."',
																			  fr_branch ='".$_POST['newbrnch']."',
																			  fr_ifsc ='".$_POST['newifsc']."' where fr_code = '".$_POST['updid']."'");
					$this->db->query("delete from temp where temp_code = '".$_POST['updid']."'");														  
					redirect('admin/createlogin/franchise?act=freupd');														  
			}
			else if($_POST['action']=='Reject')			
			{
					$this->db->query("delete from temp where temp_code = '".$_POST['updid']."'");														  
					redirect('admin/createlogin/franchise?act=nofreupd');
			}
		}
		public function edit_user(){
		/* echo "<pre>";
	    print_r($_POST);
	    
		echo " UPDATE `user` SET 
		`name`='".$_POST['name']."',
		`gender`='".$_POST['gender']."',
		`dob`='".$_POST['dob']."',
		`mobile`='".$_POST['mobile']."',
		`address`='".$_POST['address']."',
		`city`='".$_POST['city']."',
		`district`='".$_POST['district']."',
		`state`='".$_POST['state']."',
		`pincode`='".$_POST['pincode']."',
		`country`='".$_POST['country']."'
		 where user_id='".$_POST['user_id']."' ";
 		die;*/
	 

	 $result = $this->db->query(" UPDATE `user` SET 
		`name`='".$_POST['name']."',
		`gender`='".$_POST['gender']."',
		`dob`='".$_POST['dob']."',
		`mobile`='".$_POST['mobile']."',
		`address`='".$_POST['address']."',
		`city`='".$_POST['city']."',
		`district`='".$_POST['district']."',
		`state`='".$_POST['state']."',
		`pincode`='".$_POST['pincode']."',
		`country`='".$_POST['country']."'
		 where user_id='".$_POST['user_id']."' ");
		
		
		if(!$result){
		$arr['error']="Sorry!There gose somthing wrong";
		}else{
		$arr['sucess']="Updated Profile successfully";
		}
			redirect('editprofile',$arr['error']);
		
		}
 }
 