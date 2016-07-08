<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
		
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->model('admin_model');
    }

    public function index() {
		
        $arr['page'] ='home';

		if ($this->session->userdata('is_admin_login')) {
			
        $arr['totals']= $this->admin_model->totals();
		$arr['subresult']= $this->admin_model->dofindall();
		
			
			$this->load->view('admin/admin2',$arr);
           }else{
		  $this->load->view('admin/login',$arr);
		  }
		
		
    }

     public function do_login() {

        if ($this->session->userdata('is_admin_login')) {
			            redirect('home/loggedin');
        } else {
            $user = $_POST['username'];
            $password = $_POST['password'];

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
 /*
         * Code By Abhishek R. Kaushik
         * Sr. Software Developer 
         */
                $this->load->view('login');
            } else {
                $sql = "SELECT * FROM users WHERE user_name = '" . $user . "' AND user_hash = '" . md5($password) . "'";
                $val = $this->db->query($sql);
				


                if ($val->num_rows) {
                    foreach ($val->result_array() as $recs => $res) {

                        $this->session->set_userdata(array(
                            'a_id' => $res['id'],
                            'admin_name' => $res['user_name'],
                            'a_email' => $res['email'],                            
                            'is_admin_login' => true
                                )
                        );
                    }
                    redirect('calls/call');
                } else {
                    $err['error'] = 'Username or Password incorrect';
                    $this->load->view('login', $err);
                }
            }
        }
           }

        
    public function logout() {
       $this->session->unset_userdata('a_id');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('a_email');
        $this->session->unset_userdata('is_admin_login');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }
	
	public function clearall()
	{
		if($query=$this->db->query("update ".$_POST['page']." set newcomings = 1 where newcomings = 0 "))
		{
			$result = 1;			
		}
		echo json_encode($result);
		return $result;
	}
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */