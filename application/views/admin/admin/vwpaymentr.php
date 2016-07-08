<script>
function phonenumber(inputtxt)
{  
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(inputtxt.match(phoneno))
        {
      return true;
        }
      else
        {
        alert("Not a valid Mobile Number");
		document.getElementById("mob2").value = "";
        return false;
        }
}
function allnumeric(inputtxt)
      {  
      var numbers = /^[0-9]+$/;
      if(inputtxt.match(numbers))
      { 
      return true;
      }
      else
      { 
      alert('Please input numeric characters only');
      document.getElementById("ph2").value = "";
      return false;
      }
      }
</script>
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
$data['id']="pt";
$this->load->view('admin/vwHeader',$data);
?>

 <div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Payment Received</small></h2>
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
         <th>Date</th>
         <th>Party Name</th>
         <th>Amount</th>
         <th>Payment Flow</th>
        <!-- <th>Date</th>-->
         <th>Action</th>
         </tr>
           <?php foreach($row as $rows){
			 
		//echo '<pre>';print_r($rows);die;
		?>
         <tr>
         <td><?php echo $rows['date'];//$rows['d_name'];?></td>
         <td><?php echo $rows['d_name'];//$rows['d_address'];?></td>
         <td><?php echo $rows['price'];//$rows['phone'];?></td>
         <td><?php if($rows['payment_flow']==1){echo "Cash";}elseif($rows['payment_flow']==2){echo "Cheque";}else{echo "Credit";}//echo $rows['payment_flow'];?></td>
         <!--<td><?php echo $rows['cur_date'];?></td>-->
         <td><h5 style="color: darkblue;cursor: pointer;">
        <!-- editdealer-->
        <a href="editpaymentr?id=<?php echo $rows['id']; ?>" class="btn btn-success btn-xs">Edit</a>
        <a href="<?php echo base_url(); ?>admin/paymentr/delete_dealer?id=<?php echo $rows['id']; ?>" class="btn btn-success btn-xs">Delete</a>   
    
     <!-- <a href="dealer?id=<?php echo $rows['dealer_id']; ?>">Delete</a>-->
         </h5>
         
         </td>
        
         </tr>
         <?php } ?>
        
      </thead>
 </table>
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
 <input id="add" type="button" class="btn btn-success" name="add" value="ADD Payment Received" />
 </div>
 </div>
 <div id="adduser" style="display:none">
 
 <div id="userform">
 <h2 id="close" style="float: right;margin-top: -24px;cursor: pointer;">X</h2>
 <form method="post" enctype="multipart/form-data" action="" id="form2">
 <table>
 <thead>
 <tr><th>Date:</th>
 <td><input class="form-control" type="date" name="cdate" /></td></tr>
 
 <tr><th>Party Name:</th>
 <td><select class="form-control" name="partyname" required>
 <!--<option value="0">--none--</option>-->
 <?php //echo "<pre>"; print_r($gb);
 foreach($pty as $ptys){  ?>
 <option value="<?php echo $ptys['dealer_id']; ?>" ><?php echo $ptys['d_name']; ?></option>
 <?php } ?>
 </select>
 <!--<input class="form-control" type="text" name="partyname" />--></td></tr>
 
 <tr><th>Amount:</th>
 <td><input class="form-control" type="text" name="price"  /></td></tr>

 <tr><th>Payment Flow:</th>
 <td><select class="form-control" name="payflow">
 <option value="1">Cash</option>
 <option value="2">Cheque</option>
 </select><!--<input class="form-control" type="text" name="payflow"  />--></td></tr>
 <!--id="ph2" pattern="[0-9].{1,}" onkeyup="allnumeric(document.getElementById('ph2').value);";  id="mob2" pattern="[0-9].{1,}"<tr><th>Date:</th><td><input type="date" name="cdate" class="form-control"/></td></tr>-->
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