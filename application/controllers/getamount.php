<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Getamount extends CI_Controller {

 
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index() {
        

	if($_GET['p']!='' && $_GET['q']!=''){
		
		$var = $this->home_model->get_magbyid($_GET['q']);
		
		//echo "<pre>";print_r($var[0]['price']); die;
		
	echo $amount = $var[0]['price']*$_GET['p']; die;
		
	}
	}
}

?>