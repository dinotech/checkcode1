<?php
//include_once("../../../../../../../192.168.2.71/htdocs/mahima/emagzine/application/controllers/admin/config.php");
//include_once("../../../../../../../192.168.2.71/htdocs/mahima/emagzine/application/controllers/admin/functions.php");
//include "../../../../../../../192.168.2.71/htdocs/mahima/emagzine/application/controllers/admin/test.php";




class Datatables extends CI_Controller {


  public function __construct() {
         parent::__construct();
		 $this->load->model('home_model');
		 $this->load->model('datatables_model');
		 $this->load->model('edituser_model');
		  $this->load->model('magazine_model');
              $this->load->model('subscription_model');
			  $this->load->model('admin_model');
        $this->load->library('form_validation');
    }

    public function index() {
		
        $arr['page'] ='datatables';
	   	if((isset($_POST['next'])) || (isset($_POST['pre']))){
			 
			$s=$_POST['limit'];
			
			$limit=10;
			if(isset($_POST['pre'])){
			$start=($s-2)*10;
			$data['limit']=$s-1;	
			$data['row']=$this->datatables_model->get_row($start);
			$data['row']=$data['row'][0];
				
			}else{
			$start=$s*10;
			$data['limit']=$s+1;
			$data['row']=$this->datatables_model->get_row($start);
			$data['row']=$data['row'][0];
			}
			
 }
 else{
	 $data['limit']="1";
	 $this->load->model('datatables_model');
	 $start=0;
	 $data['row']=$this->datatables_model->get_row($start);
	 $data['row']=$data['row'][0];
 }

		
        $this->load->view('admin/datatables',$data);
   
	}
	
	public function edit_user() {
        if(isset($_GET['id']))
		{ 
		$id= $_GET['id'];
		$data['row']=$this->edituser_model->get_row($id);
		$data['row']=$data['row'][0];
	
		$this->load->view('admin/edit_user',$data);}
	
		}
		
		public function save_edit() {
        if(isset($_POST))
		{ 
		$id= $_POST['user_id'];
	
		$data['row']=$this->edituser_model->insert_row($id);
		
		}
}
			public function add_data() {
				$arr['user'] = $_GET['acc'];
				$arr['magazines'] = $this->magazine_model->get_row();
				$arr['seq'] = $this->magazine_model->get_seq($arr['user']);
				$arr['subresult']= $this->admin_model->dofindall();
			      $this->load->view('admin/add_user',$arr);
		}
		
		
		
		public function add_userdata() {
			if(isset($_POST))
			{ 
				$data['row']=$this->edituser_model->add_user_new();
			}
		}
		public function add_userdata1() {

			if(isset($_POST))	{ 
			$this->form_validation->set_rules('fcode',' Code', 'trim|required');
		 $this->form_validation->set_rules('fname','Name', 'trim|required');
		 $this->form_validation->set_rules('emailid1','Email ID', 'trim|required');
         $this->form_validation->set_rules('addr1','Address', 'trim|required') ;
		 $this->form_validation->set_rules('country','Country', 'trim|required') ;
         $this->form_validation->set_rules('state', 'State', 'trim|required');
         $this->form_validation->set_rules('fmob1','Mobile', 'trim|required');

if($_POST['rolename']=='franchise'){		 
$this->form_validation->set_rules('fname2','Name For Proprietor Contact','trim|required');
		 $this->form_validation->set_rules('fmob2','Mobile For Proprietor Contact','trim|required');
         $this->form_validation->set_rules('femailid2','Email Id For Proprietor Contact ','trim|required');
		 $this->form_validation->set_rules('faddr2','Address For Proprietor Contact ','trim|required');
		 }
//echo'<pre>';print_r($_POST);die;
          if ($this->form_validation->run() == FALSE) {
			  	$arr['user'] =$_POST['rolename'];
		       	$arr['magazines'] = $this->magazine_model->get_row();
				$arr['seq'] = $this->magazine_model->get_seq($arr['user']);
		      $this->load->view('admin/add_user.php',$arr);
			   }else{
				$data['row']=$this->edituser_model->add_franchisenew();
			   }
			}
			}
	 
	 public function logout() {
		 
		 $this->session->unset_userdata('a_id');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('a_email');
       // $this->session->unset_userdata('admin_type');
        $this->session->unset_userdata('is_admin_login');
		 //$this->session->sess_destroy();
		 $this->load->helper('cookie');
		 delete_cookie("name");
		 redirect('admin/home');
		
       
     }
	 
	public function businessReport(){
		$data['use'] = $_GET['acc'];
		$data['user'] = $this->edituser_model->allfrench($_GET['acc']);
		$data['subresult']= $this->admin_model->dofindall();
		  $this->load->view('admin/busireport' , $data);
//		  $this->load->view('admin/add_user',$arr);	
	}
	
	public function findallrecords()
	{
		$query1 = $this->db->query("select mag_id, name from magazine where status =1");
		$row=$query1->result_array();	
		$arr = array();
		//echo'<pre>';print_r($row);die;	
		foreach($row as $qq)
			{
				
				$query2 = $this->db->query("select * from subscription where tracking = ".$_POST['fid']." && mag_id = '".$qq['mag_id']."' && status = 2");							
				//$arr[$qq['name']] = array('users' => $query2->num_rows);
				$dur=0;
				$amt=0;
				foreach($query2->result_array() as $qw)
				{//echo'<pre>';print_r($qw);
				if(sizeof($qw) != '0')
					{
							$dur += $qw['duration']	;
							$amt += $qw['amount'];
					}
					$arr[$qq['name']] =array('dur' => $dur , 'amt' => $amt, 'users' => $query2->num_rows);
			}
				
			}
			if(sizeof($arr) != '0')
			{
				echo json_encode($arr);
			}
			else 
			{
				echo '0';
			}
			
	}
	public function findallrecordswidate()
	{
		$query1 = $this->db->query("select mag_id, name from magazine where status =1");
		$row=$query1->result_array();	
		$arr = array();
		//echo'<pre>';print_r($_POST);die;	
		foreach($row as $qq)
			{				
				$query2 = $this->db->query("select * from subscription where tracking = ".$_POST['fid']." && mag_id = '".$qq['mag_id']."' && status = 2 && start_time BETWEEN '".$_POST['sdate']."' AND  '".$_POST['edate']."'");							
				//print_r("select * from subscription where tracking = ".$_POST['fid']." && mag_id = '".$qq['mag_id']."' && status = 2 && start_time BETWEEN '".$_POST['sdate']."' AND  '".$_POST['edate']."'");				
				$dur=0;
				$amt=0;		
				//echo'<pre>';print_r($query2->result_array());		
				foreach($query2->result_array() as $qw)
				{
					if(sizeof($qw) != '0')
					{
							$dur += $qw['duration']	;
							$amt += $qw['amount'];
							$arr[$qq['name']] =array('dur' => $dur , 'amt' => $amt, 'users' => $query2->num_rows);
					}
				}
			}
		
		echo json_encode($arr);
	}
}
	?>