<?php $this->load->view('vwHeader');?>

<div class="heading">
<h3>My Account</h3>
</div>
<div class="container myaccount">
<div class="row">
<div class="subscription">
<h3><strong>My Subscriptions</strong></h3>
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
<td><a href="<?php echo BASE_URL."paymentdetail?payid=".$mysub['payment_id']; ?>"><?php echo $mysub['payment_id']; ?></a></td>
<td><span  class="col-sm-12 ">
<?php  
$name1 =$this->home_model->get_magbyid($mysub['mag_id']);?>
<a href="editions?mag=<?php echo $mysub['mag_id']; ?>"><img  width="150" height="200"  src="<?php echo HTTP_ASSETS_PATH."pdf_thumb/".$name1['thumbnail']; ?>" /></a></span></td>
<td><span  class="col-sm-12 ">

<?php  $name2 =$this->home_model->get_edibyid($mysub['mag_id']);?>


<?php foreach($name2 as $k=>$v){

if($mysub['status']==2){ 
$path=explode(".",$v['path']);
?>
<a href="<?php echo base_url()."read?mag=".str_replace(" ","",$path[0]);?>" target="_blank"  />
<?php } ?>
<?php 
if(strtotime($v['publish_date'])>=strtotime($mysub['start_time']) && strtotime($v['publish_date'])<=strtotime($mysub['end_time'])) {
if($v['parentid']==$mysub['mag_id']){
echo $v['issue_name']."( ".date('d-M-Y',strtotime($v['publish_date']))." )<br>";?>
<?php }} 
if($mysub['status']==2){ ?>
</a>
<?php } } ?></span>
</td>
<td><?php /*print_r($mysub);die;*/ echo $mysub['duration']; ?></td>
<td><?php echo date('d-M-Y',strtotime($mysub['end_time'])); ?></td>
<td>
<?php 
if($mysub['status']==2){echo "Active";}
else if($mysub['status']==1){ ?>Awaited for approval
<?php }else if($mysub['status']==0){ ?>
<a   href="<?php echo BASE_URL."Updatepay?editid=".$mysub['payment_id']; ?> ">Edit Payment Details</a> to read this awsome contant
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
<div >
<h3><strong>Magazines</strong></h3>
</div>
<?php 

foreach($magazine as $k=>$v){ 
?>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
    <?php  $path = HTTP_PDF_THUMB_PATH.'no_image.jpg'; ?>
	   <img src="<?php echo HTTP_PDF_THUMB_PATH.$v['thumbnail'] ?>" 
      onerror="this.src ='<?php  echo  $path ?>'"  height="420px" >
   
      <div class="caption">
        <h3><?php echo $v['name'] ?></h3>
        <p><?php echo $v['description'] ?></p>
        <p><a href="editions?mag=<?php echo $v['mag_id']; ?>" class="btn btn-primary" role="button">See more</a></p>
      </div>
    </div>
  </div>

<?php } ?>
</div>

<h3><strong>Profile</strong></h3>

<div class="row">
<?php //echo "<pre>";print_r($userdata);?>

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
<td><span  class="col-sm-12 "><?php echo $userdata['contect_mail'];?></span></td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">DOB</label></th>
<td><span  class="col-sm-12 "><?php echo $userdata['dob'];?></span></td>
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

</div>
<?php $this->load->view('vwFooter');?>