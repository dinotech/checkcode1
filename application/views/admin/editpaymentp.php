<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class editpaymentp extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('editpaymentp_model');
       }

    public function index() {
	 
	 $this->load->model('editpaymentp_model');
	 $data['row']=$this->editpaymentp_model->get_row();
	 $data['row']=$data['row'][0];
		
	if(isset($_POST['submit']))
	  {
		//echo '<pre>';print_r($_POST);die;
		$this->editpaymentp_model->update_row($_POST);
	  }
	$data['pty']=$this->editpaymentp_model->pty();
	//redirect('admin/rent'); 
	$this->load->view('admin/admin/vweditpaymentp',$data);
		 
    }
	
	}