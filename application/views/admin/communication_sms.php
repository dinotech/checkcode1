<?php  $this->load->view('admin/my_header.php');?>
<div class="content-section mail_sec">
    <div class="container-liquid">
        <div class="row">
            <div class="col-xs-12">
                <div class="sec-box">                   
                    <header>
                        <h1 class="heading">SMS Settings</h1>
                    </header>
                    <div class="error"><?php if(isset($success)){ echo $success;} ?></div>
                    <div class="contents">  
<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/communication/sms_setting" enctype="multipart/form-data">
  <div class="form-group"  style="margin-top: 30px;">
    <label for="inputEmail3" class="col-sm-2 control-label">Message</label>
    <div class="col-sm-10"  style="margin-top: 5px;">
      <textarea class="form-control" id="msg_contant" name="msg" placeholder="Message here"></textarea>
    </div>
  </div>
  
   <div class="form-group">
    <label for="config" class="col-sm-2 control-label">Sending configration:</label>
    <label for="config" class="col-sm-6 control-label config_head" >click here for see configration</label>
    <div class="col-sm-12"  style="margin-top: 5px;">
    <div id="config" style="display:none" >
    <div class="form-group">
    <label  class="col-sm-5 control-label">protocol</label>
    <label  class="col-sm-5 control-label">sendmail</label>
    </div>
    <div class="form-group">
    <label  class="col-sm-5 control-label">smtp host</label>
    <label class="col-sm-5 control-label">localhost</label>
    </div>
    <div class="form-group">
    <label  class="col-sm-5 control-label">smtp port</label>
    <label class="col-sm-5 control-label">587</label>
    </div>
    <div class="form-group">
    <label class="col-sm-5 control-label">smtp user</label>
    <label class="col-sm-5 control-label">e-magazine@emithra.com</label>
    </div>
    <div class="form-group">
    <label class="col-sm-5 control-label">smtp pass</label>
    <label class="col-sm-5 control-label">******</label>
    </div>
    <div class="form-group">
    <label class="col-sm-5 control-label">smtp timeout</label>
    <label class="col-sm-5 control-label">4</label>
    </div>
    <div class="form-group">
    <label class="col-sm-5 control-label">mailtype</label>
    <label class="col-sm-5 control-label">html</label>
    </div>
     <div class="form-group">
    <label class="col-sm-5 control-label">charset</label>
    <label class="col-sm-5 control-label">iso-8859-1</label>
    </div>
    </div>
    </div>
  </div>
   
  
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="save" class="btn btn-success">Save</button>
    </div>
  </div>
</form>
</div>
</div>
<script>
$(document).ready(function(){
    $(".config_head").click(function(){ 
        $("#config").toggle();
    });
});
</script>