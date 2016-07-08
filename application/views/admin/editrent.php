<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	
class Editrent extends CI_Controller 
  {
	  public function __construct() 
	   {
        parent::__construct();
        $this->load->model('Editrent_model');
		//$this->load->model('Stockpurchase_model');
       }

    public function index() {
	 
	 $this->load->model('Editrent_model');
	 
	 /*$data['gb']=$this->Stockpurchase_model->gb();
	 $data['gb']=$data['gb'][0];*/
	 //echo $data['gb']; die;
	 $data['row']=$this->Editrent_model->get_row();
	 $data['row']=$data['row'][0];
	 
	 
	if(isset($_POST['submit']))
	  {
		//echo '<pre>';print_r($_POST);die;
		$this->Editrent_model->update_row($_POST);
	  }
	$data['gbq']=$this->Editrent_model->gbq();

	$data['dlr']=$this->Editrent_model->dlr();
	
	 $data['sit']=$this->Editrent_model->sit();
	 
	
	$this->load->view('admin/admin/vweditrent',$data);
		 
    }
	
	}
	?>
	
    <script>
    function myFunction() {
    var x = document.getElementById("mySelect").value;
	//Editrent_model->sit();
}
    </script>