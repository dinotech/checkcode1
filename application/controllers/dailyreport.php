<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dailyreport extends CI_Controller {

 
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index(){
		$this->load->view('vwDailyreportfore.php');
       }
	
}