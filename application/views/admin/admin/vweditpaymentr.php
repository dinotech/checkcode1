<script>
function phonenumber(inputtxt)
{ 
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(inputtxt.match(phoneno))
        {
      return true;
        }
      else
        {
        alert("Not a valid Mobile Number");
		document.getElementById("mob2").value = "";
        return false;
        }
}
function allnumeric(inputtxt)
      {  
      var numbers = /^[0-9]+$/;
      if(inputtxt.match(numbers))
      { 
      return true;
      }
      else
      { 
      alert('Please input numeric characters only');
      document.getElementById("ph2").value = "";
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
$data['id']="pt";
$this->load->view('admin/vwHeader',$data); //echo "view page";die;
?>

 <div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Edit Payment Received Information</small></h2>
            </div>
            </div>
 <hr/>
  <div class="table-responsive">
<form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr><th>Date:</th>
 <td><input class="form-control" type="date" name="cdate"  value="<? echo $row['date']; ?>"  /></td></tr>
 
 <tr><th>Party Name:</th>
 <td><select class="form-control" name="pid">
 <?php //echo "<pre>"; print_r($gb);
 foreach($pty as $dlrs){  ?>
 <option value="<?php echo $dlrs['dealer_id']; ?>" <?php if($dlrs['dealer_id']==$row['party_id']){ ?> <?php echo 'selected'; ?>
 <?php } ?>><?php echo $dlrs['d_name']; ?></option>
 <?php } ?>
 </select>
 <!--<input class="form-control" type="text" name="partyname" value="<? echo $row['d_address']; ?>"/>--></td></tr>
 
 <tr><th>Price:</th>
 <td><input class="form-control" type="number" name="price" value="<? echo $row['price']; ?>" /></td></tr>

 <tr><th>Payment Flow:</th>
 <td><select class="form-control" name="payflow">
 <option value="1">Cash</option>
 <option value="2">Cheque</option>
 </select><!--<input class="form-control" type="text" name="mobile" pattern="[0-9].{1,}" value="<? echo $row['mobile']; ?>" id="mob2"  onchange="phonenumber(document.getElementById('mob2').value);" />--></td></tr>
<!-- <tr><th>Date:</th><td><input type="date" name="cdate" class="form-control" value="<?php echo $row['cur_date']; ?>" />-->
 </thead>
 </table> 
 <input type="submit"  class="btn btn-success" name="submit" value="submit" style="margin-left: 119px;" />
 </form>
 </div>
 <div>
 </div>
 </div>
 

