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
            <h2><small style="color: brown;">Edit University/Institute</small></h2>
            </div>
            </div>
            
             <div class="table-responsive">
  <form action="" method="post" enctype="multipart/form-data">
      <table style=" width: 64%;">
      <thead>
      <tr><th>Name Of Institute</th>
 <td><input type="text" class="form-control" name="name" value="<?php echo $row['instituteName']; ?>"><td></tr>
 <tr><th>Type Of Institute</th> 
 <td><select class="form-control" name="institute">
 <?php foreach($type as $types) { ?>
 
 <option value="<?php echo $types['pick_key']; ?>"><?php echo $types['PickValue']; ?></option>
 <?php } ?>
 </select></td></tr>
 <tr><th>Contact Person First Name</th>
 <td><input type="text" class="form-control" name="first" value="<?php echo  $row['first']; ?>"></td></tr>
 <tr><th>Contact Person Last Name</th>
 <td><input type="text" class="form-control" name="last" value="<?php echo  $row['last']; ?>"></td></tr>
 <tr><th>Mobile</th>
 <td><input type="text" class="form-control" name="mobile" value="<?php echo  $row['mobile']; ?>"></td></tr>

 <tr>
 <td></td><td><input type="submit" class="btn btn-success" name="submit"></td>
 </tr>
 </thead></table>
</form></div>