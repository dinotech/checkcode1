<?php $this->load->view('vwHeader');?>
<div class="heading">
		<h3>My Account</h3>
</div>
<div class="container myaccount">
<div class="row">

<h3> Hello <strong><?php echo $this->session->userdata('user_name') ?></strong>!</h3>
	<?php if(isset($_GET['act']) && $_GET['act']=='adduser'){?>
    	<div class="alert alert-success" role="alert" style="text-align:center; font-size:16px">Successfully Subscribed for Magazine</div>
     <?php }?>   
<table>
<a href="add_subscriber"><button type="button" class="btn btn-primary"><h4>Subscriptions</h4></button></a>

<a href="mysubscription"><button type="button" class="btn btn-primary"><h4>Renewals </h4></button></a>

<a href="Updatepay/fore"><button type="button" class="btn btn-primary"><h4>Payment updates</h4></button></a>

<a href="Updatepay/trReg_f"><button type="button" class="btn btn-primary"><h4>Transaction Register</h4></button></a>

<a href="fmyaccount"><button type="button" class="btn btn-primary"><h4>Account</h4></button></a>

<a href="dailyreport"><button type="button" class="btn btn-primary"><h4>Daily report</h4></button></a>

</table>
</div></div>

<?php $this->load->view('vwFooter');?>