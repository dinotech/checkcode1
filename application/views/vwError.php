<?php $this->load->view('vwHeader');?>

<div class="heading">
<h3>Manage Subscription</h3>
</div>
<div class="row">
<?php if(isset($error)){?>
<div  class="error">
<p><?php echo $error;?></p>
</div><?php } ?>

<?php $this->load->view('vwFooter');?>