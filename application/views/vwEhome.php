<?php //echo'<pre>';print_r($this->session->userdata); 
$this->load->view('vwHeader');?>
<div class="heading">
<h3>My Account</h3>
</div>
<div class="container myaccount">
<div class="row">
<h3> Hello <strong><?php echo $this->session->userdata('user_name') ?></strong>!</h3>
	<?php if(isset($_GET['act']) && $_GET['act']=='adduser'){?>
    	<div class="alert alert-success" role="alert" style="text-align:center; font-size:16px">User Added Successfully</div>
     <?php }?>   
<table>
<a href="add_subscriber"><button type="button" class="btn btn-primary"><h4>Subscriptions</h4></button></a>

<a href="mysubscription"><button type="button" class="btn btn-primary"><h4>Renewals </h4></button></a>

<a href="Updatepay/eore"><button type="button" class="btn btn-primary"><h4>Payment updates</h4></button></a>

<a href="Updatepay/trReg_e"><button type="button" class="btn btn-primary"><h4>Transaction Report</h4></button></a>

<a href="Updatepay/viewsubs"><button type="button" class="btn btn-primary"><h4>view subscriber list</h4></button></a>


</table>
</div></div>

<?php $this->load->view('vwFooter');?>




<?php /*?>*<?php $this->load->view('vwHeader');?>
<div class="heading">
<h3>My Account</h3>
</div>
<div class="container myaccount">
<div class="row">
<h3> Hello! <strong><?php echo $this->session->userdata('user_name') ?></strong></h3>
<?php 
if(isset($edition))
{
foreach($edition as $k=>$v){ 
?>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?php echo $v['thumbnail'] ?>" alt="<?php  $name =$this->home_model->get_magbyid($v['mag_id']); echo $name['name'];   ?>" height="290px">
      <div class="caption">
        <h3><?php echo $name['name'] ?></h3>
        <p><?php echo $v['Description'] ?></p>
        <p><a href="#" class="btn btn-primary" role="button">Subscribe now</a></p>
      </div>
    </div>
  </div>

<?php }} ?>
</div>

<h3>Profile</h3>

<div class="row">
<?php 
echo'<pre>';print_r($userdata);die;
?>

<table class="table table-hover">
 <tbody>
<tr>
<th><label  class="col-sm-4 control-label">NAME</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['name'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">GENDER</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['gender'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">CONTACT MAIL</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['email_id'];?></span></td>
</tr>


<tr>
<th><label  class="col-sm-4 control-label">MOBILE</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['mobile'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">ADDRESS</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['address'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">CITY</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['city'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">DISTRICT</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['district'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">STATE</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['state'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">PINCODE</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['pincode'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">COUNTRY</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['country'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">Change mail id</label></th>
<td><span  class="col-sm-12 "><a href ='<?php echo BASE_URL;?>editmail' >EDIT</a></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">Change Password</label></th>
<td><span  class="col-sm-12 "><a href ='<?php echo BASE_URL;?>resetpassword' >EDIT</a></span></td>
</tr>
 </tbody>
 </table>
 </div>
<div class="subscription">
<h3>Subscription</h3>
<div class="row">
<table class="table table-hover">
<tr>
<th>Payment Id</th>
<th>Magazine Name</th>
<th>Edition published</th>
<th>Duration</th>
<th>Subscription Expire date</th>
<th>Payment statue</th>
</tr>
<tbody>
<?php 
if(count($subscription)>0){
foreach ($subscription as $mysub){
 ?>
<tr>
<td><a><?php echo $mysub['payment_id']; ?></a></td>
<td><span  class="col-sm-12 ">
<?php  
$name =$this->home_model->get_magbyid($mysub['mag_id']);
 echo $name['name'];   ?></span></td>
<td><span  class="col-sm-12 ">
<?php  
$name =$this->home_model->get_edibyid($mysub['edition_id']);
echo date('d-M-Y',strtotime($name['publish_date']));   ?></span>
</td>
<td><?php echo $mysub['duration']; ?></td>
<td><?php echo date('d-M-Y',strtotime($mysub['end_time'])); ?></td>
<td>
<?php 
if($mysub['status']==2){echo "Active";}
else if($mysub['status']==1){ ?>Awaited for approval
<?php }else if($mysub['status']==0){ ?>
<a href="<?php echo BASE_URL."Updatepay?editid=".$mysub['payment_id']; ?> ">Edit Payment Details</a> to read this awsome contant
<?php } ?></td>

</tr>
<?php }}else{ ?>
<tr>
<td colspan="2">No subscriptions</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>


<?php $this->load->view('vwFooter');?><?php */?>