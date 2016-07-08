<?php $this->load->view('vwHeader');?>

<div class="heading">
<h3>Change Password</h3>
</div>

<div id="ack" class="alert alert-danger col-sm-8 col-sm-offset-2" style="height:5%; display:none; margin-bottom:40px;  text-align:center;">Please Enter correct Password</div><br />

<div class="container">
<div class="row">
<br />
<div class="error">
  <?php  echo validation_errors(); ?>
</div>
<?php if(isset($success)){ ?>
<div class="alert alert-success" role="alert;"><?php echo $success; ?></div>
<?php } ?>

<form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>resetpassword/change_password">
  <div class="form-group">
    <label for="currpass" class="col-sm-2 control-label">Current Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="curpass" id="curpass" placeholder="Enter Current Password" onblur="checkfun(this.value)">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">New Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Enter nrePassword">
    </div>
  </div>
  <div class="form-group">
    <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
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
<script>
	function checkfun(data)
	{
	
		$.ajax({
			url:'resetpassword/checkdata',
			type:'post',
			data:'curpass='+data,
			success:function(data){
					if(data==0)
					{
						$('#ack').show();
						$('#curpass').val('');
						$('#curpass').focus();
						$('#inputPassword').val('');
						$('#confirm_password').val('');						
					}
			}
		});
	}
</script>
<?php $this->load->view('vwFooter');?>
