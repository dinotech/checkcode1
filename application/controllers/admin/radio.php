<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class radio extends CI_Controller {
	
	
	  public function index() {
      if(isset($_POST['submit'])){
	   if($_POST['choice']=="party"){redirect('admin/dashboard?type=pt');}
	   else{redirect('admin/dashboard?type=sh');}
	   }
	   $this->load->view('admin/vwradio');
    }
}