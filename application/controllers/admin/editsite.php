<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Editsite extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Editsite_model');
       }

    public function index() {
	 
	 $this->load->model('Editsite_model');
	 $data['row']=$this->Editsite_model->get_row();
	 $data['row']=$data['row'][0];
		
	if(isset($_POST['submit']))
	  {
		//echo '<pre>';print_r($_POST);die;
		$this->Editsite_model->update_row($_POST);
	  }
	$data['dlr']=$this->Editsite_model->dlr();
	
	$this->load->view('admin/admin/vweditsite',$data);
		 
    }
	
	}