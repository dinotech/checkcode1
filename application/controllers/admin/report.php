<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Report extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
		$this->load->library('excel');
        $this->load->model('Report_model');error_reporting(E_ALL ^ E_NOTICE);
       }

    public function index() {
	
	if(isset($_POST['numb']))
	  { 
	  $data['row']=$this->Report_model->dealr($_POST['selectr']);
	  $data['stockinrent']=$this->Report_model->getstockinrent($_POST['selectr'],$_POST['from'],$_POST['to']);
	  $data['rent']=$this->Report_model->getrent($_POST['selectr'],$_POST['from'],$_POST['to']);
	  $data['stockpurchase']=$this->Report_model->getstockpurchase($_POST['selectr'],$_POST['from'],$_POST['to']);
	  $data['sale']=$this->Report_model->getsale($_POST['selectr'],$_POST['from'],$_POST['to']);
	  $data['preceived']=$this->Report_model->getpaymentreceived($_POST['selectr'],$_POST['from'],$_POST['to']);
	  $data['ppayed']=$this->Report_model->getpaymentpaid($_POST['selectr'],$_POST['from'],$_POST['to']);
	  
	  $data['tstockinrent']=$this->Report_model->getstockinrent($_POST['selectr']);
	  $data['trent']=$this->Report_model->getrent($_POST['selectr']);
	  $data['tstockpurchase']=$this->Report_model->getstockpurchase($_POST['selectr']);
	  $data['tsale']=$this->Report_model->getsale($_POST['selectr']);
	  $data['tpreceived']=$this->Report_model->getpaymentreceived($_POST['selectr']);
	  $data['tppayed']=$this->Report_model->getpaymentpaid($_POST['selectr']);
	  
	  
	  }
	  if($_POST['numbers']==7){
		  $data['stockpurchase']=$this->Report_model->getstockpurchase1();
		   $data['sale']=$this->Report_model->getsale1();
		  }
	  
	  if(isset($_POST['numbe'])){
		  $data['row']=$this->Report_model->godown($_POST['selectg']);
		  
		  $data['outwardg']=$this->Report_model->outwardg($_POST['selectg'],$_POST['from'],$_POST['to']);
		  $data['inwardg']=$this->Report_model->inwardg($_POST['selectg'],$_POST['from'],$_POST['to']);
		 
		  
		  $data['rentg']=$this->Report_model->rentg($_POST['selectg'],$_POST['from'],$_POST['to']);
		  $data['saleg']=$this->Report_model->saleg($_POST['selectg'],$_POST['from'],$_POST['to']);
		  $data['purchaseg']=$this->Report_model->purchaseg($_POST['selectg'],$_POST['from'],$_POST['to']);
		  
		
		  }
	  
	  
	if(isset($_POST['submit']))
	  {  
	 
	  
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
	   if(isset($_POST['submit1'])){
	   $data['dealer']=$this->Report_model->getshree1($_POST['from'],$_POST['to']);
	   $data['outward']=$this->Report_model->getshree2($_POST['from'],$_POST['to']);
	   $data['inword']=$this->Report_model->getshree3($_POST['from'],$_POST['to']);
	  }
	$this->load->view('admin/admin/vwReport',$data);
		 
    }
	
	 public function csv()
      { 
	    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
	    $currentSegment = $segments[5];
		                                                  
		if($currentSegment=="dealer")
		{ 
		 $data['row']=$this->Report_model->dlr();
		 $this->load->view('admin/admin/vwGenerate',$data);
		 }
		
		if($currentSegment=="godown")
		{ 
		 $data['row']=$this->Report_model->get_row();
		 $this->load->view('admin/admin/vwGenerate',$data);
		}
		
		if($_POST['submit'])
		{
		 $data['row']=$this->Report_model->sales(); 
		 
		 echo "Sales report is going on"."<pre>"; print_r($this->session->data); die;
		 
		 $this->load->view('admin/admin/vwGenerate',$data);
		}
		 
	  
	  }

	
	}