<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fmyaccount extends CI_Controller {

 
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index() {
        $arr['page'] ='fmyaccount';		
		$arr['userdata'] = $this->home_model->get_userbyid($this->session->userdata('id'));
		$arr['propdata'] = $this->home_model->get_extra($arr['userdata']['code']);
		$this->load->view('vwFmyaccount.php',$arr);
	}
}
