<?php
class Subscription_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}

    public function get_row($start){
		//$start=0;
		$limit=10;
		
 $query=$this->db->query("select * from subscription where status!=2 order by sub_id asc  ");
 $row=$query->result_array();
 
 return $row;
		
	}
public function get_row_data(){
	
$query=$this->db->query("select *,s.status from subscription as s join user as u on s.user_id=u.user_id where s.status!=2 order by sub_id asc  ");
$row=$query->result_array();
//echo'<pre>';print_r($row);die;
return $row;

	}
	
 public function insert_row()
	  { 
	  $odate=$_POST['cdate'];
	  if(empty($_POST['cdate'])){
		  $odate=date('Y-m-d');
		  }
	  
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
	  
 public function delete_row()
	  {  $id=$id =$this->input->get('id', TRUE); 
	  
	  $this->db->where('dealer_id',$id);
	  /* $this->db->delete('dealer_info');  */
      $this->db->delete('party');
	  redirect('admin/party'); 
	 
	  }
	  
	   public function get_subs($user)
	   
	  {  
	  if($user=='subscriber'){
	    $sql = "Select s.*,u.email_id,u.name,u.mobile,u.role from user as u join subscription as s on s.user_id = u.user_id  where u.role = '".$user."' AND u.code='direct'";
	  }else{
		$sql = "Select s.*,u.code,u.email_id,u.name,u.mobile,u.role from user as u join subscription as s on s.user_id = u.user_id  where u.role = '".$user."'";
	 
	// echo "Select s.*,u.code,u.email_id,u.name,u.mobile,u.role from user as u join subscription as s on s.user_id = u.user_id  where u.role = '".$user."'";
	  } 
	  
	  
	  $val = $this->db->query($sql);
	  $row= $val->result_array();
	//  echo "<pre>"; print_r($row);
       return $row;
	 
	  }

      public function fget_subs($payid){
	  
	  $sql = $this->db->query("select * from subscription where payment_id='".$payid."' and tracking!=0");
	  $row = $sql->result_array();
	  //echo "<pre>"; print_r($row);
	  return $row;

	  }
	  
	   public function get_user(){
	   
	   $sql=$this->db->query("select * from user ");
	   $row= $sql->result_array();
	   
	   return $row; 
	   
	   }
	  
	   public function get_magazine(){
	   
	   $sql=$this->db->query("select * from magazine ");
	   $row= $sql->result_array();
	  // print_r($row); die;
	   return $row;   
	   
	   }
	   public function findallrecords($fid)
	{
		$query1 = $this->db->query("select mag_id, name from magazine where status =1");
		$row=$query1->result_array();	
		//echo'<pre>';print_r($row);die;	
		foreach($row as $qq)
			{
				$query2 = $this->db->query("select * from subscription where tracking = ".$fid." && mag_id = '".$qq['mag_id']."' && status = 2");							
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
		echo json_encode($arr);
	}

	 public function searching()	   
	  {  
	  //echo'<pre>';print_r($_POST);echo'</pre>';
	  $new_row=array();
		 $newrow=array();
		 
		  if(isset($_POST['item']) && $_POST['item']=='')
		  {
			  $sql = "Select * from user as u join subscription s on u.user_id=s.user_id  where u.role ='subscriber'";
              $val = $this->db->query($sql);
				
		  }
		  else if(isset($_POST['obj']) && $_POST['obj']=='Co')
		  {
			  	$sql = "Select * from user as u join subscription s on u.user_id=s.user_id  where u.country LIKE '%".$_POST['item']."%' && u.role='".$_POST['user']."'";
                $val = $this->db->query($sql);
		  }
		  else if(isset($_POST['obj']) && $_POST['obj']=='fr')
		  {
			  //var_dump($_POST['item']);die;
			 //print_r("select user_id from user where name  LIKE '%".$_POST['item']."%' OR code LIKE '%".$_POST['item']."%' OR email_id LIKE '%".$_POST['item']."%' && role ='franchise'");
			    $query= $this->db->query("select user_id from user where name  LIKE '%".$_POST['item']."%' OR code LIKE '%".$_POST['item']."%' OR email_id LIKE '%".$_POST['item']."%' && role ='franchise'");
			    $q=$query->result_array();	  
				//print_r("Select * from user as u join subscription as s on u.user_id=s.user_id  where  u.code = '".$q[0]['user_id']."' && u.role ='subscriber' && s.tracking='".$q[0]['user_id']."'");			

                $val = $this->db->query("Select * from user as u join subscription as s on u.user_id=s.user_id  where  u.code = '".$q[0]['user_id']."' && u.role ='subscriber' && s.tracking='".$q[0]['user_id']."'");
				//print_r($val->result_array());die;
		  }
		  else if(isset($_POST['obj']) && $_POST['obj']=='ex')
		  {
    		   $query= $this->db->query("select user_id from user where name  LIKE '%".$_POST['item']."%' OR code LIKE '%".$_POST['item']."%' OR email_id LIKE '%".$_POST['item']."%' && role ='executive'");
			   $q=$query->result_array();
			    if(!isset($q[0]['user_id']))
			  	{
					$q[0]['user_id'] = 0;
				}
				$sql = "Select * from user as u join subscription s on u.user_id=s.user_id  where  u.code = '".@$q[0]['user_id']."' && u.role ='subscriber' && s.tracking='".$q[0]['user_id']."'";
                $val = $this->db->query($sql);

		  }
		   else if(isset($_POST['obj']) && $_POST['obj']=='St')
		  {
			  	$sql = "Select * from user as u join subscription s on u.user_id=s.user_id where u.state LIKE '%".$_POST['item']."%' && u.role = '".$_POST['user']."'";
                $val = $this->db->query($sql);
		  }
		  else if(isset($_POST['obj']) && $_POST['obj']=='Ci')
		  {
			  	$sql = "Select * from user as u join subscription s on u.user_id=s.user_id where  u.city LIKE '%".$_POST['item']."%' && u.role = '".$_POST['user']."'";
                $val = $this->db->query($sql);
		  }
		  else if(isset($_POST['obj']) && $_POST['obj']=='mag1')
		  {
			  	$sql1 = $this->db->query("Select m.mag_id from magazine as m join  magazine_sub as ms on m.mag_id=ms.parentid  where m.name LIKE '%".$_POST['item']."%'  OR  m.category LIKE '%".$_POST['item']."%' OR  ms.issue_name LIKE '%".$_POST['item']."%'");
                $q = $sql1->result_array();
				if(sizeof($q)==0){$q[0]['mag_id']=0;}
				
				
				$sql = "Select * from user as u join subscription s on u.user_id=s.user_id where s.mag_id LIKE '%".@$q[0]['mag_id']."%'  && u.role = '".$_POST['user']."'";
                $val = $this->db->query($sql);
				
		  }
		   else if(isset($_POST['obj']) && $_POST['obj']=='mag2')
		  {
			  //print_r("Select m.mag_id from magazine as m join  magazine_sub as ms on m.mag_id=ms.parentid  where m.name LIKE '%".$_POST['item']."%'  OR  m.category LIKE '%".$_POST['item']."%' OR  ms.issue_name LIKE '%".$_POST['item']."%'");
			  	$sql1 = $this->db->query("Select m.mag_id from magazine as m join  magazine_sub as ms on m.mag_id=ms.parentid  where m.name LIKE '%".$_POST['item']."%'  OR  m.category LIKE '%".$_POST['item']."%' OR  ms.issue_name LIKE '%".$_POST['item']."%'");
                $q = $sql1->result_array();
				//print_r($q);die;
				
				if(sizeof($q)==NULL){$q[0]['mag_id'] = 0;}
				
				
				$sql = "Select * from user as u join subscription s on u.user_id=s.user_id where s.mag_id LIKE '%".@$q[0]['mag_id']."%'  && u.role = '".$_POST['user']."'";
                $val = $this->db->query($sql);
				
		  }
		  else if(isset($_POST['obj']) && $_POST['obj']=='noi')
		  {
			  	 preg_match_all('!\d+!',$_POST['item'],$m);
				$today = time();	
				$end_time =date('Y-m-d',strtotime("+".$m[0][0]." months",$today));
                $sql = "Select * from user as u join subscription s on u.user_id=s.user_id where  u.status='1' && u.role = '".$_POST['user']."' && s.end_time<='".$end_time."' && s.end_time>'".date('Y-m-d')."'";
                $val = $this->db->query($sql);
		 }
		 else if(isset($_POST['obj']) && $_POST['obj']=='exp')
		  {			  
			  	 preg_match_all('!\d+!',$_POST['item'],$m);
				 $today = time();				
//				  print_r(date('Y-m-d',strtotime("-".$m[0]." months",$today)));die;	
				 $end_time = '';
				 if(!empty($m['0']))
				 $end_time =date('Y-m-d',strtotime("-".$m['0']." months",$today));
				
				 //print_r(date('Y-m-d',strtotime("-".$m[0][0]." months",$today)));
				 $sql = "Select * from user as u join subscription s on u.user_id=s.user_id where   u.role = '".$_POST['user']."' && s.end_time <= '".$end_time."'";
                 $val = $this->db->query($sql);
		  }
		 
 				$row= $val->result_array();
				foreach($row as $r=>$w)
				{	
					$datestr = $w['end_time'];
					$date=strtotime($datestr);//Converted to a PHP date (a second count)
					
					//Calculate difference
					$diff=$date-time();//time returns current time in seconds					
					$days=ceil($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
					$hours=ceil(($diff-$days*60*60*24)/(60*60));
					$months=ceil($days/30);
					if($months>=0)
					{
						$row[$r]['remain'] = $months." Issues";
					}
					else if($months<0)
					{
						$row[$r]['remain'] = "0 Issues";
					}									
					$arr = $this->db->query("select name from magazine where mag_id='".$w['mag_id']."'");
					$ar= $arr->result_array();				
					$row[$r]['mag_name']=trim($ar[0]['name']);
				}
				/*if($_POST['act']==2)
				{
					foreach($row as $k=>$v)
					{
						if(($v['end_time']<date('Y-m-d')) && ($v['status']=='2') ){
							$new_row[$k]=$v;
							}
					}
					$row=array();
					$row=$new_row;
				}*/
				/*if($_POST['act']==1)
				{
					foreach($row as $k=>$v)
					{
						 preg_match_all('!\d+!',$v['remain'],$re);
						//echo "<pre>";
						//print_r($row);
						if($re<=10)
						{
							$newrow[$k]=$v;
						}					
					}
					$row=array();
					$row=$new_row;
				}*/
				//echo "<pre>";print_r($row);
				
			    echo json_encode($row);
	  }
	  public function user_details($id){
		  $sql=$this->db->query("select * from user as u join subscription as s on u.user_id=s.user_id  where u.user_id=".$id." order by s.sub_id DESC");
		  $result=$sql->result_array();
		  foreach($result as $k=>$l){
		  if($l['renew']==1){
		  $sql1=$this->db->query("select start_time as renew_start_time  from renew where sub_id='".$l['sub_id']."' order by renew_id DESC");
		  $req=$sql1->result_array();
		  $result[$k]['renew_details']=$req;
		  }else {
		  $result[$k]['renew_details']='';
		  }
		  
		  
		  $sql2=$this->db->query("select issue_num,issue_name from magazine_sub where  mag_id=".$l['mag_id']);
		  $result2=$sql2->result_array();
		  $result[$k]['mag_subs']=$result2;
		  
		  
		  }
	    	// echo "<pre>";print_r($result);// die;
		   return $result;
	  
	  }
                public function last_franc_id(){
		$sql=$this->db->query("select code from user where role='franchise' order by user_id DESC");
		$result=$sql->result_array();
		if(isset($result[0]['code'])){
		$var = $result[0]['code'];
		}else{
			$var = '1111';
		}
                  return $var;
		}
          
                public function last_exec_id(){
		$sql=$this->db->query("select code from user where role='executive' order by user_id DESC");
		$result=$sql->result_array();
		if(isset($result[0]['code'])){
		$var = $result[0]['code'];
		}else{
			$var = '1111';
		}
                  return $var;
		}




	 
	  
	
 }