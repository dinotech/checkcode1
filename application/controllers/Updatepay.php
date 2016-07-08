<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Updatepay extends CI_Controller {

 
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index() {
        $arr['page'] ='login';
		$arr['amt'] = $this->home_model->findamount();
        $this->load->view('vwUpdatepay.php',$arr);
    }
	
	
	
	public function fore() {
		//print_r($this->session->userdata['role']);die;
        		$this->load->view('vwUpdatepayfore.php');
	}
	
	public function eore() {
		//print_r($this->session->userdata['role']);die;
        		$this->load->view('vwUpdatepayfore.php');
	}
	
	
	public function update_payment_fore(){
		//echo'<pre>';print_r($_POST);die;
	   $this->load->library('form_validation');
          $details=array();
		if($_POST['paym']=='offline'){
			
			if($_POST['offline']=='MoneyOrder'){
					
		$this->form_validation->set_rules('modate', 'Moner order date', 'required');
		$this->form_validation->set_rules('amount1', 'Amount', 'required');
		$this->form_validation->set_rules('sendername1', 'Sender Name', 'required');
			
			}else if($_POST['offline']=='DemandDraft'){
			
		$this->form_validation->set_rules('ddnum', 'Demand Draft Number', 'required');
		$this->form_validation->set_rules('amount2', 'Amount', 'required');
		$this->form_validation->set_rules('sendername2', 'Sender Name', 'required');
		
				
				}else if($_POST['offline']=='BankDeposite'){
		
		$this->form_validation->set_rules('tensid', 'Transaction Id', 'required');
		$this->form_validation->set_rules('amount3', 'Amount', 'required');
		
				
				}
			
			}
			if ($this->form_validation->run() == FALSE)
		{
		  foreach($_POST as $ky=>$dt){
			if($ky=='paym')
			{
				continue;
			}else if($ky=='amount1' || $ky=='amount2' || $ky=='amount3'){
				$ky='amount';
			}else if($ky=='sendername1' || $ky=='sendername2'){
				$ky='sname';
			}
				if($dt!=''){
				$details[$ky]=$dt;
				}
			}   
	   $data=array(
	   'payment_method'=>$_POST['paym'],
	   'payment_details'=>serialize($details)
	   );	  
	   if($this->home_model->update_fore($_POST['payid']))
	   {	  
				$this->db->query("INSERT INTO `payments`(`pay_id`, `paym`, `payment_details`, `product`) VALUES ('".$_POST['payid']."','".$data['payment_method']."','".$data['payment_details']."','')");			   
				$arr['success']="<p>Your Payment Information is updated.</p>";
				$this->load->view('vwUpdatepayfore.php',$arr);	
	   }
	   else
	   {
			   $err['error']="<p>There is a problem to update details please Refill details</p>";
			   $this->load->view('vwUpdatepay.php',$err);	   
	   }
	   }else {
	   
	   $this->load->view('vwUpdatepay');
	   }
	}
	

        public function reupdate_payment_fore1(){
		//echo'<pre>';print_r($_POST);die;

                $uid = $this->session->userdata('id');
		$payid= $_POST['payid1'];		
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
		 $date = date("Y-m-d");
	    $this->db->query("insert into payments set pay_id = '".$payid."', paym = 'offline', payment_details = '".$data."', user_id = '".$uid."',date = '".$date."', status = '1'");			   
        redirect('Updatepay/fore');	   


        }
	public function reupdate_payment_fore(){
		//echo'<pre>';print_r($_POST);die;
		$uid = $this->session->userdata('id');
		$payid= $_POST['payid1'];		
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
	    $this->db->query("update payments set pay_id = '".$payid."',
																	  payment_details = '".$data."',
																	  user_id = '".$uid."'  where  pay_id = '".$payid."'");			   
        redirect('Updatepay/fore');	   
	}
	
	 public function update_payment_details(){
		// echo'<pre>';print_r($_POST);die;
	   $this->load->library('form_validation');
          $details=array();
		if($_POST['paym']=='offline'){
			
			if($_POST['offline']=='MoneyOrder'){
					
		$this->form_validation->set_rules('modate', 'Moner order date', 'required');
		$this->form_validation->set_rules('amount1', 'Amount', 'required');
		$this->form_validation->set_rules('sendername1', 'Sender Name', 'required');
			
			}else if($_POST['offline']=='DemandDraft'){
			
		$this->form_validation->set_rules('ddnum', 'Demand Draft Number', 'required');
		$this->form_validation->set_rules('amount2', 'Amount', 'required');
		$this->form_validation->set_rules('sendername2', 'Sender Name', 'required');
		
				
				}else if($_POST['offline']=='BankDeposite'){
		
		$this->form_validation->set_rules('tensid', 'Transaction Id', 'required');
		$this->form_validation->set_rules('amount3', 'Amount', 'required');
		
				
				}
			
			}
			if ($this->form_validation->run() == FALSE)
		{ 
                        
                            $this->load->view('vwUpdatepay');
                }else {

		  foreach($_POST as $ky=>$dt){
			if($ky=='paym')
			{
				continue;
			}else if($ky=='amount1' || $ky=='amount2' ||  $ky=='amount3'){
				$ky='amount';
			}else if($ky=='sendername1' || $ky=='sendername2'){
				$ky='sname';
			}
				if($dt!=''){
				$details[$ky]=$dt;
				}
			}
			   
	   $data=array(
	   'payment_method'=>$_POST['paym'],
	   'payment_details'=>serialize($details)
	   );
	   //echo'<pre>';print_r($_POST);die;
	   if($this->home_model->update_user($this->session->userdata('id'),$data)){
	    $this->db->query("INSERT INTO `payments`(`pay_id`, `paym`, `payment_details`, `product`,`user_id`,`date`) VALUES    ('".$_POST['payid']."','".$_POST['paym']."','".$data['payment_details']."','','".$this->session->userdata('id')."','".date('Y-m-d')."')");			   
         $this->db->query("Update `subscription` set `status`=1 where payment_id='".$_POST['payid']."'");			   
        $arr['success']="<p>Your Payment Information is updated.</p>";
	    redirect('myaccount');
		//$this->load->view('vwMyaccount.php',$arr);
	   }else {
	   $err['error']="<p>There is a problem to update details please Refill details</p>";
	   $this->load->view('vwUpdatepay.php',$err);
	   }
	   }
	   }
	public function trReg_f() {
       		$this->load->view('vwTxReg.php');
    }
	public function trReg_e() {
       		$this->load->view('vwTxreg_e.php');
    }
	public function tr_french() {
       		$this->load->view('vwTxReg.php');
    }
	public function abc() {
//		echo'<pre>';print_r($_POST);die;
       		$this->home_model->tr_french();
    }
	public function abcd() {
//		echo'<pre>';print_r($_POST);die;
       		$this->home_model->tr_exec();
    }
	
	public function updatepayments() {
			//echo'<pre>';print_r($_POST);die;
    		 $var = $this->home_model->getupdates();
			 return $var;
    }
        public function updatepaymentsfore() {
			//echo'<pre>';print_r($_POST);die;
    		 $var = $this->home_model->getupdatesfore();
			 return $var;
    } 

	public function viewsubs() {			
    	$this->load->view('vwsubslist');
    }
	public function detail(){
		  $this->home_model->find_subs1();
	}
}