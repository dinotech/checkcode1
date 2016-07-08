<?php //echo'<pre>'; print_r($row);echo'</pre>';
$this->load->view('admin/my_header.php'); ?>

<!-- Content Section Start -->
<div class="content-section">
<div class="container-liquid">
<div class="row">
<div class="col-xs-12">
<div class="sec-box">                   
<header>
<h1 class="heading">Volume Settings </h1>
</header>
<div class="contents">                       
<div class="table-box">
<table class="table">
<tbody>
<tr class="col-md-12">                                        	                                            
<td class="col-md-4">No of issues in a volume</td>
<td class="col-md-6"><input type="text" name="issue" readonly value="<?php if(isset($row[0])){ echo $row[0]['allowedissues'];} else echo 5;?>" class="form-control"></td>
<td class="col-md-2"> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Modify</button></td>
</tr>
<tr class="col-md-10">                                        	                                            
<td class="col-md-4">Current volume number</td>
<td class="col-md-6"><input type="text" name="volume" readonly value="<?php if(isset($row[0])){ echo $row[0]['newvol'];} else echo 1;?>" class="form-control"></td>                                            
</tr>
<tr class="col-md-12">                                        	                                            
<td class="col-lg-4">Increment volume number</td>
<td class="col-md-6"><input type="text" name="volume" readonly class="form-control" value="<?php if(isset($row[0])){ echo $row[0]['newvol'];} else echo 1;?>"></td>
<td class="col-md-2"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2">Change</button></td>
</tr>   
<tr class="col-md-12">                                        	                                            
<td class="col-lg-4">Rate of magazine</td>
<td class="col-md-6"><input type="text" name="price" readonly class="form-control" value="<?php // echo $_GET['magzid'];
$price=$this->magazine_model->get_magbyid($_GET['magzid']);
echo $price['price'];
 ?>"></td>
<td class="col-md-2"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal23">Change</button></td>
</tr>                                                           
</tbody>
</table>


</div>                      
</div>
<div class="clearfix" ></div>
</div>
</div>
</div>

<!-- Row End -->
</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<form id="issuemodal" action="<?php echo base_url(); ?>admin/magazine/volset_issue_update" method="post">
<div class="modal-content col-md-10 col-md-offset-1">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h3 class="modal-title">Are You Confirm to Modify Issues in the Volume</h3>
</div>
<div class="modal-body">
<input class="form-control" type="number" name="totissues" value="<?php if(isset($row[0])){ echo $row[0]['allowedissues'];} else echo 5;?>">
<input type="hidden" name="id" value="<?php echo $_GET['magzid']?>">
</div>
<div class="modal-footer">
<button type="button" id="modissue" class="btn btn-success">Yes</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
</div>
</div>
</form>
</div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form id="volmodal" action="<?php echo base_url(); ?>admin/magazine/volset_vol_update" method="post">
<div class="modal-content col-md-10 col-md-offset-1">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h3 class="modal-title">Are you Confirm to Increase Volume Number</h3></div>
<div class="modal-body">
<input class="form-control" type="number" name="latestvol" min="<?php if(isset($row[0])){ echo $row[0]['newvol'];} else echo 1;?>" value="<?php echo $row[0]['newvol']?>">
<input type="hidden" name="id" value="<?php echo $_GET['magzid']?>"></div>
<div class="modal-footer">
<button type="button" id="modvol" class="btn btn-success">Yes</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
</div>
</div>
</form>              
</div></div>
<div class="modal fade" id="myModal23" tabindex="-1" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form id="pricemodel" action="<?php echo base_url(); ?>admin/magazine/price_set" method="post">
<div class="modal-content col-md-10 col-md-offset-1">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h3 class="modal-title">Are you Confirm to Change price</h3></div>
<div class="modal-body">
<input class="form-control" type="text" name="price" value="<?php $price=$this->magazine_model->get_magbyid($_GET['magzid']);
echo $price['price'];?>">
<input type="hidden" name="id" value="<?php echo $_GET['magzid']?>"></div>
<div class="modal-footer">
<button type="button" id="pvol" class="btn btn-success">Yes</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
</div>
</div>
</form>              
</div>
</div>
<!-- Wrapper End -->
<!-- Modal -->
<script>
$(document).ready(function(e) {
$('#modissue').click(function(e) {
$('#issuemodal').submit();		
});
$('#modvol').click(function(e) {
$('#volmodal').submit();		
});
$('#pvol').click(function(e) {
$('#pricemodel').submit();		
});
});
</script>
</body>
</html>

