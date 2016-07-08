<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

 
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('home_model');
    }

    public function index() {
        $arr['page'] ='home';
        $this->load->view('vwhome.php',$arr);
    }

     public function do_login() {
	
	  if ($this->session->userdata('is_client_login')) {
            redirect('home');
        } else {
            $user = @$_POST['emailid'];
            $password = @$_POST['password'];
			
            $this->form_validation->set_rules('emailid', 'Email id', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
				 $this->load->view('vwhome');
				 
            } else {
                $sql = "SELECT * FROM user WHERE email_id = '" . $user . "' AND password = '" . md5($password) . "'";
				
	               $val = $this->db->query($sql);


                if ($val->num_rows) {
                    foreach ($val->result_array() as $recs => $res) {

                        $this->session->set_userdata(array(
                            'id' => $res['user_id'],
                            'user_name' => $res['name'],
                            'email' => $res['email_id'], 
							'regi_id' => $res['regiid'],
							'pay_id' => $res['payid'],
							'role' => $res['role'],                           
                            'code' =>$res['code'],
							'is_client_login' => true
                                )
                        );
                    }
      
		             $sql13=$this->db->query("INSERT INTO `transaction_register`(`date`, `time`, `usercode`, `event`) VALUES ('".date('Y-m-d')."','".date('H:i:s', time())."','".$res['user_id']."','login')");
		
					$arr['sucess'] =" Welcome ".strtoupper($res['name']);
					if(trim($res['role'])=='subscriber'){
					redirect('myaccount',$arr);
					}else if(trim($res['role'])=='franchise'){
					redirect('Flogin',$arr);
					}else if(trim($res['role'])=='executive'){
					redirect('Flogin',$arr);
					}
					
					
                } else {
$val1= $this->db->query("SELECT * FROM user WHERE email_id = '" . $user . "'"); 
$val2= $this->db->query("SELECT * FROM user WHERE password = '" . md5($password) . "'");
                 if($val1->num_rows==0) {
					 $err['error'] = '<p>This email id is not subscribed. Please visit <a href="'.BASE_URL.'register" class="alert-link">subscribe now! </a> For new subscription</p>';
                     $this->load->view('vwhome.php',$err);
					 
                }else if($val2->num_rows==0) {
					 $err['error'] = '<p>You have entered a wrong password.<a href="'.BASE_URL.'forgotpassword" class="alert-link">Click here!</a> to reset your password</p>';
                     $this->load->view('vwhome.php',$err);
					  
                }
				}
            }
        }
           }

        
    public function logout() {
		
		 $sql13=$this->db->query("INSERT INTO `transaction_register`(`date`, `time`, `usercode`, `event`) VALUES ('".date('Y-m-d')."','".date('H:i:s', time())."','".$this->session->userdata('id')."','logout')");
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('regi_id');
        $this->session->unset_userdata('pay_id');
		//$this->session->unset_userdata('flag');
		$this->session->unset_userdata('role');
        $this->session->unset_userdata('is_client_login');
        $this->session->sess_destroy();
        
		
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }

    
	
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */