 <?php
class Home_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	
	 public function get_userbyid($user_id){
	   
       $row = $this->db->query("select * from user where user_id = '".$user_id."' and status='1'");
    
	$row_result = $row->result_array();
	  return $row_result[0]; 
	  
	 }
	 
	 
	 
	 public function findamount()
{
	$data = $this->session->userdata('pay_id');
   $query1 = $this->db->query("SELECT amount FROM subscription WHERE payment_id = '".$data."'");
$row1 = $query1->result_array();
	return $row1[0];
}
	
	public function get_extra($data)
	{
		$row = $this->db->query("select * from fredetail where fr_code = '".$data."'");   
		$row_result = $row->result_array();
		// print_r($row_result);die;
	  	return $row_result[0]; 
	}
					
	 public function update_user($user_id,$data=array()){
	 
	 $this->db->where('user_id', $user_id);
	 $this->db->where('status', "1");
     $this->db->update('user', $data);
	  return true;
	 }
	 
	 public function update_fore($data1){
		//echo'<pre>'; print_r($data1);	print_r($data2); die;
			 $this->db->query("update subscription set status = 1 where payment_id = '".$data1."'");
	  return true;
	 }


	 public function get_data($table)
	 {
		  if($table!="magazine_sub"){
	  $row = $this->db->query("select * from ".$table ." where status='1'");
		  }		 else  {
			   $row = $this->db->query("select * from ".$table ." ");
		  }	
	  $result = $row->result_array();
	 return $result; 
	 
	 }
	 
	
	
	 public function get_edibyid($id)
	 {
	  $row = $this->db->query("select * from  magazine_sub where parentid ='".$id."'");
	  
	  $row_data =$row->result_array(); 
	  
      return $row_data;
	 
	 }
	 
	 
	public function mysubscriptions($id){
	
       $row = $this->db->query("select  * from  subscription where user_id ='".$id."' ");  
   $row_result = $row->result_array();  
	  
	   return  $row_result;
	   
      }
	  
	  public function mysubscribedissue($magid){
	
       $row = $this->db->query("select  * from  subscription as s join magazine_sub as m on s.mag_id=m.mag_id where s.mag_id ='".$magid."' and s.user_id='".$this->session->userdata('id')."' and s.status='2'");  
	  
	  
   $row_result = $row->result_array();  
	  

	  
	   return  $row_result;
	   
      }
	  
	   public function get_magazines(){
		   
		   $data = $this->home_model->mysubscriptions($this->session->userdata('id'));
		  
		  // echo "size = ".sizeof($data);die;
		   
		   $result=$res=array();
		   
		   
		   if(sizeof($data)!=0){
	       foreach($data as $key=>$val)
		   {
			   foreach($val as $k=>$v)
		   {
			   if($k=='mag_id'){
			$res['magzaine'][] = $v ;
			   }
		   }
		   }}
		  // print_r($res);
		  if(sizeof($res)!=0){
	      $sql=$this->db->query("select * from magazine where mag_id NOT IN (".implode(",",$res['magzaine']).")");
			}
		else {
	  $sql=$this->db->query("select * from magazine");
		
			}
		  $result=$sql->result_array();
//echo "<pre>";print_r($result); die;
		  return $result;
       
		   
	  }
	  
	  
	  public function update_subscription($payid){
		   $data=array(
		   'status' => '1',
		   );
    $this->db->where('pay_id', $payid);
     $this->db->update('payments',$data );
	  return true;
		  
		  }
		  
		  
		 public function loadissue(){		
		$query=$this->db->query("select DISTINCT issue_num,issue_name from magazine_sub where parentid ='".$_POST['parentid']."'");		
		$row=$query->result_array();		
		return $row;
	}	
	  
	public function addsubsciption()
	  {	
	 $limit = sizeof($_POST['email']);
	  $parentid = $_POST['parentid'];
	 for($i=0; $i<$limit; $i++)
		{
			$page[$i] = array("email" => $_POST['email'][$i], "mobile" => $_POST['mobile'][$i], "name" => $_POST['name'][$i], "magazine" => $_POST['magazine'][$i], "lang" => $_POST['lang'][$i], "issue" => $_POST['issue'][$i],  "amount" => $_POST['total'][$i]);
		}
		$unq = uniqid();
			$datai = array(
			'user_id' => $parentid,
			'amount' => $_POST['finaltotal_amount'],
			'payment_id' => $unq
			);
			$this->db->insert('subscription', $datai);
			$isparent = $this->db->insert_id();

	 // echo'<pre>';print_r($_POST); die;
		$passw = uniqid();
		$encrpass = md5($passw);
		for($i=0; $i<$limit; $i++)
		{
			
			if($this->session->userdata('role')=='franchise')	
				{
						$code = "F_".uniqid(); 
				}
			else if($this->session->userdata('role')=='executive') 
				{
						$code = "E_".uniqid(); 
				}
			$data_insert = array(
												'email_id' => $page[$i]['email'],
												'subscription' => $page[$i]['magazine'],
												'duration' => $page[$i]['issue'],
												'lang' => $page[$i]['lang'],
												'name' => $page[$i]['name'],
												'mobile' => $page[$i]['mobile'],
												'status' => 1,
												'password' => $encrpass,
												'regiid' =>$this->session->userdata('id'),
												'payid' => $unq,
												'role' => 'subscriber',	
												'code' => $this->session->userdata('id'),							
											);
							
			$this->db->insert('user', $data_insert);
			$to = $page[$i]['email'];
				$subject = "Welcome Mail";				
				$message = "
				<html>
				<body>
					<table>
							<tr>
								<p>Welcome ".$page[$i]['name']." to the family of E-Magazine</p><br/>
								<p>your <strong>Usename</strong> is ".$page[$i]['email'].
								"<p><strong>Password</strong> is ".$passw."</p>
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
				mail($to,$subject,$message,$headers);
			
			$data = array(
			'user_id' => $this->db->insert_id(),
			'parentid' => $isparent,
			'tracking' => $parentid,
			'mag_id' => $page[$i]['magazine'],
			'edition_id' => 1,
			'payment_id' => $unq,
			'start_time' => date('Y-m-d'),
			'end_time' => date('Y-m-d', strtotime("+".$page[$i]['issue']." months")),
			//date('Y-m-d','+'.$page[$i]['issue'].' months'),
			'duration' => $page[$i]['issue'],
			'status'=>'1',
			'amount' => $page[$i]['amount'],
			
			  );
			$this->db->insert('subscription',$data);
			
			$details=array();
			
			
		  foreach($_POST as $ky=>$dt)
		  {
					if($ky=='offline' || $ky=='modate' || $ky=='amount' || $ky=='ddnum' || $ky=='transid' )
					{
						if($dt!=''){
						$details[$ky]=$dt;
						}
					}else if($ky=='sendername1' || $ky=='sendername2')
					{
							$ky='sendername';			
							if($dt!='')
							{
								$details[$ky]=$dt;
							}
					}   
			}
			if(isset($_POST['paym']))
			{
					$payment_details = serialize($details);
					$insert_pay=array('pay_id'=>$unq,'paym'=>$_POST['paym'],'payment_details'=>$payment_details,'user_id'=>$this->db->insert_id(),'date'=>date('Y-m-d'));			
					$this->db->insert('payments',$insert_pay);
			}
		}
	  redirect('Flogin?act=adduser');
	  }
	public function mysubscriber($emailid){
		echo $emailid;
	}
	public function addonlysubsciption0()
	  {	 
	  //echo'<pre>';print_r($_POST);die;
	  		$parentid = $_POST['parentid'];
	 		$email = $_POST['email'];			
			$payid = uniqid();
					$datai = array(
					'user_id' => $parentid,
					'payment_id' =>$payid,
					'amount' => $_POST['totalformag'],
					);
			$this->db->insert('subscription', $datai);
			$isparent = $this->db->insert_id();		
			
			$query=$this->db->query("select user_id from user where email_id ='".$email."'");		
			$row = $query->result_array();
			$uid = $row[0]['user_id'];	
			
			$data = array(
			'user_id' => $uid,
			'parentid' => $isparent,
			'tracking' => $parentid,
			'mag_id' => $_POST['submag'],
			'renew' => 1,
			'edition_id' => 1,
			'payment_id' => $payid,
			'start_time' => date('Y-m-d'),
			'end_time' => date('Y-m-d', strtotime("+".$_POST['duration']." months")),
			//date('Y-m-d','+'.$page[$i]['issue'].' months'),
			'duration' => $_POST['duration'],
			'status'=>'1',
			'amount' => $_POST['totalformag'],
			
			  );
			  //0print_r($this->db->insert('subscription',$data));die;
			  $this->db->insert('subscription',$data);
			  
			  if(isset($_POST['offline']))
			  {
					if($_POST['offline'] == 'MoneyOrder')	
					 {
							$detail['offline'] = $_POST['offline'];
							$detail['amount'] = $_POST['amount'];
							$detail['date'] = $_POST['date'];
							$detail['sname'] = $_POST['sendername1'];
							$data = serialize($detail);
					 }
					 else if($_POST['offline'] == 'DemandDraft')	
					 {
						   $detail['offline'] = $_POST['offline'];
							$detail['amount'] = $_POST['amount'];
							$detail['ddnum'] = $_POST['ddnum'];
							$detail['sname'] = $_POST['sendername2'];
							$data = serialize($detail);
					 }
					 else if($_POST['offline'] == 'BankDeposite')	
					 {
							$detail['offline'] = $_POST['offline'];
							$detail['amount'] = $_POST['amount'];
							$detail['txid'] = $_POST['tensid'];
							$detail['date'] = $_POST['date'];
							$data = serialize($detail);
					 }
					 
	    		$this->db->query("insert into payments set pay_id = '".$payid."', paym = '".$_POST['paym']."',
																	  payment_details = '".$data."', user_id = '".$parentid."' ");	
			  }
		
			 redirect('mysubscription?act=userupdated');
	  }
	  public function addonlysubsciption()
	  {	
	 $limit = sizeof($_POST['newmag']);
	//echo'<pre>';print_r($_POST);die;
	  $parentid = $_POST['frenchid'];
	  $email = $_POST['email'];
	 for($i=0; $i<$limit; $i++)
		{
			$page[$i] = array("magid" => $_POST['newmag'][$i], "duration" => $_POST['issue'][$i], "payamount" => $_POST['amount'][$i]);
		}
		//echo'<pre>';print_r($page);die;
		$payid = uniqid();
			$datai = array(
			'user_id' => $parentid,
			'payment_id' =>$payid,
			'amount' => $_POST['total'],
			);
			$this->db->insert('subscription', $datai);
			$isparent = $this->db->insert_id();			
			//print_r($email);die;
		$query=$this->db->query("select user_id from user where email_id ='".$email."'");		
		$row = $query->result_array();
		$uid = $row[0]['user_id'];
		
		for($i=0; $i<$limit; $i++)
		{
			$data = array(
			'user_id' => $uid,
			'parentid' => $isparent,
			'tracking' => $parentid ,
			'mag_id' => $page[$i]['magid'],
			'renew' => 1,
			'edition_id' => 1,
			'payment_id' => $payid,
			'start_time' => date('Y-m-d'),
			'end_time' => date('Y-m-d', strtotime("+".$page[$i]['duration']." months")),
			//date('Y-m-d','+'.$page[$i]['issue'].' months'),
			'duration' => $page[$i]['duration'],
			'status'=>'1',
			'amount' => $page[$i]['payamount'],
			
			  );
			
			$this->db->insert('subscription',$data);
		}
		if(isset($_POST['offline']))
			  {
					if($_POST['offline'] == 'MoneyOrder')	
					 {
							$detail['offline'] = $_POST['offline'];
							$detail['amount'] = $_POST['amount'];
							$detail['date'] = $_POST['date'];
							$detail['sname'] = $_POST['sendername1'];
							$data = serialize($detail);
					 }
					 else if($_POST['offline'] == 'DemandDraft')	
					 {
						   $detail['offline'] = $_POST['offline'];
							$detail['amount'] = $_POST['amount'];
							$detail['ddnum'] = $_POST['ddnum'];
							$detail['sname'] = $_POST['sendername2'];
							$data = serialize($detail);
					 }
					 else if($_POST['offline'] == 'BankDeposite')	
					 {
							$detail['offline'] = $_POST['offline'];
							$detail['amount'] = $_POST['amount'];
							$detail['txid'] = $_POST['tensid'];
							$detail['date'] = $_POST['date'];
							$data = serialize($detail);
					 }
					 
	    		$this->db->query("insert into payments set pay_id = '".$payid."', paym = '".$_POST['paym']."',
																	  payment_details = '".$data."', user_id = '".$parentid."' ");	
			  }
	  redirect('mysubscription?act=userupdated');
	  }
	  
	 public function get_subscriber($id,$mail=''){
		 if($mail==''){
     $row = $this->db->query("select * from user where role='subscriber' and status='1' and code='".$id."'");
		 }else if($mail!=''){
     $row = $this->db->query("select * from user where role='subscriber' and status='1' and code='".$id."' and email_id='".$mail."'");
		 }
	 $row_result = $row->result_array();
	// print_r($row_result); die;
       return $row_result; 
	 }  
	
	public function mysubs($id){	 
		
		$sql = $this->db->query("select * from user where email_id='".$id."' and code='".$this->session->userdata('id')."'");
		$result=$sql->result_array();
		
		return $result;
	 }
	 
	 public function subs(){
		 
		$sql = $this->db->query("select * from subscription as s join user as u where u.email_id='".$id."' and code='".$this->session->userdata('id')."'");
		$result=$sql->result_array();
	    return $result;
		 	}
	 public function get_magazine($data){
	 		$row = $this->db->query("select distinct subscription.mag_id, user.email_id from subscription LEFT JOIN user on subscription.user_id = user.user_id  where  user.email_id = '".$data."' && subscription.status = 1");
			$row_result = $row->result_array();	
			 return $row_result; 
       //print_r($row_result);die;  
	 }
	 
	  public function get_magbyid($id)
	 {
	  $row = $this->db->query("select * from  magazine where mag_id = ".$id." and status='1'");
	 $row_data =$row->result_array(); 
	 //print_r($row_data[0])	 ;die;
      return $row_data[0];	 
	 }
	 
	 public function get_newmag($data){
	 $row = $this->db->query("SELECT m.mag_id, m.name, m.price FROM magazine AS m WHERE m.mag_id NOT IN ( SELECT subscription.mag_id FROM subscription LEFT JOIN user AS u ON subscription.user_id = u.user_id  WHERE u.email_id =  '".$data."' )");
     $row_result = $row->result_array();
	// print_r($row_result);die;
	 //print_r($row_result); die;
       return $row_result; 
	 }
	 public function paymentdeatil($id){	 
	$var = $this->db->query("select * from payments as p join subscription as s on p.pay_id=s.payment_id where p.pay_id = '".$id."'");
	 $result  = $var->result_array();
	  return $result;
	 }
public function get_payment($id){	
//print_r($id); print_r($_POST);die;
	$var = $this->db->query("select sub_id, parentid, payment_id, amount from subscription where tracking = ".$id." and status = 1");
	 $result  = $var->result_array();
	//echo'<pre>';print_r($result);die;
	  return $result;
	 }
	 public function findpayback($data)
	 {
			$var = $this->db->query("SELECT amount FROM payouts WHERE payid = '".$data."' and f_code = '".$this->session->userdata['code']."'");	 
			$result = $var->result_array();
			//echo'<pre>';print_r($result);die;
			$qw =@ $result[0]['amount'];
			return $qw;
	 }
	public function tr_exec()
	{		
		$start =  $_POST['sdate']; $end = $_POST['edate'];
	while (strtotime($start) <= strtotime($end)) {
   		$var0 = $this->db->query("SELECT * from subscription where start_time = '".$start."'	and tracking = 1 and status IN ('0','2')"); 
				if($var0->num_rows > 0)
				{				
				$vrar[$start] = $var0->result_array();
				}
    $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
}
		/*//print_r("SELECT * from subscription where start_time between '".$_POST['sdate']."' and '".$_POST['edate']."' 	and tracking = 1");die;
		
				$var0 = $this->db->query("SELECT * from subscription where start_time between '".$_POST['sdate']."' and '".$_POST['edate']."' 	and tracking = 1"); 
				$vrar = $var0->result_array();*/
			//echo'<pre>';print_r($vrar);die;
		echo json_encode($vrar);
	}
public function tr_french(){	
	//print_r("SELECT s.payment_id, s.start_time, s.amount, p.payment_details FROM subscription as s LEFT JOIN payments as p ON s.payment_id = p.pay_id WHERE s.start_time BETWEEN  '".$_POST['sdate']."' AND '".$_POST['edate']."' AND s.tracking = '".$_POST['fid']."'");die; 	 
	$var = $this->db->query("SELECT s.payment_id, s.start_time, s.amount, s.status, p.payment_details FROM subscription AS s LEFT JOIN payments AS p ON s.payment_id = p.pay_id WHERE s.start_time BETWEEN  '".$_POST['sdate']."' AND '".$_POST['edate']."' AND s.tracking = '".$_POST['fid']."'");
	$result = $var->result_array();
	//echo'<pre>';print_r($result);
	foreach($result as $k=>$data)
	{
		if($this->session->userdata['role']=='franchise'){
		$result[$k]['payouts'] = $this->findpayback($data['payment_id']);}
		$result2 = $data['payment_details'];		
		$result[$k]['payment_details'] = unserialize($result2);
	}
	//echo'<pre>';print_r($result);echo'</pre>';
	echo json_encode($result);//die;
	
	//return json_encode($result);
	 }
	 /*?>subscription.user_id, subscription.payment_id, subscription.start_time, subscription.end_time <?php */ 
  
 
	public function find_date(){	 
	$var = $this->db->query("select created_date from user where user_id=".$this->session->userdata['id']);
	$result  = $var->result_array();
	//print_r($result[0]['created_date']);
	return $result[0]['created_date'];
	 }
	 
	public function getupdates(){	 
//print_r("select payment_details from payments where pay_id='".$_POST['payid']."'");
	
			$var = $this->db->query("select payment_details from payments where pay_id='".$_POST['payid']."'");
			$result = $var->result_array();	
			
		//echo'<pre>';print_r($result);die;
			$newvar = unserialize($result[0]['payment_details']);
			echo json_encode($newvar);
	return $newvar;
	 }

        public function getupdatesfore(){	 
			$var = $this->db->query("select amount from subscription where payment_id='".$_POST['payid']."'");
			$result  = $var->result_array();
//print_r($result);die;				
			echo json_encode($result[0]);
	//return $result[0]['amount'];
	 }


	public function checkinguser()
	{//print_r($_POST);die;
			$var = $this->db->query("select *  from user where email_id='".$_POST['email']."'");	
			
			$result  = $var->num_rows();		
			print_r($result);die;	
			if($result > 0){
				echo  1;
				}
			else{
				echo 0;
				}
	}
	
	public function find_subs(){
		
			$var0 = $this->db->query("select name from magazine");			
			$res = $var0->result_array();
			foreach($res as $mag)	{
			$var1= $this->db->query("select s.user_id,m.name,s.duration  from subscription as s JOIN magazine as m on s.mag_id = m.mag_id where s.tracking ='".$this->session->userdata('id')."' and s.start_time = '".$_POST['data']."' and  s.renew = '0' and s.status = '2' and m.name = '".$mag['name']."'");	
			$raw[]= $var1->result_array();
			}		
			//echo "<pre>";print_r($raw);
			foreach($raw as $key=>$dt)
					{	$dur =0;	
					$duration= 0;				
						if(sizeof($dt) > 1)
						{							
							foreach($dt as $t)
							{	
								$name =$t['name'];
								$duration += $t['duration']; 
							}			
								$vrar[0][$key]['name'] = $name;
								$vrar[0][$key]['subscription'] = sizeof($dt);
								$dur += $duration;
								$vrar[0][$key]['duration'] =$dur; 			
						}
						else if(sizeof($dt) ==1)
						{
							$vrar[0][$key]['name'] = $dt[0]['name'];
							$vrar[0][$key]['subscription'] = 1;
							$vrar[0][$key]['duration'] = $dt[0]['duration']; 
						}
						
					}
			
			
			$var9 = $this->db->query("select name from magazine");			
			$res1 = $var9->result_array();
			
			foreach($res1 as $mag1)	{	
			
		    $var2 = $this->db->query("select s.user_id,m.name,s.duration  from subscription as s JOIN magazine as m on s.mag_id = m.mag_id where s.tracking ='".$this->session->userdata('id')."' and s.start_time = '".$_POST['data']."' and  s.renew = '1'  and s.status = '2'  and m.name = '".$mag1['name']."'");	
			$raw1= $var2->result_array();			
			}
			if($raw1 !=NULL)
			{
			foreach($raw1 as $key2=>$dt2)
					{	$dur2=0;	
					$duration2= 0;						
						if(sizeof($dt2)>1)
						{
							foreach($dt2 as $t2)
							{	
								$name2 =$t2['name'];
								$duration2 += $t2['duration']; 
							}			
								$vrar['1'][$key2]['name'] = $name2;
								$vrar['1'][$key2]['subscription'] = sizeof($dt2);
								$dur2 += $duration2;
								$vrar['1'][$key2]['duration'] =$dur2; 			
						}
						else if(sizeof($dt2)==1)
						{
							$vrar['1'][$key2]['name'] = $dt2[0]['name'];
							$vrar['1'][$key2]['subscription'] = 1;
							$vrar['1'][$key2]['duration'] = $dt2[0]['duration']; 
						}						
					}
			}
			else
			{
				$vrar['1'][0]['name'] = 0;
				$vrar['1'][0]['subscription'] = 0;
				$vrar['1'][0]['duration'] = 0;
			}
			$var3 = $this->db->query("select pay_id,payment_details from payments where user_id = '".$this->session->userdata('id')."'");
			if($var3->result_array() != NULL)
				{
					$vrar[] = $var3->result_array();				
					foreach(@$vrar[2] as $kal=>$val)
					{
					  $arr = unserialize($vrar[2][$kal]['payment_details']);
					  $vrar[2][$kal]['amount']=$arr['amount'];
					}
				}
				else
				{
					$vrar[2][0]['pay_id']=0;
					$vrar[2][0]['amount']=0;
				}
			$var4 = $this->db->query("select payment_id,amount  from subscription where tracking ='".$this->session->userdata('id')."' and start_time = '".$_POST['data']."' and status = '1'");
			if($var4->result_array() != NULL)
				{
					$vrar[] = $var4->result_array();
				}
				else
				{
					$vrar[3][0]['payment_id']=0;
					$vrar[3][0]['amount']=0;
				}			
			$var5 = $this->db->query("select tid,amount  from payouts where f_code ='".$this->session->userdata('code')."'");
			if($var5->result_array() != NULL)
				{
					$vrar[] = $var5->result_array();
				}
				else
				{
					$vrar[4][0]['tid']=0;
					$vrar[4][0]['amount']=0;
				}
			$varxx = $this->db->query("select u.user_id, u.email_id, u.name, u.mobile, s.mag_id, s.duration from user AS u LEFT JOIN subscription AS s on u.user_id = s.user_id where s.status=2 and u.created_date = '".$_POST['data']."' and u.code = '".$this->session->userdata['id']."'");
			
				if($varxx->result_array() != NULL)
				{
					$vd = $varxx->result_array();
					foreach($vd as $k=>$d)
					{ 				
						$n= $this->get_magbyid($d['mag_id']);
						$vd[$k]['mag_name'] = $n['name'];
					}
					$vrar[] = $vd;
				}
				else
				{
					$vrar[5][0]['user_id']=0;
					$vrar[5][0]['email_id']=0;
					$vrar[5][0]['name']=0;
					$vrar[5][0]['mobile']=0;
					$vrar[5][0]['mag_id']=0;
					$vrar[5][0]['duration']=0;
				}			
		
		
	echo json_encode($vrar);
	}
	public function find_subs1(){
		//print_r("select email_id, name, mobile from user where created_date = '".$_POST['data']."' and code = '".$this->session->userdata('id')."'");die;						
			$varxx = $this->db->query("select DISTINCT u.user_id, u.email_id, u.name, u.mobile, s.mag_id, s.duration from user AS u LEFT JOIN subscription AS s on u.user_id = s.user_id where s.status=2 and u.created_date = '".$_POST['data']."' and u.code = '".$this->session->userdata['id']."'");
//print_r("select DISTINCT u.user_id, u.email_id, u.name, u.mobile, s.mag_id, s.duration from user AS u LEFT JOIN subscription AS s on u.user_id = s.user_id where s.status=2 and u.created_date = '".$_POST['data']."' and u.code = '".$this->session->userdata['id']."'");
			$v = $varxx->result_array();
			foreach($v as $k=>$d)
			{ 
			
				$n = $this->get_magbyid($d['mag_id']);
				$v[$k]['mag_name'] = $n['name'];
			}
			$vrar[] = $v;
		//echo'<pre>';print_r($vrar);
	echo json_encode($vrar);
	}
	
	
	
	public function last_regi_id(){
		$sql=$this->db->query("select regiid from user order by user_id DESC");
		$result=$sql->result_array();
		
		if(isset($result[0]['regiid'])){
		$regi_id = $result[0]['regiid'];
		$pre = substr($regi_id,-4);
       $var = $pre+1;
		}else{
			$var = '1111';
		}
        return $var;
		}


		public function updatemail_model()
		{
			$datai = array(
			'sub_code' => $this->session->userdata['code'],
			'old_mail' =>$_POST['uid'],
			'new_mail' => $_POST['mail'],
			'status' => '0',
			'date' => date('Y-m-d')
			);
			if($this->db->insert('id_modify', $datai))
			{
				echo '1';
			}
			
		}
		public function detail(){
		  $arr['subs']=$this->home_model->find_subs();
	}
public function notification($table){

$sql=$this->db->query("select count(*) from ".$table." where notification=0");
$result=$sql->fetch_result();
return $result['count'];
}
}