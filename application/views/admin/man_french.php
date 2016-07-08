<?php 
//print_r($user);
$this->load->view('admin/my_header.php'); ?>
<div class=" container">
		<div class="row">
        <?php if($user == 'franchise'){?>
				<div name="blk_btn" style="margin-top:15%; ">                                                                 
						<a href="<?php echo base_url(); ?>admin/createlogin/manage_users?user=franchise" type="button" class="btn btn-success btn-lg btn-block" style="width:35%;margin-left:5%; float:left">View all franchise </a>
   						<a href="<?php echo base_url(); ?>admin/datatables/add_data?acc=franchise" type="button" class="btn btn-success btn-lg btn-block" style="width:35%;margin-left:5%; float:left">New franchise </a>
						<a href="<?php echo base_url(); ?>admin/datatables/businessReport?acc=franchise" type="button" class="btn btn-success btn-lg btn-block" style="width:35%;margin-left:5%; float:left">Business report </a>
						<a href="<?php echo base_url(); ?>admin/createlogin/updateaccount" type="button" class="btn btn-success btn-lg btn-block" style="width:35%;margin-left:5%; float:left">Account Approvals </a>

				</div>
        <?php }else if ($user == 'executive'){?>        
        		<div name="blk_btn" style="margin-top:15%; ">                                                                 
						<a href="<?php echo base_url(); ?>admin/createlogin/manage_users?user=executive" type="button" class="btn btn-success btn-lg btn-block" style="width:25%;margin-left:5%; float:left">View Executives </a>
   						<a href="<?php echo base_url(); ?>admin/datatables/add_data?acc=executive" type="button" class="btn btn-success btn-lg btn-block" style="width:25%;margin-left:5%; float:left">New Executive </a>
						<a href="<?php echo base_url(); ?>admin/datatables/businessReport?acc=executive" type="button" class="btn btn-success btn-lg btn-block" style="width:25%;margin-left:5%; float:left"> Business report </a>
						

				</div>
        <?php } ?>
		</div>
</div>
<?php $this->load->view('admin/vwFooter');?>
