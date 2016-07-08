<?php
class Transactionregister extends CI_Controller {


  public function __construct() {
         parent::__construct();
		 $this->load->model('admin_model');
		 $this->load->model('transaction_model');
	     $this->load->library('form_validation');
    }

    public function index() {
		 
		    $arr['row']=$this->transaction_model->get_row();
			$arr['subresult']= $this->admin_model->dofindall();
			$this->load->view('admin/vwtransactionregister',$arr);
	}
}