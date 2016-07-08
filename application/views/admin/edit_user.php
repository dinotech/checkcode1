<?php  $this->load->view('admin/my_header.php');?>

<!-- Content Section Start -->
<div class="content-section">
<div class="container-liquid">
<div class="row">
<div class="col-xs-12">
<div class="sec-box">

<h1 class="heading">Full Profile </h1>

<div class="contents">

<form action="<?php echo base_url(); ?>admin/datatables/save_edit" enctype="multipart/form-data" method="post">

<table class="table">
<thead>
<tr>
<th class="col-md-4">Description</th>
<th class="col-md-8">Form Elements</th>
</tr>
</thead>
<tbody>

<?php foreach($row as $rows){

//	echo '<pre>';print_r($rows);die;
?>                         
<tr><input type="hidden" name="user_id" value="<?php echo $rows['user_id']?>" >
<td class="col-md-4">Name</td>
<td class="col-md-8"><input type="text" name="name" value="<?php echo $rows['name']?>" placeholder="" class="form-control"></td>
</tr>
<tr>
<td class="col-md-4">Password</td>
<td class="col-md-8"><input type="text" name="password" value="<?php echo $rows['password']?>" placeholder="" class="form-control" readonly="readonly"></td>
</tr>



<tr>
<td class="col-md-4">Email Id</td>
<td class="col-md-8"><input type="text" name="emailid" value="<?php echo $rows['email_id']?>" placeholder="" class="form-control"></td>
</tr>
<tr>
<td class="col-md-4">Subscription</td>
<td class="col-md-8"><input type="text" name="subscription" value="<?php echo $rows['subscription']?>" placeholder="" class="form-control"></td>


</tr>
<tr>
<td class="col-md-4">Duration</td>
<td class="col-md-8"><input type="text" name="duration" value="<?php echo $rows['duration']?>" placeholder="" class="form-control"></td>


</tr>
<tr>
<td class="col-md-4">City</td>
<td class="col-md-8"><input type="text" name="city" value="<?php echo $rows['city']?>" placeholder="" class="form-control"></td>


</tr>
<tr>
<td class="col-md-4">Payment Method</td>
<td class="col-md-8"><input type="text" name="paymethod" value="<?php echo $rows['payment_method']?>" placeholder="" class="form-control"></td>


</tr>
<tr>
<td class="col-md-4">Registered Id</td>
<td class="col-md-8"><input type="text" name="regid" value="<?php echo $rows['regiid']?>" placeholder="" class="form-control"></td>


</tr>
<tr>
<td class="col-md-4">Payment Id</td>
<td class="col-md-8"><input type="text" name="paymentid" value="<?php echo $rows['payid']?>" placeholder="" class="form-control"></td>


</tr>
<tr>
<td class="col-md-4">Role</td>
<td class="col-md-8"><select  name="role"  placeholder="" class="form-control">
<option  value="<?php echo $rows['role']?>">Subscriber</option>
</select></td>


</tr>
<tr>
<td class="col-md-4">Status</td>
<td class="col-md-8">

<select  name="status"  placeholder="" class="form-control">
<option <?php  if($rows['status'] ==1){ echo 'selected="selected"'; }?> value="1">Active</option>
<option <?php  if($rows['status'] ==0){echo 'selected="selected"'; }?> value="0">Inactive</option></select></td>


</tr>


<?php }?>                              


<td class="">
<div class="form-group has-success">
<input type="submit" value="submit" name="save" class="form-control">
</div>

</tr>

</tbody>
</table></form>
</div><!--<a style="float:right;font:Arial, Helvetica, sans-serif;font-size:18px;padding-right:20px;" href="datatables.php"><b>View</b></a>-->
<div class="clearfix"></div>

</div>
</div>
</div>
</div>
<!-- Row End -->
</div>
</div>
<!-- Content Section End -->
</div>
<!-- Right Section End -->
</div>
</div>
<!-- Wrapper End -->

<!--<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-42761673-1', 'extracoding.com');
ga('send', 'pageview');

</script>
-->
</body>
</html>
