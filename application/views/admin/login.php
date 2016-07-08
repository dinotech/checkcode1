<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>Login</title>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<!--// Stylesheets //-->
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" media="screen" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" media="screen" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!--// Javascript //-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.accordion.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.custom-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/selectnav.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/functions.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">




</head>



<body class="align">

<div class="site__container">

<div class="grid__container">
<div style="color:#ffffff "><?php if(isset($error))echo $error ;  ?></div>
<form action="<?php echo base_url(); ?>admin/createlogin/do_login" method="POST" class="form form--login">

<div class="form__field">
<label class="fontawesome-user" for="login__username" style="font-size:14px;margin-bottom:0px !important;"><span class="hidden">Email</span></label>
<input id="login__username" type="text" name="username" class="form__input" placeholder="Username" required>
</div>

<div class="form__field">
<label class="fontawesome-lock" for="login__password" style="font-size:14px;margin-bottom:0px !important;"><span class="hidden">Password</span></label>
<input id="login__password" type="password" name="password" class="form__input" placeholder="Password" required>
</div>

<div class="form__field">
<input type="submit" value="Sign In">
</div>

</form>


</div></div></body>
</html>




