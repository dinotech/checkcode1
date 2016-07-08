
<?php  $this->load->view('admin/my_header.php');?>

<div class="contents">
<form name="form1" method="post" action="" onSubmit="return validate();">
<input name="delete" type="submit" id="delete" value="Delete" class="btn btn-danger" role="button" style="float:right; margin-right:10px;margin-left:10px; margin-top:5px;">

<table class="display table dtable">
<thead>
<tr>
<th></th>
<th>Id</th>
<th>Name</th>
<th>Email</th>

<th>Mobile</th>
<th>Address</th>
<th>City</th>
<th>state</th>
<th>Register Id</th>
<th>Role</th>
<th>Status</th>
<th></th>

<!--  <th class="center">CSS grade</th>-->
</tr>
</thead>
<tbody>

<?php foreach($row as $rows){


?>

<tr><td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $rows['id']; ?>"></td>
<td><?php echo $rows['id']?></td>
<td><?php echo $rows['username']?></td>
<td><?php echo $rows['email']?></td>
<td><?php echo $rows['mobile_no']?></td>
<td><?php echo $rows['address']?></td>

<td><?php echo $rows['city']?></td>
<td><?php echo $rows['state']?></td>
<td><?php echo $rows['regiid']?></td>
<td><?php echo $rows['role']?></td>
<td > 
<?php  if($rows['status'] ==1){echo 'Active';}else{echo 'Inctive';}?>
</td>


<td><a href="<?php echo base_url(); ?>admin/admin_profile/edit_admin?id=<?php echo $rows['id']?>"><button type="button" class="btn btn-success">Edit</button></a></td>



</tr>
<?php } ?>



</tr>

</tbody> 
</table></form>
<?php

// Check if delete button active, start this
if(isset($_POST['delete'])){
for($i=0;$i<count($_POST['checkbox']);$i++){
$del_id=$_POST['checkbox'][$i];
$sql = "DELETE FROM admin_user WHERE id=$del_id";
$result = mysql_query($sql);
}
if($result){
redirect('admin/admin_profile');
}
}

?>




</div>
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

<script type="application/javascript" src="<?php echo HTTP_JS_PATH ?>jquery.dataTables.min.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH ?>jquery.dataTables.css">
<script>
$(document).ready(function(){
$('.dtable').DataTable();
});
</script>

</body>
</html>
