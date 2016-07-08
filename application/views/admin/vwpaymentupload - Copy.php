<?php  $this->load->view('admin/my_header.php');?>
<div class="content-section mail_sec">
    <div class="container-liquid">
    <div class="row">
    <div class="col-xs-12">
    <div class="sec-box">                   
    <header>
    <h1 class="heading">Payment upload</h1>
    </header>
    <div class="contents"> 
    <div class="error">
    <?php echo validation_errors(); 
	if(isset($error)){
	echo "<p>".$error."</p>";
	}
	?>
    </div>

    <form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>admin/paymentupload/makepay">
    
    <h3>Select mode:</h3>
    
     <div class="form-group">
     <label for="bankdeposite" class="col-sm-2 control-label">Bank Deposit</label>
     <div class="col-sm-1">
     <input type="radio" id="inputOffline" name="offline" value="BankDeposite" onClick="Offline(1)">
     </div>
     
     <label for="bankdeposite" class="col-sm-2 control-label">Money Order</label>
     <div class="col-sm-1">
     <input type="radio" id="inputOffline" name="offline" value="MoneyOrder" onClick="Offline(2)">
     </div>
     
     <label for="bankdeposite" class="col-sm-2 control-label">Demand Draft</label>
     <div class="col-sm-1">
     <input type="radio" id="inputOffline" name="offline" value="DemandDraft" onClick="Offline(3)">
     </div>
     </div>
     
    <div class="form-group" >
    <label for="payid" class="col-sm-2 control-label">Payment Id</label>
    <div class="col-sm-10">
    <input type="text"  class="form-control" name="payid" id="payid" placeholder="Payment Id"  >
    </div>
    </div>
    
    <div class="form-group" >
    <label for="payid" class="col-sm-2 control-label">user Id</label>
    <div class="col-sm-10">
   <select name="user_id" id="user_id" class="form-control">
   <?php foreach($user as $k=>$v){ ?>
   <option value="<?php echo $v['user_id']; ?>"><?php echo $v['name']; ?></option>
   <?php } ?>
   </select>
    </div>
    </div>
    
    <div class="form-group" >
    <label for="payid" class="col-sm-2 control-label">Magazine</label>
    <div class="col-sm-10">
    <select name="product" id="product" class="form-control">
    <?php foreach($mag as $k=>$v){ ?>
    <option value="<?php echo $v['mag_id']; ?>"><?php echo $v['name']; ?></option>
    <?php } ?>
    </select>
   </div>
    </div>
     
     
    <div id="inputOffline2" >
    <label>MONEY ORDER</label>
    <div class="form-group" >
    <label for="inputBank" class="col-sm-2 control-label">MO Date :
    </label>
    <div class="col-sm-10">
    <input type="text"  class="form-control" name="modate" id="inputModate" placeholder="Money Date"  >
    </div>
    </div>
     
     <div class="form-group" >
     <label for="inputAmount" class="col-sm-2 control-label">Amount:</label>
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
    
   <div id="inputOffline3" >
   <label>DEMAND DRAFT</label>
   <div class="form-group" >
   <label for="inputBank" class="col-sm-2 control-label">DD number:</label>
   <div class="col-sm-10">
   <input type="text"  class="form-control" name="ddnum" id="inputDDnumber" placeholder="DD number"  >
   </div>
   </div>
     
   <div class="form-group" >
   <label for="inputAmount" class="col-sm-2 control-label">Amount:</label>
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
     
   <div id="inputOffline1" >
   <label> Bank deposit:</label>
   <div class="form-group" >
   <label for="inputBank" class="col-sm-2 control-label">Transaction ID:</label>
   <div class="col-sm-10">
   <input type="text"  class="form-control" name="tensid" id="inputTransactionid" placeholder="Transaction ID"  >
   </div>
   </div>
   </div>
   
   <button type="submit" name="submit" class="btn btn-success">SUBMIT</button>
     
   </form>
   </div>
   
    <div class="contents "> 
    
 <div class="inputOffline2">
    <table class="table">
    <tr><td><h3>Payment Detils</h3></td></tr>
    <tr>
    <th>Payment ID</th>
    <th>Payment Method</th>
    <th>DD number:</th>
    <th>Payment Amount</th>
    <th>Sender Name</th>
    </tr>
<?php foreach($payment as $kp=>$vp) {
$pay_detail = unserialize($vp['payment_details']); 
//print_r($pay_detail);
if($pay_detail['offline']=='MoneyOrder'){
?><tr>
<td><?php echo  $vp['pay_id'] ;?></td>
<td><?php echo $pay_detail['offline']; ?></td>
<td><?php echo $pay_detail['modate']; ?></td>
<td><?php echo $pay_detail['amount']; ?></td>
<td><?php echo $pay_detail['sendername']; ?></td>
</tr>
<?php } ?><?php } ?>
    </table>
    </div>
    
    <div class="inputOffline3">
    <table class="table">
    <tr><td><h3>Payment Details</h3></td></tr>
    <tr>
    <th>Payment ID</th>
    <th>Payment Method</th>
    <th>Payment Date</th>
    <th>Payment Amount</th>
    <th>Sender Name</th>


    </tr>
<?php foreach($payment as $kp=>$vp) {
$pay_detail = unserialize($vp['payment_details']); 
if($pay_detail['offline']=='DemandDraft'){
?><tr>
<td><?php echo  $vp['pay_id'] ;?></td>
<td><?php echo $pay_detail['offline']; ?></td>
<td><?php echo $pay_detail['modate']; ?></td>
<td><?php echo $pay_detail['amount']; ?></td>
<td><?php echo $pay_detail['sendername']; ?></td>
</tr>

</tr>
<?php }?>

<?php } ?>
    </table>
    </div>
    <div class="inputOffline1">
    <table class="table">
    <tr><td><h3>Payment Detils</h3></td></tr>
    <tr>
    <th>Payment ID</th>
    <th>Payment Method</th>
    <th>Date</th>
    <th>Transcation ID</th>
     <th>Amount</th>
  </tr>
<?php foreach($payment as $kp=>$vp) {
$pay_detail = unserialize($vp['payment_details']); 

if($pay_detail['offline']=='BankDeposite'){
?><tr>
<?php foreach($pay_detail as $k=>$p ){
	echo "<td>".$p."</td>";
	 }?>
</tr>
<?php }?>

<?php } ?>
    </table>
    </div>
    
    </div>
   </div>
   </div>
   </div>
   </div>
   
   </div>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
