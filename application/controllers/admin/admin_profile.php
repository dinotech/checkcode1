<?php
//include_once("../../../../../../../192.168.2.71/htdocs/mahima/emagzine/application/controllers/admin/config.php");
//include_once("../../../../../../../192.168.2.71/htdocs/mahima/emagzine/application/controllers/admin/functions.php");
//include "../../../../../../../192.168.2.71/htdocs/mahima/emagzine/application/controllers/admin/test.php";


class Admin_profile extends CI_Controller {
  public function __construct() {
         parent::__construct();
		   $this->load->library('form_validation');
		 $this->load->model('admin_model');
		// $this->load->model('editSubs_model');
        //$this->load->library('form_validation');
    }

    public function index() {
		
       // $arr['page'] ='datatables';
	   	if((isset($_POST['next'])) || (isset($_POST['pre']))){
			 
			$s=$_POST['limit'];
			$limit=10;
			if(isset($_POST['pre'])){
			$start=($s-2)*10;
			$data['limit']=$s-1;	
			$data['row']=$this->admin_model->get_row($start);
			$data['row']=$data['row'][0];
				
			}else{
			$start=$s*10;
			$data['limit']=$s+1;
			$data['row']=$this->admin_model->get_row($start);
			$data['row']=$data['row'][0];
			}
			
 }
 else{
	 $data['limit']="1";
	 $this->load->model('admin_model');
	 $start=0;
	 $data['row']=$this->admin_model->get_row($start);
	 $data['subresult']= $this->admin_model->dofindall();
	 $data['row']=$data['row'][0];
 }
		//$data['row']=$this->datatables_model->get_row($start);
		$data['subresult']= $this->admin_model->dofindall();
        $this->load->view('admin/admin_users',$data);
   
	}
	
		public function edit_admin() 
		{
			$data['row']=$this->admin_model->edit_row();
			$data['row']=$data['row'][0];
			$this->load->view('admin/edit_admin',$data);
		}
		
		public function save_edit() {
        if(isset($_POST))
		{ 
		 $this->form_validation->set_rules('mobile_no', 'Mobile', 'min_length[10]');
      
         $this->form_validation->set_rules('address', 'Address', 'required');
		 $this->form_validation->set_rules('username', 'Name', 'required');
		 $this->form_validation->set_rules('state',  'State', 'required');
         $this->form_validation->set_rules('country', 'Country', 'required');
		
		 
		 if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/edit_admin');
							 
          } else{
				
		$id= $_POST['id'];
		

		$data['row']=$this->admin_model->update_row($id);
		
		  }
		
		}
}
			public function add_data() {
			$this->admin_model->allowusercadmin();	
			$arr['subresult']= $this->admin_model->dofindall();
				$this->load->view('admin/add_admin', $arr);
		   }
		   
		   public function add_admin() {
              if(isset($_POST))
		   { 
		   
		 $this->form_validation->set_rules('email', 'Emailid', 'required');
		 $this->form_validation->set_rules('email', 'Email_id', 'is_unique[admin_user.email]');
		 $this->form_validation->set_rules('mobile_no', 'Mobile', 'min_length[10]');
         $this->form_validation->set_rules('password', 'Password', 'required') ;
         $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]|required');
         $this->form_validation->set_rules('address', 'Address', 'required');
		 $this->form_validation->set_rules('name', 'Name', 'required');
		 $this->form_validation->set_rules('state',  'State', 'required');
         $this->form_validation->set_rules('country', 'Country', 'required');
		
		 
		 if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/add_admin');
				 
          } else{
		  $data['row']=$this->admin_model->add_admin();
		  }
		
		}
		
		}
		public function manage_account() {
			$this->admin_model->allowusermadmin();	
          $this->admin_model->allowuser();	   
		 $data['row']=$this->admin_model->manage_account();
		$data['row']=$data['row'][0];
		$data['subresult']= $this->admin_model->dofindall();
		$this->load->view('admin/edit_account',$data);
		   
	  
		
		}
		
		public function edit_account() {
        if(isset($_GET['id']))
		{ 
		$id= $_GET['id']; 
		$data['row']=$this->admin_model->edit_account($id);
		$data['subresult']= $this->admin_model->dofindall();
		$this->load->view('admin/edit_account_form',$data);}
		
		}
		
			public function add_subscription() {
        if(isset($_POST))
		{ 
		//$id= $_POST['user_id'];
	
		$data['row']=$this->admin_model->add_subs_new();
	
		}
}
	 
	 public function logout() {
		 
		 $this->session->unset_userdata('a_id');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('a_email');
       // $this->session->unset_userdata('admin_type');
        $this->session->unset_userdata('is_admin_login');
		// $this->session->sess_destroy();
		 $this->load->helper('cookie');
		 delete_cookie("name");
		 redirect(admin/home);
		 //$this->load->view('admin/home');
       
     }
	 public function uniquemail() {
			//print_r($_POST); die;
			$this->admin_model->uniquemailm();
	 }
	 public function useraccess() {
			$this->admin_model->useraccessmod();
	 }
}
	?>