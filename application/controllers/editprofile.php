<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Editprofile extends CI_Controller {
 public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
		$this->load->model('edituser_model');
    }

    public function index(){
		
		  if (!$this->session->userdata('is_client_login')) {
           redirect('register');
		 }else{
          $arr['userdata'] = $this->home_model->get_userbyid($this->session->userdata('id'));
		
		 $this->load->view('vwEditprofile.php',$arr);
		 }
		
	}
	 public function edit(){
	// echo "<pre>";
	// print_r($_POST);
	// die;
	 
	 $this->edituser_model->edit_user();	 
	 }
	
}