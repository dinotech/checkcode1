
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard</title>
<!--// Stylesheets //-->
<link href="<?php echo HTTP_CSS_PATH; ?>style.css" rel="stylesheet" media="screen" />
<link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet" media="screen" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
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
                        <a href="<?php echo ROOT; ?>admin"><img src="<?php echo HTTP_IMAGES_PATH; ?>logo1.png" width="150" height="70"  alt="EcoPages" /></a>
                    </div>
                    <!-- Logo End -->
                    <!-- Toggle Button Start -->
                    <a href="#" class="togglemenu">&nbsp;</a>
                    <!-- Toggle Button End -->
                    <div class="clearfix"></div>
                </header>
                <!-- Sidebar Header End -->
                <!-- Sidebar Navigation Start -->
                <nav class="navigation">
                    <ul class="navi-acc" id="nav2">
                        
                        <li>
                            <a href="<?php echo ROOT;?>admin/datatables" class="layouts">Users</a>
                            
                        </li>
                
                        <li>
                            <a href="<?php echo ROOT;?>admin/subscription" class="forms">Subscription</a>
                            
                        </li>
                       <li>
                            <a href="<?php echo ROOT;?>admin/magazine" class="pages">Magzines</a>
                            
                        </li>
                  
                    </ul>
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
                <div class="search-box">
                    <input type="text" placeholder="Search " />
                    <input type="submit" value="go" />
                </div>
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
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome to Admin Panel ! 
            </div>
                    
               
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
