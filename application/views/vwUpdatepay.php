<?php
 $this->load->view('vwHeader');?>

<div class="heading">
<h3>My Payment Details</h3>
</div>

<div class="error">
<?php echo validation_errors(); ?>
</div>

<?php if(isset($success)){ ?>
<br />
<div class="alert alert-success" role="alert"><?php echo $success; ?></div>
<?php }else if(isset($error)){ ?>
<div class="error">
<div class="alert alert-danger" role="alert"><?php echo $error; ?>
</div>
</div>
<?php }?>
<div class="container">
<form class="form-horizontal" method="post" id="update"  action="<?php echo BASE_URL.'Updatepay/update_payment_details'?>">
<div  class="col-sm-12"><h2>Payment Method</h2></div>
   <div class="form-group" >
   <label class="col-sm-2 control-label">Payment ID</label>
    <div class="col-sm-4">
  
   <input type="text" class="form-control" name="payid"  readonly="readonly" value="<?php if(isset($payid)){ echo $payid; }
   else if($this->session->userdata('pay_id')){
	    echo $this->session->userdata('pay_id'); }?> "/>
   </div></div>

     <div class="form-group" >
     <label for="inputPaym" class="col-sm-2 control-label">Payment Method</label>
     <div class="col-sm-10">
      <label  class="col-sm-1 control-label">Offline</label>
      <input type="radio" class="col-sm-1"  id="inputPaym1" name="paym" value="offline"  onclick="Paym(1)" onselect="Paym(1)">
       <label class="col-sm-1 control-label">Online</label>
      <input type="radio"  class="col-sm-1" checked="checked" id="inputPaym2"  name="paym" value="online" onClick="Paym(0)">
    </div>
   </div>
   <div id="offline" >
   <div class="form-group" >
      <label for="inputOffline" class="col-sm-2 control-label">Offline</label>
      <div class="col-sm-10">
     <label class="col-sm-1 control-label">Money order</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="MoneyOrder" onClick="Offline(1)" >
       
     
      <label class="col-sm-1 control-label">Demand Draft</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="DemandDraft"  onClick="Offline(2)" >
      
   
     <label  class="col-sm-1 control-label">Bank Deposite</label>
     <input type="radio" class="col-sm-1" id="inputOffline" name="offline" value="BankDeposite" onClick="Offline(3)"></div>
   
   </div></div>
  
   
    
   <div id="inputOffline1" >
   <label> MONEY ORDER </label>
    <div class="form-group" >
    <label for="inputBank" class="col-sm-2 control-label">MO Date :
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="modate" id="inputModate" placeholder="Money Date"  >
    </div>
     </div>
     
      <div class="form-group" >
    <label for="inputAmount" class="col-sm-2 control-label">Amount:
</label>

    <div class="col-sm-10">
     <input type="text"  class="form-control" name="amount1" id="inputAmount" placeholder="Amount" value="<?php echo $amt['amount']?>" >
    </div>
     </div>
     
      <div class="form-group" >
    <label for="inputSendername" class="col-sm-2 control-label">Sender name:</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="sendername1" id="inputSendername" placeholder="Sender name"  >
    </div>
     </div>
     
     </div>
   
     <div id="inputOffline2" >
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
     <input type="text"  class="form-control" name="amount2" id="inputAmount" placeholder="Amount" value="<?php echo $amt['amount']?>" >
    </div>
     </div>
     
      <div class="form-group" >
    <label for="inputSendername" class="col-sm-2 control-label">Sender name:</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="sendername2" id="inputSendername" placeholder="Sender name"  >
    </div>
     </div>
     
     </div>
   
<div id="inputOffline3" >
   <label> Bank deposit:</label>
    <div class="form-group" >
    <label for="inputBank" class="col-sm-2 control-label">Transaction ID:
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="tensid" id="inputTransactionid" placeholder="Transaction ID"  >
    </div>
    <label for="inputBank" class="col-sm-2 control-label">Amount:
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="amount3" id="inputAmount" placeholder="Amount" value="<?php echo $amt['amount']?>"  >
    </div>
     </div>
    
     </div>
     
     
     <div  class="form-group" >
     <div  align="center" class="col-sm-12" id="submitbtn">
     <input type="submit"  class=" btn btn-primary" id="inputSubmit" value="Submit ">     <span> &nbsp; and Update payment Information</span>
    </div>
   </div>
 
</form>
</div>


<?php $this->load->view('vwFooter');?>