<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Editions extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index() {
		
        $arr['page'] ='editions';
		$arr['magzines'] = $this->home_model->get_data('magazine');
		$arr['magazine_sub'] = $this->home_model->get_edibyid($_GET['mag']);
		$arr['my_magazine_sub'] = $this->home_model->mysubscribedissue($_GET['mag']);
		$arr['magzines']['name'] = $this->home_model->get_magbyid($_GET['mag']);
		
			
	     if (!$this->session->userdata('is_client_login')) {
            redirect('register');
		 }else{
         $this->load->view('vwEditions',$arr);
		 }
  }
}