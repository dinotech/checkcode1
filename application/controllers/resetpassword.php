<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resetpassword extends CI_Controller {

 
    public function __construct() {
		
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
		 $arr['page'] ='resetpassword';
		 if (!$this->session->userdata('is_client_login')) {
         redirect('home');
        } else {
        $this->load->view('vwResetpassword.php',$arr);
		}}	
		
		public function change_password(){
			
			
			 $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

           
			$this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required');

            if ($this->form_validation->run() == FALSE) {
				 $this->load->view('vwResetpassword');
			}else 
			{
				
				if($this->db->query("update user set `password`='".md5($password)."' where user_id ='".$this->session->userdata('id')."'")){
				$sql13=$this->db->query("INSERT INTO `transaction_register`(`date`, `time`, `usercode`, `event`) VALUES ('".date('Y-m-d')."','".date('H:i:s', time())."','".$this->session->userdata('id')."','Password change')");
		
				$msg['sucess'] = "</p>YOUR PASSWORD IS RESET SUCCESSFULLY</p>";;
				 $this->load->view('vwResetpassword.php',$msg);
				}
			}
			
		
		}
function checkdata()
		{
//			echo'<pre>';print_r($this->session->userdata['email']);die;
			$query = $this->db->query("select * from user where email_id = '".$this->session->userdata['email']."' and password = '".md5($_POST['curpass'])."'");
			$var = $query->num_rows();
			echo json_encode($var);
			
		}
    
}