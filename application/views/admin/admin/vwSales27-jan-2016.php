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
            <h2><small style="color: brown;">Sales Information</small></h2>
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
         <th>Dealer Name</th>
         <th>Price</th>
         <th>No. Of Bags</th>
         <th>OPC/PPC</th>
         <th>T/NT</th>
         <th>Date & Time</th>
         <th>Godown</th>
         <th>Action</th>
         </tr>
         </tr>
        
         <?php foreach($row as $rows){?>
         <tr>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php echo $rows['prices'];?></td>
         <td><?php echo $rows['no_of_bags'];?></td>
         <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
         <td><?php if($rows['t_nt']==1){ echo "Trading";} if($rows['t_nt']==2) { echo "non trading"; }?></td>
         <td><?php echo $rows['date'];?></td>
         <td><?php echo $rows['g_name'];?></td>
         <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a href="editsales?id=<?php echo $rows['sales_id']; ?>" class="btn btn-success btn-xs">Edit</a>
  <a href="<?php echo base_url(); ?>admin/sales/delete_sales?id=<?php echo $rows['sales_id']; ?>" class="btn btn-success btn-xs">Delete</a>   
    
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
 <input id="add" type="button" class="btn btn-success" name="add" value="ADD Sales" />
 </div>
 </div>
 <div id="adduser" style="display:none">
 
 <div id="userform">
 <h2 id="close" style="float: right;margin-top: -24px;cursor: pointer;">X</h2>
 <form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr>
 <th>Dealer Name:</th>
 <td>
 <select class="form-control" name="dname" required>
 <!--<option value="0">--none--</option>-->
 <?php die; //echo "<pre>"; print_r($gb);
 foreach($dlr as $dlrs){  ?>
 <option value="<?php echo $dlrs['dealer_id']; ?>" ><?php echo $dlrs['d_name']; ?></option>
 <?php } ?>
 </select>
 
 </td>
 
 </tr>
  <tr><th>Price:</th>
 <td>
 <input class="form-control" type="number" name="price" required="required" pattern="[0-9].{1,}"/></td></tr>
 
 <tr><th>No. Of Bags:</th>
 <td><input class="form-control" type="number" name="bags" required="required"  /></td></tr>

 <tr><th>OPC/PPC:</th>
 <td><p>
    <input type="radio" name="opc_ppc" value="0" checked="checked" />
     OPC 
    <input type="radio" name="opc_ppc" value="1"/>
     PPC 
   <br />
 </p>  </td></tr>
 
 <tr><th>T/NT:</th>
 <td><select class="form-control" name="t_nt">
 <!--<option value="0">--none--</option>-->
 <option value="1">Trading</option>
 <option value="2">Non Trading</option>
 
 </select></td></tr>
 <tr><th>Godown:</th>
 <td>
<select class="form-control" name="gd">
 <!--<option value="0">--none--</option>-->
<?php //echo "<pre>"; print_r($gb);
foreach($gb as $gbs){  ?>
 <option value="<?php echo $gbs['g_id']; ?>" ><?php echo $gbs['g_name']; ?></option>
 <?php } ?>
 </select>
 </td></tr>
 
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