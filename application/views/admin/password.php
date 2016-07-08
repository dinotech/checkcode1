<?php
class Password extends CI_Controller  {
	
	
	public function __construct() {
        parent::__construct();
        $this->load->model('password_model');
    }
	
	public function index() {
		//echo $this->ion_auth->user()->row()->id;die;
		$id=$this->session->userdata('a_id');//echo $id;die;
		if(isset($_POST['submit'])/*&&($_POST['new']==$_POST['confirm'])*/){
			if($_POST['new']!=$_POST['confirm']){
				$data['msg']="Yes";
				$this->load->view('admin/myprofile/vwpassword',$data);
				return;
				}
				else{
					$data['msg']="No";
					}
			$r=$this->password_model->addpassword($_POST,$id);
			if(isset($r)&&($r==0)){
				$data['err']="Yes";
				}
				else{
					$data['err']="No";
					}
			
			//$data['msg']="No";
		}
		else{
			//$data['msg']="Yes";
			//$data['conf']="Password and confirm password must be same";
			//$this->load->view('admin/myprofile/vwpassword',$data);
			
			}
		if(isset($data)){
		$this->load->view('admin/myprofile/vwpassword',$data);
		}else{
		
		$this->load->view('admin/myprofile/vwpassword');
		}
	
	}
}