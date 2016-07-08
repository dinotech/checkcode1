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
                        <a href="admin2.php"><img src="assets/images/logo.png" width="150" height="70"  alt="Adminise" /></a>
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
                            <a href="datatables.php" class="layouts">Features</a>
                            
                        </li>
                    <!--    <li>
                        <a href="#ui-elements" class="ui-elements">Elements</a>
                        <ul>
                            <li><a href="tiles.html">Tiles</a></li>
                            <li><a href="buttons.html">Buttons</a></li>
                            <li><a href="tabs.html">Tabs and Accordion</a></li>
                            <li><a href="typography.html">Typography</a></li>
                            <li><a href="tooltip.html">Tooltip and Popovers</a></li>
                            <li><a href="navbar.html">Navbars</a></li>
                            <li><a href="breadcrumbs.html">Breadcrumbs</a></li>
                            <li><a href="pagination.html">Pagination</a></li>
                            <li><a href="progressbar.html">Progress bars</a></li>
                            <li><a href="blockquotes.html">Blockquotes</a></li>
                            <li><a href="modals.html">Modals</a></li>
                            <li><a href="alerts.html">Alerts</a></li>
                            <li><a href="labels.html">Labels</a></li>
                            <li><a href="comments.html">Comments</a></li>
                        </ul>
                    </li>-->
                     <!--   <li>
                            <a href="#mailbox" class="mailbox">Mailbox<span class="label label-custom1">05</span></a>
                            <ul>
                                <li><a href="inbox.html">Inbox</a></li>
                                <li><a href="compose.html">Compose</a></li>
                                <li><a href="emaildetails.html">Email Detail</a></li>
                            </ul>
                        </li>-->
                        <li>
                            <a href="datatables1.php" class="forms">Project Category</a>
                            
                        </li>
                       <li>
                            <a href="datatables2.php" class="pages">Project Detail</a>
                            
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
                    <figure>
                        <a href="#"><img src="assets/images/avatar1.jpg" alt="Adminise" /></a>
                    </figure>
                    <div class="welcome">
                        <p>Welcome</p>
                        
                    </div>
                </div>
                <!-- User Section End -->
                <!-- Search Section Start -->
                <div class="search-box">
                    <input type="text" placeholder="Search Anything" />
                    <input type="submit" value="go" />
                </div>
                <!-- Search Section End -->
                <!-- Header Top Navigation Start -->
                <nav class="topnav">
                    <ul id="nav1"><li class="tasks">
                        	<a href="logout.php">Logout</a></ul></nav>
                
                <!-- Header Top Navigation End -->
                <div class="clearfix"></div>
            </header>
            <!-- Right Section Header End -->
            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                    <!--    <div class="col-xs-2">
                            <div class="stat-box colorone">
                                <i class="author">&nbsp;</i>
                                <h4>Users</h4>
                                <h1>56</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colortwo">
                                <i class="chart">&nbsp;</i>
                                <h4>Visits</h4>
                                <h1>1288</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colorthree">
                                <i class="pages">&nbsp;</i>
                                <h4>Pages</h4>
                                <h1>125</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colorfour">
                                <i class="users">&nbsp;</i>
                                <h4>New Users</h4>
                                <h1>23</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colorfive">
                                <i class="downloads">&nbsp;</i>
                                <h4>Downloads</h4>
                                <h1>4005</h1>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="stat-box colorsix">
                                <i class="comments">&nbsp;</i>
                                <h4>Comments</h4>
                                <h1>56</h1>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Daily Visitors</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="charts-box boxpadding">
                                    	<script type="text/javascript" src="assets/js/raphael-2.1.0.min.js"></script>
										<script type="text/javascript" src="assets/js/morris-0.4.1.min.js"></script>
                                        <div id="displaydigonalbar" class="chartdark"></div>
                                        <script>
                                            /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
                                            var day_data = [
                                              {"period": "2012-10-01", "licensed": 3407, "sorned": 660},
                                              {"period": "2012-09-30", "licensed": 3351, "sorned": 629},
                                              {"period": "2012-09-29", "licensed": 3269, "sorned": 618},
                                              {"period": "2012-09-20", "licensed": 3246, "sorned": 661}
                                            ];
                                            Morris.Bar({
                                              element: 'displaydigonalbar',
                                              data: day_data,
                                              xkey: 'period',
                                              ykeys: ['licensed', 'sorned'],
                                              labels: ['Licensed', 'SORN'],
                                              xLabelAngle: 60,
											  
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Updating data</h2>
                                </header>
                                <div class="contents boxpadding">
                                    <a class="togglethis">Toggle</a>
                                    <div class="charts-box">
                                        <div id="updatingdata"></div>
                                        <script>
                                            var nReloads = 0;
                                            function data(offset) {
                                              var ret = [];
                                              for (var x = 0; x <= 360; x += 10) {
                                                var v = (offset + x) % 360;
                                                ret.push({
                                                  x: x,
                                                  y: Math.sin(Math.PI * v / 180).toFixed(4),
                                                  z: Math.cos(Math.PI * v / 180).toFixed(4)
                                                });
                                              }
                                              return ret;
                                            }
                                            var graph = Morris.Line({
                                                element: 'updatingdata',
                                                data: data(0),
                                                xkey: 'x',
                                                ykeys: ['y', 'z'],
                                                labels: ['sin()', 'cos()'],
                                                parseTime: false,
                                                ymin: -1.0,
                                                ymax: 1.0,
                                                hideHover: true
                                            });
                                            function update() {
                                              nReloads++;
                                              graph.setData(data(5 * nReloads));
                                              $('#reloadStatus').text(nReloads + ' reloads');
                                            }
                                            setInterval(update, 100);
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                                     
                        <div class="col-xs-4">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Some List</h2>
                                </header>
                                <div class="contents boxpadding">
                                    <a class="togglethis">Toggle</a>
                                    <div class="linkslist">
                                        <ul>
                                            <li class="success-list"><a href="#">Feed the cat</a><span class="captions">23 minutes ago</span></li>
                                            <li class="error-list"><a href="#">Meeting with Mark</a><span class="captions">23 minutes ago</span></li>
                                            <li><a href="#">Visit John</a><span class="captions">23 minutes ago</span></li>
                                            <li><a href="#">Urna adipiscing dictumst</a><span></span></li>
                                            <li><a href="#">Scelerisque magna adipiscing</a><span></span></li>
                                            <li><a href="#">Porttitor integer odio enim</a><span></span></li>
                                            <li><a href="#">Platea! Dis sociis a purus</a><span></span></li>
                                            <li class="error-list"><a href="#">Meeting with Mark</a><span class="captions">23 minutes ago</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="sec-box">
                                <a href="#" class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Top Users</h2>
                                </header>
                                <div class="contents boxpadding">
                                    <a href="#" class="togglethis">Toggle</a>
                                    <div class="users-section scrolable scroller">
                                        <ul>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar1.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">Edmund E. Lindley</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar5.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">Robert S. Lara</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar6.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">Stephen N. Arellano</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar7.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">Randall A. Smoot</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar8.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">Olin C. Phillips</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar9.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">David R. Webb</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar1.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">Vincent P. Stjohn</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar5.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">David J. Kitchens</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar6.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">Stephen N. Arellano</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar7.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">David J. Dill</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar8.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">Ronald B. Albert</a></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <a href="#"><img src="assets/images/avatar9.jpg" alt="Adminise" /></a>
                                                </figure>
                                                <div class="welcome">
                                                    <p>Welcome</p>
                                                    <h5><a href="#">James D. Baker</a></h5>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
											
                                        </section>
                                    </div>
                                    <div class="tab-pane" id="messages">
                                    	<section class="boxpadding">
                                        	<p>
                                            <strong>Rhoncus duis enim in purus? Ac augue mid est mus augue lundium purus, turpis? Ut quis lundium pid, ridiculus ac aliquam dolor, scelerisque aliquet, sit porta cras ultricies ridiculus tempor vel sit, scelerisque! Rhoncus urna. Integer nec porttitor urna turpis, pellentesque nascetur, dictumst nunc? Enim!</strong>
                                            </p>
                                            <p>
Magna dictumst massa? Mauris phasellus et mus, adipiscing augue ac nisi, turpis integer sed? Pulvinar platea sagittis adipiscing diam arcu platea, duis pulvinar proin pid ac phasellus vel magna, risus vut enim scelerisque? Rhoncus lundium? Proin nunc integer cum et rhoncus, risus natoque et. Quis vel sed? Rhoncus nec. Ac phasellus. Mattis quis, tincidunt aliquet? Elementum turpis porttitor dignissim, nisi elementum, tincidunt risus, amet lectus nisi nisi facilisis, amet lacus integer porttitor pulvinar diam eu velit enim aliquam scelerisque lacus sit phasellus tincidunt augue eros ac phasellus scelerisque a, mauris. Quis et dapibus tortor vel scelerisque! Cum ultrices nisi, adipiscing velit diam purus! Proin scelerisque quis ac purus et? Ridiculus, vel! Rhoncus etiam, aliquet scelerisque nisi lundium dolor est. Ridiculus, vel! Rhoncus etiam, aliquet scelerisque nisi lundium dolor est.
											</p>
                                        </section>
                                    </div>
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
