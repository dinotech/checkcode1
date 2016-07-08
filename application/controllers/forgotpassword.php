<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {

 
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
  }

     public function index() {
        $arr['page'] ='Forgotpassword';
        $this->load->view('vwForgotpassword.php',$arr);
    }
	public function send_mail() {
		
		if(isset($_POST['email'])){
   
	$val =$this->db->query("select * from user where email_id ='".$_POST['email']."'");
	//echo "select * from user where email_id ='".$_POST['email']."'"; 
//	echo'<pre>';print_r($val->num_rows);
//	echo'<pre>';print_r($val->result_array());die;
       if ($val->num_rows) {
            foreach ($val->result_array() as $recs => $res) {
            $newpass = uniqid();
            $to = $_POST['email'];
			$subject = "E-magazine Reset Password ";
			$message="Your Registration id is : <h5>".$res['regiid']."</h5>
			<br/> New password is ".$newpass." ";
			$headers = "From:<e-magazine@itrportfolio.com>";
			//echo $message;
			}
			if(mail($to,$subject,$message,$headers)){
			
	        $this->db->query("update user set password ='".md5($newpass)."' where email_id='".$to."'");
			//echo "update user set password ='".md5($newpass)."' where email_id='".$to."'";
	
			$arr['Success']="New password is send to your Email id please check";
		    $this->load->view('vwForgotpassword.php',$arr);
		    }else{
			$err['error']="There is a problem in sending Mail";
		    $this->load->view('vwForgotpassword.php',$err);
		    }
					
			
	   }else{
		$err['error']="No id is registed from given id please check you Email";
		$this->load->view('vwForgotpassword.php',$err);
	}
		}else if(isset($_POST['mobile'])){
			$val =$this->db->query("select * from user where mobile ='".$_POST['mobile']."'");
//	echo "select * from user where mobile ='".$_POST['mobile']."'"; 
	
	
       if ($val->num_rows) {
            foreach ($val->result_array() as $recs => $res) {
			
			}
	}
		}}
}