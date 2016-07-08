<html>
<head></head>
<body>
<?php  $this->load->view('admin/my_header.php');?>
<div class=" container">
    <div class="row">
        <div name="blk_btn" style="margin-top:2%; ">
            <a href="<?php echo base_url()?>admin/magazine/add_magzdata" type="button" class="btn btn-success" style="margin:0%;">Add a new Magazine</a>
            <a href="<?php echo base_url()?>admin/magazine/stoppublish" type="button" class="btn btn-success" style="margin:0%;">Stop publishing a Magazine</a>
            <a href="<?php echo base_url()?>admin/magazine/notpublishing" type="button" class="btn btn-success" style="margin:0%;">Publishing Stopped Magazines</a>
        </div>
    </div>
    
    <div class="row">
    <?php
		foreach($row as $data)
		{
	?>
    	<div style="float:left; width:200; margin:16px; height:250px; " >
			<a href="<?php echo base_url()?>admin/magazine/manage_magz?magzid=<?php echo $data['mag_id']?>"><img src="<?php echo base_url();?>assets/pdf_thumb/<?php echo $data['thumbnail']?>" class="img-responsive img-thumbnail thumb" alt="" style="width:190px;height:auto; max-height:250px;"></a>
		</div>            
    <?php
		}
	?>
    </div>
</div>
<div class="clearfix"></div>
</body>
</html>
