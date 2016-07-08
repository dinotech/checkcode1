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
$this->load->view('admin/vwHeader',$data); //echo "view page";die;
?>

 <div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Edit Site Information</small></h2>
            </div>
            </div>
 <hr/>
  <div class="table-responsive">
<form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr><th>Site Name:</th>
 <td><input class="form-control" type="text" name="sname"  value="<? echo $row['s_name']; ?>"/>
 </td></tr>
 
 <tr><th>Address:</th>
 <td>
 <textarea class="form-control" type="textarea" name="address"  rows="4" cols="50"><? echo $row['s_address']; ?></textarea></td></tr>
 
 <tr><th>City:</th>
 <td><input class="form-control" type="text" name="city"  value="<? echo $row['s_city']; ?>"/></td></tr>

 <tr><th>State:</th>
 <td><input class="form-control" type="text" name="state"  value="<? echo $row['s_state']; ?>" /></td></tr>
 
 <tr>
 <th>Dealer:</th>
 <td> 
 <select class="form-control" name="dname">
 <?php //echo "<pre>"; print_r($gb);
 foreach($dlr as $dlrs){  ?>
 <option value="<?php echo $dlrs['dealer_id']; ?>" <?php if($dlrs['dealer_id']==$row['d_id']){ ?> <?php echo 'selected'; ?>
 <?php } ?>><?php echo $dlrs['d_name']; ?></option>
 <?php } ?>
 </select>
 
 </td>
 
 </tr>
 <tr><th>Date:</th><td><input type="date" name="cdate" value="<?php echo $row['cur_date1']; ?>"/>
 </thead>
 </table> 
 <input type="submit"  class="btn btn-success" name="submit" value="submit" style="margin-left: 119px;" />
 </form>
 </div>
 <div>
 </div>
 </div>
 

