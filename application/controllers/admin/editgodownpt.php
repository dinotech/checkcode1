<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class editgodownpt extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('editgodownpt_model');
       }

    public function index() {
	 
	 $this->load->model('editgodownpt_model');
	 $data['row']=$this->editgodownpt_model->get_row();
	 $data['row']=$data['row'][0];
		
	if(isset($_POST['submit']))
	  {
		//echo '<pre>';print_r($_POST);die;
		$this->editgodownpt_model->update_row($_POST);
	  }
	
	
	$this->load->view('admin/admin/vweditgodownpt',$data);
		 
    }
	
	}