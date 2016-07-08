<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Onlinesubscription extends CI_Controller {
  public function __construct() {
         parent::__construct();
		 $this->load->model('online_model');
		 $this->load->model('admin_model');
    }
	
	public function index(){	
      $arr['online'] = $this->online_model->online_subscription();
	  $arr['subresult']= $this->admin_model->dofindall();
			$this->load->view('admin/onlinesubscription',$arr);
	}
}