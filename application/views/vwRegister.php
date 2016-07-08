<?php $this->load->view('vwHeader');?>

<div class="heading">
<h3>Register</h3>
</div>

<div class="container register">
 <div class="error">
  <?php  echo validation_errors();
  if(isset($error)){ 
  echo $error;
  }
   ?>
</div>
 <form class="form-horizontal" method="post" id="register"  action="<?php echo BASE_URL.'register/do_register'?>">
    <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Email<span>*</span></label>
    <div class="col-sm-10">
      <input type="email" class="form-control" required="required" name="emailid" id="inputEmail" placeholder="Email">
    </div>
   </div>
   <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Password<span>*</span></label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
    </div>
   </div>
   <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Password Confirmation<span>*</span></label>
    <div class="col-sm-10">
      <input type="password" class="form-control" required="required" name="passwordc" id="inputPassword" placeholder="Password">
    </div>
   </div>
   <div class="form-group">
    <label for="inputSubscription" class="col-sm-2 control-label">Subscription<span>*</span></label>
    <div class="col-sm-10">
    <select class="form-control" required="required" name="product" id="inputSubscription">
    <option value="">Select Magzine</option>
    <?php  foreach ($magzines as $k=>$v){//echo "<pre>"; print_r($v); ?>
    <option value="<?php echo $v['mag_id'] ?>" data-amount=<?php echo $v['price']; ?> ><?php echo $v['name']; ?></option>
	<?php } ?>
    </select>
    </div>
  </div>
    <div class="form-group">
    <label for="inputDuration" class="col-sm-2 control-label">Duration<span>*</span></label>
    <div class="col-sm-2">
    <input type="number" required="required" min="1" max="12" value="1" class="form-control" name="subscription" id="inputDuration" />
    </div>
     <div class="col-sm-2">
     <h5>Months</h5>
     </div>
  </div>
   <div class="form-group">
    <label for="inputDuration" class="col-sm-2 control-label">Amount</label>
    <div class="col-sm-4">
    <input type="text" readonly="readonly" class="form-control" name="amount" value="0" id="inputAmount" />
    </div>
    </div>
  <div align="center" class="col-sm-12"><h2>Profile</h2></div>
  <div class="form-group">
    <label for="inputName" class="col-sm-2 control-label">Your Name<span>*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" required="required" id="inputName" placeholder="Name">
    </div>
   </div>
   <div class="form-group">
    <label for="inputGender" class="col-sm-2 control-label">Your Gender<span>*</span></label>
    <div class="col-sm-10">
      <label  class="col-sm-1 control-label">Male</label>
      <input type="radio" required="required" checked="checked" class="col-sm-1" id="inputGender" name="gender" placeholder="Gender" value="Male">
      <label class="col-sm-1 control-label">Female</label>
      <input type="radio" required="required"  class="col-sm-1" id="inputGender" name="gender" placeholder="Gender" value="Female">
       <label class="col-sm-1 control-label">Other</label>
      <input type="radio" required="required"  class="col-sm-1" id="inputGender" name="gender" placeholder="Gender" value="other">
    </
    </div>
   </div>
    <div class="form-group" >
    <label for="inputdob" class="col-sm-2 control-label">DOB<span>*</span></label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" required="required" name="dob" id="inputdob" placeholder="Your dob">
    </div>
   </div>
    <div class="form-group" >
    <label for="inputMobile" class="col-sm-2 control-label">Mobile<span>*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" required="required" name="mobile" id="inputMobile" placeholder="Your Mobile Number(Must be 10 digits)" onchange="checkingmobile()">
    </div>
   </div>
    <div class="form-group" >
    <label for="inputcMail" class="col-sm-2 control-label">Contact Mail<span>*</span></label>
    <div class="col-sm-10">
      <input type="email"  class="form-control" required="required" name="cmail" id="inputMail" placeholder="Your Contact Mail">
    </div>
   </div>
   <div class="form-group" >
    <label for="inputAddress" class="col-sm-2 control-label">Address<span>*</span></label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" required="required" name="address" id="inputAddress" placeholder="Your Address">
    </div>
   </div>
 
   <div class="form-group" >
    <label for="inputCountry" class="col-sm-2 control-label">Country<span>*</span></label>
    <div class="col-sm-10">
     <select name="country" class="countries form-control " id="countryId" required="required">
<option value="">Select Country</option>
</select>
     </div>
   </div>
    <div class="form-group" >
    <label for="inputState" class="col-sm-2 control-label">State<span>*</span></label>
    <div class="col-sm-10">
    <select name="state" class="states form-control " id="stateId"  required="required">
<option value="">Select State</option>
</select>
    </div>
   </div>
   <div class="form-group" >
    <label for="inputCity" class="col-sm-2 control-label">City</label>
    <div class="col-sm-10">
    <select name="city" class="cities form-control" id="cityId">
<option value="">Select City</option>
</select>

    </div>
   </div>
   
     
   <div class="form-group" >
    <label for="inputDistrict" class="col-sm-2 control-label">District</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" name="district" id="inputDistrict" placeholder="Your District">
    </div>
   </div>
  
   <div class="form-group" >
    <label for="inputPincode" class="col-sm-2 control-label">Pincode</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" required="required" name="pincode" id="inputPincode" placeholder=" Pincode">
    </div>
   </div>
   
   <div align="center" class="col-sm-12"><h2>Payment Method</h2></div>
   <div class="form-group" >
    <label for="inputPaym" class="col-sm-2 control-label">Payment Method<span>*</span></label>
     <div class="col-sm-10">
      <label  class="col-sm-1 control-label">Offline</label>
      <input type="radio" class="col-sm-1" id="inputPaym1" name="paym" value="offline" onClick="Paym(1)"  required="required">
       <label class="col-sm-1 control-label">Online</label>
      <input type="radio"  class="col-sm-1" id="inputPaym2" checked="checked" name="paym" value="online" onClick="Paym(0)"  required="required">
    </div>
   </div>
   <div id="offline" >
   <div class="form-group" >
      <label for="inputOffline" class="col-sm-2 control-label">Offline</label>
      <div class="col-sm-10">
     <label  class="col-sm-1 control-label">Bank Deposite</label>
     <input type="radio" class="col-sm-1" id="inputOffline" name="offline" value="BankDeposite" onClick="Offline(1)">
      <label class="col-sm-1 control-label">Demand Draft</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="DemandDraft"  onClick="Offline(2)" >
      <label class="col-sm-1 control-label">Money order</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="MoneyOrder" onClick="Offline(3)" >
   </div>
   </div>
   </div>
   
   
     <div id="inputOffline1" >
    <div class="form-group" >
    <label for="inputBank" class="col-sm-2 control-label">Bank</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="bank" id="inputBank" placeholder="Your Bank" disabled="disabled" value="ICICI">
    </div>
   </div>
   <div class="form-group" >
    <label for="inputAName" class="col-sm-2 control-label">Account Name</label>
    <div class="col-sm-10">
     <input type="text"   class="form-control" name="acc_name" id="inputAName" placeholder="Your Bank Account Name" disabled="disabled" value="JOHN">
    </div>
   </div>
   <div class="form-group" >
    <label for="inputANumber" class="col-sm-2 control-label">Account Number</label>
    <div class="col-sm-10">
     <input type="text"   class="form-control" name="acc_number" id="inputANumber" placeholder="Your Bank Account Number" disabled="disabled" value="389874563214556">
    </div>
   </div>
   <div class="form-group" >
    <label for="inputBranch" class="col-sm-2 control-label">Branch</label>
    <div class="col-sm-10">
     <input type="text"   class="form-control" name="branch" id="inputBranch" placeholder="Your Bank Branch" disabled="disabled" value="Chennai Cenotaph Road">
    </div>
   </div>
   <div class="form-group" >
    <label for="inputIFSC" class="col-sm-2 control-label">IFSC</label>
    <div class="col-sm-10">
     <input type="text"   class="form-control" name="ifsc" id="inputIFSC" placeholder="Your Bank IFSC" disabled="disabled" value="ICIC0000001">
    </div>
   </div>
     
     </div>
   
   <div id="inputOffline2" >
      <div class="form-group" >
    <label for="inputDDname" class="col-sm-2 control-label">DD Drawn in the name of:
</label>
    <div class="col-sm-10">
     <input type="text"   class="form-control" id="inputDDname" placeholder="DD Drawn in the name" disabled="disabled" value="JOHN">
    </div>
   </div>
  <p>Please write down the payment ID behind DD and send it to the below address:
   <br>Kindly note down your DD number to update in website.</p>
   </div>
   
   <div id="inputOffline3" >
   <p>You can send money order to the below address. <br> <br>


   <br>Please mention your payment ID in your MO.
   <br>Update the MO date and amount in website for faster processing.</p>
    </div>
   

   
   
   <div  class="form-group" >
    <div  align="center" class="col-sm-12" id="submitbtn">
     <input type="submit"  class=" btn btn-primary" id="inputSubmit" value="Submit and generate payment ID">
    </div>
   </div>
   
</form>
</div></div>
<?php $this->load->view('vwFooter');?>
<script>
$('#inputSubscription').change(function(e) {
   var selected = $(this).find('option:selected');
  var extra = selected.data('amount');
    var dueration = $('#inputDuration').val();
 var amount=parseFloat(extra)*parseFloat(dueration); 
 if(amount>0 || amount==null ){$('#inputAmount').val(amount);}
else {
	alert("Please select a manazine");
	$('#inputAmount').val('0');
	}
});

$('#inputDuration').change(function(e) {
   var selected = $('#inputSubscription').find('option:selected');
  var extra = selected.data('amount');
    var dueration = $(this).val();
 var amount=parseFloat(extra)*parseFloat(dueration); 
  if(amount>0 || amount==null ){$('#inputAmount').val(amount);}
  else {
	alert("Please select a manazine");
	$('#inputAmount').val('0');
	}
});
function checkingmobile()
 {
	 //alert($('#inputMobile').val().length);
	var mob = $('#inputMobile').val() 
	if(mob.length < 10)
	{
		alert('You are requested to enter the Mobile number Correctly');
			$('#inputMobile').val(''); 
	}
 }
</script>