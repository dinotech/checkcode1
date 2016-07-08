<?php 
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mysubscription extends CI_Controller {

 
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index() {
//		echo'<pre>';print_r($_POST);die;
      $arr['page'] ='login';
      if ($this->session->userdata('is_client_login')){
	  $arr['edition']=$this->home_model->get_data('magazine_sub');
	//  $arr['subscriber']=$this->home_model->get_subscriber($this->session->userdata('id'));
	  $arr['magazine']=$this->home_model->get_magazines();
	  $arr['userdata']=$this->home_model->get_userbyid($this->session->userdata('id'));
	  $arr['subscription'] = $this->home_model->mysubscriptions($this->session->userdata('id'));
	     if(trim($this->session->userdata('role'))=='subscriber'){
		  $this->load->view('vwSmysubscription.php',$arr);
		 }else if(trim($this->session->userdata('role'))=='franchise'){
		  $this->load->view('vwMysubscription.php',$arr);
		 }else if(trim($this->session->userdata('role'))=='executive'){
		  $this->load->view('vwEmysubscription.php',$arr);
		 }
		
		}else{
		 redirect('register');
		}
    }
	public function renew_suscription(){
	//echo'123';die;
  $sql =  $this->db->query("select * from subscription where user_id='".$this->session->userdata('id')."' and mag_id='".$_POST['subscription']."'");
	$result=$sql->result_array();
	
	if(sizeof($result)>0){
	 
	 $this->db->query('INSERT INTO `renew`(`sub_id`, `user_id`, `mag_id`, `start_time`, `end_time`, `duration`, `status`) VALUES ("'.$result[0]['sub_id'].'",
	 "'.$result[0]['user_id'].'",
	 "'.$result[0]['mag_id'].'",
	 "'.date('Y-m-d').'",
	 "'.date('Y-m-d',strtotime('+'.$_POST['noofmonth']." months")).'",
	 "'.$_POST['noofmonth'].'",
	 1)');
	 
	 
	 $this->db->query("update subscription set end_time='".date('Y-m-d',strtotime('+'.$_POST['noofmonth']." months"))."'");
	 
	  $details=array();
		  foreach($_POST as $ky=>$dt){
			if($ky=='renewpaym' || $ky=='subscription' || $ky=='noofmonth' )
			{
				continue;
			}else if($ky=='amount1' || $ky=='amount2'){
				$ky='amount';
			}else if($ky=='sendername1' || $ky=='sendername2'){
				$ky='sname';
			}
				if($dt!=''){
				$details[$ky]=$dt;
				}
			}
			$data['payment_details']=serialize($details);
			 $this->db->query("INSERT INTO `payments`(`pay_id`, `paym`, `payment_details`, `product`,`user_id`,`date`) VALUES ('".$result[0]['payment_id']."','".$_POST['renewpaym']."','".$data['payment_details']."','".$_POST['subscription']."','".$result[0]['user_id']."','".date('Y-m-d')."')");	
			 
			$arr['magazine']=$this->home_model->get_magazines();
	        $arr['subscription'] = $this->home_model->mysubscriptions($this->session->userdata('id'));
	        $arr['sucess']="Subscription id sucessfull";
			$this->load->view('vwSmysubscription.php',$arr);
	}
	 
	}
	public function new_suscription(){
		
	
		
		$payid=uniqid();
    	$sql2 ="INSERT INTO  `subscription`(`user_id`, `mag_id`, `start_time`, `end_time`, `duration`, `status`, `payment_id`) VALUES ('". $this->session->userdata('id')."','".$_POST['newsubscription']."','".date('Y-m-d')."','".date('Y-m-d',strtotime("+".$_POST['newnofmonth']." months"))."','".$_POST['newnofmonth']."',0,'".$payid ."')";
    
		if($this->db->query($sql2)){
		  $sql13=$this->db->query("INSERT INTO `transaction_register`(`date`, `time`, `usercode`, `event`) VALUES ('".date('Y-m-d')."','".date('H:i:s', time())."','".$this->session->userdata('id')."','new subscription')");
	
	
		}
		
	
	  $details=array();
		  foreach($_POST as $ky=>$dt){
			if($ky=='paym' || $ky=='newsubscription' || $ky=='newnofmonth' )
			{
				continue;
			}else if($ky=='amount1' || $ky=='amount2'){
				$ky='amount';
			}else if($ky=='sendername1' || $ky=='sendername2'){
				$ky='sname';
			}
				if($dt!=''){
				$details[$ky]=$dt;
				}
			}
		
	  $payid=uniqid();
			$data['payment_details']=serialize($details);
			 $this->db->query("INSERT INTO `payments`(`pay_id`, `paym`, `payment_details`, `product`,`user_id`,`date`) 
			 VALUES ('".$payid."','".$_POST['paym']."','".$data['payment_details']."','".$_POST['newsubscription']."','".$this->session->userdata('id')."','".date('Y-m-d')."')");	
	 
	
	
      $arr['magazine']=$this->home_model->get_magazines();
	  $arr['subscription'] = $this->home_model->mysubscriptions($this->session->userdata('id'));
	  $arr['success']="Subscription sucessfully completed";
	  $this->load->view('vwSmysubscription.php',$arr);
	}
	 public function mailid(){
		//echo "<pre>"; print_r($_POST);
		$res = $this->home_model->mysubs($_POST['emailid']);		
		  $arr['subscriber']=$this->home_model->get_subscriber($this->session->userdata('id'),$_POST['emailid']);
		 $this->load->view('vwMysubscription.php',$arr);	
		 }	
		 
	public function detail(){
		  $arr['subs']=$this->home_model->find_subs();
	}
	public function check(){
		$q =  $this->home_model->checkinguser();
		return $q;
	}
	public function updatemail()
		{
				$rev = $this->home_model->updatemail_model();	
				return $rev;
		}
}