<?php
class Communication extends CI_Controller {
  public function __construct() {
         parent::__construct();
		 $this->load->model('communication_model');
		 $this->load->model('admin_model');
		 
    }
	
	public function index(){
		$arr['subresult']= $this->admin_model->dofindall();	
			$this->load->view('admin/communication',$arr);
	}
	public function mail_setting(){	
	
	   $sql = $this->db->query("select * from mail_settings ");
	  $arr['result'] = $sql->result_array();
		
	
	if(isset($_POST['save']))
	{
		$this->communication_model->communication_mail();
	}
	$arr['subresult']= $this->admin_model->dofindall();
	$this->load->view('admin/communication_mail',$arr);
			
		
			}
	public function sms_setting(){	
		 if(isset($_POST['save']))
	{
		$this->communication_model->communication_sms();
	}
	$arr['subresult']= $this->admin_model->dofindall();
	$this->load->view('admin/communication_sms', $arr);
		}
}