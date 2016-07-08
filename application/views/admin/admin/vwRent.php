<style type="text/css">

#adduser{
	    width: 100%;
    height: 1092px;
    position: absolute;
	        top: 0;
			
    background-color: rgba(0,0,0,.4);
	z-index: 99999999;
}

#userform table tr td {
	    padding: 10px;
}

#userform{
	    text-align: -webkit-center;
		    padding: 34px;
	    position: relative;
    margin: 64px 329px 29px 110px;;
    z-index: 99999999999999;
	background-color: whitesmoke;
}
</style>

<?php
$this->load->view('admin/vwHeader');
?>

 <div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Dealer Transfer</small></h2>
            <hr/></div>
            </div>
 <?php
  //echo '<pre>';print_r($row);die;
  //$row[0][$i]['usergroup_assign']=$rows->result_array(); //echo '<pre>';print_r($r);die;

 ?>
  <div class="table-responsive">
  <form action="" method="post" enctype="multipart/form-data">
      <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Dealer Name</th>
         <th>Rent Price</th>
         <th>No. Of Bags</th>
         <th>Metricton</th>
         <th>OPC/PPC</th>
         <th>Cement Type</th>
         <th>Date & Time</th>
         <th>Godown</th>
         <th>Narration<!--Site Name--></th>
         
         <!--<th>Challan No.</th>-->
         <th>Date</th>
         <th>Action</th>
         
         </tr>
         </tr>
        
         <?php 
		 
		 //print_r($row);die;
		 foreach($row as $rows){
			 
		// echo '<pre>';print_r($rows);die;
		?>
         <tr>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php echo $rows['rprice'];?></td>
         <td><?php echo $rows['no_of_begs'];?></td>
         <td><?php echo $rows['metricton'];?></td>
         <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
         <td><?php if($rows['t_nt']==1){ echo "Cement";} if($rows['t_nt']==2) { echo "Shi cement"; }?></td>
         <td><?php echo $rows['date_t'];?></td>
         <td><?php echo $rows['g_name'];?></td>
         <td><?php echo $rows['sit_id'];?></td><!--s_name-->
               
         <!--<td><?php echo $rows['challanno']; ?></td>-->
         <td><?php echo $rows['other_date'];?></td>
         <td><h5 style="color: darkblue;cursor: pointer;">
         <a href="editrent?id=<?php echo $rows['r_id']; ?>" class="btn btn-success btn-xs">Edit</a>
         <a href="<?php echo base_url(); ?>admin/rent/delete_rent?id=<?php echo $rows['r_id']; ?>" class="btn btn-success btn-xs">Delete</a>   
         </h5>
         </td>
         </tr>
         <?php } ?>
        
      </thead>
 </table><hr/>
 <div style="float:right;    margin-right: 127px;">
 <input type="hidden" name="limit" value="<?php echo $limit; ?>" />
 <?php if($limit > 1) { ?>
 <input id="" class="btn btn-success" type="submit"  name="pre" value="Pre"/>
 <?php } ?>
 <input id="" class="btn btn-success" type="submit" name="next" value="Next" />
 </div>
 </form>
 </div>
 <div>
 <input id="add" type="button" class="btn btn-success" name="add" value="ADD Dealer Transfer" />
 </div>
 </div>
 <div id="adduser" style="display:none">
 
 <div id="userform">
 <h2 id="close" style="float: right;margin-top: -24px;cursor: pointer;">X</h2>
 <form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr>
 <th>Dealer Name:</th>
 <td>
 <select class="form-control" name="dname" required="required" id="dname" >
 <option value="0">--Select--</option>
 <?php //echo "<pre>"; print_r($gb);
 foreach($dlr as $dlrs){  ?>
 <option value="<?php echo $dlrs['dealer_id']; ?>"  ><?php echo $dlrs['d_name']; ?></option>
 <?php } ?>
 </select>
 
 </td>
 
 </tr>
 <tr><th>Date:</th><td><input class="form-control" type="date" name="cdate" /></td></tr>
  <tr><th>Rent Price:</th>
 <td>
 <input class="form-control" type="number" name="price" pattern="[0-9].{1,}"/></td></tr>
 
 <!--<tr><th>No. Of Bags:</th>
 <td><input class="form-control" type="number" name="bags" id="TextBox1" onfocus="javascript:focused1(this)" /></td><th>Metric ton</th><td><input type="number" id="TextBox2" name="metricton"onfocus="javascript:focused(this)" step="any" class="form-control" /></td></tr>-->
<tr><th>No. Of Bags:</th><td><input class="form-control" step="any" type="number" name="bags" id="textBox"/></td><th>Metric ton</th><td><input type="number" step="any" id="message"name="metricton"/></td></tr>
<script type="text/javascript">
function focused(txt3){
	var result = document.getElementById("TextBox1").value * 0.05;
            txt3.value = result;
	}
function focused1(txt3){
	var result = document.getElementById("TextBox2").value * 20;
            txt3.value = result;
	}
/*$("#textBox").change(function(){
   $("#message").val($(this).val()*0.05);
});

$("#message").change(function(){
   $("#textBox").val($(this).val()*20);
});
$("#textBox").keyup(function(){
   $("#message").val($(this).val()*0.05);
});

$("#message").keyup(function(){
   $("#textBox").val($(this).val()*20);
});*/

$("#textBox").keyup(function(){
	var val =$(this).val()*0.05;
	var v=val.toFixed(2);
   $("#message").val(v);
});

$("#message").keyup(function(){
	var val=$(this).val()*20;
	var v=val.toFixed(2);
	
   $("#textBox").val(v);
});
$("#textBox").change(function(){
	var val=$(this).val()*0.05;
	var v=val.toFixed(2);
   $("#message").val(v);
});

$("#message").change(function(){
   var val=$(this).val()*20;
   var v=val.toFixed(2);
   
   $("#textBox").val(v);
});

$('#dname').change(function(){
	var val = $( "#dname option:selected" ).val();
	var MyAppUrlSettings = {
    MyUsefulUrl : '@Url.Action("Action","Controller")'}
	$.ajax({
	url : 'sitename.php',
	type:'POST',
	data : {d_id:val},
	success: function(result){
    }
	})
	});

</script>
 <tr><th>OPC/PPC:</th>
 <td><p>
    <input type="radio" name="opc_ppc" value="0"  />
     OPC 
    <input type="radio" name="opc_ppc" value="1" checked="checked"/>
     PPC 
   <br />
 </p>  </td></tr>
 
 
 <tr><th>Cement Type:</th>
 <td><select class="form-control" name="t_nt">
 <!--<option value="0">--none--</option>-->
 <option value="1">Cement</option>
 <option value="2">Sri Cement</option>
 
 </select></td></tr>
 <tr><th>Godown:</th>
 <td>
<select class="form-control" name="gd">
 <!--<option value="0">--none--</option>-->
<?php //echo "<pre>"; print_r($gb);
foreach($gb as $gbs){  ?>
 <option value="<?php echo $gbs['g_id']; ?>" ><?php echo $gbs['g_name']; ?></option>
 <?php } ?>
 </select>
 </td></tr>
 
 <tr><th>Narration:</th><td><input type="text" name="sname" class="form-control"/></td>
<!-- <td>
<select class="form-control" name="sname">
 <!--<option value="0">--none--</option>-->
<!--<?php //echo "<pre>"; print_r($gb);
foreach($sit as $sits){  ?>
 <option value="<?php echo $sits['id']; ?>" ><?php echo $sits['s_name']; ?></option>
 <?php } ?>
 </select>
 </td>--></tr>
 <!--<tr><th>Challan No.</th><td><input type="number" name="cno" class="form-control"/></td></tr>-->
 
 </thead>
 </table> 
 <input type="submit"  class="btn btn-success" name="submit" value="submit" style="margin-left: 119px;" />
 </form>
 </div>
 </div>


 <script type="text/javascript">
 $('#add').click(function(){
	 $('#adduser').show();
 });
 
 $('#close').click(function(){
	 $('#adduser').hide();
 });
 
 </script>