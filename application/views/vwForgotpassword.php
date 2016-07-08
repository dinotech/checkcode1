<?php $this->load->view('vwHeader');?>
<div class="heading">
<h3>Forgot Password</h3>
</div>

<div class="container">
<div class="row">
<?php if(isset($error)){?>
<div  class="error">
<p><?php echo $error;?></p>
</div>
<?php }else if(isset($success)){?>
<div  class="error">
<h5><p><?php echo $success;?></p></h5>
</div>
<?php } ?>


 <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist" id="tabs">
    <li role="presentation" class="active"><a href="#email" aria-controls="email" role="tab" data-toggle="tab">E mail</a></li>
    <li role="presentation"><a href="#mobile" aria-controls="mobile" role="tab" data-toggle="tab">Mobile</a></li>
   
  </ul>

  <!-- Tab panes -->
  
<br />
<p>A reset password link have been sent to your registered email, please visit it to reset the password. If you don’t see it in your inbox please check your spam folder too.
</p>

 <div class="tab-content">
    <div role="tabpanel" class="tab-pane active"  id="email">
<form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>forgotpassword/send_mail">

 <div class="form-group">
   <label for="inputEmail" class="col-sm-2 control-label">Provide Your Mail id</label>
    <div class="col-sm-10">
  <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E mail">
    </div>
  </div>
  
   <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
   <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>

</form>

</div>
 <div role="tabpanel" class="tab-pane"   id="mobile">
<p>If you don’t have access to your mail</p>
<p> <form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>forgotpassword/send_mail" id="mobile">

 <div class="form-group">
   <label for="inputEmail" class="col-sm-2 control-label">Provide your registered mobile number </label>
    <div class="col-sm-10">
  <input type="text" class="form-control" name="mobile"  placeholder="mobile number" id="textbox" onkeypress="return numbersonly(event)">
    </div>
  </div>
  
   <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
   <button type="submit" class="btn btn-primary"  onclick="checkLength()">Submit</button>
    </div>
  </div>

</form></p>
</div></div></div>

</div>

<div>
</div>


 <?php $this->load->view('vwFooter');?>