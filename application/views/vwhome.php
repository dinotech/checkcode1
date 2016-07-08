<?php error_reporting(E_ERROR | E_WARNING | E_PARSE); ?>
<?php $this->load->view('vwHeader');
if($this->session->userdata('username')){
?>
<div class="alert alert-info container" role="alert">Welcome <?php echo $this->session->userdata('user_name'); ?></div>
<?php } ?>


<div class="error"><?php  echo validation_errors(); echo $error; ?></div>

<?php $this->load->view('vwSlider');?>


<div class="container">
<div class="row">
  <div class="col-md-4">
  <h4>E magzine the 21st century publication of record for those wanting the inside track on trade and commerce within the region, and the Gulf Cooperation Council’s economic       prominence in the world.</h4>
  
  
  </div>
  <div class="col-md-4">
  <h4>Through a diverse portfolio of interactive editorial tools, the title enables its readers to enhance their professional development and maximise profits for their businesses</h4>
 
  
  </div>
  
  <div class="col-md-4">
  <h4>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</h4>
 </div>

</div>
<div class="row">
  <div class="col-md-3"></div>
  <div align="center" class="col-md-6">
   <h3><a href="<?php echo BASE_URL; ?>register"><button type="button" class="btn btn-primary btn-lg">SUBSCRIBE NOW</button></a></h3>
   </div>
  
</div>


</div>



<?php $this->load->view('vwFooter');?>