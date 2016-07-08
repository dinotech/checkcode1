	<?php
	class Payment_model extends CI_Model {
	
	public function __construct()
	{
	$this->load->database();
	}
	
	public function get_row($user){
	
	if($user == 'subscriber')
	{
		
	$query=$this->db->query("SELECT s.user_id, s.start_time, s.payment_id, s.status,s.amount, p.pay_id, p.payment_details, p.date FROM subscription as s LEFT JOIN payments as p on s.payment_id = p.pay_id WHERE s.user_id IN (SELECT user_id FROM `user` WHERE `role`='".$user."' && code = 'direct') AND s.status!=2 ");
	$row=$query->result_array();
	if($row != NULL){
	$query1 = $this->db->query("SELECT * FROM payments WHERE pay_id = '".$row[0]['payment_id']."'");
	$row1 = $query1->result_array();
	if($row1==NULL)
	{
		$row[0]['status']=0;
	}
	}

	return $row;
	}
	if($user == 'franchise')
	{
				
	$query=$this->db->query("SELECT s.user_id, s.start_time, s.payment_id, s.status,s.amount, p.pay_id, p.payment_details, p.date FROM subscription as s LEFT JOIN payments as p on s.payment_id = p.pay_id WHERE s.tracking IN (SELECT user_id FROM `user` WHERE `role`='".$user."') AND s.status!=2");
	
	$row=$query->result_array();
	//print_r($row);die;
	if($row != NULL){
	$query1 = $this->db->query("SELECT * FROM payments WHERE pay_id = '".$row[0]['payment_id']."'");
	$row1 = $query1->result_array();
	if($row1==NULL)
	{
		$row[0]['status']=0;
	}
	
	//echo'<pre>';print_r($row);die;
	return $row;
	}}
	if($user == 'executive')
	{
				
	$query=$this->db->query("SELECT s.user_id, s.start_time, s.payment_id, s.status,s.amount, p.pay_id, p.payment_details, p.date FROM subscription as s LEFT JOIN payments as p on s.payment_id = p.pay_id WHERE s.tracking IN (SELECT user_id FROM `user` WHERE `role`='".$user."') AND s.status!=2");
	
	$row=$query->result_array();
	//print_r($row);die;
	if($row != NULL){
	$query1 = $this->db->query("SELECT * FROM payments WHERE pay_id = '".$row[0]['payment_id']."'");
	$row1 = $query1->result_array();
	if($row1==NULL)
	{
		$row[0]['status']=0;
	}
	
	return $row;
	}}
}
	public function findetail($data)
	
	{ 
	$query=$this->db->query("SELECT name,code,email_id from user where user_id = ".$data);
	$row=$query->result_array();
	//print_r($row);die;
	return $row;
	}
	
	public function update_row($id)
	{ 
	
	echo "id ==".$id; die;
	$data_insert = array(
	'status' => $_POST['status']
	
	);
	$this->db->where('payment_id', $id);
	$this->db->update('subscription', $data_insert);
	redirect('admin/payment');
	}
	
	public function delete_row()
	{  $id=$id =$this->input->get('id', TRUE); 
	
	$this->db->where('dealer_id',$id);
	/* $this->db->delete('dealer_info');  */
	$this->db->delete('party');
	redirect('admin/party'); 
	
	}
	
	public function edit_row($id)
	
	{  
	$query=$this->db->query("select * from payments where payment_id = '".$id."' ");
	$row=$query->result_array();
	
	foreach($row as $k=>$rows){
	
	
	$query1=$this->db->query("select email_id from user where user_id= '".$rows['user_id']."' ");
	$row2=$query1->result_array();
	
	foreach($row2 as $row3)
	{ $val = $row3['email_id'];
	$row[$k]['email_id']= $val;
	}
	
	
	$query2=$this->db->query("select status from subscription where user_id= '".$rows['user_id']."' ");
	$row4=$query2->result_array();
	
	foreach($row4 as $row5)
	{ $val2 = $row5['status'];
	$row[$k]['status']= $val2;
	}
	}
	return $row;
	
	}
	
	public function get_mag(){
	
	$sql=$this->db->query("select mag_id,name from magazine");
	$result=$sql->result_array();
	return $result;
	}
	
	public function get_payment(){
	
	$sql=$this->db->query("select * from payment_upload where paym='offline'");
	$result = $sql->result_array();
	return $result;
	}
	public function get_user(){
	
	$sql=$this->db->query("select * from user");
	$result = $sql->result_array();
	return $result;
	}
	public function makepayment(){
	
	//echo "<pre>"; print_r($_POST);die;
		
	$pay_id=$result1=array();
	$paym='offline';
	$offine=$_POST['offline'];
	$action=$_POST['submit'];
	if($offine=='MoneyOrder'){
	
	$sql=$this->db->query("select * from payments");
	$result = $sql->result_array();
	foreach($result as $row ){
		
	$pay_details = unserialize($row['payment_details']);
	if(trim($pay_details['offline'])=='MoneyOrder'){ 
	if($row['pay_id']==$_POST['payid']){
	if($pay_details['amount']==$_POST['amount1'] && ($pay_details['sname']==$_POST['sendername1'])){
	$pay_id[]=$row['pay_id'];
	}}}}}
	else if($offine=='BankDeposite'){
	$sql=$this->db->query("select * from payments");
	$result = $sql->result_array();
	foreach($result as $row ){
		
	$pay_details = unserialize($row['payment_details']);
	if($pay_details['offline']=='BankDeposite'){
	if(trim($pay_details['tensid'])==trim($_POST['tensid'])){
	$pay_id[]=$row['pay_id'];
	}}}}
	
	else if($offine=='DemandDraft'){
	$sql=$this->db->query("select * from payments");
	$result = $sql->result_array();
	foreach($result as $row ){
	$pay_details = unserialize($row['payment_details']);
	if($pay_details['offline']=='DemandDraft'){
	if(($pay_details['ddnum']==$_POST['ddnum']) && ($pay_details['amount']==$_POST['amount2'])){
	$pay_id[]=$row['pay_id'];
	}}}}
	echo "<pre>";
	//print_r($pay_id);
	foreach($pay_id as $pay){
	
	$sql1=$this->db->query("select * from  payments as p join subscription as s on s.payment_id=p.pay_id join user as u on u.user_id=s.user_id where pay_id='".$pay."'");
	$result1=$sql1->result_array();
	
	//echo "select * from  payments where pay_id='".$pay."'";die;
	
	$this->db->query("update subscription set `status`=2 where payment_id ='".$pay."'");
	
	}
	//echo "<pre>";
	//print_r($result1);
	// die;
	}
	
	public function findpayment(){
	
	$sql=$this->db->query("select DISTINCT p.payment_details,p.pay_id from payments as p left join subscription as s on p.pay_id = s.payment_id where p.paym ='offline' and s.status = '5'");
	$result = $sql->result_array();
	if($result != NULL){
	foreach($result as $k => $datas)
	{
	$result1[$k] = unserialize($datas['payment_details']);
	$result1[$k]['payid'] = $datas['pay_id'];
	
	}
	//echo'<pre>';print_r($result1);die;
	return $result1;
	}}
	
	public function findsubdetail($daata1,$daata2,$daata3){
	
	$sql=$this->db->query("select u.email_id,u.role,u.code from user AS u left join subscription AS s on u.user_id = s.user_id where s.payment_id = '".$daata1."'");
	$result = $sql->result_array();
	
	//print_r($result[0]);die;
	return $result[0];
	}
	
	}