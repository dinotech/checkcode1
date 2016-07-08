<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Editsales extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Editsales_model');
		//$this->load->model('Stockpurchase_model');
       }

    public function index() {
	 
	 $this->load->model('Editsales_model');
	 
	 /*$data['gb']=$this->Stockpurchase_model->gb();
	 $data['gb']=$data['gb'][0];*/
	 //echo $data['gb']; die;
	 $data['row']=$this->Editsales_model->get_row();
	 $data['row']=$data['row'][0];
	 
	 
	if(isset($_POST['submit']))
	  {
		//echo '<pre>';print_r($_POST);die;
		$this->Editsales_model->update_row($_POST);
	  }
	$data['gbq']=$this->Editsales_model->gbq();

	$data['dlr']=$this->Editsales_model->dlr();
	
	$this->load->view('admin/admin/vweditsales',$data);
		 
    }
	
	}