<?php 
//echo'<pre>';print_r($row);die;
$this->load->view('admin/my_header.php'); ?>
<div class="table-box" style="margin-top:3%">
<div class="col-sm-10 col-sm-offset-1"  style="margin-bottom:3%">
		<div class="col-sm-6"><label class="col-sm-3">Search by</label><input type="text" id="searched" /></div>
        <div style="margin-left:10px; float:left"><button class="btn btn-success" id="Co" name="Country" onclick="searching(this.id)">Country</button></div>
        <div style="margin-left:10px; float:left"><button class="btn btn-success" id="St" name="State" onclick="searching(this.id)">State</button></div>
        <div style="margin-left:10px; float:left"><button class="btn btn-success"  id="Ci" name="City" onclick="searching(this.id)">City</button></div>
        <div style="margin-left:10px; float:left"><button class="btn btn-success"  id="Ac" name="Active" onclick="searching(this.id)">Active</button></div>
        <div style="margin-left:10px; float:left"><button class="btn btn-success"  id="In" name="In" name="Inactive" onclick="searching(this.id)">Inactive</button></div>
</div><input type="hidden" id="subsc" value="<?php echo $_GET['user']?>" />
        <table class=" col-lg-10 table table-bordered" id="example">
        		<thead>
                        <tr>                              
                                <th>Franchise Code</th>
                                <th>Franchise_name</th>
                                <th>City</th>
                                <th>Deactivate / Inactive</th>
                        </tr>
        		</thead>
				<tbody class="result">
				<?php foreach($row as $rows){?>
                        <tr>
                                <td><a href="<?php echo base_url()?>admin/createlogin/showprofile?id=<?php echo $rows['user_id']?>"><div><?php echo $rows['code']?></div></td>
                                <td><a href="<?php echo base_url()?>admin/createlogin/showprofile?id=<?php echo $rows['user_id']?>"><div><?php echo $rows['name']?></div></td>
                                <td><a href="<?php echo base_url()?>admin/createlogin/showprofile?id=<?php echo $rows['user_id']?>"><div><?php echo $rows['city']?></div></td>                                
                                
                                <td><div><?php  if($rows['status'] ==1){?><button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModal" onclick="sendid(<?php echo $rows['user_id']?>)"><?php echo 'Active'?></button><?php }else{?><button class="btn btn-danger"><?php echo 'Inctive';?></button><?php }?></div></td>                                                              
                                <?php /*echo base_url(); ?>admin/datatables/edit_user?id=<?php echo $rows['user_id']?>"><button type="button" class="btn btn-success">Edit</button></a></td>                                */?>
                        </tr>
                        <?php } ?>                                            
				</tbody>
		</table>
</tbody>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Are You sure to  Make the Franchise Inactive</p>
        </div>
        <div class="modal-footer">
        <form method="post" action="<?php echo base_url()?>admin/createlogin/eidtuser">
        <input type="hidden" id="exeid" name="exeid" />
          <button type="submit" class="btn btn-success" >Yes</button>          
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
         </form> 
        </div>
      </div>
      
    </div>
  </div>
<script>
function sendid(id)
{
	$('#exeid').val(id)
}
	function  searching(obj)
	{
		var items = $('#searched').val();
		var user = $('#subsc').val();
		$('.result').html('');
			$.ajax({
				url:'<?php echo base_url()?>admin/createlogin/search',
				type:'post',
				data:'obj='+obj+'&item='+items+'&user='+user,
				success:function(data)
				{
						var abhi = JSON.parse(data);						
						var count = abhi.length;
						jQuery.each(abhi, function(index, itemt) {		
						if(itemt.status==1){					
								$('.result').append('<tr>'+'<td>'+itemt.code +'</td>'+'<td >'+itemt.name+'</td>'+'<td >'+itemt.city+'</td>'+'<td>'+'<button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModal" onclick="sendid('+itemt.user_id+')">Active</button>'+'</td>');
						}
						if(itemt.status==0){
									$('.result').append('<tr>'+'<td>'+itemt.code +'</td>'+'<td >'+itemt.name+'</td>'+'<td >'+itemt.city+'</td>'+'<td>'+'<button type="button" class="btn btn-danger">Inactive</button>'+'</td>');
						}	
						})		
				},				
			});
	
		/*elseif(obj =='St'){ }
		elseif(obj =='Ci'){ }
		elseif(obj =='Ac'){ }
		elseif(obj =='In'){ }*/
	}
</script>
</body>
</html>
 
 
 <?php /* $this->load->view('admin/my_header.php'); ?>

<div class="contents" style="margin-top:10%;">
<form name="form1" method="post" action="" onSubmit="return validate();">
<input name="delete" type="submit" id="delete" value="Delete" class="btn btn-danger" role="button" style="float:right; margin-right:10px;margin-left:10px; margin-top:5px;">
<a href="<?php echo base_url(); ?>admin/datatables/add_data" class="btn btn-info" role="button" style="float:right;margin-top:5px;">Add</a>
<table class="display table" id="example">
<thead>
<tr><th></th>
<th>User Id</th>
<th>Names</th>
<th>Password</th>
<th>Email</th>

<th>Subscription</th>
<th>Duration</th>
<th>City</th>
<th>Payment Method</th>
<th>Register Id</th>
<th>Payment Id</th>
<th>Role</th>
<th>status</th>
<th></th>

<!--  <th class="center">CSS grade</th>-->
</tr>
</thead>
<tbody>

<?php foreach($row as $rows){

//	echo '<pre>';print_r($rows);die;
?>

<tr><td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $rows['user_id']; ?>"></td>
<td><?php echo $rows['user_id']?></td>
<td><?php echo $rows['name']?></td>
<td><?php echo $rows['password']?></td>
<td><?php echo $rows['email_id']?></td>
<td><?php echo $rows['subscription']?></td>
<td><?php echo $rows['duration']?></td>
<td><?php echo $rows['city']?></td>
<td><?php echo $rows['payment_method']?></td>
<td><?php echo $rows['regiid']?></td>
<td><?php echo $rows['payid']?></td>
<td><?php echo $rows['role']?></td>
<td>   <?php  if($rows['status'] ==1){echo 'Active';}else{echo 'Inctive';}?></td>


<td><a href="<?php echo base_url(); ?>admin/datatables/edit_user?id=<?php echo $rows['user_id']?>"><button type="button" class="btn btn-success">Edit</button></a></td>



</tr>
<?php } ?>



</tr>

</tbody>
<tfoot>
<!--<tr class="control">
<td ><a href="#">Show details</a></td>
<td ><a href="#">Hide details</a></td>
</tr>-->
</tfoot>  
</table></form>
<?php

// Check if delete button active, start this
if(isset($_POST['delete'])){
for($i=0;$i<count($_POST['checkbox']);$i++){
$del_id=$_POST['checkbox'][$i];
$sql = "DELETE FROM user WHERE user_id=$del_id";
$result = mysql_query($sql);
}
// if successful redirect to delete_multiple.php
if($result){
redirect('admin/datatables');
//echo "<meta http-equiv=\"refresh\" content=\"0;URL=datatables.php\">";
}
}

?>
<!--
<tr>
<th><input type="text" name="search_engine" value="Search engines" class="search_init" /></th>
<th><input type="text" name="search_browser" value="Search browsers" class="search_init" /></th>
<th><input type="text" name="search_platform" value="Search platforms" class="search_init" /></th>
<th><input type="text" name="search_version" value="Search versions" class="search_init" /></th>
<th><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
</tr>-->

<script>
$(document).ready( function () {
$('#example').DataTable();
} );
</script>


<!-- <script>
var asInitVals = new Array();			
$(document).ready(function() {
var oTable = $('#example').dataTable( {
"oLanguage": {
"sSearch": "Search all columns:"
}
} );

oTable = $("#example").dataTable({
"columnDefs": [{
"defaultContent": "-",
"targets": "_all"
}]
});

$("tfoot input").keyup( function () {
/* Filter on the column (the index) of this element 
oTable.fnFilter( this.value, $("tfoot input").index(this) );
} );



/*
* Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
* the footer

$("tfoot input").each( function (i) {
asInitVals[i] = this.value;
} );

$("tfoot input").focus( function () {
if ( this.className == "search_init" )
{
this.className = "";
this.value = "";
}
} );

$("tfoot input").blur( function (i) {
if ( this.value == "" )
{
this.className = "search_init";
this.value = asInitVals[$("tfoot input").index(this)];
}
} );
} );

</script>-->
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
<!-- Wrapper End -->

<!--<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-42761673-1', 'extracoding.com');
ga('send', 'pageview');

</script>-->

</body>
</html> */
