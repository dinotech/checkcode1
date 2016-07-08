<html>
<head></head>
<body>
<?php //echo'<pre>'; print_r($row);
if(isset($row[0]['parentid']) && $row[0]['parentid']=='')
{
	$row[0]['parentid']= $_GET['magzid'];
}
 $this->load->view('admin/my_header.php');?>
<div class=" container">
    <div class="row">
    <?php 
	if(isset($_GET['action']) and $_GET['action']=='insert')
		{
			echo '<div class="alert alert-success col-xs-10" role="alert">Issue Uploaded Successfully</div>';
		}
		elseif(isset($_GET['action']) && $_GET['action']=='supinsert')
		{
			echo '<div class="alert alert-success col-xs-10" role="alert">Supplement Inserted Successfully</div>';
		}
	?>
        <div name="blk_btn" style="margin-top:2%;">
            <a href="<?php echo base_url()?>admin/magazine/upload_edition?magzid=<?php echo $_GET['magzid']?>" type="button" class="btn btn-success" style="margin:3%;">Upload a New Issue</a>
            <a href="<?php echo base_url()?>admin/magazine/previous_issues?magzid=<?php echo $_GET['magzid']?>" type="button" class="btn btn-success" style="margin:3%;">View Old Issue</a>
            <a href="<?php echo base_url()?>admin/magazine/volsetting?magzid=<?php echo $_GET['magzid'] ?>" type="button" class="btn btn-success" style="margin:3%;">Volume Setting</a>
            <a href="<?php echo base_url()?>admin/magazine/republish?magzid=<?php echo $_GET['magzid'] ?>" type="button" class="btn btn-success" style="margin:3%;">Re-Publish</a>
            <a href="<?php echo base_url()?>admin/magazine/supplement?magzid=<?php echo $_GET['magzid'] ?>" type="button" class="btn btn-success" style="margin:3%;">Upload Supplement</a>
        </div>
    </div>
    <div class="row">
    <?php  
	if(isset($row[0]['thumbnail']))
	{
		foreach($row as $data)
		{$path=explode(".",$data['path']);
	?>
    	<div style="float:left;width:25%;margin-top: 15px;">
			<a target="_blank"  <?php if($data['path'] !==''){ ?> href="<?php echo base_url()."admin/read?mag=".str_replace("'","",$path[0]) ?>&action=read" <?php } ?>><img src="<?php echo base_url();?>assets/pdf_thumb/<?php echo $data['thumbnail']?>" class="img-responsive img-thumbnail thumb" alt="" style="width:190px;height:auto; max-height:250px;"></a>
		</div>        
    <?php
		}
	}
	?>    
    </div>
</div>
<div class="clearfix"></div>
</body>
</html>
