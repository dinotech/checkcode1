<?php 
class Paymentdetail extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index() {
		
		 $arr['page'] ='paymentdetail';
		 
		 $payid = $_GET['payid'];
		$arr['paydetails'] = $this->home_model->paymentdeatil($payid);
	    if (!$this->session->userdata('is_client_login')) {
            redirect('register');
		 }else{
         $this->load->view('vwPaymentdetail.php',$arr);
		 }
	
	}
	
	}