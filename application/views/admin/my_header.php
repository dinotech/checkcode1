<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard</title>
<!--// Stylesheets //-->
<link href="<?php echo HTTP_CSS_PATH; ?>style.css" rel="stylesheet" media="screen" />
<link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet" media="screen" />
<link href="<?php echo HTTP_CSS_PATH; ?>style.css" rel="stylesheet" media="screen" />
<link href="<?php echo HTTP_CSS_PATH; ?>main.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH; ?>font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH; ?>font-awesome/css/font-awesome.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!--// Javascript //-->
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.dataTables.min.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.js"></script> 	
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.custom-scrollbar.min.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>location.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>defaultjs.js"></script>
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>bootstrap.min.js"></script>
<!--<script src="<?php echo HTTP_JS_PATH; ?>app.js"></script>
-->

</head>

<body>
 <?php $this->load->model('home_model'); ?>
<!-- Wrapper Start -->
<div class="wrapper">
<div class="structure-row">
<aside class="sidebar">
<div class="sidebar-in">
<header>
<div class="logo">
<a href="<?php echo ROOT; ?>admin"><img src="<?php echo HTTP_IMAGES_PATH; ?>logo1.png" width="250" height="100"  alt="EcoPages" /></a>
</div>
<a href="#" class="togglemenu">&nbsp;</a>
<div class="clearfix"></div>
</header>
<nav class="navigation">
<ul class="navi-acc" id="nav2">
<li id="user">
<a  class="pages"><i class="fa fa-user"></i>&nbsp;&nbsp;User&nbsp;&nbsp;<?php if(isset($subresult['users']) && $subresult['users']!=0){
echo '<span class="notif">'.$subresult['users'].'</span>';}?></a>
<ul id="user_op" class="naviacc" style="display:none;">
<li><a href="<?php echo ROOT;?>admin/createlogin/manage_users?user=subscriber" onClick="return user1('user');" class="pages">Manage Subscriber</a></li>
<li><a href="<?php echo ROOT;?>admin/createlogin/franchise" onClick="return user1('user');" class="pages">Manage Franchise </a></li>
<li><a href="<?php echo ROOT;?>admin/createlogin/executive" onClick="return user1('user');" class="pages">Manage Executive</a></li>
</ul>
</li>
<li id="subs">
<a class="pages"><i class="fa fa-file"></i>&nbsp;&nbsp;Subscription&nbsp;&nbsp;<?php if(isset($subresult['subs']) && $subresult['subs']!=0){
echo '<span class="notif">'.$subresult['subs'].'</span>';}?></a>
<ul id="subs_op" class="naviacc" style="display:none;">
<li><a href="<?php echo ROOT;?>admin/subscription?user=subscriber" onClick="return user1('subscription');" class="pages">Direct subscription</a></li>
<li><a href="<?php echo ROOT;?>admin/subscription?user=franchise" onClick="return user1('subscription');" class="pages">Franchise subscription</a></li>
<li><a href="<?php echo ROOT;?>admin/subscription?user=executive" onClick="return user1('subscription');" class="pages">Executive subscription</a></li>
</ul>
</li>
<li>
<a href="<?php echo ROOT;?>admin/magazine" class="pages"><i class="fa fa-file-text"></i>&nbsp;&nbsp;Magazine</a>
</li>
<li id="pay">
<a  class="pages"><i class="fa fa-money"></i>&nbsp;&nbsp;Payments&nbsp;&nbsp;<?php if(isset($subresult['payments']) && $subresult['payments']!=0){
echo'<span class="notif">'.$subresult['payments'].'</span>';}?></a>
<ul id="pay_op" class="naviacc" style="display:none;">
<li><a href="<?php echo ROOT;?>admin/payment?user=subscriber" onClick="return user1('payments');" class="pages">Direct Payments</a></li>
<li><a href="<?php echo ROOT;?>admin/payment?user=franchise" onClick="return user1('payments');" class="pages">Franchise Payments </a></li>
<li><a href="<?php echo ROOT;?>admin/payment?user=executive" onClick="return user1('payments');" class="pages">Executive Payments</a></li>
</ul>
</li>
<li id="admin">
<a class="pages"><i class="fa fa-users"></i>&nbsp;&nbsp;Admins</a>
<ul id="admin_op" class="naviacc" style="display:none;">
<li><a href="<?php echo ROOT;?>admin/createlogin/manage_profile" class="pages">Admin Profile</a></li>
<li><a href="<?php echo ROOT;?>admin/createlogin/manage_account" class="pages">Admin Account</a></li>
</ul>
</li>
<li>
<a href="<?php echo ROOT;?>admin/onlinesubscription" class="pages"><i class="fa fa-upload"></i>&nbsp;&nbsp;Online Subscriptions&nbsp;&nbsp;<span class="notif">0</span></a>
</li>
<li>
<a href="<?php echo ROOT;?>admin/communication" class="pages"><i class="fa fa-comment"></i>&nbsp;&nbsp;Communication</a>
</li>
<li>
<a href="<?php echo ROOT;?>admin/idmodification" class="pages"><i class="fa fa-edit"></i>&nbsp;&nbsp;Id Modification</a>
</li>
<li>
<a href="<?php echo ROOT;?>admin/Paymentupload" class="pages"><i class="fa fa-upload"></i>&nbsp;&nbsp;Payment Upload</a>
</li>
<li>
<a href="<?php echo ROOT;?>admin/transactionregister" class="pages"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Activity Registers</a>
</li>
<li>
<a href="<?php echo ROOT;?>admin/payouts" class="pages"><i class="fa fa-file-text"></i>&nbsp;&nbsp;Payouts</a>
</li>


</ul>
<div class="clearfix"></div>
</nav>
<span class="shadows"></span>
</div>
</aside>      
<div class="right-sec">
<header>
<div class="logo_res" >
<a href="<?php echo ROOT; ?>admin"><img src="<?php echo HTTP_IMAGES_PATH; ?>logo1.png" style=" width:100%; height:100%"  alt="EcoPages" /></a>
</div>

<div class="user">
<div class="welcome">
</div>
</div>
<nav class="topnav">
<ul id="nav1"><li class="tasks">
<a href="<?php echo base_url(); ?>admin/datatables/logout" class="btn btn-info" role="button">Logout</a></li></ul></nav>
<div class="clearfix"></div>
</header>

<script type="text/javascript" >
$( document ).ready(function() {
$( ".error p" ).addClass("bg-danger");
});
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
$( "#user" ).click(function() {
  $( "#user_op" ).toggle();
});
$( "#subs" ).click(function() {
  $( "#subs_op" ).toggle();
});
$( "#pay" ).click(function() {
  $( "#pay_op" ).toggle();
});
$( "#admin" ).click(function() {
  $( "#admin_op" ).toggle();
});
function user1(page)
{
	$.ajax({
		url:'<?php echo base_url()?>admin/home/clearall',
		type:'post',
		data:'page='+page,
		success: function data()
		{
			
		}
	});
}


</script>
 
