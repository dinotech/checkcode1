<?php
class Paymentupload extends CI_Controller {


  public function __construct() {
         parent::__construct();
		 $this->load->model('admin_model');
		 $this->load->model('payment_model');
	     $this->load->library('form_validation');
    }

    public function index() {
		$arr['page'] ='payment_upload';
		
		
		
		}
}