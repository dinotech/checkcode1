<?php
class Header extends CI_Controller {
	
	public function index() {
		//echo '<pre>';print_R($_POST);die;
		/*$id=$_POST['id'];
		$data['id']=$id;*/
		//echo '<pre>';print_R($data['id']);die;
		$data['id']=$_GET['id'];
		//echo "hello";
		$data['id']=1;
		$this->load->view('admin/vwheader',$data);	
	}
	
	
	
	
	
	
}
?>