<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Register extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index() {
        
		$arr['page'] ='register';
		$arr['magzines'] = $this->home_model->get_data('magazine');
	
	    if ($this->session->userdata('is_client_login')) {
            redirect('myaccount');
		 }else{
         $this->load->view('vwRegister.php',$arr);
		 }
  }
  
    public function do_register() {
		
		$cur = $this->home_model->last_regi_id();

		//$pre = substr($regi_id,-4);
                //$cur = $pre+1;
		
		$arr['magzines'] = $this->home_model->get_data('magazine');	
		$emailid = $_POST['emailid'];
		$password = md5($_POST['password']);
		$product = $_POST['product'];
		$subscription = $_POST['subscription'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$dob = date('Y-m-d',strtotime($_POST['dob']));
		$mobile = $_POST['mobile'];
		$cmail = $_POST['cmail'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$pincode = $_POST['pincode'];
		$country = $_POST['country'];
		$amount = $_POST['amount'];
		$paym = $_POST['paym'];
		$code='direct';
		
		$payment_details =""; 
		$payment_detail = "";
			$cc = substr($country, 0, 2);
			$sc = substr($state, 0, 2);

	      $regiid=strtoupper($cc." ".$sc." ".$cur);
               $payid = uniqid().$cur;
		  $flag='0';
		  $role='subscriber';
		//echo $regiid; die;
		if($amount<=0){
			$arr['error']="<p>Must Select correct magazine</p>";
			 $this->load->view('vwRegister',$arr);
			}
		
		 $this->form_validation->set_rules('emailid','Email id', 'trim|required');
		 $this->form_validation->set_rules('emailid','Email id', 'trim|is_unique[user.email_id]');
		 $this->form_validation->set_rules('mobile','Mobile', 'trim|max_length[10]');
         $this->form_validation->set_rules('password','Password', 'trim|required') ;
		 $this->form_validation->set_rules('passwordc','Password Confirmation', 'trim|required|matches[password])') ;
         $this->form_validation->set_rules('product', 'Subscription', 'required');
         $this->form_validation->set_rules('subscription','Duration', 'required');
		 $this->form_validation->set_rules('name','Name','trim|required');
		 $this->form_validation->set_rules('state','State','trim|required');
         $this->form_validation->set_rules('country','Country','trim|required');
		 $this->form_validation->set_rules('amount','Amount','trim|required');
		 

          if ($this->form_validation->run() == FALSE) {
               if(!isset($this->session->userdata['id'])){
			    $this->load->view('vwRegister',$arr);
			   }else if($this->session->userdata['id']){
			   redirect('Login');
			   }
				
          } else {

		 $sql1 = "INSERT INTO `user`(`email_id`, `password`, `subscription`, `duration`, `lang`, `name`, `gender`, `dob`, `mobile`, `contect_mail`, `address`, `city`, `district`, `state`, `pincode`, `country`, `payment_method`, `payment_details`,`regiid`,`payid`,`role`,`status`,`code`) VALUES('".$emailid."','".$password."','".$product."','".$subscription."','en','".$name."','".$gender."','".$dob."','".$mobile."','".$cmail."','".$address."','".$city."','".$district."','".$state."','".$pincode."','".$country."','".$paym."','".$payment_detail."','".$regiid."','".$payid."','subscriber','1','".$code."')";
		  $val1 = $this->db->query($sql1);
		  $last_inserted = $this->db->insert_id();
		   $sql2 ="INSERT INTO 
		 `subscription`(`user_id`, `mag_id`, `start_time`, `end_time`, `duration`, `status`, `payment_id`,`amount`) VALUES ('". $last_inserted."','".$product."','".date('Y-m-d')."','".date('Y-m-d',strtotime("+".$subscription." months"))."','".$subscription."',0,'".$payid ."','".$amount."')";
          $val2 = $this->db->query($sql2);
		  
		  $sql13=$this->db->query("INSERT INTO `transaction_register`(`date`, `time`, `usercode`, `event`) VALUES ('".date('Y-m-d')."','".date('H:i:s', time())."','".$last_inserted."','login')");
		
		  
		   if($val1){
			   $this->session->set_userdata(array(
                            'id' => $last_inserted ,
                            'user_name' => $name,
                            'email' => $emailid, 
							'regi_id' => $regiid,
							'pay_id' => $payid,
							'flag' => $flag,
							'role' => $role,     
							'is_client_login' => true
                                )
                        );
			
			$sql = $this->db->query("select * from mail_settings where id=1");
			$result = $sql->result_array();
						//echo "<pre>"; print_r($result);
			$config = Array(        
            'protocol' => 'sendmail',
            'smtp_host' => 'localhost',
            'smtp_port' => 587,
            'smtp_user' => 'emagazine@itrportfolio.com',
            'smtp_pass' => 'em1233#',
            'smtp_timeout' => '4',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
	    $this->email->from($result[0]['mail_id'], 'E-magazine');
        $data = array('userName'=> 'E-magazine');
        $this->email->to($emailid);  // replace it with receiver mail id
        $this->email->subject($result[0]['mail_content']); // replace it with relevant subject 
        $path = HTTP_ASSETS_PATH.'mail_templete/'.$result[0]['file_upload'];
	    header('Content-type: text/plain');
        $body = file_get_contents($path);
        $this->email->message($body);
        $this->email->send();
      	redirect('login');

   }
	
		}
		
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/register.php */