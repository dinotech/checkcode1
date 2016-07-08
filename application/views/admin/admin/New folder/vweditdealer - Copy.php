<style type="text/css">
table tr {
	    height: 38px;
}</style>
<?php
$this->load->view('admin/vwHeader');
?>

<div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Edit User</small></h2>
            </div>
            </div>
            
             <div class="table-responsive" style="display:flex">
  <form action="" method="post" enctype="multipart/form-data" style="    width: 60%;">
      <table style="     text-align: center;
    width: 75%;">
      <thead>
      <tr><th>Name</th>
 <td><input class="form-control" type="text" name="name" value="<?php echo $row['Username']; ?>"><td></tr>
 <tr><th>User email</th> 
 <td>
 
 <input class="form-control" type="email" name="email" value="<?php echo $row['email']; ?>">
 
 <!--<select name="institute">
 <?php //foreach($type as $types) { ?>
 
 <option value="<?php echo $types['pick_key']; ?>"><?php echo $types['PickValue']; ?></option>
 <?php //} ?>
 </select>--></td></tr>
 <!--<tr><th>User Active</th>
 <td><input type="text" name="useractive" value="<?php echo  $row['IsUserActive']; ?>"></td></tr>
 <tr><th>LastLogin</th>
 <td><input type="datetime" name="lastlogin" value="<?php echo  $row['LastLoginTime']; ?>"></td></tr>
 <tr><th>Date of Admission</th>
 <td><input type="datetime" name="dateofadmission" value="<?php echo  $row['DateOfAdmission']; ?>"></td></tr>-->
 <tr><th>Photo Upload</th>
 <td><input class="form-control" type="file" name="photoupload" ></td></tr>
 <tr><th>Assign To User Group:</th> 
 <td>
 <select class="form-control"name="role">
 <option value="no">Select</option>
 <?php foreach($role as $roles){ ?>
 <option value="<?php echo $roles['idGroup']; ?>" <?php if($roles['idGroup']==$row['usergroup']){ ?> <?php echo 'selected'; ?>
 <?php } ?>><?php echo $roles['Name']; ?></option>
 <?php } ?>
 </select>
 </td></tr>
 
 <tr><th>Assign To Access Profile:</th> 
 <td>
 <select class="form-control" name="access">
 <option value="no">Select</option>
 <?php foreach($access as $accesss){ ?>
 <option value="<?php echo $accesss['idAccess_Profiles']; ?>" <?php if($accesss['idAccess_Profiles']==$row['access']){ ?> <?php echo 'selected'; ?>
 <?php } ?>><?php echo $accesss['Name']; ?></option>
 <?php } ?>
 </select>
 </td></tr>
 

 <tr>
 <td></td><td style=""><input class="btn btn-success"  type="submit" name="submit"></td>
 </tr>
 </thead></table>
</form>


<?php if(!($row['photo']=="")){ ?>
<img src="<?php echo base_url(); ?>image/userphoto/<?php echo $row['photo']; ?>" style="    width: 10%;
    height: 20%;" />
    <?php } ?></div>