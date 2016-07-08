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
            <h2><small style="color: brown;">Site Information</small></h2>
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
         <th>Site Name</th>
         <th>Address</th>
         <th>City</th>
         <th>State</th>
         <th>Dealer</th>
         <th>Date</th>
         <th>Action</th>
         </tr>
         </tr>
        
         <?php //echo '<pre>';print_r($row);die;
		 foreach($row as $rows){
			 
		
		?>
         <tr>
         <td><?php echo $rows['s_name'];?></td>
         <td><?php echo $rows['s_address'];?></td>
         <td><?php echo $rows['s_city'];?></td>
         <td><?php echo $rows['s_state'];?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php echo $rows['cur_date1'];?></td>
         <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a href="editsite?id=<?php echo $rows['id']; ?>" class="btn btn-success btn-xs">Edit</a>
  <a href="<?php echo base_url(); ?>admin/site/delete_site?id=<?php echo $rows['id']; ?>" class="btn btn-success btn-xs">Delete</a>   
          
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
 <input id="add" type="button" class="btn btn-success" name="add" value="ADD Site" />
 </div>
 </div>
 <div id="adduser" style="display:none">
 
 <div id="userform">
 <h2 id="close" style="float: right;margin-top: -24px;cursor: pointer;">X</h2>
 <form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr><th>Site Name:</th>
 <td><input class="form-control" type="text" name="sname"  /></td></tr>
 
 <tr><th>Address:</th>
 <td>
 <textarea class="form-control" type="textarea" name="address" rows="4" cols="50"></textarea></td></tr>
 
 <tr><th>City:</th>
 <td><input class="form-control" type="text" name="city"  /></td></tr>

 <tr><th>State:</th>
 <td><input class="form-control" type="text" name="state"   /></td></tr>
 <tr><th>Date:</th><td><input type="date" name="cdate" class="form-control"/></td></tr>
 <th>Dealer:</th>
 <td>
 <select class="form-control" name="dname">
 <!--<option value="0">--none--</option>-->
 <?php //echo "<pre>"; print_r($gb);
 foreach($dlr as $dlrs){  ?>
 <option value="<?php echo $dlrs['dealer_id']; ?>" ><?php echo $dlrs['d_name']; ?></option>
 <?php } ?>
 </select>
 
 </td>
 </tr>
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