<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Invert extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Invert_model');
       }

    public function index() {
		 
		if((isset($_POST['next'])) || (isset($_POST['pre']))){
			 
			$s=$_POST['limit'];
			$limit=10;
			if(isset($_POST['pre'])){
			$start=($s-2)*10;
			$data['limit']=$s-1;	
			$data['row']=$this->Invert_model->get_row($start);
			$data['row']=$data['row'][0];
				
			}else{
			$start=$s*10;
			$data['limit']=$s+1;
			$data['row']=$this->Invert_model->get_row($start);
			$data['row']=$data['row'][0];
			}
			
 }
 else{
	 $data['limit']="1";
	 $this->load->model('Invert_model');
	 $start=0;
	 $data['row']=$this->Invert_model->get_row($start);
	 $data['row']=$data['row'][0];
 }//echo '<pre>';print_r($row);die;
		
	if(isset($_POST['submit']))
	  {
		
		$this->Invert_model->insert_row($_POST);
	  }
	   $data['gb']=$this->Invert_model->gb();
	   
	   $data['dlr']=$this->Invert_model->dlr();
	   //echo '<pre>';print_r($data['gb']);die;
		
	
	/*if(isset($_POST['del']))
	{
		$this->Stockinrent_model->delete_row($_POST);
	}*/
	$this->load->view('admin/admin/vwInvert',$data);
	}
	
	public function delete_invert() {
        
		$this->Invert_model->delete_row($_POST);
		//echo "controller call"; die;
		}
	
	}