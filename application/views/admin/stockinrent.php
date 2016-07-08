<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Stockinrent extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Stockinrent_model');
       }

    public function index() {
		 
		if((isset($_POST['next'])) || (isset($_POST['pre']))){
			 
			$s=$_POST['limit'];
			$limit=10;
			if(isset($_POST['pre'])){
			$start=($s-2)*10;
			$data['limit']=$s-1;	
			$data['row']=$this->Stockinrent_model->get_row($start);
			$data['row']=$data['row'][0];
				
			}else{
			$start=$s*10;
			$data['limit']=$s+1;
			$data['row']=$this->Stockinrent_model->get_row($start);
			$data['row']=$data['row'][0];
			}
			
 }
 else{
	 $data['limit']="1";
	 $this->load->model('Stockinrent_model');
	 $start=0;
	 $data['row']=$this->Stockinrent_model->get_row($start);
	 $data['row']=$data['row'][0];
 }//echo '<pre>';print_r($row);die;
		
	if(isset($_POST['submit']))
	  {
		
		$this->Stockinrent_model->insert_row($_POST);
	  }
	   $data['gb']=$this->Stockinrent_model->gb();
	   
	   $data['dlr']=$this->Stockinrent_model->dlr();
	   //echo '<pre>';print_r($data['gb']);die;
		
	
	/*if(isset($_POST['del']))
	{
		$this->Stockinrent_model->delete_row($_POST);
	}*/
	$this->load->view('admin/admin/vwStockinrent',$data);
	}
	
	public function delete_stockinrent() {
        
		$this->Stockinrent_model->delete_row($_POST);
		//echo "controller call"; die;
		}
	
	}