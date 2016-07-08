<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Idmodification extends CI_Controller {
  public function __construct() {
         parent::__construct();
		 $this->load->model('idmodification_model');
		 $this->load->model('admin_model');
		 
    }
	
	public function index(){	
      $arr['content'] = $this->idmodification_model->get_modify();
	  $arr['subresult']= $this->admin_model->dofindall();
			$this->load->view('admin/idmodification',$arr);
	}
	
	public function editmail(){

$newmail=trim($_POST['new_mail']);
$oldmail=trim($_POST['old_mail']);	
 //print_r($_POST);die;
 if($_POST['submit']=='Approve'){
	 
	 		if($this->db->query("update user set `email_id`='".$newmail."' where email_id ='".$oldmail."'")){
		
		$this->db->query("update id_modify set `status`='1' where id ='".$_POST['id']."'");
		    	$this->db->query("INSERT INTO `transaction_register`(`date`, `time`, `usercode`, `event`) VALUES ('".date('Y-m-d')."','".date('H:i:s', time())."','".$this->session->userdata('id')."','User mail Id Modification')");
				
				$arr['success'] = "<p>Your Mail id Is Reset Sucessfully</p>";
$to      = $_POST['old_mail'];
$subject = 'E-magazine - Mail Id edited';
$message ='<html><body>';
$message .= 'As you requested your mail id id edited <br  /> your mail id is -  '.$_POST['new_mail'];
$message .='</body></html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:  <emagazine@itrportfolio.com>' . "\r\n";

mail($to, $subject, $message, $headers);
     $arr['content'] = $this->idmodification_model->get_modify();
	 $this->load->view('admin/idmodification',$arr);
	 }
 }else  if($_POST['submit']=='Reject'){
	 
	 			$this->db->query("update id_modify set `status`='2' where id ='".$_POST['id']."'");
				$arr['error'] = "<p>Your Mail Id Is Rejected</p>";
			    $arr['content'] = $this->idmodification_model->get_modify();
            	 $this->load->view('admin/idmodification',$arr);

 
	
	}
	}
}
	
	
