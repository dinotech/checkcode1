<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Rent extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Rent_model');
       }

    public function index() {
		 
		if((isset($_POST['next'])) || (isset($_POST['pre']))){
			 
			$s=$_POST['limit'];
			$limit=10;
			if(isset($_POST['pre'])){
			$start=($s-2)*10;
			$data['limit']=$s-1;	
			$data['row']=$this->Rent_model->get_row($start);
			$data['row']=$data['row'][0];
				
			}else{
			$start=$s*10;
			$data['limit']=$s+1;
			$data['row']=$this->Rent_model->get_row($start);
			$data['row']=$data['row'][0];
			}
			
 }
 else{
	 $data['limit']="1";
	 $this->load->model('Rent_model');
	 $start=0;
	 $data['row']=$this->Rent_model->get_row($start);
	 $data['row']=$data['row'][0];
 }//echo '<pre>';print_r($row);die;
		
	if(isset($_POST['submit']))
	  {
		
		$this->Rent_model->insert_row($_POST);
	  }
	   $data['gb']=$this->Rent_model->gb();
	   
	   $data['dlr']=$this->Rent_model->dlr();
	   
	   $data['sit']=$this->Rent_model->sit();
	
	/*if(isset($_POST['del']))
	{
		$this->Rent_model->delete_row($_POST);
	}*/
	$this->load->view('admin/admin/vwRent',$data);
	 }
	
	public function delete_rent() {
        
		$this->Rent_model->delete_row($_POST);
		//echo "controller call"; die;
		}
	
	
	
  }