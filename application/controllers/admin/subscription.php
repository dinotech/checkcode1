<?php
//include_once("config.php");
//include_once("functions.php");
//include "test.php";
class Subscription extends CI_Controller {


public function __construct() {
parent::__construct();
$this->load->model('subscription_model');
$this->load->model('subscribers_model');
$this->load->model('home_model');
$this->load->model('editSubs_model');
$this->load->model('admin_model');

}

public function index() {

if((isset($_POST['next'])) || (isset($_POST['pre']))){

$s=$_POST['limit'];
$limit=10;
if(isset($_POST['pre'])){
$start=($s-2)*10;
$data['limit']=$s-1;	
$data['row']=$this->subscription_model->get_row($start);
$data['row']=$data['row'][0];

}else{
$start=$s*10;
$data['limit']=$s+1;
$data['row']=$this->subscription_model->get_row_data();

}

}
else{
$data['limit']="1";
$this->load->model('subscription_model');
$data['row']=$this->subscription_model->get_row_data();
$data['subresult']= $this->admin_model->dofindall();
}
$this->load->view('admin/subscription',$data);

}

public function edit_sub() {
if(isset($_GET['id']))
{ 
$id= $_GET['id']; 
$data['row']=$this->editSubs_model->get_row($id);
$data['row']=$data['row'][0];

$this->load->view('admin/edit_subs',$data);}

}

public function save_edit() {
if(isset($_POST))
{ 
$id= $_POST['sub_id'];

$data['row']=$this->editSubs_model->insert_row($id);

}
}
public function add_data() {

$arr['users'] = $this->subscription_model->get_user();
$arr['magazines'] = $this->subscription_model->get_magazine();
$this->load->view('admin/add_subs',$arr);
}



public function add_subscription() {
if(isset($_POST))
{ 
//$id= $_POST['user_id'];

$data['row']=$this->editSubs_model->add_subs_new();
//redirect('admin/datatables');
//$data['row']=$data['row'][0];
//echo '<pre>'; print_r($data);die;
//$this->load->view('admin/edit_user',$data);}
//$this->datatables_model->edit_user($_POST);
//echo "controller call"; die;Dealer
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
redirect('admin/home');
//$this->load->view('admin/home');
}
public function abt_to_expire(){
$arr['abt_to_expire']=1;
$arr['expired']=0;
$arr['all_subs']=0;
$arr['row']=$this->subscribers_model->abttoexpire();
$arr['subresult']= $this->admin_model->dofindall();
$this->load->view('admin/subscribers',$arr);
}
public function expired(){
$arr['abt_to_expire']=0;
$arr['expired']=1;
$arr['all_subs']=0;
$arr['row']=$this->subscribers_model->expire();
$arr['subresult']= $this->admin_model->dofindall();
$this->load->view('admin/subscribers',$arr);
}
public function all_subs(){
$arr['abt_to_expire']=0;
$arr['expired']=0;
$arr['all_subs']=1;
$arr['row']=$this->subscribers_model->allsubs();
$arr['subresult']= $this->admin_model->dofindall();
$this->load->view('admin/subscribers',$arr);

}
public function hide_row(){
//echo $_POST['payid']; 
$sql = $this->db->query("update subscription set `status`=3 where sub_id='".$_POST['subid']."'");

redirect('admin/subscription/expired');
}
public function search()
{
//echo "<pre>";print_r($_POST);die;
$var = $this->subscription_model->searching();
return $var;
}
public function details_page(){
$arr['row']=$this->subscription_model->user_details($_GET['user']);
$this->load->view('admin/details_page',$arr);
}

}
?>