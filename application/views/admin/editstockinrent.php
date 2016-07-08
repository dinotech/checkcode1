<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Editstockinrent extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Editstockinrent_model');
		//$this->load->model('Stockpurchase_model');
       }

    public function index() {
	 
	 $this->load->model('Editstockinrent_model');
	 
	 /*$data['gb']=$this->Stockpurchase_model->gb();
	 $data['gb']=$data['gb'][0];*/
	 //echo $data['gb']; die;
	 $data['row']=$this->Editstockinrent_model->get_row();
	 $data['row']=$data['row'][0];
	 
	 
	if(isset($_POST['submit']))
	  {
		//echo '<pre>';print_r($_POST);die;
		$this->Editstockinrent_model->update_row($_POST);
	  }
	$data['gbq']=$this->Editstockinrent_model->gbq();

	$data['dlr']=$this->Editstockinrent_model->dlr();
	
	$this->load->view('admin/admin/vweditstockinrent',$data);
		 
    }
	
	}