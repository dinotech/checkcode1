<!DOCTYPE html>
<html lang="en"><head>

  <style>
  
  <!--datatablr-->
  th.headerSortUp { 
    background-image: url(../img/small_asc.gif); 
    background-color: #3399FF; 
} 
th.headerSortDown { 
    background-image: url(../img/small_desc.gif); 
    background-color: #3399FF; 
} 
th.header { 
    background-image: url(../img/small.gif); 
    cursor: pointer; 
    font-weight: bold; 
    background-repeat: no-repeat; 
    background-position: center left; 
    padding-left: 20px; 
    border-right: 1px solid #dad9c7; 
    margin-left: -1px; 
} 
table.tablesorter thead tr .headerSortUp {
	background-image: url(../assets/images/asc.gif);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(../assets/images/desc.gif);
}
table.tablesorter thead tr .header {
	background-image: url(../assets/images/bg.gif);
	background-repeat: no-repeat;
	background-position: center right;
	cursor: pointer;
}
  <!--end datatable-->
  #divMenu, ul, li, li li {
    margin: 0;
    padding: 0;
}
 
#divMenu {
    width: 150px;
    height: 27px;
}
 
#divMenu ul
{
     line-height: 25px;
}
 
    #divMenu li {
        list-style: none;
        position: relative;
        background: #641b1b;
    }
 
        #divMenu li li {
            list-style: none;
            position: relative;
            background: #641b1b;
            left: 148px;
            top: -27px;
        }
 
 
    #divMenu ul li a {
        width: 148px;
        height: 25px;
        display: block;
        text-decoration: none;
        text-align: center;
        font-family: Georgia,'Times New Roman',serif;
        color:#ffffff;
        /*border:1px solid #eee;*/
    }
 
    #divMenu ul ul {
        position: absolute;
        visibility: hidden;
        top: 27px;
    }
 
    #divMenu ul li:hover ul {
        visibility: visible;
    }
 
    #divMenu li:hover {
        background-color: #945c7d;
    }
 
    #divMenu ul li:hover ul li a:hover {
        background-color: #945c7d;
    }
 
    #divMenu a:hover {
        font-weight: bold;
    }
	
	/*ul {list-style: none;padding: 0px;margin: 0px;}
  ul li {display: block;position: relative;float: left;*//*border:1px solid #000*/}
  /*li ul {display: none;}
  ul li a {display: block;background: #000;padding: 5px 10px 5px 10px;text-decoration: none;
           white-space: nowrap;color:#fff*/ /*#fff*//*;}
  ul li a:hover {*//*background: #f00;*//*}
  li:hover ul {display: block; position: absolute;}
  li:hover li {float: none;}
  li:hover a {*//*background: #000;*//*}*/
  <!--li:hover li a:hover {background: #000;}-->
  #drop-nav li ul li {/*border-top: 0px;*/}
  </style>
  
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    
     <title>Admin Panel</title>
     
    
      <!--<link rel='stylesheet' href='<?php echo HTTP_CSS_PATH; ?>form-style.css' type='text/css' /> --> 
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>styles.css" rel="stylesheet">
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <!-- JavaScript -->
    <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js" type="text/javascript"></script>
 

    
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
    <!-- Add custom CSS here -->
    <link href="<?php echo HTTP_CSS_PATH; ?>arkadmin.css" rel="stylesheet">
   
    
    
    <!--<script src="<?php echo HTTP_JS_PATH; ?>/valid/phoneno-+international-format.js"></script>-->
    
    <script src="<?php echo HTTP_JS_PATH; ?>bootstrap.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>das.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
    <!--  

Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->
<!-- New code Data Table for CSV -->
   <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>tablesorter/jquery-latest.js"></script> 
<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>tablesorter/jquery.tablesorter.js"></script> 


  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>admin">Admin Panel</a>
        </div>
 <?php date_default_timezone_set('Asia/Calcutta');
// Define a default Page 
 //$id=$id =$this->input->get('admin', TRUE);
 $cs=uri_string(); 
//echo $id; die; 
 //echo $admin; die;
  $pg = isset($page) && $page != '' ?  $page :'dash'  ;    
?>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
        <div class="dropdown">
      <!--   <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown trigger
    <span class="caret"></span>
  </button>-->

        
          <ul class="nav navbar-nav side-nav">
          <?php if(isset($id)&&($id=="pt")){?>
            <li <?php echo  $cs =='admin/dashboard' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i>&nbsp;  Dashboard<?php //echo $id;?> </a>
            </li>
			<!--dealer -->            
           </li>
           <li <?php echo  $cs =='admin/party' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/party" ><i class="fa fa-user"></i>&nbsp;  Party</a></li>              
           <li <?php echo  $cs =='admin/site' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/site"><i class="fa fa-connectdevelop"></i>&nbsp;  Sites</a></li>
           <li <?php echo  $cs =='admin/godownpt' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/godownpt"><i class="fa fa-ge"></i>&nbsp;  Godown</a></li>
           <li <?php echo  $cs =='admin/stockpurchase' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/stockpurchase"><i class="fa fa-ge"></i>&nbsp;  Stock Purchase</a></li>
           <!--<li <?php echo  $cs =='admin/stockinrent' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/stockinrent"><i class="fa fa-ge"></i>&nbsp;  Outward Challan</a></li>-->
           <li <?php echo  $cs =='admin/sales' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/sales"><i class="fa fa-ge"></i>&nbsp;  Sales</a></li>
           <!--<li <?php echo  $cs =='admin/rent' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/rent"><i class="fa fa-ge"></i>&nbsp;  Dealer Transfer</a></li>-->
          <li <?php echo  $cs =='admin/paymentr' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/paymentr"><i class="fa fa-ge"></i>&nbsp;  Payment Received</a>
           <!--invert-->
           </li>
           <li <?php echo  $cs =='admin/paymentp' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/paymentp"><i class="fa fa-ge"></i>&nbsp;  Payment Paid</a></li>
           <li <?php echo  $cs =='admin/report' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/report"><i class="fa fa-ge"></i>&nbsp;  Reports</a></li>
   		   
           <li <?php echo  $cs =='admin/importexport' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/importexport"><i class="fa fa-ge"></i>&nbsp;  Import/Export</a></li>
           <?php }else{?>
           <li id="shric" >
           	<a>
            	<i class="fa fa-ge"></i>&nbsp;  Shri Cement <i class="fa fa-caret-down"></i>
            </a>
           	<ul id="shric_menu" class="nav navbar-nav " style=" padding-left:5px; ">
           		<li <?php echo  $cs =='admin/dealer' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/dealer" ><i class="fa fa-user"></i>&nbsp;  Dealer </a></li>
                <li <?php echo  $cs =='admin/godown' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/godown"><i class="fa fa-ge"></i>&nbsp;  Godown</a></li>
                <li <?php echo  $cs =='admin/rent' ? 'class="active"' : '' ?>>
                	<a href="<?php echo base_url(); ?>admin/rent?s=1">
                    	<i class="fa fa-ge"></i>&nbsp;  Dealer Transfer
                    </a>
               </li>
           	   <li <?php echo  $cs =='admin/stockinrent' ? 'class="active"' : '' ?>>
               	<a href="<?php echo base_url(); ?>admin/stockinrent?s=1">
                	<i class="fa fa-ge"></i>&nbsp;  Outward Challan</a></li> 
   		   <li <?php echo  $cs =='admin/invert' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/invert?s=1"><i class="fa fa-ge"></i>&nbsp;  Inword</a></li>
           
           <li <?php echo  $cs =='admin/reportsh' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/reportsh?s=1"><i class="fa fa-ge"></i>&nbsp;  Report</a></li>
           
           </ul></li><?php }?>
           <li class="dropdown messages-dropdown"></li>
   </ul><ul class="dropdown-menu">
               <li class="divider"></li><li>hi</li></ul>
</div>




          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
            
            </li>
            <li class="dropdown alerts-dropdown">
           
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('admin_name') ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
               <li class="divider"></li>
                <?php if(isset($id)&&($id=="pt")){?>
                <li><a href="<?php echo base_url(); ?>admin/dashboard?type=sh"><i class="fa fa-power-off"></i> Shree Cement</a></li>
                <?php }
				else
				{?><li><a href="<?php echo base_url(); ?>admin/dashboard?type=pt"><i class="fa fa-power-off"></i> Party</a></li><?php }?><li><a href="<?php echo base_url(); ?>admin/home/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
<script>
( function( $ ) {
$( document ).ready(function() {
$(".tablesorter").tablesorter(); 
$('#cssmenu > ul > li > a').click(function() {
  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active');	
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false;	
  }		
});
});
} )( jQuery );

$( "#shric" ).click(function() {
  $( "#shric_menu" ).toggle( "slow", function() {});  
});


</script>
  