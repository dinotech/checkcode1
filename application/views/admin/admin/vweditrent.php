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
$this->load->view('admin/vwHeader'); //echo "view page";die;
?>

 <div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Edit Dealer Transfer Information</small></h2>
            </div>
            </div>
 <hr/>
  <div class="table-responsive">
<form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr>
 <th>Source Name: &nbsp &nbsp</th>
 <td> 
 <select class="form-control" name="dname" id="mySelect" onchange="myFunction()">
 <?php //echo "<pre>"; print_r($gb);
 foreach($dlr as $dlrs){  ?>
 <option value="<?php echo $dlrs['dealer_id']; ?>" <?php if($dlrs['dealer_id']==$row['d_id']){ ?> <?php echo 'selected'; ?>
 <?php } ?>><?php echo $dlrs['d_name']; ?></option>
 <?php } ?>
 </select>
 <br/>
 </td>
 
 </tr>
 <tr><th>Rent Price:</th>
 <td>
 <input class="form-control" type="number" name="price" value="<? echo $row['rprice']; ?>" required="required" pattern="[0-9].{1,}"/><br/></td></tr>
 
 <!--<tr><th>No. Of Bags:</th>
 <td><input class="form-control" type="number" name="bags" value="<? echo $row['no_of_begs']; ?>"/></td></tr>-->
<tr><th>No. Of Bags:</th><td><input class="form-control" step="any" type="number" name="noofbags" value="<?php echo $row['no_of_begs'];?>"id="textBox"/></td><th>&nbsp &nbsp &nbsp Metric ton: &nbsp &nbsp </th><td><input type="number" step="any" id="message"name="metricton" value="<? echo $row['metricton']; ?>" class="form-control"/><br/></td></tr>

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



</script>
 <tr><th>OPC/PPC:</th>
 <td>
 <p>
   <input type="radio" name="opc_ppc" value="0" <?php if($row['opc_ppc']==0){ ?>checked="checked" <? } ?> />
     OPC 
   <input type="radio" name="opc_ppc" value="1" <?php if($row['opc_ppc']==1){ ?>checked="checked" <? } ?>/>
     PPC 
   <br />
 </p>  
 </td></tr>
 
 <tr><th>Cement Type:</th>
 <td><!--<input class="form-control" type="text" name="t_nt" value="<? echo $row['t_nt']; ?>" />-->
 
 <select class="form-control" name="t_nt">
<!-- <option value="0">--none--</option>-->
 <option value="1" <?php if($row['t_nt']==1){ ?> <?php echo 'selected'; ?>
 <?php } ?>>Cement</option>
 <option value="2" <?php if($row['t_nt']==2){ ?> <?php echo 'selected'; ?>
 <?php } ?>>Shree Cement</option>
 
 </select>
 <br/>
 </td></tr>
 
 <tr><th>Godown:</th>
 <td>
 <select class="form-control" name="gd">
 <option value="0">--none--</option>
<?php  
foreach($gbq as $gbs){  ?>
 <option value="<?php echo $gbs['g_id']; ?>" <?php if($gbs['g_id']==$row['gid']){ ?> <?php echo 'selected'; ?>
 <?php } ?>><?php echo $gbs['g_name']; ?></option>
 <?php } ?>
 
 </select><br/>
 </td></tr>
 
 
 
 <tr><th>Date:</th><td><input type="date" name="cdate"  value="<?php echo $row['other_date']; ?>" /><br/><br/></td></tr><!--value="$row['cur_date']"-->
  <tr><th>Narration:</th>
 <td><input type="text" name="sname"  value="<?php echo $row['sit_id']; ?>" /><br/>
<!--<select class="form-control" name="sname">
 <!--<option value="0">--none--</option>-->
<!--<?php //echo "<pre>"; print_r($gb);
foreach($sit as $sits){  ?>
 <option value="<?php echo $sits['id']; ?>" ><?php echo $sits['s_name']; ?></option>
 <?php } ?>
 </select>
 <br/>--></td></tr>
 </thead>
 </table> 
 <input type="submit"  class="btn btn-success" name="submit" value="submit" style="margin-left: 119px;" />
 </form>
 </div>
 <div>
 </div>
 </div>
 

