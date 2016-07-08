<html>
<head>
<title>cement</title>
 <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo HTTP_CSS_PATH; ?>signin.css" rel="stylesheet">
    
    <style>
body {
	
    background:url(../image/cement_image.jpg);
    /*background-repeat: no-repeat;*/
}
   input[type=radio] {
    border: 0px;
    width: 70%;
    height: 1em;
}
</style>
    
 
</head>
<body>
<div class="container" >
<br/><br/><br/><br/><br/><br/><br/>
<form class="form-signin panel" action="" method="post">
<center><!--<br/><br/><br/><br/><br/><br/><br/>-->
<!--<label for="shreecement">Shree Cement</label>-->

<table><tr><th><br/>
<!--<h4 class="form-signin-heading">--><h4 style="font-size:24px;"><b>Shree Cement</b></h4><!--</h4>class="form-control"--></th><td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="choice" value="shreecement"/></td></tr><tr>
<th><!-- -->
<label for="party"><br/><h4 style="font-size:24px;"><b>Party</b></h4></label></th><td>
<!--<label class="checkbox">-->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="choice" value="party"></input></td></tr></table><!--Party--><!--</label>-->
<input type="submit" name="submit" value="submit" class="btn btn-lg btn-success btn-block"/></center>
</form></div></body>
</html>
