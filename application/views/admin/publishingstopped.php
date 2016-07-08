<html>
<head></head>
<body>
<?php // echo'<pre>';print_r($row);echo'</pre>';
$this->load->view('admin/my_header.php');?>
<div class=" container">
    <div class="row">
    <?php
		foreach($row as $data)
		{
	?>
    	<div style="float:left; width:200; margin:20px;">
			<a href="<?php echo base_url() ?>admin/magazine/previous_issues?magzid=<?php echo $data['mag_id'] ?>"><img src="<?php echo base_url();?>assets/pdf_thumb/<?php echo $data['thumbnail']?>" class="img-responsive img-thumbnail" alt="" style="width:190px;height:auto; max-height:250px;"></a>						
    </div>
    <?php
		}
	?>
</div>
<div class="clearfix"></div>
</body>
</html>
