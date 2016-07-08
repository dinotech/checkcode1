<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class importexport extends CI_Controller 
  {
	  public function index(){
	  
	  $this->load->view('admin/admin/dbexport');
	  
	  if(isset($_POST['dbexport'])){$this->load->view('admin/admin/dbexport');}
	  }
  }