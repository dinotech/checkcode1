<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Report extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Report_model');error_reporting(E_ALL ^ E_NOTICE);
       }

    public function index() {
	//$data['row']=0;
	if(isset($_POST['submit']))
	  { 
	  
		//echo "<pre>"; print_r($_POST); die; 
	  if($_POST['numbers']==1)
	   {  
		  $data['row']=$this->Report_model->dlr();
	     
		 
		}
	  if($_POST['numbers']==2)
	   {
	   $data['row']=$this->Report_model->get_row();
	   $data['row']=$data['row'][0]; 
	   }
	  if($_POST['numbers']==3)
	   {
	   $data['row']=$this->Report_model->sales();
	   }
	  if($_POST['numbers']==4)
	   {
	   $data['row']=$this->Report_model->stock_purchase();
	   }
	   if($_POST['numbers']==5)
	   {
	   $data['row']=$this->Report_model->stock_rent();
	   }
	   
	  }
	$this->load->view('admin/admin/vwReport',$data);
		 
    }
	
	

	
	}