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
            <h2><small style="color: brown;">Users</small></h2>
            </div>
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
         <th>Name</th>
         <th>User email</th>
         <th>User active</th>
         <th>Last login</th>
         <th>Date of admission</th>
         <th>Photo Upload</th>
         <th>User group assigned</th>
         <th>Access profile assigned</th>
         <th>Action</th>
         </tr>
         </tr>
        
         <?php foreach($row as $rows){
			 
		//echo '<pre>';print_r($rows);die;?>
          <tr>
         <td><?php echo $rows['Username'];?></td>
         <td><?php echo $rows['email'];?></td>
         <td><?php echo $rows['IsUserActive'];?></td>
         <td><?php echo $rows['LastLoginTime'];?></td>
         <td><?php echo $rows['DateOfAdmission'];?></td>
         <?php if(empty($rows['photo'])){ ?>
         <td>No</td>
         <?php }else{ ?>
          <td>Yes</td>
         <?php } ?>
         <td><?php echo $rows['usergroup_assign'];?></td>
         <td><?php echo $rows['access_assign'];?></td>
          <td><h5 style="color: darkblue;cursor: pointer;"><a href="edituser?id=<?php echo $rows['idUser']; ?>">Edit</a><!--/<a href="edituser?id=<?php //echo $rows['idUser']; ?>&delete=true">Delete</a>--></h5></td>
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
 <input id="add" type="button" class="btn btn-success" name="add" value="ADD User" />
 </div>
 </div>
 <div id="adduser" style="display:none">
 
 <div id="userform">
 <h2 id="close" style="float: right;margin-top: -24px;cursor: pointer;">X</h2>
 <form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr><th>Firstname:</th>
 <td><input class="form-control" type="text" name="firstname" /></td></tr>
 <tr><th>Lastname:</th>
 <td><input class="form-control" type="text" name="lastname" /></td></tr>
 <tr><th>Username:</th>
 <td><input class="form-control" type="text" name="username" /></td></tr>
 <tr><th>Date Of Birth:</th>
 <td><input class="form-control" type="date" name="date" /></td></tr>
 <tr><th>Date Of Admission:</th>
 <td><input class="form-control" type="date" name="addate" /></td></tr>
 <tr><th>Gender:</th>
 <td><select class="form-control" name="gender">
 <option value="M">Male</option>
 <option value="F">Female</option>
 </select></td></tr>
 <tr><th>Blood Group:</th>
 <td><select class="form-control" name="blood">
 <option value="NULL">Select</option>
 <?php foreach($blood as $bloods){ ?>
 <option value="<?php echo $bloods['pick_key']; ?>"><?php echo $bloods['PickValue']; ?></option>
 <?php } ?>
 </select></td></tr>
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
 <tr><th>Direction:</th>
 <td><input class="form-control" type="text" name="direction" /></td></tr>
 <tr><th>Branch:</th> 
 <td>
 <select class="form-control" name="branch">
 <?php foreach($branch as $branchs){ ?>
 <option value="<?php echo $branchs['idBranch']; ?>"><?php echo $branchs['Branch_Name']; ?></option>
 <?php } ?>
 </select>
 </td></tr>
 <tr><th>User Group:</th> 
 <td>
 <select class="form-control" name="role">
 <?php foreach($role as $roles){ ?>
 <option value="<?php echo $roles['idGroup']; ?>"><?php echo $roles['Name']; ?></option>
 <?php } ?>
 </select>
 </td></tr>
 <tr><th>Access Profile:</th> 
 <td>
 <select class="form-control" name="access">
 <?php foreach($access as $accesss){ ?>
 <option value="<?php echo $accesss['idAccess_Profiles']; ?>"><?php echo $accesss['Name']; ?></option>
 <?php } ?>
 </select>
 </td></tr>
 <tr><th>Email:</th>
 <td><input class="form-control" type="text" name="id" /></td></tr>
 <tr><th>Password:</th>
 <td><input class="form-control" type="password" name="password" /></td></tr>
 <tr><th>Photo:</th>
 <td><input class="form-control" type="file" name="file" /></td></tr>
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