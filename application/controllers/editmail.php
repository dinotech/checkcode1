<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Editmail extends CI_Controller {

 
    public function __construct() {
		
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
		 $arr['page'] ='editmail';
		 if (!$this->session->userdata('is_client_login')) {
         redirect('home');
        } else {
        $this->load->view('vwEditmail.php',$arr);
		}}	
		
		public function change_mail(){

			//echo "<pre>"; print_r($_POST);
			$msg['error']='';
			$msg['sucess']='';
			$Current_mail = $_POST['Current_mail'];
             $new_mail = trim($_POST['new_mail']);
 $query=$this->db->query("select * from user where email_id='".$new_mail ."'");
if($query->num_rows == 1)
{
$msg['error']="<p>This Email-id is already registered, please try again with other email-id</p>";
$this->load->view('vwEditmail.php',$msg);
}else{
			//echo $this->session->userdata('email');
           if($this->session->userdata('email')!=$Current_mail){
			   $msg['error']="<p>Current mail is not matching</p>";
			    $this->load->view('vwEditmail.php',$msg);
			   }
		  else if($Current_mail==''){
			    $msg['error']="<p>Current mail should not be blank</p>";
			    $this->load->view('vweditmail.php',$msg);
			   }else if($new_mail==''){
				  $msg['error']="<p>new mail should not be blank</p>";
			      $this->load->view('vwEditmail.php',$msg);
			   }else  if (trim($Current_mail)==trim($new_mail)) {
			     $msg['error']="<p>new mail should not be same to old mail</p>";
				 $this->load->view('vwEditmail.php',$msg);
			   }else{
				$this->db->query("INSERT INTO `id_modify`(`date`, `sub_code`, `old_mail`, `new_mail`) VALUES('".date('Y-m-d')."','".$this->session->userdata('code')."','".$this->session->userdata('email')."','".$new_mail."')");				
				
				$msg['success'] = "<p>YOUR MAIL ID  RESET REQUEST IS PLACED SUCCESSFULLY</p>";
				$this->load->view('vwEditmail.php',$msg);
				
			}
			}
		
		}
    
}