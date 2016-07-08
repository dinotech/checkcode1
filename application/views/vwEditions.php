<?php $this->load->view('vwHeader');?>
<div class="heading">
<h3>Editions</h3>
</div>

<div class="container editions">
<div class="row">

<?php  foreach($magazine_sub as $k=>$v){?>

 <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img style="border:1px solid #aaa;" src="<?php echo HTTP_PDF_THUMB_PATH.$v['thumbnail'] ?>" alt="" height="290px">
      <div align="center" class="caption" style="padding-top:0px !important;">
      
<?php foreach($my_magazine_sub as $key=>$val){?> 
  <h3><?php echo $v['issue_name'] ?></h3>  
  <?php  if(strtotime($v['publish_date'])>=strtotime($val['start_time']) && strtotime($v['publish_date'])<=strtotime($val['end_time'])) {
if($v['parentid']==$val['mag_id']){    
$path=explode(".",$v['path']);

//echo "<pre>";print_r($path);
?> 
       <p><a target="_blank" href="<?php echo base_url()."read?mag=".str_replace(" ","",$path[0]);?>" class="btn btn-primary" role="button">Read Now</a></p>
<?php } }} ?>
      </div>
    </div>
  </div>



<?php } ?>
</div>
</div>


<?php $this->load->view('vwFooter');?>