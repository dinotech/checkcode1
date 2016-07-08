<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payouts extends CI_Controller {
  public function __construct() {
         parent::__construct();
		 $this->load->model('payouts_model');
		 $this->load->model('admin_model');
    }
	
	public function index(){	
      $arr['payouts'] = $this->payouts_model->get_data();
	  $arr['franchise'] = $this->payouts_model->get_franchise();
	  $arr['subresult']= $this->admin_model->dofindall();
			$this->load->view('admin/vwPayouts',$arr);
	}
	public function insert_data(){
		
	$this->payouts_model->insert_data($_POST);
	}
	
	
	public function get_payid(){
	$result = $this->payouts_model->get_payid();
    echo json_encode($result);
	
	}
		
}