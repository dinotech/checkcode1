<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Read extends CI_Controller { 

    public function __construct() {
        parent::__construct();
		$this->load->model('home_model');
    }

    public function index(){
		print_r($_GET);die;
        $this->load->view('admin/reading');
	}

    public function issupplementing()
    {
       $query = $this->db->query("select * from magazine_sub where mag_id = ".$_POST['last']);
       $row=$query->result_array();
       
       if(isset($row[0]))
       {
          $issue_name = $row[0]['issue_name'];
          $path = $row[0]['path'];
          $thumbnail = $row[0]['thumbnail'];
          $supplementname= $row[0]['supplementname'];
       }

                                                    
      if($query1 = $this->db->query("update magazine_sub set issue_name = '".$issue_name."',
                                                    path = '".$path."',
                                                    thumbnail = '".$thumbnail."',
                                                    supplementname= '".$supplementname."' where mag_id = '".$_POST['pre']."'"))
      {
        $this->db->query("delete from magazine_sub where mag_id = ".$_POST['last']);
        $qw = 1;
      }
  echo json_encode($qw);  
}


public function republishingis()
{

  $query = $this->db->query("select * from magazine_sub where mag_id = ".$_POST['last']);
 $row=$query->result_array();
if(isset($row[0])){
  $issue_name = $row[0]['issue_name'];
$path = $row[0]['path'];
$repub_description = $row[0]['repub_description'];}

  if($query1 = $this->db->query("update magazine_sub set issue_name = '".$issue_name."',
                                                    path = '".$path."',
                                                    repub_description = '".$repub_description."' where mag_id = '".$_POST['pre']."'"))
{
$this->db->query("delete from magazine_sub where mag_id = ".$_POST['last']);
$qw = 1;
}
  

  echo json_encode($qw);
  
}

public function newpublish()
{

  if($query1 = $this->db->query("update magazine_sub set status=1 where mag_id = '".$_POST['last']."'"))
{

$qw = 1;
}
  echo json_encode($qw); 
}

 

    public function cancelling()
    {
//print_r($_POST);die;
      if($this->db->query("delete from magazine_sub where parentid= '".$_POST['parentid']."' and issue_name = '".$_POST['name']."'"))
       { 
          $q=1;
         echo json_encode($q); 
         }

	  $query = $this->db->query("select latestissue from magazine where mag_id = ".$_POST['parentid']);
      $row=$query->result_array();

$new = $row[0]['latestissue'];$new = $new-1;

	 $this->db->query("update magazine set latestissue = ".$new." where mag_id= '".$_POST['parentid']."'");	 
     }

   public function cancelling1()
    {
      if($this->db->query("delete from magazine_sub where mag_id = ".$_POST['last']))
       { 
          $q=1;
         echo json_encode($q); 
         }
       }
    
}
	?>
		