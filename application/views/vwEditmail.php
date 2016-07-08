<?php $this->load->view('vwHeader');?>

<div class="heading">
<h3>Change Mail</h3>
</div>
<div class="container">
<div class="row">

<div class="error">
  <?php  echo validation_errors();
  if(isset($error)){  echo $error; }?>
</div>
<?php if(isset($success)){ ?>
<div class="alert alert-success" role="alert"><?php echo $success; ?></div>
<?php } else { ?>
<p>Edit your mail id here.</p>

<?php } ?>

<form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>editmail/change_mail">
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Current Mail</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="Current_mail" id="inputPassword" placeholder="Current Mail">
    </div>
  </div>
  <div class="form-group">
    <label for="confirm_password" class="col-sm-2 control-label">New Mail Id</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="new_mail" id="new_mail" placeholder="New Mail Id">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
   <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

</div> 
</div>
<?php $this->load->view('vwFooter');?>