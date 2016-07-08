<?php  $this->load->view('admin/my_header.php');?>

<div class="container-liquid">
<div class="row">
<div class="col-xs-12">
<div class="sec-box">                   
<header>
<h3 class="heading">
<?php if($_GET['user']=='subscriber'){ ?>
Direct Subscription
<?php }else if($_GET['user']=='franchise'){ ?>
Franchise Subscription
<?php }else if($_GET['user']=='executive'){ ?>
Executive Subscription
<?php }?>
</h3>
</header>
<div class="contents"> 
<!-- <a class="togglethis">Toggle</a>-->
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.dataTables.min.js"></script>
<table class="table" >

<?php if($_GET['user']=='subscriber'){ ?>
<thead>
<tr>
<th>Email</th>
<th>Magazine</th>
<th>Number Of issue</th>
<th>Amount</th>
<th>Payment Id</th>
<th>Name</th>
<th>Mobile Number</th>
<th>Approve</th>
</tr>
</thead>
<tbody>

<?php
//echo'<pre>';print_r($row);die;
 foreach($row as $rows){
//echo '<pre>';print_r($rows);//die;
  if($rows['role']=='subscriber' && $rows['code']=='direct'){ ?>

<tr>
<td><?php echo $rows['email_id']?></td>
<td><?php 
$name = $this->home_model->get_magbyid($rows['mag_id']);
echo $name['name']; ?></td>
<td><?php echo $rows['duration']?></td>
<td><?php echo $rows['amount']?></td>
<td><?php echo $rows['payment_id']?></td>
<td><?php echo $rows['name']?></td>
<td><?php echo $rows['mobile']?></td>
<td>
<form action="<?php base_url()?>createlogin/change_status?user=subscriber" method="post">
<?php  if($rows['status']==2){ ?>
<?php echo 'Approved';?>
<? }else if($rows['status']==1){ ?>
<input type="hidden" name="pay_id" value="<?php echo $rows['payment_id'] ?>" />
<button type="submit" class="btn btn-success" name="act" value="2">
<?php echo 'Approve';?>
</button>
<?php }else if($rows['status']==0){?>
<input type="hidden" name="pay_id" value="<?php echo $rows['payment_id'] ?>" />
<button type="submit" class="btn btn-success" name="act" value="2">
<?php echo 'Waiting for Payment'; ?>
</button>
<?php } ?>
</form>
</td></tr>
<?php }} ?>


<?php }else if($_GET['user']=='franchise'){ ?>
<thead>
<tr>
<th>F-code</th>
<th>F Name</th>
<th>Magazines&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>No of subscriptions</th>
<th>Total No Issues </th>
<th>Amount</th>
<th>Payment Id</th>
<th>Approve</th>
</tr>
</thead>
<tbody>
<?php
//echo'<pre>';print_r($row);die;
 foreach($row as $rows){
	 
	// echo "<pre>";print_r($rows);

  if($rows['role']=='franchise'){ 
  $data = $this->subscription_model->fget_subs($rows['payment_id']);
  //echo'<pre>';print_r($data);die;
  $rows['mags']=$data;
  //print_r($data);die;
  foreach($data as $k=>$l){
	$name = $this->home_model->get_magbyid($l['mag_id']);
	
		$rows['magissue'][$name['mag_id']]=$name;
  }
?>
<tr>
<td><?php echo $rows['code']?></td>
<td><?php echo $rows['name']?></td>
<td><?php 
if(isset($rows['magissue'])){
foreach($rows['magissue'] as $rm){
echo $rm['name']."<br />";
}}?></td>
<td><?php echo count($rows['mags'])?></td>
<td><?php

 	for($i=0;$i<count($rows['mags']);$i++){
	$count =$rows['mags'][$i]['duration'];
	//echo "<pre>";print_r($rows['mags']);
	if($i==0){
		if(@$rows['mags'][0]['mag_id']==@$rows['mags'][1]['mag_id']){continue;}
		else{
			echo $count."<br>";
			}
	}else if($i>0){
		if(@$rows['mags'][$i]['mag_id']==@$rows['mags'][$i-1]['mag_id']){
		$count +=$rows['mags'][$i-1]['duration'];
		}
		echo $count."<br>";
	}
	}
	
?></td>
<td><?php echo $rows['amount']?></td>
<td><?php echo $rows['payment_id']?></td>
<td>
<form action="<?php base_url()?>createlogin/change_status?user=franchise" method="post">
<?php  if($rows['status']==2){ ?>
<?php echo 'Approved';?>
<? }else if($rows['status']==0){ ?>
<input type="hidden" name="pay_id" value="<?php echo $rows['payment_id'] ?>" />
<button type="submit" class="btn btn-success" name="act" value="2">
<?php echo 'Approve';?>
</button>
<?php } ?>
</form>
</td></tr>

<?php }} }else if($_GET['user']=='executive'){ ?>
<thead>
<tr>
<th>E-code</th>
<th>E Name</th>
<th>Magazines&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>No of subscriptions</th>
<th>Total No Issues </th>
<th>Amount</th>
<th>Payment Id</th>
<th>Approve</th>
</tr>
</thead>
<tbody>
<?php
 foreach($row as $rows){

  if(($rows['status']==0)  && ($rows['role']=='executive')){ 

 
  $data = $this->subscription_model->fget_subs($rows['payment_id']);
  $rows['mags']=$data;
  foreach($data as $k=>$l){
	$name = $this->home_model->get_magbyid($l['mag_id']);
		$rows['magissue'][$name['mag_id']]=$name;
  }
 // echo "<pre>";print_r($rows);
?>
<tr>
<td><?php echo $rows['code']?></td>
<td><?php echo $rows['name']?></td>
<td><?php if(isset($rows['magissue'])){
foreach($rows['magissue'] as $rm){
echo $rm['name']."<br />";
}}?></td>
<td><?php echo count($rows['mags'])?></td>
<td><?php
   for($i=0;$i<count($rows['mags']);$i++){
	$count =$rows['mags'][$i]['duration'];
	//echo "<pre>";print_r($rows['mags']);
	if($i==0){
		if(@$rows['mags'][0]['mag_id']==@$rows['mags'][1]['mag_id']){continue;}
		else{
			echo $count."<br>";
			}
	}else if($i>0){
		if(@$rows['mags'][$i]['mag_id']==@$rows['mags'][$i-1]['mag_id']){
		$count +=$rows['mags'][$i-1]['duration'];
		}
		echo $count."<br>";
	}
	}
	
?></td>
<td><?php echo $rows['amount']?></td>
<td><?php echo $rows['payment_id']?></td>
<td>
<form action="<?php base_url()?>createlogin/change_status?user=executive" method="post">
<?php  if($rows['status']==2){ ?>
<?php echo 'Approved';?>
<? }else if($rows['status']==0){ ?>
<input type="hidden" name="pay_id" value="<?php echo $rows['payment_id'] ?>" />
<button type="submit" class="btn btn-success" name="act" value="2">
<?php echo 'Approve';?>
</button>
<?php } ?>
</form>
</td></tr>

<?php }} }?>

</tbody>
</table>

</div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
<!-- Row End -->
</div>
</div>
<!-- Content Section End -->
</div>
<!-- Right Section End -->
</div>
</div>

</body>
</html>
