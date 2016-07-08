
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard</title>
<!--// Stylesheets //-->
<link href="<?php echo HTTP_CSS_PATH; ?>style.css" rel="stylesheet" media="screen" />
<link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet" media="screen" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!--// Javascript //-->
<!--
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.accordion.js"></script>
<script type="text/javascript" src="assets/js/jquery.custom-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/selectnav.min.js"></script>
<script type="text/javascript" src="assets/js/functions.js"></script>
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>

<body>
<!-- Wrapper Start -->
<div class="wrapper">
	<div class="structure-row">
        <!-- Sidebar Start -->
        <aside class="sidebar">
        	<div class="sidebar-in">
                <!-- Sidebar Header Start -->
                <header>
                    <!-- Logo Start -->
                    <div class="logo">
                        <a href="admin2.php"><img src="<?php echo HTTP_IMAGES_PATH; ?>logo1.png" width="150" height="70"  alt="EcoPages" /></a>
                    </div>
                    <!-- Logo End -->
                    <!-- Toggle Button Start -->
                    <a href="#" class="togglemenu">&nbsp;</a>
                    <!-- Toggle Button End -->
                    <div class="clearfix"></div>
                </header>
                <!-- Sidebar Header End -->
                <!-- Sidebar Navigation Start -->
                <nav class="navigation" >
                  <!--  <ul class="navi-acc" id="nav2">
                        
                        <li>
            <a href="<?php echo ROOT;?>admin/datatables" class="layouts">Users</a>
                        </li>
                         <li>
            <a href="<?php echo ROOT;?>admin/subscription" class="forms">Subscription</a>
                        </li>
                        <li>
            <a href="<?php echo ROOT;?>admin/magazine" class="pages">Magzines</a>
                        </li>
                  
                    </ul>-->
                    <div class="clearfix"></div>
                </nav>
                <!-- Sidebar Navigation End -->
                <!-- Shadow Start -->
                <span class="shadows"></span>
                <!-- Shadow End -->
            </div>
        </aside>
        <!-- Sidebar End -->
        <!-- Right Section Start -->
        <div class="right-sec">
            <!-- Right Section Header Start -->
            <header>
                <!-- User Section Start -->
                <div class="user">
                    <!--<figure>
                        <a href="#"><img src="assets/images/avatar1.jpg" alt="Adminise" /></a>
                    </figure>-->
                    <div class="welcome">
                        <p></p>
                        
                    </div>
                </div>&nbsp;&nbsp;&nbsp;
                <!-- User Section End -->
                <!-- Search Section Start -->
                <!--<div class="search-box">
                    <input type="text" placeholder="Search " />
                    <input type="submit" value="go" />
                </div>-->
                <!-- Search Section End -->
                <!-- Header Top Navigation Start -->
                <nav class="topnav">
                    <ul id="nav1"><li class="tasks">
                    <a href="<?php echo base_url(); ?>admin/datatables/logout" class="btn btn-info" role="button">Logout</a></li></ul></nav>
                
                <!-- Header Top Navigation End -->
                <div class="clearfix"></div>
            </header>
            <!-- Right Section Header End -->
            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                    
                    <div class="alert alert-success alert-dismissable" style="top:50px !important;">
              <button type="button btn-lg" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              You Dont Have Permission To Access This Page !
            </div>
            <div style="text-align:center;margin-top:80px ;">
             <a href="<?php echo base_url(); ?>admin/createlogin/go_to_dashboard" class="btn btn-info btn-lg" role="button" style=" ">Go To Dashboard</a>
             </div>
         

</body>
</html>
