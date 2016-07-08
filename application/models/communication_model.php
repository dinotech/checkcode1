<?php

 class Communication_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	public function communication_mail(){
		
		
		
		$_FILES['file_name']['name'] = str_replace(' ', '_', $_FILES['file_name']['name']);
		$config['upload_path'] =  './assets/mail_templete/';
		$config['allowed_types'] = 'html|php';
		
	      $this->load->library('upload', $config);
		  $this->upload->initialize($config);

		if ( !$this->upload->do_upload('file_name'))
		{
		$arr['data'] =  $this->upload->display_errors();
       
		}
		else
		{
			$arr['data'] =  $this->upload->data();
			

		}	
	
		
		$config = Array(        
            'protocol' => 'sendmail',
            'smtp_host' => 'localhost',
            'smtp_port' => 587,
            'smtp_user' => 'e-magazine@emithra.com',
            'smtp_pass' => 'em1233#',
            'smtp_timeout' => '4',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
	    $this->email->from('e-magazine@emithra.com', 'E-magazine');
        $data = array('userName'=> 'E-magazine');
        $this->email->to($_POST['mail_id']);  // replace it with receiver mail id
        $this->email->subject('Emagazine'); // replace it with relevant subject 
       
	   
	     $path = HTTP_ASSETS_PATH.'/mail_templete/'.$_FILES['file_name']['name'];
		
          header('Content-type: text/plain');
         $body = file_get_contents($path);
	
		 $body = $_POST['mail_contant'];
	
	    $sql = $this->db->query("select * from mail_settings ");
		$result = $sql->result_array();
		
		if(sizeof($result)==0){
    	$this->db->query("INSERT INTO `mail_settings`(`mail_content`, `file_upload`, `config`, `mail_id`, `identity`) 
		VALUES ('".$_POST['mail_contant']."','".$_FILES['file_name']['name']."','".serialize($config)."','".$_POST['mail_id']."','".$_POST['sender_identity']."')");
		}else {
		$this->db->query("update `mail_settings` set `mail_content`='".$_POST['mail_contant']."' and `file_upload`='".$_FILES['file_name']['name']."' and `mail_id`='".$_POST['mail_id']."' and  `identity`= '".$_POST['sender_identity']."'  ");
		}
	
	        $arr['success']="<p>mail Seting updated</p>";
			redirect('admin/communication/mail_setting',$arr);
		
	}
	
	public function communication_sms(){
	
	
		
		$config = Array(        
            'protocol' => 'sendmail',
            'smtp_host' => 'localhost',
            'smtp_port' => 587,
            'smtp_user' => 'e-magazine@emithra.com',
            'smtp_pass' => 'em1233#',
            'smtp_timeout' => '4',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
		
	    $sql = $this->db->query("select * from sms_settings ");
		$result = $sql->result_array();
		
		if(sizeof($result)==0){
    	$this->db->query("INSERT INTO `sms_settings`( `sms_content`, `configration`)
		VALUES ('".$_POST['msg']."','".serialize($config)."')");
		}else {
		$this->db->query("update `sms_settings` set `sms_content`='".$_POST['msg']."'  where id='1'");
		}
		
		       $arr['success']="<p>SMS Seting updated</p>";
			redirect('admin/communication/sms_setting',$arr);
	}
}