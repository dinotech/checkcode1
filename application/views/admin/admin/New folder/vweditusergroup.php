<style type="text/css">
table tr {
	    height: 25px;
}
table, tr, th {
	    border-bottom: 0px;
}
</style>
<?php
$this->load->view('admin/vwHeader');
?>

<div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Edit User Group</small></h2>
            </div>
            </div>
            
             <div class="table-responsive">
  <form action="" method="post" enctype="multipart/form-data">
      <table  class="table table-hover tablesorter" style=" width: 64%;">
      <thead>
      <tr><td>User Groups</td>
 <td><input class="form-control" type="text" name="usergroup" value="<?php echo $row['Name']; ?>"><td></tr>
 <tr><td>Description</td> 
 <td>
 
 <input class="form-control" type="text" name="description" value="<?php echo $row['Description']; ?>">
 
 <!--<select name="institute">
 <?php //foreach($type as $types) { ?>
 
 <option value="<?php echo $types['pick_key']; ?>"><?php echo $types['PickValue']; ?></option>
 <?php //} ?>
 </select>--></td></tr>
 <!--<tr><th>User Active</th>
 <td><input type="text" name="useractive" value="<?php //echo  $row['IsUserActive']; ?>"></td></tr>
 <tr><th>LastLogin</th>
 <td><input type="datetime" name="lastlogin" value="<?php //echo  $row['LastLoginTime']; ?>"></td></tr>
 <tr><th>Date of Admission</th>
 <td><input type="datetime" name="dateofadmission" value="<?php //echo  $row['DateOfAdmission']; ?>"></td></tr>
 <tr><th>Photo Upload</th>
 <td><input type="text" name="photoupload" value="<?php //echo  $row['photo']; ?>"></td></tr>
 <tr><th>Usergroup Assigned</th>
 <td><input type="text" name="usergroupassigned" value="<?php //echo  $row['UserType']; ?>"></td></tr>-->
 
 
 
 <tr>
 <td></td><td style="padding: 15px;"><input type="submit" class="btn btn-success" name="submit"></td>
 </tr>
 </thead></table>
</form></div>