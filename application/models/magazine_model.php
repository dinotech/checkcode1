<?php

 class Magazine_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row(){
		//$start=0;
		$limit=10;
		
		 $query=$this->db->query("select * from magazine where status=1 order by mag_id asc");
		 $row=$query->result_array();
		
		   return $row;
		}
	public function get_seq($user){
		
		 $query=$this->db->query("select code from user where role='".$user."' order by user_id DESC");
		 $row=$query->result_array();//echo'<pre>';print_r($row);die;
		 if(sizeof($row)==0){ if($user=='franchise'){$row['0']['code']='F_'."11111111";}else if($user=='executive'){$row['0']['code']='E_'."11111111";}}
		 else{
			 $newstring = substr($row[0]['code'], -8);
                         $s = $newstring+1;
			  if($user=='franchise'){ 
			 $row[0]['code']='F_'.$s;}
			 else if($user=='executive'){$row[0]['code']='E_'.$s;}}
		 
		   return $row;
}
	public function details($data1,$data2)
	{
		//print_r($data1);
		//echo'<br>';print_r($data2);die;
	}
	public function notpublished(){
	 $query=$this->db->query("select * from magazine where status=0 && stoppublishing=1");
		 $row=$query->result_array();
		
		   return $row;
	}		
			
	public function view_edition($id){
		
		 $query=$this->db->query("select * from magazine_sub where parentid = $id order by mag_id DESC");
		
		 $row=$query->result_array();
		   return $row;
			}
	public function latestvolume($id){
		
		 $query=$this->db->query("select latestvolume,latestissue from magazine where mag_id = $id");
		 $row=$query->result_array();
		
		   return $row;
			}
	public function oldmagzissue(){
		//echo'<pre>'; print_r($_GET['magzid']);
		$query=$this->db->query("select DISTINCT vol_num from magazine_sub where parentid = ".$_GET['magzid']);
		$row=$query->result_array();		
		return $row;
	}
	public function oldmagzvolissue(){		
		$query=$this->db->query("select DISTINCT issue_num from magazine_sub where parentid ='".$_POST['parentid']."' && vol_num ='".$_POST['volid']."'");
		$row=$query->result_array();		
		return $row;
	}				
	public function magzdetail($id){
		$query=$this->db->query("select newvol,allowedissues from volume_settings where parentid = $id");
		$row=$query->result_array();		
		return $row;
	}					
	public function issue_update(){
		$this->db->query("update volume_settings set allowedissues = '".$_POST['totissues']."' where parentid = '".$_POST['id']."'");
		redirect('admin/magazine/volsetting?magzid='.$_POST['id'].'&action=insert');
	}
	public function vol_update(){		
		$this->db->query("update volume_settings set newvol = '".$_POST['latestvol']."' where parentid = '".$_POST['id']."'");
		$this->db->query("update magazine set latestvolume = '".$_POST['latestvol']."',latestissue=0 where mag_id= '".$_POST['id']."'");
		redirect('admin/magazine/volsetting?magzid='.$_POST['id'].'&action=insert');
	}
	public function supplemented1($newfilename){		
	
		//echo'<pre>';print_r($_POST); //print_r($_FILES['magvol']['name']);
//die;
	$pre = $this->db->query("select mag_id from   magazine_sub where parentid = '".$_POST['parentid']."' && vol_num = '".$_POST['volume']."' &&issue_num = '".$_POST['issue']."'");        
		$pre1 = $pre->result_array();
//print_r($pre1);die;
                  $this->db->query("insert into magazine_sub set  issue_name = '".$newfilename."', thumbnail = '".$_FILES['magvolimg']['name']."', path= '".$_FILES['magvol']['name']."',  supplementname = '".$_POST['supname']."'");
$lastinsertion = $this->db->insert_id();
 redirect('admin/read?mag='.$newfilename.'&id='.$_POST['parentid'].'&action=verify&page=supplemented&last='.$lastinsertion.'&pre='.$pre1[0][mag_id]);
        
	}	
			
  public function add_volume($newname)
	  {	 
		 $data_insert = array(
		'parentid' => $_POST['parent_id'],
		'vol_num' => $_POST['vol'],
		'issue_num' => $_POST['issue'],
		'issue_name' => $newname,
		'thumbnail' => $_FILES['magvolimg']['name'],
		'path' => $_FILES['magvol']['name'],
                'status' => '0'
		);
	  $this->db->insert('magazine_sub', $data_insert);
      $lastinsertion = $this->db->insert_id();
	  $query=$this->db->query("select allowedissues from volume_settings where parentid =".$_POST['parent_id']);
	  $row=$query->result_array();
	  if($_POST['issue'] == ($row[0]['allowedissues']))
	  {
		  $newvol = $_POST['vol']+1;
	  	  $newissue = 0;
	  }
	  else{
		  $newvol = $_POST['vol'];
	  	  $newissue = $_POST['issue'];
	  }
	  $this->db->query("update magazine set latestvolume = '".$newvol."',
	  								 latestissue = '".$newissue."',
									 path = '".$_FILES['magvolimg']['name']."',
									 thumbnail = '".$_FILES['magvolimg']['name']."' where mag_id = '".$_POST['parent_id']."'");
	  $this->db->query("update volume_settings set newvol = '".$newvol."' where parentid = '".$_POST['parent_id']."'");								 
	 /* dealer_info redirect('admin/dealer');*/
	    redirect('admin/read?mag='.$newname.'&id='.$_POST['parent_id'].'&action=verify&page=new&last='.$lastinsertion);
                      
	  }
				
	
 public function insert_row(){ 
		 $data_insert = array(
		'd_name' => $_POST['dname'],
		'd_address' => $_POST['address'],
		'phone' => $_POST['phone'],
		'mobile' => $_POST['mobile'],
		'cur_date' => $odate//$_POST['cdate']
	);
	$this->db->insert('party', $data_insert);
	 /* dealer_info redirect('admin/dealer');*/
	    redirect('admin/party');
	  }
 public function stopped(){  
		 $data_insert = array(
		'sp_parentid' => $_POST['magid'],
		'sp_review' => $_POST['desc'],			
	);
	$this->db->insert('stopped_publication', $data_insert);
	$this->db->query("update magazine set status = 0, stoppublishing = 1 where mag_id = '".$_POST['magid']."'");
	    redirect('admin/magazine?action=delete');
	  }	  
	  
 public function delete_row(){  
 		$id=$id =$this->input->get('id', TRUE); 
	  
	  $this->db->where('dealer_id',$id);
	  /* $this->db->delete('dealer_info');  */
      $this->db->delete('party');
	  redirect('admin/party'); 
	 
	  }
 
	public function add_magz_new()
	  { 
	  /*echo'<pre>';print_r($_POST);
	  	print_r($_FILES);die;*/
		/*$rand=rand(99999,999999);
		$tmp_name = $_FILES["magimg"]["tmp_name"];
		$name = $_FILES["magimg"]["name"];
		$path = $_SERVER['DOCUMENT_ROOT'].'/mahima/emagzine/assets/images/'.$name;
		move_uploaded_file($tmp_name, $path);*/
		$name = $_FILES["magimg"]["name"];
		$data_insert = array(
		 
		 'name' => $_POST['name'],
		 'price' => $_POST['price'],
		 'frequency' => $_POST['freq'],
		 'category' => $_POST['magcat'],
		 'path' => $name,
		 'thumbnail' => $name,
		 'description' => $_POST['desc'],
		 'status' => $_POST['status'],
		 'publish_date' => $_POST['date']
		);
	$this->db->insert('magazine', $data_insert);
	$insert_id = $this->db->insert_id();
	$data_insert = array(
		 
		 'parentid' => $insert_id,
		 'newvol' => '1',
		 'allowedissues' => '5',
		 
		);
	$this->db->insert('volume_settings', $data_insert);	 
	    redirect('admin/magazine');
	
 		}
	public function republished(){	

 $newname = str_replace(".pdf","",$_FILES['republish']['name']);

		$query = $this->db->query("select mag_id from magazine_sub where parentid= '".$_POST['parentid']."' && vol_num= '".$_POST['volume']."' && issue_num = '".$_POST['issue']."'");
               $row=$query->result_array();

                $this->db->query("insert into magazine_sub set path= '".$_FILES['republish']['name']."',issue_name = '".$newname."', repub_description= '".$_POST['desc']."'");
$lastid = $this->db->insert_id();
		redirect('admin/read?mag='.$newname.'&id='.$_POST['parentid'].'&action=verify&page=republish&last='.$lastid.'&pre='.$row[0]['mag_id']);
	}
	
	public function supplements(){	
	//echo'<pre>';print_r($_POST);print_r($_FILES);die;			
		//$this->db->query("update magazine_sub set supplementname = '".$_FILES['republish']['name']."',repub_description= '".$_POST['desc']."' where parentid= '".$_POST['parentid']."' && vol_num= '".$_POST['volume']."' && issue_num = '".$_POST['issue']."'");
		//redirect('admin/magazine/manage_magz?magzid='.$_POST['parentid'].'&action=insert&page=republish');
	}	
	public function get_magbyid($id)
	 {
	  $row = $this->db->query("select * from  magazine where mag_id = ".$id." and status='1'");
	 $row_data =$row->result_array(); 
	 //print_r($row_data[0])	 ;die;
      return $row_data[0];	 
	 }	
	 public function change_price(){
	 
	 $this->db->query("update magazine set price='".$_POST['price']."' where mag_id='".$_POST['id']."'");
	 redirect('admin/magazine/volsetting?magzid='.$_POST['id']);
	 }
		
 }