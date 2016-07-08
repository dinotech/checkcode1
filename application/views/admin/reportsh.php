<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class reportsh extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
		$this->load->library('excel');
        $this->load->model('reportsh_model');error_reporting(E_ALL ^ E_NOTICE);
       }

    public function index() {
	

	if(isset($_POST['numb']))
	  { 
	  $data['row']=$this->reportsh_model->dealr($_POST['selectr']);
	  $data['stockinrent']=$this->reportsh_model->getstockinrent($_POST['selectr'],$_POST['from'],$_POST['to']);
	  $data['rent']=$this->reportsh_model->getrent($_POST['selectr'],$_POST['from'],$_POST['to']);
	  $data['stockpurchase']=$this->reportsh_model->getstockpurchase($_POST['selectr'],$_POST['from'],$_POST['to']);
	  $data['sale']=$this->reportsh_model->getsale($_POST['selectr'],$_POST['from'],$_POST['to']);
	  
	
	 
	  
	  
	  }
	    
		
		if($_POST['numbers']==7){
		$data['stockinrent']=$this->reportsh_model->getstockinrent1();	
			$data['rent']=$this->reportsh_model->getrent1();
			}
	  
	  if(isset($_POST['numbe'])){
		  $data['row']=$this->reportsh_model->godown($_POST['selectg']);
		  $data['outwardg']=$this->reportsh_model->outwardg($_POST['selectg'],$_POST['from'],$_POST['to']);
		  $data['inwardg']=$this->reportsh_model->inwardg($_POST['selectg'],$_POST['from'],$_POST['to']);
		  $data['rentg']=$this->reportsh_model->rentg($_POST['selectg'],$_POST['from'],$_POST['to']);
		  $data['saleg']=$this->reportsh_model->saleg($_POST['selectg'],$_POST['from'],$_POST['to']);
		  $data['purchaseg']=$this->reportsh_model->purchaseg($_POST['selectg'],$_POST['from'],$_POST['to']);
		  

		  
		
		  }
	  
	  
	if(isset($_POST['submit']))
	  {  
	 
	  
	  if($_POST['numbers']==1)
	   {  
		 $data['row']=$this->reportsh_model->dlr();
	
	   }
	  if($_POST['numbers']==2)
	   {
	   $data['row']=$this->reportsh_model->get_row();
	   $data['row']=$data['row'][0]; 
	   }
	  if($_POST['numbers']==3)
	   {
	   $data['row']=$this->reportsh_model->sales();
	   }
	  if($_POST['numbers']==4)
	   {
	   $data['row']=$this->Report_model->stock_purchase();
	   }
	   if($_POST['numbers']==5)
	   {
	   $data['row']=$this->reportsh_model->stock_rent();
	   }
	    
	  }
	   if(isset($_POST['submit1'])){
		   
		   
	   $data['dealer']=$this->reportsh_model->getshree1($_POST['from'],$_POST['to']);
	   $data['outward']=$this->reportsh_model->getshree2($_POST['from'],$_POST['to']);
	   $data['inword']=$this->reportsh_model->getshree3($_POST['from'],$_POST['to']);
	   
	   $data['tdealer']=$this->reportsh_model->getshree1();
	   $data['toutward']=$this->reportsh_model->getshree2();
	   $data['tinword']=$this->reportsh_model->getshree3();
	  }
	$this->load->view('admin/admin/vwreportsh',$data);
		 
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