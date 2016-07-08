<?php $this->load->view('vwHeader');?>
<div class="heading">
<h3>My Account</h3>
</div>
<div class="container myaccount">
<div class="row">
	<?php if(isset($_GET['act']) && $_GET['act']=='adduser'){?>
    	<div class="alert alert-success" role="alert" style="text-align:center; font-size:16px">User Added Successfully</div>
     <?php }?>   
<table>
<a href="add_subscriber"><button type="button" class="btn btn-primary"><h4>Subscriptions</h4></button></a>

<a href="mysubscription"><button type="button" class="btn btn-primary"><h4>Renewals </h4></button></a>

<a href="Updatepay"><button type="button" class="btn btn-primary"><h4>Payment updates</h4></button></a>

<a href="#"><button type="button" class="btn btn-primary"><h4>Transaction Report</h4></button></a>

<a href="#"><button type="button" class="btn btn-primary"><h4>view subscriber list</h4></button></a>


</table>
</div></div>

<?php $this->load->view('vwFooter');?>