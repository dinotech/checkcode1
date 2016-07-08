<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Myaccount extends CI_Controller {

 
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index(){

        $arr['page'] ='myaccount';
	
		
		if ($this->session->userdata('is_client_login')) {
            $arr['magazine'] = $this->home_model->get_data('magazine');
	    $arr['userdata'] = $this->home_model->get_userbyid($this->session->userdata('id'));
		
		$arr['subscription'] = $this->home_model->mysubscriptions($this->session->userdata('id'));
        
		 if(trim($this->session->userdata('role'))=='franchise'){
			  $this->load->view('vwFhome.php',$arr);
		 }else   if(trim($this->session->userdata('role'))=='executive'){
			  $this->load->view('vwEhome.php',$arr);
		 }else if(trim($this->session->userdata('role'))=='subscriber'){
		
                    $this->load->view('vwMyaccount.php',$arr);
 
		    }
			
		}else{
		 redirect('register');
		}
		
       }

}