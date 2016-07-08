<?php  
//echo'<pre>';print_r($data);die;
$this->load->view('admin/my_header.php');?>
<form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>admin/Paymentupload/makepay">
<!--Models-->

<div class="modal fade dds" tabindex="-1" role="dialog" style="top:-0px; left:-100px;">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="row">
<div class="col-sm-10 col-sm-offset-1" style="padding:20px;">
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


<button type="submit" name="submit" class="btn btn-success" value="dd">Upload Payment</button>
</div></div></div></div></div>

<div class="modal fade bd" tabindex="-1" role="dialog" >
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="row">
<div class="col-sm-10 col-sm-offset-1" style="padding:20px;">
<div class="form-group" >
<label for="inputBank" class="col-sm-2 control-label">Date</label>
<div class="col-sm-10">
<input type="date"  class="form-control " name="date" id="datepicker" placeholder="Date"  >
</div>
</div>

<div class="form-group" >
<label for="inputBank" class="col-sm-2 control-label">Amount</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="amount3" id="inputAmount" placeholder="Amount"  >
</div>
</div>

<div class="form-group" >
<label for="inputBank" class="col-sm-2 control-label">Transaction ID:</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="tensid" id="inputTransactionid" placeholder="Transaction ID"  >
</div>
</div>
<button type="submit" name="submit" class="btn btn-success" value="bd">Upload Payment</button>
</div>
</div></div></div></div>

<div class="modal fade mo" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="row">
<div class="col-sm-10 col-sm-offset-1" style="padding:20px;">
<div class="form-group" >
<label for="inputSendername" class="col-sm-2 control-label">Sender name:</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="sendername1"   id="inputSendername" placeholder="Sender name"  >
</div>
</div>


<div class="form-group" >
<label for="inputBank" class="col-sm-2 control-label">Payment Id</label>
<div class="col-sm-10">
<input type="text" class="form-control " name="payid"  placeholder="Payment Id"  >
</div>
</div>

<div class="form-group" >
<label for="inputBank" class="col-sm-2 control-label">Email Id</label>
<div class="col-sm-10">
<input type="email" class="form-control " name="email"  placeholder="Email Id"  >
</div>
</div>



<div class="form-group" >
<label for="inputAmount" class="col-sm-2 control-label">Amount:</label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="amount1"  id="inputAmount" placeholder="Amount"  >
</div>
</div>


<button type="submit" name="submit" class="btn btn-success" value="mo">Upload Payment</button>
</div></div></div></div></div>




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

<h3>Select mode:</h3>

<div class="form-group">
<label for="bankdeposite" class="col-sm-2 control-label">Bank Deposit</label>
<div class="col-sm-1">
<input type="radio" id="BankDeposite"  name="offline" value="BankDeposite" onClick="Offline(1)">
</div>

<label for="bankdeposite" class="col-sm-2 control-label">Money Order</label>
<div class="col-sm-1">
<input type="radio" id="MoneyOrder"  name="offline" value="MoneyOrder" onClick="Offline(2)">
</div>

<label for="bankdeposite" class="col-sm-2 control-label">Demand Draft</label>
<div class="col-sm-1">
<input type="radio" id="DemandDraft"  name="offline" value="DemandDraft" onClick="Offline(3)">
</div>
</div>

<div id="inputOffline1" >
<h3>Bank Deposite</h3>
<table class="table">
<tr>
<th>Date</th>
<th>Amount</th>
<th>Transaction ID</th>
</tr>

<?php 
//print_r($data);
if($data != NULL){
foreach($data as $k){
	if($k['offline']=='BankDeposite')
	{
?>
<tr>
<td ><?php if(isset($k['modate']) && $k['modate'] != NULL){ echo $k['modate'];}else if(isset($k['date']) && $k['date'] != NULL){echo $k['date']; }  ?></td>
<td><?php echo $k['amount'];  ?></td>
<td><?php if(isset($k['tensid']) && $k['tensid'] != NULL){echo $k['tensid'];}else if(isset($k['txid']) && $k['txid'] != NULL){echo $k['txid']; }  ?></td>
</tr>
<?php }}}?>
</table>
<button type="button" class="btn btn-success uploadpay" data-toggle="modal" data-target=".bd">Upload Payment</button>


</div>

<div id="inputOffline3" >
<h3>DEMAND DRAFT</h3>
<table class="table">
<tr>
<th>DD number </th>
<th>Amount</th>
</tr>

<?php
if($data != NULL){
foreach($data as $k){
	if($k['offline']=='DemandDraft')
	{
?>
<tr>
<td><?php echo $k['ddnum'];  ?></td>
<td><?php echo $k['amount'];  ?></td>
</tr>
<?php }}}?>
</table>
<button type="button"  name="submit" class="btn btn-success uploadpay" data-toggle="modal" data-target=".dds">Upload Payment</button>

</div>

<div id="inputOffline2" >
<h3> Money Order</h3>
<table class="table">
<tr>
<th>Sender Name</th>
<th>Email ID</th>
<th>Payment ID</th>
<th>Amount</th>
</tr>
<?php
//echo'<pre>';print_r($data);die;
if($data != NULL){
foreach($data as $k){
	if($k['offline']=='MoneyOrder')
	{
?>
<tr>
<td><?php echo $k['sname'];  ?></td>
<td><?php //echo $k['email_id'];  ?></td>
<td><?php echo $k['payid'];  ?></td>
<td><?php echo $k['amount'];  ?></td>
</tr>
<?php } } }?>
</table>
<button type="button"  name="submit" class="btn btn-success uploadpay" data-toggle="modal" data-target=".mo">Upload Payment</button>



</div>


</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>

</div>



</form>


