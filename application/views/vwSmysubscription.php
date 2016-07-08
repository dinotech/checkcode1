<?php //echo'<pre>';print_r($edition);print_r($subscribers);print_r($magazine);print_r($userdata);print_r($subscription);echo'<pre>';   
$this->load->view('vwHeader');?>

<div class="heading">
<h3>Manage Subscription</h3>
</div>
<div class="row">
<?php if(isset($error)){?>
<div  class="error">
<p><?php echo $error;?></p>
</div>
<?php }else if(isset($success)){?>
<div  class="error">
<h5><p><?php echo $success;?></p></h5>
</div>
<?php } ?>

<div class="container">


<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist" id="tabs">
    <li role="presentation" class="active"><a href="#renew" aria-controls="renew" role="tab" data-toggle="tab">Renew existing subscription</a></li>
    <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Subscribe to a new magazine</a></li>
</ul>
 <div class="tab-content"> 	
    <div role="tabpanel" class="tab-pane active"  id="renew"  > 
<h3><u>Renew existing subscription</u></h3>
<?php 

if(count($subscription)==0){  echo '<h3 align="center" style="padding:100px"> OOPS!No subscription Till Date </h3>'; } else {?>
<form class="form-horizontal" method="post" id="renew"  action="<?php echo BASE_URL.'mysubscription/renew_suscription'?>">
<div class="form-group">
<label for="inputsubscription" class="col-sm-4 control-label">My Subscriptions</label>
<div class="col-sm-8">
<select class="form-control" name="subscription" id="inputsubscription" onchange="renew_showAmount()" >
<option value="0">select one magazine</option>
<?php   foreach($subscription as $mysubscribers){?>
<option value="<?php echo $mysubscribers['mag_id'] ?>" >
<?php $mag=$this->home_model->get_magbyid($mysubscribers['mag_id']); ?>
<?php echo $mag['name'] ?></option>
<?php }  ?>
</select>

</div>
</div>
<div class="form-group">
<label for="inputsubscription" class="col-sm-4 control-label">For</label>
<div class="col-sm-1">
<input class="form-control" type="number" min="1" id="inputnoofmonth" name="noofmonth"  value="1" onclick="renew_showAmount()" />
</div>
<label class="col-sm-4 control-label" style="text-align: left;">Month(s)</label>
</div>



<div class="col-sm-12"><h2>Payment Method</h2></div>
   <div class="form-group" >
    <label for="inputPaym" class="col-sm-2 control-label">Payment Method</label>
     <div class="col-sm-10">
      <label  class="col-sm-1 control-label">Offline</label>
      <input type="radio" class="col-sm-1" id="renewinputPaym1" name="renewpaym" value="offline" onClick="renewPaym(1)">
       <label class="col-sm-1 control-label">Online</label>
      <input type="radio"  class="col-sm-1" id="renewinputPaym2" checked="checked" name="renewpaym" value="online" onClick="renewPaym(0)">
    </div>
   </div>
   <div id="renewoffline" >
   <div class="form-group" >
      <label for="inputOffline" class="col-sm-2 control-label">Offline</label>
      <div class="col-sm-10">
     <label class="col-sm-1 control-label">Money order</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="MoneyOrder" onClick="renewOffline(1)" >
       
     
      <label class="col-sm-1 control-label">Demand Draft</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="DemandDraft"  onClick="renewOffline(2)" >
      
   
     <label  class="col-sm-1 control-label">Bank Deposite</label>
     <input type="radio" class="col-sm-1" id="inputOffline" name="offline" value="BankDeposite" onClick="renewOffline(3)"></div>
     </div></div>
  
   
    
<div id="renewinputOffline1" >
<label> MONEY ORDER </label>
<div class="form-group" >
<label for="inputBank" class="col-sm-2 control-label">MO Date :</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="modate" id="inputModate" placeholder="Money Date"  >
</div></div>
     
<div class="form-group" >
<label for="inputAmountnew" class="col-sm-2 control-label">Amount:</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="amount1" id="inputAmountnew" placeholder="Amount"  >
</div></div>
     
<div class="form-group" >
<label for="inputSendername" class="col-sm-2 control-label">Sender name:</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="sendername1" id="inputSendername" placeholder="Sender name"  >
</div></div>
 </div>
   
<div id="renewinputOffline2" >
<label>DEMAND DRAFT</label>
<div class="form-group" >
<label for="inputBank" class="col-sm-2 control-label">DD number:</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="ddnum" id="inputDDnumber" placeholder="DD number"  >
</div></div>
     
<div class="form-group" >
<label for="inputAmount" class="col-sm-2 control-label">Amount:</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="amount2" id="inputAmount" placeholder="Amount"  >
</div></div>
     
<div class="form-group" >
<label for="inputSendername" class="col-sm-2 control-label">Sender name:</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="sendername2" id="inputSendername" placeholder="Sender name"  >
</div></div>
</div>
   
<div id="renewinputOffline3" >
<label> Bank deposit:</label>
<div class="form-group" >
<label for="inputBank" class="col-sm-2 control-label">Transaction ID:</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="tensid" id="inputTransactionid" placeholder="Transaction ID"  >
</div></div>
</div>
          
<div  class="form-group" >
<div  align="center" class="col-sm-12" id="submitbtn">
<input type="submit"  class=" btn btn-primary" id="inputSubmit" value="Submit ">     <span> &nbsp; and Renew Subscription</span>
</div></div>
  
</form>
<?php } ?>
</div>

<div role="tabpanel" class="tab-pane " id="new">
<h3><u>Subscribe to a new magazine</u></h3>
<form class="form-horizontal" method="post" id="new"  action="<?php echo BASE_URL.'mysubscription/new_suscription'?>">
<div class="form-group">
<label for="inputnewsubscription" class="col-sm-4 control-label">Magazines</label>
<div class="col-sm-8">
<select class="form-control" name="newsubscription" id="inputnewsubscription" onclick="new_showAmount()"  >
<option value="0">select one magazine</option>
<?php if(count($magazine)>0){

 foreach($magazine as $mymagazine){
	?>
<option value="<?php echo $mymagazine['mag_id'] ; ?>"><?php echo $mymagazine['name'] ; ?></option>
<?php } }  ?>
</select>
</div>
</div>
<div class="form-group">
<label for="inputnewnoofmonth" class="col-sm-4 control-label">For</label>
<div class="col-sm-1">
<input class="form-control" type="number" min="1" id="inputnewnofmonth" name="newnofmonth"  value="1" onclick="new_showAmount()" />
</div>
<label class="col-sm-4 control-label" style="text-align: left;">Month(s)</label>
</div>
<!--<div class="form-group">
<label for="inputnewamount" class="col-sm-4 control-label"> Amount</label>
<div class="col-sm-2">
<input class="form-control" type="text" id="inputnewamount" name="amount"  
value="" disabled="disabled" />
</div>
</div>-->
<div  class="col-sm-12"><h2>Payment Method</h2></div>
   <div class="form-group" >
    <label for="inputPaym" class="col-sm-2 control-label">Payment Method</label>
     <div class="col-sm-10">
      <label  class="col-sm-1 control-label">Offline</label>
      <input type="radio" class="col-sm-1" id="inputPaym1" name="paym" value="offline" onClick="newPaym(1)">
       <label class="col-sm-1 control-label">Online</label>
      <input type="radio"  class="col-sm-1" id="inputPaym2" checked="checked" name="paym" value="online" onClick="newPaym(0)">
    </div>
   </div>
   <div id="newoffline" >
   <div class="form-group" >
      <label for="inputOffline" class="col-sm-2 control-label">Offline</label>
      <div class="col-sm-10">
     <label class="col-sm-1 control-label">Money order</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="MoneyOrder" onClick="newOffline(1)" >
       
     
      <label class="col-sm-1 control-label">Demand Draft</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="DemandDraft"  onClick="newOffline(2)" >
      
   
     <label  class="col-sm-1 control-label">Bank Deposite</label>
     <input type="radio" class="col-sm-1" id="inputOffline" name="offline" value="BankDeposite" onClick="newOffline(3)"></div>
   
   </div></div>
  
   
    
   <div id="newinputOffline1" >
   <label> MONEY ORDER </label>
    <div class="form-group" >
    <label for="inputnewModate" class="col-sm-2 control-label">MO Date :
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control hasDatepicker" name="modate" id="inputnewModate" placeholder="Money Order Date"  >
    </div>
     </div>
     
      <div class="form-group" >
    <label for="inputAmount" class="col-sm-2 control-label">Amount:
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="amount1" id="inputAmount" placeholder="Amount"  >
    </div>
     </div>
     
      <div class="form-group" >
    <label for="inputSendername" class="col-sm-2 control-label">Sender name:</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="sendername1" id="inputSendername" placeholder="Sender name"  >
    </div>
     </div>
     
     </div>
   
     <div id="newinputOffline2" >
   <label>DEMAND DRAFT</label>
    <div class="form-group" >
    <label for="inputBank" class="col-sm-2 control-label">DD number:</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="ddnum" id="inputDDnumber" placeholder="DD number"  >
    </div>
     </div>
     
      <div class="form-group" >
    <label for="inputAmount" class="col-sm-2 control-label">Amount:
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="amount2" id="inputAmount" placeholder="Amount"  >
    </div>
     </div>
     
      <div class="form-group" >
    <label for="inputSendername" class="col-sm-2 control-label">Sender name:</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="sendername2" id="inputSendername" placeholder="Sender name"  >
    </div>
     </div>
     
     </div>
   
<div id="newinputOffline3" >
   <label> Bank deposit:</label>
    <div class="form-group" >
    <label for="inputBank" class="col-sm-2 control-label">Transaction ID:
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="tensid" id="inputTransactionid" placeholder="Transaction ID"  >
    </div>
     </div>
    
     </div>
     
     
     <div  class="form-group" >
     <div  align="center" class="col-sm-12" id="submitbtn">
     <input type="submit"  class=" btn btn-primary" id="inputSubmit" value="Submit ">     </div>
   </div>
  
</form>     
</div>
</div>
</div>
</div>

<?php $this->load->view('vwFooter');?>


<script type="text/javascript">

function renew_showAmount() {
	var xhttp;
    var duration = document.getElementById("inputnoofmonth").value;  
	var str = document.getElementById("inputsubscription").value;  
    if (str == 0) {
     document.getElementById("inputamount").value=0;
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("inputamount").value=xhttp.responseText;
    }
  };
  xhttp.open("GET", "<?php echo BASE_URL ?>getamount?q="+str+"&p="+duration, true);
  xhttp.send();
}

function new_showAmount() {
	var xhttp;
    var duration = document.getElementById("inputnewnofmonth").value;  
	var str = document.getElementById("inputnewsubscription").value;  
    if (str == 0) {
     document.getElementById("inputnewamount").value=0;
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("inputnewamount").value=xhttp.responseText;
    }
  };
  xhttp.open("GET", "<?php echo BASE_URL ?>getamount?q="+str+"&p="+duration, true);
  xhttp.send();
}

</script>