<?php $this->load->view('admin/my_header.php'); ?>
<div class="right-sec">
<div class="content-section">
<div class="container-liquid" style="margin-top:5%">
<div align="center" class="alert alert-success alert-dismissable">
<h1>Welcome to Admin Panel!</h1> </div>

<div class="row">
<div class="col-xl-12">
<div class="row">
<div class="col-sm-6">
<article class="statistic-box purple">
<div>
<div class="number"><?php echo $totals['subs'][0]['subs']; ?></div>
<div class="caption"><div>Subscribers</div></div>
<!--<div class="percent">
<div class="arrow up"></div>
<p></p>
</div>
--></div>
</article>
</div><!--.col-->
<div class="col-sm-6">
<article class="statistic-box red">
<div>
<div class="number"><?php echo $totals['frnc'][0]['frnc']; ?></div>
<div class="caption"><div>Franchise</div></div>
<!--<div class="percent">
<div class="arrow down"></div>
 <p></p>
</div>
--></div>
</article>
</div><!--.col-->
<div class="col-sm-6">
<article class="statistic-box yellow">
<div>
<div class="number"><?php echo $totals['exec'][0]['exec']; ?></div>
<div class="caption"><div>Executive</div></div>
<!--<div class="percent">
<div class="arrow down"></div>
 <p></p>
</div>-->
</div>
</article>
</div><!--.col-->
<div class="col-sm-6">
<article class="statistic-box green">
<div>
<div class="number"><?php echo $totals['mag'][0]['mag']; ?></div>
<div class="caption"><div>Magazines</div></div>
<!--<div class="percent">
<div class="arrow up"></div>
<p></p>
</div>-->
</div>
</article>
</div><!--.col-->
</div><!--.row-->
</div><!--.col-->
</div>
<!--end-->

<div class="row">

<a href="<?php echo base_url(); ?>admin/payment?user=subscriber" class="btn btn-info col-md-4" role="button" style="width:30%;float:none;margin-top:60px; margin-left:10px; margin-right:10px;">Direct Payments </a>
<a href="<?php echo base_url(); ?>admin/payment?user=franchise" class="btn btn-danger col-md-4" role="button" style="width:30%;float:none;margin-top:60px; margin-left:10px; margin-right:10px;">Franchise Payments</a>
<a href="<?php echo base_url(); ?>admin/payment?user=executive" class="btn btn-success col-md-4" role="button" style="width:30%;float:none;margin-top:60px; margin-left:10px; margin-right:10px;">Executive Payments</a>


<a href="<?php echo base_url(); ?>admin/createlogin/manage_subscription?user=subscriber" class="btn btn-success col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Direct Subscriptions</a>
<a href="<?php echo base_url(); ?>admin/createlogin/manage_subscription?user=franchise" class="btn btn-warning col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Franchise Subscriptions</a>
<a href="<?php echo base_url(); ?>admin/createlogin/manage_subscription?user=executive" class="btn btn-info col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Executive Subscriptions </a>

<a href="<?php echo base_url(); ?>admin/onlinesubscription" class="btn btn-info col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Online Subscriptions</a>
<a href="<?php echo base_url(); ?>admin/communication" class="btn btn-success col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Communication</a>
<a href="<?php echo base_url(); ?>admin/idmodification" class="btn btn-danger col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Id Modification</a>

<a href="<?php echo base_url(); ?>admin/createlogin/manage_users?user=subscriber" class="btn btn-success col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px; ">Manage Subscribers</a>
<a href="<?php echo base_url(); ?>admin/createlogin/franchise" class="btn btn-info col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Manage Franchise</a>
<a href="<?php echo base_url(); ?>admin/createlogin/executive" class="btn btn-warning col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Manage Executive</a>

<a href="<?php echo base_url(); ?>admin/magazine/" class="btn btn-warning col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Manage Magazine</a>
<a href="<?php echo base_url(); ?>admin/createlogin/manage_profile" class="btn btn-danger col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Admin Profile</a>
<a href="<?php echo base_url(); ?>admin/createlogin/manage_account" class="btn btn-success col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Admin Account</a>

<a href="<?php echo base_url(); ?>admin/Paymentupload" class="btn btn-info col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Payment Upload</a>
<a href="<?php echo base_url(); ?>admin/transactionregister" class="btn btn-warning col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Activity Registers</a>
<a href="<?php echo base_url(); ?>admin/payouts" class="btn btn-success col-md-4" role="button" style="width:30%;float:none;margin-top:30px; margin-left:10px; margin-right:10px;">Payouts</a>



<!-- Row End -->
</div> 
</div>
<!-- Content Section End -->
</div>
<!-- Right Section End -->
</div>
</div>
</div>
<!-- Wrapper End -->

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-42761673-1', 'extracoding.com');
ga('send', 'pageview');

</script>

</body>
</html>
