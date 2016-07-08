<?php

error_reporting(1);	

class Createlogin extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model('admin_model');
			$this->load->model('edituser_model');
			$this->load->model('datatables_model');
			$this->load->model('home_model');
		}
		
		public function index() {		
			   // $arr['page'] ='home';
			   // $this->load->view('admin/login',$arr);
		}
	
		public function do_login() 
		{
			
				if(true) 
				{
				
							$user = $_POST['username'];
							$password = $_POST['password'];
							$this->form_validation->set_rules('username', 'Username', 'required');
							$this->form_validation->set_rules('password', 'Password', 'required');	
									
							if ($this->form_validation->run() == FALSE) 
							{
							$this->load->view('admin/login');
				      	} 
					else
					{               	
								$sql = "Select * from super_admin where username = '".$user."'";
								$val = $this->db->query($sql);          
								if ($val->num_rows) 
								{
										foreach ($val->result_array() as $recs => $res) 
										{						
													if($password == $res['password'] )
													{							
																$this->session->set_userdata(array(
																'a_id' => $res['id'],
																'admin_name' => $res['username'],
																'a_email' => $res['email'],   
																'a_role' => $res['role'],                           
																'is_admin_login' => true
																	));		
																$arr['subresult']= $this->admin_model->dofindall();													
																$this->load->view('admin/admin2',$arr);
													}
										}					
							} 
							else
							{
								$sql1 = "Select * from admin_user where email = '".$user."' and password = '".md5($password)."'";
								$val1 = $this->db->query($sql1);
										if ($val1->num_rows) 
										{
												foreach ($val1->result_array() as $recs => $res) 
												{					
													$this->session->set_userdata(array(
													'a_id' => $res['id'],
													'admin_name' => $res['username'],
													'a_email' => $res['email'], 
													'a_role' => $res['role'],                            
													'is_admin_login' => true
														));
													$arr['subresult']= $this->admin_model->dofindall();	
													$this->load->view('admin/admin2',$arr); 
											   }
									}
									else
									{				
										$err['error'] = 'Username or Password incorrect';                 
										$this->load->view('admin/login', $err);                
									}
							}					
						}
				}
		}
		public function manage_users(){  
				if($_GET['user']=='subscriber')
				{
/*						$this->admin_model->allowuserd();	
						$user = $_GET['user'];
						$this->load->model('datatables_model');
						$data['row'] = $this->datatables_model->get_subs($user);
						$data['row']=$data['row'][0];	
*/						$arr['subresult']= $this->admin_model->dofindall();								
						$this->load->view('admin/subscribers', $arr);
				}
				if($_GET['user'] == "franchise")
				{
						$this->admin_model->allowuserf();
						$user = $_GET['user'] ;$data['user'] = $user;  
						$this->load->model('datatables_model');
						$data['row'] = $this->datatables_model->get_subs($user);
						$data['row']=$data['row'][0];	
						$data['subresult']= $this->admin_model->dofindall();
						$this->load->view('admin/manage_allfrenc', $data);
				}
				if($_GET['user'] == "executive")
				{
						$this->admin_model->allowusere();
						$user = $_GET['user'] ;
						$data['user'] = $user;
						$this->load->model('datatables_model');
						$data['row'] = $this->datatables_model->get_subs($user);						
						$data['row']=$data['row'][0];						
						$data['subresult']= $this->admin_model->dofindall();
						$this->load->view('admin/manage_allfrenc', $data);
				}				
				
		}
		
		
		public function franchise(){
			$data['user'] = 'franchise';
			$data['subresult']= $this->admin_model->dofindall();
			$this->load->view('admin/man_french' , $data);	
		}
		public function executive(){
			$data['user'] = 'executive';
			$data['subresult']= $this->admin_model->dofindall();
			$this->load->view('admin/man_french' , $data);	
		}
		
		public function manage_subscription(){  	
			  $user = $_GET['user'] ; 
		if($_GET['user']=='subscriber')
		{
		$this->admin_model->allowuserdsubs();
		
		}
		if($_GET['user'] == "franchise")
		{
			$this->admin_model->allowuserfsubs();
		 
		}
		if($_GET['user'] == "executive")
		{
			$this->admin_model->allowuseresubs();
		  
		}		   
		$this->load->model('subscription_model');
		$data['row'] = $this->subscription_model->get_subs($user);
		
		$this->load->view('admin/subscription', $data);
		}
		
		  public function manage_profile(){  				  
		if ($this->session->userdata('is_admin_login')) 
		{								
			if($this->session->userdata('a_role') == "superadmin"){				
			  $this->load->model('admin_model');
			  $data['row'] = $this->admin_model->get_row();
			  $data['row']=$data['row'][0];
			  $data['subresult']= $this->admin_model->dofindall();
			  $this->load->view('admin/admin_users', $data);
			}else {
				 $data['subresult']= $this->admin_model->dofindall();
				 $this->load->view('admin/no_permission');					
				}
		} 
		else
		{
		   $this->load->view('admin/login');
		}
		}
		
		public function edit_profile(){  
		$this->load->model('admin_model');
		$data['row'] = $this->admin_model->edit_row();
		$data['row']=$data['row'][0];
		$this->load->view('admin/edit_admin', $data);
		}
		
		public function manage_account(){  
		
				if ($this->session->userdata('is_admin_login')) 
				{
					$arr['subresult']= $this->admin_model->dofindall();					
					$this->load->view('admin/manage_account',$arr);
				}
				/*else if($this->session->userdata('is_admin_login'))
				{
						$query = $this->db->query("select * from access_control where email='".$this->session->userdata('a_email')."'");
						$val = $query->result_array();
						foreach($val as $vals)
						{
								if($vals['Admin_Create'] == '1' || $vals['Admin_Create'] == '1')
								{
										$this->load->view('admin/manage_account');						
								}
								else
								{							  
										$this->load->view('admin/no_permission');
								}
						}
				}*/
				else 
				{		
						$this->load->view('admin/login');
				}
		}
		public function go_to_dashboard()
		{				 
				$this->load->view('admin/admin2');
		}
		
		public function showprofile()
		{				 
				if(isset($_GET['id']))
				{ 
				$id= $_GET['id'];				
				$data['row']=$this->edituser_model->get_row($id);
				$data['row']=$data['row'][0];
				$this->load->view('admin/edit_userf',$data);
				}
				
		}
		public function viewupdate()
		{
			//print_r('hello');die;
				$data['row']=$this->edituser_model->see_detail();
				$this->load->view('admin/newdetails',$data);	
		}
		public function updateaccount()
		{
			$data['row']=$this->edituser_model->seedetail();
			$data['subresult']= $this->admin_model->dofindall();
			$this->load->view('admin/updatedetailsf', $data);
		}
		
		public function updatedetails()
		{
			$this->edituser_model->updatedetails();
		}
		
		public function search()
		{
			$var = $this->datatables_model->searching();
			return $var;
		}
		
		public function eidtuser()
		{
			$this->datatables_model->editinguser();
		}
		public function change_status(){
			$this->db->query("update subscription set `status`=".$_POST['act']." where payment_id='".$_POST['pay_id']."'");
			//echo $_GET['user'];die;
			redirect('admin/subscription?user='.$_GET['user']);
			
			}
		public function update_status(){
			$this->db->query("update subscription set `status`='2',newcomings='1' where payment_id='".$_REQUEST['pay_id']."'");
			//echo $_GET['user'];die;
			redirect('admin/Paymentupload');
		}

                 public function update_status1(){
			$this->db->query("update subscription set `status`='2',newcomings='1' where payment_id='".$_REQUEST['pay_id']."'");
                        $this->db->query("update payments set `status`='5'where pay_id='".$_REQUEST['pay_id']."'");
			//echo $_GET['user'];die;
			redirect('admin/Paymentupload');
		}
			public function frenchiseupd()
			{				
					$this->edituser_model->newupd();
			}
}