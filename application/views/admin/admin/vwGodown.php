<script>
function phonenumber(inputtxt)
{ 
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(inputtxt.value.match(phoneno))
        {
      return true;
        }
      else
        {
        alert("Not a valid Mobile Number");
		document.getElementById("mob").value = "";
        return false;
        }
}
function allnumeric(inputtxt)
      {
      var numbers = /^[0-9]+$/;
      if(inputtxt.value.match(numbers))
      {
      return true;
      }
      else
      {
      alert('Please input numeric characters only');
      document.getElementById("ph").value = "";
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
            <h2><small style="color: brown;">Godown Information</small></h2>
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
         <th>Godown Name</th>
         <th>Address</th>
         <th>Phone No.</th>
         <th>Mobile</th>
         <th>City</th>
         <th>State</th>
         <th>Date</th>
         <th>Action</th>
         </tr>
         </tr>
        
         <?php foreach($row as $rows){
			 
		//echo '<pre>';print_r($rows);die;
		?>
         <tr>
         <td><?php echo $rows['g_name'];?></td>
         <td><?php echo $rows['g_address'];?></td>
         <td><?php echo $rows['ph_no'];?></td>
         <td><?php echo $rows['mob'];?></td>
         <td><?php echo $rows['city'];?></td>
         <td><?php echo $rows['state'];?></td>
         <td><?php echo $rows['cur_date'];?></td>
         <td><h5 style="color: darkblue;cursor: pointer;">
        
  <a href="editgodown?id=<?php echo $rows['g_id']; ?>" class="btn btn-success btn-xs">Edit</a>
  <a href="<?php echo base_url(); ?>admin/godown/delete_godown?id=<?php echo $rows['g_id']; ?>" class="btn btn-success btn-xs">Delete</a>   
   
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
 <input id="add" type="button" class="btn btn-success" name="add" value="ADD Godown" />
 </div>
 </div>
 <div id="adduser" style="display:none">
 
 <div id="userform">
 <h2 id="close" style="float: right;margin-top: -24px;cursor: pointer;">X</h2>
 <form method="post" enctype="multipart/form-data" action="" name="form1">
 <table>
 <thead>
 <tr><th>Godown Name:</th>
 <td><input class="form-control" type="text" name="gname"  /></td></tr>
 <tr><th>Date:</th><td><input class="form-control" type="date" name="cdate" /></td></tr>
 <tr><th>Address:</th>
 <td>
 <textarea class="form-control" type="textarea" name="address" rows="4" cols="50"></textarea></td></tr>

 <tr><th>Phone Number:</th>
 <td><input class="form-control" type="text" name="phone" id="ph" onkeyup="allnumeric(document.form1.phone)" /></td></tr>

 <tr><th>Mobile Number:</th>
 <td><input class="form-control" type="text" name="mobile" id="mob" maxlength="10"  onchange="phonenumber(document.form1.mobile);" /></td></tr>
 
 <tr><th>City:</th>
 <td><input class="form-control" type="text" name="city"  /></td></tr>
 
 <tr><th>State:</th>
 <td><input class="form-control" type="text" name="state"  /></td></tr>
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