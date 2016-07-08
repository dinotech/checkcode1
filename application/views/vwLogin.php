<?php $this->load->view('vwHeader');?>
<div class="container" style="margin-bottom:5%">
<div class="row">
<u><h4>Hello <strong><?php echo $this->session->userdata('user_name'); ?></strong></h4></u><br />
<div class="alert alert-success" role="alert">
<h5>Thanks for subscribing you are one step away from some awesome content; please share your subscription payment details.
</h5></div>
<h4>Payment ID: <strong><?php echo $this->session->userdata('pay_id')  ?></strong></h4>
<?php 
if($this->session->userdata('role')=='subscriber' ){ ?>
<h4>Customer Code : <strong><?php echo $this->session->userdata('regi_id')  ?></strong></h4>
<?php } ?><?php ?>
<br />
<a href="<?php echo BASE_URL ?>Updatepay" ><div class="btn btn-primary">Update Payment Detail</div></a>
&nbsp;&nbsp;&nbsp;&nbsp;OR&nbsp;&nbsp;&nbsp;&nbsp; 
<a href="<?php echo BASE_URL ?>myaccount" ><div class="btn btn-primary">My Account</div></a>


</div></div>
<?php $this->load->view('vwFooter');?>