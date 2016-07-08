<?php $this->load->view('vwHeader');?>

<div class="heading">
<h3>Payment details</h3>
</div>

<div class="container editions">
<div class="row">

<?php
if(sizeof($paydetails)==0){
	echo "<h1 align='center'><b>No payment Yet</b></h1>";
}else{
 foreach($paydetails as $k=>$v){
//echo "<pre>";print_r($v); echo "</pre>";
$pay = unserialize($v['payment_details']);
?>
<div class="col-sm-12">
   <label class="control-label col-sm-3" >payment Id</label>
   <div class="col-sm-9">
   <span><?php echo $v['pay_id']; ?></span></div>
</div> 
<div class="col-sm-12">
   <label class="control-label col-sm-3" >payment Method</label>
   <div class="col-sm-9">
   <span><?php echo $v['paym']; ?></span></div>
</div> 
<div class="col-sm-12">
   <label class="control-label col-sm-3" >payment Details</label>
   <div class="col-sm-9">
   <span><?php //print_r($pay); ?>
   <table class="table">
   <?php foreach($pay as $k=>$p) {
	   if($k=='payid'){ continue;}
	   ?>
  <tr>
  <td>
  <label><?php echo $k; ?></label>
  </td>
  <td>
  <span><?php echo $p; ?></span>
  </td>
  </tr>
   <?php } ?>
   </table>
   </span></div>
</div> 

<div class="col-sm-12">
   <label class="control-label col-sm-3" >Magazine</label>
   <div class="col-sm-9">
   <span><?php $var = $this->home_model->get_magbyid($v['mag_id']); echo $var['name'] ?></span></div>
   </span>
</div>

<div class="col-sm-12">
   <label class="control-label col-sm-3" >Amount</label>
   <div class="col-sm-9">
   <span><?php echo $v['amount'] ?></span></div>
   </span>
</div>

<div class="col-sm-12">
   <label class="control-label col-sm-3" >Subscription date</label>
   <div class="col-sm-9">
   <span><?php echo date('d M Y',strtotime($v['start_time'])); ?></span></div>
   </span>
</div>

<div class="col-sm-12">
   <label class="control-label col-sm-3" >Expire date</label>
   <div class="col-sm-9">
   <span><?php echo date('d M Y',strtotime($v['end_time']));?></span></div>
   </span>
</div>

  
<?php }} ?>
</div>
</div>
</div>


<?php $this->load->view('vwFooter');?>