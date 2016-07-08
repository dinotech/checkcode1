<style type="text/css">

#adduser2{
	    width: 100%;
    height: 1725px;
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
    margin: 220px 329px 29px 110px;;
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
            <h2><small style="color: brown;">Access Profiles</small></h2>
            </div>
            </div>
            
            
    <div class="table-responsive">
  <form action="" method="post" enctype="multipart/form-data">
      <table class="table table-hover tablesorter">
      <thead>
      <tr><th>Access profiles</th>
     <th>Description</th><th>Action</th>
      </tr>
      
      
       <?php foreach($row as $rows) { ?>
      <tr>
     <td style="color: cornflowerblue;"><?php echo $rows['Name']; ?></td>
     <td><?php echo $rows['Description']; ?></td><td><h5 style="color: darkblue;cursor: pointer;"><a href="editaccess?id=<?php echo $rows['idAccess_Profiles']; ?>">Edit</a></h5></td>
      </tr>
      <?php } ?>
      </thead>
      </table>
      
      <div style="float:right;    margin-right: 127px;">
 <input type="hidden" name="limit" value="<?php echo $limit; ?>" />
 <?php if($limit > 1) { ?>
 <input id="" type="submit" class="btn btn-success"  name="pre" value="Pre"/>
 <?php } ?>
 <input id="" type="submit" class="btn btn-success" name="next" value="Next" />
 </div>
      
      </form>
      
      </div>
      <div>
      <input id="add" class="btn btn-success" type="button" value="Add Access Profile""/>
      </div>
      <div id="adduser2" style="display:none">
 
 <div id="userform2">
 <h2 id="close" style="float: right;margin-top: -24px;cursor: pointer;">X</h2>
  <form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr><th>Name</th>
 <td><input class="form-control" type="text" name="name"><td></tr>
 <tr><th>Description</th>
 <td><input class="form-control" type="text" name="description"></td></tr>
 <tr><td></td><td><input type="submit" class="btn btn-success"  name="submit" value="submit"></td></tr>
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