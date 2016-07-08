<?php
class Payment extends CI_Controller 
{


		public function __construct() 
		{
			 parent::__construct();
			 $this->load->model('admin_model');
			 $this->load->model('payment_model');
			// $this->load->model('edituser_model');
			$this->load->library('form_validation');
		}

		public function index() 
		{
						//echo'<pre>';print_r($this->session->userdata);die;
					$this->admin_model->allowuser();		
					if ($this->session->userdata('is_admin_login')) 
					{
							//echo $_GET['user'];
							$arr['page'] ='payment';
							$this->load->model('payment_model');
							$data['row']=$this->payment_model->get_row($_GET['user']);
							//echo'<pre>';print_r($data['row']);die;
							$data['subresult']= $this->admin_model->dofindall();

							$this->load->view('admin/payment',$data);
					  }
					 // else if($this->session->userdata('is_admin_login'))
					  {
/*						  $query = $this->db->query("select * from access_control where email='".$this->session->userdata('a_email')."'");
							  $val = $query->result_array();							  
							  foreach($val as $vals)
							  {
								  
									  if($vals['Direct_Payment'] == '1' ) 
									  {
												$arr['page'] ='payment';
												$this->load->model('payment_model');
												$data['row']=$this->payment_model->get_row();
												$this->load->view('admin/payment',$data);			  
									  }
									  else
									  {					  
												$this->load->view('admin/no_permission');
									  }
							  }
*/				  }		
		}
	
	public function edit_payment() {
        if(isset($_GET['id']))
		{ 
				$id= $_GET['id'];
				$data['row']=$this->payment_model->get_row($id);
				//$data['row']=$data['row'][0];
			
				$this->load->view('admin/edit_payment',$data);}
	
		}
		
		public function save_edit() 
		{
				if(isset($_POST))
				{ 
						$id= $_POST['pay_id'];
					
						$data['row']=$this->payment_model->update_row($id);
				
				}
		}
		public function add_data() 
		{			
			      $this->load->view('admin/add_user');		
		}
		
		
		
		public function add_userdata() 
		{
        		if(isset($_POST))
				{ 
						$data['row']=$this->edituser_model->add_user_new();		
				}
		}
	 
	 public function logout() 
	 {		 
				$this->session->unset_userdata('a_id');
				$this->session->unset_userdata('admin_name');
				$this->session->unset_userdata('a_email');
			   // $this->session->unset_userdata('admin_type');
				$this->session->unset_userdata('is_admin_login');
				// $this->session->sess_destroy();
				 $this->load->helper('cookie');
				 delete_cookie("name");
				 redirect('admin/home');
     }
	 
	public function change_state(){
		//echo "<pre>"; print_r($_GET);die;
		if($_POST['act']=='Approve')
			$this->db->query("update subscription set `status`= 2 where payment_id='".$_POST['pay_id']."'");
			//echo $_GET['user'];die;
			redirect('admin/payment?user='.$_POST['user']);
			
			}
}
	?>