<?php $this->load->view('vwHeader');?>

<div class="heading">
<h3>Editions</h3>
</div>

<div class="container editions">
<div class="row">

<?php 
//echo "magazine_sub -- ";
//echo'<pre>';print_r($magazine_sub);

//echo "my_magazine_sub -- ";
//echo'<pre>';print_r($my_magazine_sub);


 foreach($magazine_sub as $k=>$v){
	//echo'<pre>';print_r($v);
	?>

 <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img style="border:1px solid #aaa;" src="<?php echo HTTP_PDF_THUMB_PATH.$v['thumbnail'] ?>" alt="" height="290px">
      <div class="caption" style="padding-top:0px !important;">
      
<?php  foreach($my_magazine_sub as $key=>$val){ 
if($val['issue_num'] ==$v['issue_num']){?>      
        
        <h3><?php echo $v['issue_name'] ?></h3>
      <p><a target="_blank" href="<?php echo base_url()?>read" class="btn btn-primary" role="button">Read Now</a></p>
      
      <?php }  } ?>
      </div>
    </div>
  </div>



<?php } ?>
</div>
</div>


<?php $this->load->view('vwFooter');?>