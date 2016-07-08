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
            <h2><small style="color: brown;">Edit Party Information</small></h2>
            </div>
            </div>
 <hr/>
  <div class="table-responsive">
<form method="post" enctype="multipart/form-data" action="">
 <table>
 <thead>
 <tr><th>Dealer Name:</th>
 <td><input class="form-control" type="text" name="dname"  value="<? echo $row['d_name']; ?>"  /></td></tr>
 
 <tr><th>Address:</th>
 <td>
 <textarea class="form-control" type="textarea" name="address" rows="4"  cols="50"><? echo $row['d_address']; ?></textarea></td></tr>
 
 <tr><th>Phone Number:</th>
 <td><input class="form-control" type="text" id="ph2" pattern="[0-9].{1,}" name="phone" value="<? echo $row['phone']; ?>" onkeyup="allnumeric(document.getElementById('ph2').value);"/></td></tr>

 <tr><th>Mobile Number:</th>
 <td><input class="form-control" type="text" name="mobile" pattern="[0-9].{1,}" value="<? echo $row['mobile']; ?>" id="mob2"  onchange="phonenumber(document.getElementById('mob2').value);" /></td></tr>
 <tr><th>Date:</th><td><input type="date" name="cdate" class="form-control" value="<?php echo $row['cur_date']; ?>" />
 </thead>
 </table> 
 <input type="submit"  class="btn btn-success" name="submit" value="submit" style="margin-left: 119px;" />
 </form>
 </div>
 <div>
 </div>
 </div>
 

