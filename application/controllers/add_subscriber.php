<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Add_subscriber extends CI_Controller {

 
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index() {
        
		$arr['page'] ='add_subscriber';
		$arr['magazines'] = $this->home_model->get_data('magazine');
		$arr['userdata'] = $this->home_model->get_userbyid($this->session->userdata('id'));
		if($this->session->userdata('is_client_login')){
		$this->load->view('vwAdd_subscrber.php',$arr);
		}else 
		{
			redirect('register');
			}
	}
	
	 public function addsubs(){
		//echo'<pre>';print_r($_POST);die;
		$this->home_model->addsubsciption();
	 }
	 public function addonlysubs0(){
		//echo'<pre>';print_r($_POST);die;
		$this->home_model->addonlysubsciption0();
	 }
	 public function addonlysubs(){
		//echo'<pre>';print_r($_POST);die;
		$this->home_model->addonlysubsciption();
	 }
	 
	public function checkuser(){
			$q = $this->home_model->checkinguser();
			//echo $q;
			return $q;
	}
}
?>


