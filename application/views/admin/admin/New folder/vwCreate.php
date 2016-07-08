<style type="text/css">
#edit{
	    width: 100%;
    height: 1094px;
    position: absolute;
	        top: 0;
			
    background-color: rgba(0,0,0,.4);
	z-index: 99999999;
}

#editin2 table tr td {
	    padding: 10px;
}

#editin{
	    text-align: -webkit-center;
		    padding: 34px;
	    position: relative;
    margin: 200px 329px 29px 110px;;
    z-index: 99999999999999;
	background-color: whitesmoke;
}

#adduser2{
	    width: 100%;
    height: 1094px;
    position: absolute;
	        top: 0;
			
    background-color: rgba(0,0,0,.4);
	z-index: 99999999;
}

#userform2 table tr td {
	    padding: 10px;
}

#userform2{
	    text-align: -webkit-center;
		    padding: 34px;
	    position: relative;
    margin: 200px 329px 29px 110px;;
    z-index: 99999999999999;
	background-color: whitesmoke;
}
</style>

<?php 
$this->load->view('admin/vwheader');
?>

<div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Create University/Institute</small></h2>
            </div>
            </div>
            
            
    <div class="table-responsive">
  <form action="" method="post" enctype="multipart/form-data">
      <table class="table table-hover tablesorter">
      <thead>
      <tr><th>Name Of Institute</th>
     <th>Type Of Institute</th>
     <th>Contact Person</th>
     <th>Contact Number</th>
     <th>Course</th>
      </tr>
      
      <?php foreach($row as $rows) { ?>
	  <tr>
      <td><?php echo $rows['instituteName']; ?></td>
       <td><?php echo $rows['type']; ?></td>
       <td><?php echo $rows['first']; ?>  <?php echo $rows['last']; ?></td>
       <td><?php echo $rows['mobile']; ?></td>
       <td><h5 style="color: darkblue;cursor: pointer;"><a href="editcreate?id=<?php echo $rows['idinstituteDetails']; ?>">Edit</a></h5></td>       
      </tr>       
      <?php } ?>
	  
       </thead>
      </table>
      </form>
      
       <div>
      <input id="add" class="btn btn-success" type="button" value="Add Institute""/>
      </div>
      </div>
      
     
      
 <div id="adduser2" style="display:none"> 
 <div id="userform2">
 <h2 id="close" style="float: right;margin-top: -24px;cursor: pointer;">X</h2>
  <form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr><th>Name Of Institute</th>
 <td><input class="form-control" type="text" name="name"><td></tr>
 <tr><th>Type Of Institute</th> 
 <td><select class="form-control" name="institute">
 <?php foreach($type as $types) { ?>
 <option value="<?php echo $types['pick_key']; ?>"><?php echo $types['PickValue']; ?></option>
 <?php } ?>
 </select></td></tr>
 <tr><th>Contact Person First Name</th>
 <td><input class="form-control" type="text" name="first"></td></tr>
 <tr><th>Contact Person Last Name</th>
 <td><input class="form-control" type="text" name="last"></td></tr>
  <tr><th>Address:</th>
 <td><input class="form-control" type="text" name="address" /></td></tr>
 <tr><th>City:</th>
 <td><input class="form-control" type="text" name="city" /></td></tr>
 <tr><th>State:</th>
 <td><input class="form-control" type="text" name="state" /></td></tr>
 <tr><th>PIN:</th>
 <td><input class="form-control" type="text" name="pin" /></td></tr>
 <tr><th>Phonenumber:</th>
 <td><input class="form-control" type="text" name="phone" /></td></tr>
 <tr><th>Mobilenumber:</th>
 <td><input class="form-control" type="text" name="mobile" /></td></tr>
  <tr><th>Date Of Birth:</th>
 <td><input class="form-control" type="date" name="date" /></td></tr>
  <tr><th>Gender:</th>
 <td><select class="form-control" name="gender">
 <option value="M">Male</option>
 <option value="F">Female</option>
 </select></td></tr>
 <tr><th>Shelter:</th>
 <td>
 <select class="form-control" name="shelter">
 <option value="1">YES</option>
 <option value="0">NO</option>
 </select>
 </td></tr>
 <tr><th>Community :</th>
 <td><select class="form-control" name="community">
 <option value="NULL">Select</option>
 <?php foreach($community as $com){ ?>
 <option value="<?php echo $com['pick_key']; ?>"><?php echo $com['PickValue']; ?></option>
 <?php } ?>
 </select></td></tr>
 <tr><th>Blood Group:</th>
 <td><select class="form-control" name="blood">
 <option value="NULL">Select</option>
 <?php foreach($blood as $bloods){ ?>
 <option value="<?php echo $bloods['pick_key']; ?>"><?php echo $bloods['PickValue']; ?></option>
 <?php } ?>
 </select></td></tr>
 <tr><th>Direction:</th>
 <td><input class="form-control" type="text" name="direction" /></td></tr>
 <tr><td></td><td><input  class="btn btn-success" type="submit" name="submit" value="submit"></td></tr>
 </thead>
 </table>
 </form>
 </div>
 </div>
 
   <script type="text/javascript">
 $('#add').click(function(){
	 $('#adduser2').show();
 });
 
 $('#close').click(function(){
	 $('#adduser2').hide();
 });
 

 
 
 </script>