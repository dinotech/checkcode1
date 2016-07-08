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
<script>
function phonenumber(inputtxt)
{ 
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(inputtxt.value.match(phoneno))
        {
      return true;
        }
      else
        {
        alert("Not a valid Mobile Number");
		document.getElementById("mob").value = "";
        return false;
        }
}
function allnumeric(inputtxt)
      {
      var numbers = /^[0-9]+$/;
      if(inputtxt.value.match(numbers))
      {
      return true;
      }
      else
      {
      alert('Please input numeric characters only');
      document.getElementById("ph").value = "";
      return false;
      }
      }
</script>
<?php
$data['id']="pt";
$this->load->view('admin/vwHeader',$data); //echo "view page";die;
?>

 <div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12">
            <h2><small style="color: brown;">Edit Godown Information</small></h2>
            </div>
            </div>
 <hr/>
  <div class="table-responsive">
<form method="post" enctype="multipart/form-data" action="" name="form1">
 <table>
 <thead>
 <tr><th>Godown Name:</th>
 <td><input class="form-control" type="text"   name="gname"  value="<? echo $row['g_name']; ?>"/></td></tr>
 
 <tr><th>Address:</th>
 <td>
 <textarea class="form-control" type="textarea"  name="address" rows="4" cols="50"><? echo $row['g_address']; ?></textarea></td></tr>
 
 <tr><th>Phone Number:</th>
 <td><input class="form-control" type="text"  name="phone" id="ph"  value="<? echo $row['ph_no']; ?>" onkeyup="allnumeric(document.form1.phone)"/></td></tr>

 <tr><th>Mobile Number:</th>
 <td><input class="form-control" type="text" name="mobile" id="mob" value="<? echo $row['mob']; ?>" onkeyup="allnumeric(document.form1.mobile);" onchange="phonenumber(document.form1.mobile);" /></td></tr>
 
 <tr><th>City:</th>
 <td><input class="form-control" type="text"  name="city" value="<? echo $row['city']; ?>" /></td></tr>
 
 <tr><th>State:</th>
 <td><input class="form-control" type="text"  name="state" value="<? echo $row['state']; ?>" /></td></tr>
 <tr><th>Date:</th><td><input type="date" name="cdate" class="form-control" value="<?php echo $row['cur_date']; ?>"/></td></tr>
 </thead>
 </table> 
 <input type="submit"  class="btn btn-success" name="submit" value="submit" style="margin-left: 119px;" />
 </form>
 </div>
 <div>
 </div>
 </div>
 

