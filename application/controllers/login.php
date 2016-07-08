<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

 
    public function __construct() {
		
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
		
        $arr['page'] ='login';
		 if (!$this->session->userdata('is_client_login')) {
            redirect('home');
        } else {
        $this->load->view('vwLogin.php',$arr);}
    }
}