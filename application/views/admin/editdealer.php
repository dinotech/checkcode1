<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Editdealer extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Editdealer_model');
       }

    public function index() {
	 
	 $this->load->model('Editdealer_model');
	 $data['row']=$this->Editdealer_model->get_row();
	 $data['row']=$data['row'][0];
		
	if(isset($_POST['submit']))
	  {
		//echo '<pre>';print_r($_POST);die;
		$this->Editdealer_model->update_row($_POST);
	  }
	
	//redirect('admin/rent'); 
	$this->load->view('admin/admin/vweditdealer',$data);
		 
    }
	
	}