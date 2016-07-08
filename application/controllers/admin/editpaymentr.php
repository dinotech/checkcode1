<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class editpaymentr extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('editpaymentr_model');
       }

    public function index() {
	 
	 $this->load->model('editpaymentr_model');
	 $data['row']=$this->editpaymentr_model->get_row();
	 $data['row']=$data['row'][0];
		
	if(isset($_POST['submit']))
	  {
		//echo '<pre>';print_r($_POST);die;
		$this->editpaymentr_model->update_row($_POST);
	  }
	$data['pty']=$this->editpaymentr_model->pty();
	//redirect('admin/rent'); 
	$this->load->view('admin/admin/vweditpaymentr',$data);
		 
    }
	
	}