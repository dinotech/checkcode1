<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SiteName extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Rent_model');
       }
	   
	   public function index() {
		   	if((isset($_POST))){
				echo "<script>alert(".$_POST.")</script>";
				}
		   }
  }
	   ?>