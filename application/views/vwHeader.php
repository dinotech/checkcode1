<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
  <title>E Magazine</title>
 <!--js-->

  
  <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
  <script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.js"></script>
   <script src="<?php echo HTTP_JS_PATH; ?>defaultjs.js"></script>
 

<!--css-->  
<link href="<?php echo HTTP_CSS_PATH; ?>style.css" rel="stylesheet">

<!--BOOTSTREP-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/css/bootstrap.min.css" >
<!-- Optional theme -->
<link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/css/bootstrap-theme.min.css" >
<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo HTTP_ASSETS_PATH; ?>bootstrap/js/bootstrap.min.js" ></script>

 
 
 <!--font awesome-->
<link rel="stylesheet" 
href="<?php echo HTTP_ASSETS_PATH;?>font-awesome/css/font-awesome.min.css">
<script src="<?php echo HTTP_JS_PATH; ?>jquery.min.js"></script>
<!--<script src="http://lab.iamrohit.in/js/location.js"></script>-->
<script src="<?php echo HTTP_JS_PATH; ?>location.js"></script>
 
  
 

</head>
<body>
<header>

<div style="padding:15px">

<span id="logo">
<a href="<?php echo BASE_URL; ?>"><img src="<?php echo HTTP_IMAGES_PATH;?>logo.png" /></a>
</span>
<?php    if ($this->session->userdata('is_client_login')) { ?>
<div class="loggedin"><a href="<?php echo BASE_URL ?>myaccount"><?php  echo   strtoupper($this->session->userdata('user_name')); ?></a></div>
<?php } else {?>
<div class="loggedin"><a >&nbsp;</a></div>

<?php } ?>
<span id="menu">
<?php    if (!$this->session->userdata('is_client_login')) { ?>
<!--login button-->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-login-modal-sm">LOGIN</button>
  <?php } else { ?>

<!--logout button-->
<form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>home/logout">
<button type="submit" class="btn btn-primary" >LOGOUT</button>
</form>

  <?php } ?>


<div class="modal fade bs-login-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    
      <form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>home/do_login">
     <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="emailid" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password">
    </div>
  </div>
 
   <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <label><a href="<?php echo BASE_URL ?>forgotpassword" >Forgot Password</a></label>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
   <button type="submit" class="btn btn-primary">Login</button>
    </div>
     <div class="col-sm-offset-2 col-sm-10">
    <p>New user please click <a href="<?php echo BASE_URL; ?>register"><button type="button" class="btn btn-primary">Sign in</button></a></p>
    </div>
  </div>
</form>
    </div>
  </div>
</div>


</span><!--//menu-->

</div>

</header>  
 
    

