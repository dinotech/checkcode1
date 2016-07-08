<?php $this->load->view('vwHeader'); ?>
<div class="heading">
		<h3>My Payment Details</h3>
</div>

<?php if(isset($success)){ ?>
<br />
<div class="alert alert-success" role="alert" style="text-align:center;"><?php echo $success; ?></div>
<?php }else if(isset($error)){ ?>
        <div class="error">
                <div class="alert alert-danger" role="alert"><?php echo $error; ?>
                </div>
        </div>
<?php } ?>
<div class="container">

                <div  class="col-sm-12"><h2>Payment Method</h2></div>
                <div class="form-group col-sm-12" >
                           <label class="col-sm-3">Payment ID</label>
                            <!-- <div class="col-sm-4"><input type="hidden" id="subid" value="" name="subid">  -->
                          <div class="col-sm-6">
                          		<select id="payid"  name="payid" required  class="form-control" onChange="change(this.id)">
                                <option value="">Select Due Payments</option>
                                <?php 						
                                $var = $this->home_model->get_payment($this->session->userdata['id']);		
								if(sizeof($var)=='0')
								{?>
									<option value="" >No pending payments </option>
								<?php } //echo'<pre>';print_r($var);die;
                                foreach($var as $data)
                                {
                                ?>
                                <option value="<?php echo $data['payment_id']?>" data-id="<?php echo $data['amount']?>" data-sub="<?php echo $data['sub_id']?>"><?php echo $data['payment_id']?></option>
                                <?php
                                }
                                ?>
                          </select>
                          </div>
                </div>                        
        <form class="form-horizontal" method="post" id="update"  action="<?php if($this->session->userdata['role']=='subscriber'){echo BASE_URL.'Updatepay/reupdate_payment_fore';}else{echo BASE_URL.'Updatepay/reupdate_payment_fore1';}?>">                  
                	<div class="col-sm-12">
                    		<label  class="col-sm-3">Payment ID</label>
                            <div  class="col-sm-6">
                            		<input type="text" class="form-control" readonly="readonly" name="payid1" id="payid1" value="" />
                            </div>   
                     </div>                       
              		

<div  class="col-sm-12" style="padding-bottom:3%;">
<?php if($this->session->userdata['role']=='subscriber'){?>
                    		<label  class="col-sm-3">Selected Method of Payments</label>
                            <div  class="col-sm-6">
                            		<input type="text" class="form-control" readonly="readonly"  id="wassel" name="wassel" value="" />
                            </div>
<?php } ?>
                            <div class="col-sm-3">
                                <button type="button" id="upd" class="btn btn-primary" style="display:none">Update </button>                  
                            </div>
                    </div>                   
                    <div id="updating" class="col-sm-10" style=" margin-top:30px; display:none; padding-bottom:3%">                        
                    		<div class="col-sm-12">
                                        <label class="col-sm-2 control-label">Money order</label>
                                        <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="MoneyOrder" onClick="Offline(1)" >
                                        <label class="col-sm-2 control-label">Demand Draft</label>
                                        <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="DemandDraft"  onClick="Offline(2)" >
                                        <label  class="col-sm-2 control-label">Bank Deposite</label>
                                        <input type="radio" class="col-sm-1" id="inputOffline" name="offline" value="BankDeposite" onClick="Offline(3)">
                            </div>                                                                                          
                            <div class="inputOffline1" style=" margin-top:10%;">                                
                                    <div class="form-group" style="min-height: 30px;">
                                            <label for="inputBank" class="col-sm-3 control-label">MO Date :</label>
                                            <div class="col-sm-8">
                                                    <input type="text"  class="form-control" name="date" id="inputModate1" onchange="cdate(this.value)" placeholder="Money Date"  >
                                            </div>
                                    </div>                                
                                    <div class="form-group" style="min-height: 30px;">
                                            <label for="inputAmount" class="col-sm-3 control-label">Amount:</label>
                                            <div class="col-sm-8">
                                                    <input type="text"  class="form-control " name="amount" readonly="readonly" id="inputAmount1" placeholder="Amount"  >
                                            </div>
                                    </div>                                
                                    <div class="form-group" style="min-height: 30px;">
                                            <label for="inputSendername" class="col-sm-3 control-label">Sender name:</label>
                                            <div class="col-sm-8">
                                                    <input type="text"  class="form-control" name="sendername1" id="inputSendername" placeholder="Sender name"  >
                                            </div>
                                            <div class="col-md-12"  style="text-align:center; margin-top:5%;">
                                                    <button type="button" id="savenew" onclick="submitform11()" class="btn btn-success"> Update Payment </button>
                                            </div>
                                    </div>                        
                            </div>
                            <div class="inputOffline2"  style=" margin-top:10%;">                                            
                                            <div class="form-group" style="min-height: 30px;" >
                                                    <label for="inputBank" class="col-sm-3 control-label">DD number:</label>
                                                    <div class="col-sm-8">
                                                            <input type="text"  class="form-control" name="ddnum" id="inputDDnumber" placeholder="DD number"  >
                                                    </div>
                                            </div>                        
                                            <div class="form-group"  style="min-height: 30px;">
                                                    <label for="inputAmount" class="col-sm-3 control-label">Amount:</label>
                                                    <div class="col-sm-8">
                                                            <input type="text"  class="form-control " name="amount" readonly="readonly" id="inputAmount2" placeholder="Amount"  >
                                                    </div>
                                            </div>                        
                                            <div class="form-group"  style="min-height: 30px;">
                                    <label for="inputSendername" class="col-sm-3 control-label">Sender name:</label>
                                    <div class="col-sm-8">
                                            <input type="text"  class="form-control" name="sendername2" id="inputSendername" placeholder="Sender nameq"  >
                                    </div>
                                    <div class="col-md-12"  style="text-align:center; margin-top:5%;">
                                        <button type="button" id="savenew" onclick="submitform11()" class="btn btn-success"> Update Payment </button>
                                	</div>
                            </div>                        
                            </div>
                        <div class="inputOffline3"  style=" margin-top:10%;">                           
                                <div class="form-group"  style="min-height: 30px;">
                                        <label for="inputAmount" class="col-sm-3 control-label">Date:</label>
                                        <div class="col-sm-8">
                                                <input type="text"  class="form-control " name="date2"  id="inputModate2" onchange="cdate(this.value)" placeholder="Date"  >
                                        </div>                                        
                                </div> 
                                <div class="form-group" style="min-height: 30px;" >
                                        <label for="inputBank" class="col-sm-3 control-label">Transaction ID:</label>
                                        <div class="col-sm-8">
                                                <input type="text"  class="form-control" name="tensid" id="inputTransactionid" placeholder="Transaction ID"  >
                                        </div>                                       
                        		</div>
                                <div class="form-group"  style="min-height: 30px;">
                                                <label for="inputAmount" class="col-sm-3 control-label">Amount:</label>
                                                <div class="col-sm-8">
                                                <input type="hidden" id="login" value="<?php echo $this->session->userdata['role'];?>" >
                                                        <input type="text"  class="form-control " name="amount" readonly="readonly" id="inputAmount3" placeholder="Amount"  >
                                                </div>
                                </div> 
                                <div class="col-md-12"  style="position:relative; border:solid 0px #000000; text-align:center">
                                        <button type="button" id="savenew" onclick="submitform11()" class="btn btn-success"> Update Payment </button>
                                </div>
                        </div>
                        
                </div>
        </form>
        
</div>
<?php $this->load->view('vwFooter');?>
  <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
  <script src="<?php echo HTTP_JS_PATH; ?>jquery-ui.js"></script>
<script>
$(document).ready(function(e) {
	$('#upd').click(function(e) {
        	$('#updating').show()	
    });
	
	$('#inputModate1').datepicker({dateFormat: 'dd-mm-yy'});$('#inputModate2').datepicker({dateFormat: 'dd-mm-yy'});
});
		function cdate(data){
			//alert(data);
			$('#inputModate1').val(data);
			$('#inputModate2').val(data);
		}

		function submitform11(){
				$('#update').submit();
		}
		function change(data){
//			alert($('#'+data).find(':selected').val());
			$('#payid1').val($('#'+data).find(':selected').val());
			$('#wassel').val('');
			var payid = $('#'+data).find(':selected').val();
			$('#upd').show();
			if($('#login').val()=='subscriber')
					{	
							$.ajax({
								url:'<?php echo base_url()?>Updatepay/updatepayments',
								type:'post',
								data:'payid='+payid,
								success:function(data)
								{
									var q = $.parseJSON(data);													
											$('#wassel').val(q.offline);
											$('#inputAmount1').val(q.amount);
											$('#inputAmount2').val(q.amount);
											$('#inputAmount3').val(q.amount);					
								}
							});
					}
					else
					{
							$.ajax({
								url:'<?php echo base_url()?>Updatepay/updatepaymentsfore',
								type:'post',
								data:'payid='+payid,
								success:function(data)
								{
                                                                    var q = $.parseJSON(data);
								    $('#inputAmount1').val(q.amount);
											$('#inputAmount2').val(q.amount);
											$('#inputAmount3').val(q.amount);	
								}
							});
					}
		}
</script>

</body>
</html>