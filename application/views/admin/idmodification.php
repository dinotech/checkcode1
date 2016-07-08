<?php  $this->load->view('admin/my_header.php');?>
    <div class="content-section mail_sec">
    <div class="container-liquid">
    <div class="row">
    <div class="col-xs-12">
    <div class="sec-box">                   
   
    <h3 class="heading">Id modification</h3>
    
    <div class="contents"> 
   
   
    <table class="table table-striped dtable" >
    <thead>
    <tr>
    <th>Date</th>
    <th>Sub-code</th>
    <th>Old Mail</th>
    <th>New Mail</th>
    <th>Approve/Reject</th>
    </tr>
    </thead>
    <tbody>
      
	 <?php	 
	 foreach($content as $k=>$v)
	 {
	 ?>
     
       <tr>
       <form id="form123" method="post" action="<?php echo base_url()?>admin/idmodification/editmail">
            <td><?php echo date('d M Y',strtotime($v['date'])); ?> 
            <input type="hidden" value="<?php echo $v['id']; ?>"  name="id" />
            </td>
            <td><?php echo $v['sub_code']; ?>
            <input type="hidden" value="<?php echo $v['sub_code']; ?>"  name="sub_code"/>
            </td>
            <td><?php echo $v['old_mail']; ?>
            <input type="hidden" value="<?php echo $v['old_mail']; ?>"  name="old_mail"/>
            </td>
            <td><?php echo $v['new_mail']; ?>
            <input type="hidden" value="<?php echo $v['new_mail']; ?>"  name="new_mail"/>
            </td>
            <td> 
            <?php if($v['status']=='0'){?>
            	<input type="submit" class="btn btn-success" name="submit" id="sub" value="Approve" /> /  
            	<input type="submit" class="btn btn-success" name="submit" id="sub" value="Reject" />
            <?php } ?>
            </td>
            </form>
        </tr>
        
    <?php 
	 } 
	?> 
        
     </tbody>
    </table> 
   
    </div>
    <div class="clearfix"></div>
                </div>
    </div></div></div></div>
    
<script type="application/javascript" src="<?php echo HTTP_JS_PATH ?>jquery.dataTables.min.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH ?>jquery.dataTables.css">
<script>
$(document).ready(function(){
    $('.dtable').DataTable();
	$('#sub').click(function(e) {
        $('#form123').submit();
    });
});
</script>

  