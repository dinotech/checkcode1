<?php
//include_once("config.php");
//include_once("functions.php");
//include "test.php";

class Magazine extends CI_Controller {
  public function __construct() {
         parent::__construct();
		 $this->load->model('magazine_model');
		 $this->load->model('editMag_model');
		  $this->load->model('admin_model');
		   $this->load->model('home_model');
		 $this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
        //$this->load->library('form_validation');
    }
	
	    public function index(){	
       // $arr['page'] ='datatables';
	   	if((isset($_POST['next'])) || (isset($_POST['pre']))){
			 
			$s=$_POST['limit'];
			$limit=10;
			if(isset($_POST['pre'])){
			$start=($s-2)*10;
			$data['limit']=$s-1;	
			$data['row']=$this->magazine_model->get_row($start);
			$data['row']=$data['row'][0];
				
			}else{
			$start=$s*10;
			$data['limit']=$s+1;
			$data['row']=$this->magazine_model->get_row($start);
			$data['row']=$data['row'][0];
			}			
 }
 else{
	// $data['limit']="1";
	 $this->load->model('magazine_model');
	$data['row']=$this->magazine_model->get_row();
	 }
		//$data['row']=$this->datatables_model->get_row($start);
		$data['subresult']= $this->admin_model->dofindall();
        $this->load->view('admin/magazine',$data);   
	}
	public function notpublishing(){		
	 $data['row']=$this->magazine_model->notpublished();
	 $data['subresult']= $this->admin_model->dofindall();
	 $this->load->view('admin/publishingstopped',$data); 
	}
	public function manage_magz(){
		if(isset($_GET['magzid']))
		{
			$id = $_GET['magzid'];
			$data['row'] = $this->magazine_model->view_edition($id);
		}
		$data['subresult']= $this->admin_model->dofindall();
		$this->load->view('admin/magazine1',$data);	
	}
	public function upload_edition(){

		if(isset($_REQUEST['magzid']))
		{
			$id = $_REQUEST['magzid'];

			$data['vol'] = $this->magazine_model->latestvolume($id);
		}
		$data['subresult']= $this->admin_model->dofindall();
		$this->load->view('admin/add_magedition',$data);	
	}
	public function upload_vol() {	
		//print_r($_FILES);die;
		$_FILES['magvolimg']['name'] = str_replace(' ', '_', $_FILES['magvolimg']['name']);
	    $config['upload_path'] =  './assets/pdf_thumb/';
		$config['allowed_types'] = 'png|jpg|gif';
		
	      $this->load->library('upload', $config);
		  $this->upload->initialize($config);

		if ( !$this->upload->do_upload('magvolimg'))
		{
		$error = array('error' => $this->upload->display_errors());
     //  print_r($error); die;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
	//		print_r($data); die;

		}	
			//echo "<pre>"; print_r(str_replace(' ', '%20', $_FILES['magvol']['name']));		
		$_FILES['magvol']['name'] = str_replace(' ', '_', $_FILES['magvol']['name']);
		$config['upload_path'] =  './assets/pdf/';
		$config['allowed_types'] = 'pdf';
		
	      $this->load->library('upload', $config);
		  $this->upload->initialize($config);

		if ( !$this->upload->do_upload('magvol'))
		{
		$error = array('error' => $this->upload->display_errors());
     //  print_r($error); die;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		//print_r($data); die;

		}	
		$split = explode(".",$_FILES['magvol']["name"]);
$split[0]=str_replace("'","",$split[0]);

$pdfAbsolutePath = './assets/pdf/'.$_FILES['magvol']["name"];
if (move_uploaded_file($_FILES['magvol']["tmp_name"],$pdfAbsolutePath)) {
      $im   = new imagick($pdfAbsolutePath);
      $noOfPagesInPDF = $im->getNumberImages(); 

      if ($noOfPagesInPDF) {$i=1; 

          
//$newfilename = $split[0].getdate()[0];

            @mkdir('./assets/pdf/'.$split[0] );
           
          for ($i = 0; $i<$noOfPagesInPDF; $i++) { 
             
                   
                 exec("convert -density 300 -trim /home/itrportf/public_html/emagazine/assets/pdf/".$split[0].".pdf[".$i."] -quality 50 /home/itrportf/public_html/emagazine/assets/pdf/".$split[0] ."/".$i.".jpg");
                     
}
    
      }
 
}	
				
		//$this->load->helper(array('form', 'url'));
        	
		$this->magazine_model->add_volume($split[0]);		
		}


	public function modifyvol() {					
		$id = $_GET['magzid'];
		 $data['row'] = $this->magazine_model->oldmagzissue($id);
		 $this->load->view('admin/volsetting' , $data);
		}	
	public function volsetting(){
		 $id = $_GET['magzid'];
		 $data['row'] = $this->magazine_model->magzdetail($id);
		 $data['subresult']= $this->admin_model->dofindall();
		 $this->load->view('admin/volsetting' , $data);
	 }	
	 public function volset_issue_update(){
		 $data['row'] = $this->magazine_model->issue_update();
		 
	 }
	 public function volset_vol_update(){
		 $data['row'] = $this->magazine_model->vol_update();
		 
	 }
	 public function republish() {					
		$id = $_GET['magzid'];
		 $data['row'] = $this->magazine_model->oldmagzissue($id);
		 $data['subresult']= $this->admin_model->dofindall();
		$this->load->view('admin/republish' , $data);
		}

	public function republished(){		
							
		$config['upload_path'] =  './assets/pdf/';
		$config['allowed_types'] = 'png|jpg|gif';
		
	      $this->load->library('upload', $config);
		  $this->upload->initialize($config);

		if ( !$this->upload->do_upload('magimg'))
		{
		print_r('not uploading...');die;
		$error = array('error' => $this->upload->display_errors());
		$data['error'] =$error['error'];
         }
		else		
		{
		print_r('uploading starts...');
			$data = array('upload_data' => $this->upload->data());
                print_r('uploaded...');die;
		}	
	    
		 $data['row'] = $this->magazine_model->republished();
		 
	 }	
		
	public function stoppublish() {	
	$this->admin_model->allowuserstopmagz();	
		 $data['row'] = $this->magazine_model->get_row();
		 $data['subresult']= $this->admin_model->dofindall();
		 $this->load->view('admin/stoppublish' , $data);
         
		}
	public function stopped() {					
		 $this->load->library('form_validation');
		 $this->form_validation->set_rules('magid', 'Magazine', 'required'); 					 
		 if ($this->form_validation->run() == FALSE) { 
         $this->load->view('admin/stoppublish'); 
         } 
         else { 
		 $this->magazine_model->stopped();		
		 }
		}		
	public function edit_mag() { 
        if(isset($_GET['id']))
		{ 
		$id= $_GET['id']; 
		$data['row']=$this->editMag_model->get_row($id);
		$data['row']=$data['row'][0];
		//echo '<pre>'; print_r($data);die;
		$this->load->view('admin/edit_mag',$data);}
		//$this->datatables_model->edit_user($_POST);
		//echo "controller call"; die;Dealer
		}
		
		public function save_edit() {
        if(isset($_POST))
		{ 
		$id= $_POST['mag_id'];
	   
		$data['row']=$this->editMag_model->insert_row($id);
		//redirect('admin/datatables');
		//$data['row']=$data['row'][0];
		//echo '<pre>'; print_r($data);die;
		//$this->load->view('admin/edit_user',$data);}
		//$this->datatables_model->edit_user($_POST);
		//echo "controller call"; die;Dealer
		}
}
		public function add_magzdata() 
		{
		$this->admin_model->allowuseraddmagz();
		$arr['subresult']= $this->admin_model->dofindall();
		$this->load->view('admin/add_mag',$arr);
		}
		public function add_magazine() 
		{	
		$_FILES['magimg']['name'] = str_replace(' ', '_', $_FILES['magimg']['name']);		
		$config['upload_path'] =  './assets/pdf_thumb/';
		$config['allowed_types'] = 'png|jpg|gif';
		
	    $this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( !$this->upload->do_upload('magimg'))
		{
		$error = array('error' => $this->upload->display_errors());
       //print_r($error);die;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
    // print_r($data);die;
		}	
				$this->load->library('upload');
				$this->load->helper(array('form', 'url'));
        		$this->magazine_model->add_magz_new();
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
		 redirect('admin/home');
		 //$this->load->view('admin/home');
       
     }
	 public function underprocess(){
		$this->load->view('admin/siteunderconstruction') ;
	 }
	 public function previous_issues(){		
		 $data['row'] = $this->magazine_model->oldmagzissue();
		 $data['subresult']= $this->admin_model->dofindall();
		 $this->load->view('admin/oldissues' , $data);
	 }
	 public function volumedetails(){
		 if(isset($_POST['volid']) and isset($_POST['parentid']))
       {
           $this->output
           ->set_content_type("application/json")
           ->set_output(json_encode($this->magazine_model->oldmagzvolissue($_POST['volid'] , $_POST['parentid'])));
       }	 
		 
	 }



public function particularmag()
		{
			$query=$this->db->query("select issue_name from magazine_sub where parentid ='".$_POST['mag']."' and vol_num = '".$_POST['vol']."' and issue_num = '".$_POST['issue']."'");
	  $row=$query->result_array();
//print_r($row);die;
          echo json_encode($row[0]);
		}




	 
	 public function samplereading(){
		 $id = $_GET['magzid'];
		 $data['row'] = $this->magazine_model->oldmagzissue($id);		
		$this->load->view('admin/samplereadingpage') ;
	 }
	public function supplement() {	
		$id = $_GET['magzid'];
		 $data['row'] = $this->magazine_model->oldmagzissue($id);
		 $data['subresult']= $this->admin_model->dofindall();
		$this->load->view('admin/supplement' , $data);
	//	$this->magazine_model->	supplements();		
	}
	
	public function supplemented()
	{
			
		//print_r($_FILES);die;
		$_FILES['magvolimg']['name'] = str_replace(' ', '_', $_FILES['magvolimg']['name']);
	    $config['upload_path'] =  './assets/pdf_thumb/';
		$config['allowed_types'] = 'png|jpg|gif';
		
	      $this->load->library('upload', $config);
		  $this->upload->initialize($config);

		if ( !$this->upload->do_upload('magvolimg'))
		{
		$error = array('error' => $this->upload->display_errors());
     //  print_r($error); die;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
	//		print_r($data); die;

		}	
			//echo "<pre>"; print_r(str_replace(' ', '%20', $_FILES['magvol']['name']));		
		$_FILES['magvol']['name'] = str_replace(' ', '_', $_FILES['magvol']['name']);
		$config['upload_path'] =  './assets/pdf/';
		$config['allowed_types'] = 'pdf';
		
	      $this->load->library('upload', $config);
		  $this->upload->initialize($config);

		if ( !$this->upload->do_upload('magvol'))
		{
		$error = array('error' => $this->upload->display_errors());
     //  print_r($error); die;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		//print_r($data); die;

		}	
		$split = explode(".",$_FILES['magvol']["name"]);
$split[0]=str_replace("'","",$split[0]);
$split[0] = $split[0].time();
$pdfAbsolutePath = './assets/pdf/'.$_FILES['magvol']["name"];
if (move_uploaded_file($_FILES['magvol']["tmp_name"],$pdfAbsolutePath)) {
      $im   = new imagick($pdfAbsolutePath);
      $noOfPagesInPDF = $im->getNumberImages(); 

      if ($noOfPagesInPDF) { 
 //echo "<pre>";print_r($noOfPagesInPDF );  

      
//$newfilename = $split[0];

            mkdir('./assets/pdf/'.$split[0]);
            
          for ($i = 0; $i<$noOfPagesInPDF; $i++) { 
              $url = $pdfAbsolutePath.'['.$i.']'; 

              /*$image = new Imagick($url);
              $image->setImageFormat("jpg"); 
              $image->setImageCompression(imagick::COMPRESSION_JPEG); 
              $image->setImageCompressionQuality(400);
              $image->writeImage("./assets/pdf/$split[0]/".($i+1).'.jpg'); */
              
              $image = new imagick($url);
              $image->setImageResolution(2550,3300);
              $image->setImageFormat('jpg');
              $image->setImageCompression(imagick::COMPRESSION_JPEG); 
              $image->setImageCompressionQuality(500);              
              $image->writeImage("./assets/pdf/$split[0]/".($i+1).'.jpg');

         
          }
      
 echo "All pages of PDF is converted to images";

    
      }
      echo "PDF doesn't have any pages";

}	
				
		//$this->load->helper(array('form', 'url'));
        	
				
		$this->magazine_model->supplemented1($split[0]);
	}
	
	public function price_set(){
	 $this->magazine_model->change_price();
	}	
}
?>