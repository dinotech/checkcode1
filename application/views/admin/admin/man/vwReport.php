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
$this->load->view('admin/vwHeader');
?>

 <div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Manage Reports</small></h2>
            <hr/></div>
            </div>

  <div class="table-responsive">
  <form action="" method="post" enctype="multipart/form-data">
      <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Dealer Name</th>
         <th>Address</th>
         <th>Phone No.</th>
         <th>Mobile</th>
         </tr>
         </tr>
        
         <?php foreach($row as $rows){
			 
		//echo '<pre>';print_r($rows);die;
		?>
         <tr>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php echo $rows['d_address'];?></td>
         <td><?php echo $rows['phone'];?></td>
         <td><?php echo $rows['mobile'];?></td>
   <!--<td><h5 style="color: darkblue;cursor: pointer;">
    <a href="editdealer?id=<?php echo $rows['dealer_id']; ?>" class="btn btn-success btn-xs">Edit</a>
    <a href="<?php echo base_url(); ?>admin/dealer/delete_dealer?id=<?php echo $rows['dealer_id']; ?>" class="btn btn-success btn-xs">Delete</a>   
    </h5></td>-->
        
         </tr>
         <?php } ?>
        
      </thead>
 </table>
 </form>
 </div>
 <div>
 </div>
 </div>
 <div id="adduser" style="display:none">
 
 <!--<div id="userform">
 <h2 id="close" style="float: right;margin-top: -24px;cursor: pointer;">X</h2>
 <form method="post" enctype="multipart/form-data" action="" id="form2">
 <table>
 <thead>
 <tr><th>Dealer Name:</th>
 <td><input class="form-control" type="text" name="dname" required="required" /></td></tr>
 
 <tr><th>Address:</th>
 <td>
 <textarea class="form-control" type="textarea" name="address" required="required" rows="4" cols="50"></textarea></td></tr>
 
 <tr><th>Phone Number:</th>
 <td><input class="form-control" type="text" name="phone" id="ph2" required="required" pattern="[0-9].{1,}" onkeyup="allnumeric(document.getElementById('ph2').value);" /></td></tr>

 <tr><th>Mobile Number:</th>
 <td><input class="form-control" type="text" name="mobile" id="mob2" required="required" pattern="[0-9].{1,}" /></td></tr>
 
 </thead>
 </table> 
 <input type="submit"  class="btn btn-success" name="submit" value="submit" style="margin-left: 119px;" />
 </form>
 </div>-->
 </div>


 <script type="text/javascript">
 $('#add').click(function(){
	 $('#adduser').show();
 });
 
 $('#close').click(function(){
	 $('#adduser').hide();
 });
 
 </script>