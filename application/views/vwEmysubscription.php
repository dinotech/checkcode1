<?php 
$this->load->view('vwHeader');?>
<div class="heading">
		<h3>Magazine Renewal</h3>
</div>
<div class="container">
<div class="row">
<?php if(isset($error))
{
?>
<div  class="error">
		<p><?php echo $error;?></p>
</div>
<?php }else if(isset($success)){?>
<div  class="error">
		<h5><p><?php echo $success;?></p></h5>
</div>
<?php 
} 
?>                
<div class="contents">                                      
<div class="table-box">
<?php if(!isset($subscriber)){  ?>
<form action="<?php echo base_url()?>mysubscription/mailid" method="post">
<table class="table">
<tbody>
<tr>
<td><label  class="form_control">E-mail id  </td>
<td><input type="email" name="emailid" id="emailid" class="form-control"  required="required" /></td>                              </tr>
<tr>
<td colspan="5">
<input type="submit" value="serch" class=" btn btn-primary"  />
</td>
</tr>
</tbody>
</table>
</form>
<?php } ?>
<table class="table" >
<tbody>

<?php
if(isset($subscriber) && (count($subscriber)>0)){
$length = count($subscriber);							
for($i=0; $i<$length; $i++){?>                                      	                                         
<tr>  
<td class="col-md-2">
<input type="text" name="subscribers[]" readonly="readonly" value="<?php echo $subscriber[$i]['email_id']?>" class="form-control">                                              </td>
<td class="col-md-10 " id="expand" style="text-align:center; padding-left:5%;padding-bottom:150px;">                                                     
<ul class="nav nav-tabs">
<li class="active" style="background:#CCCCCC"><a data-toggle="tab" href="#home<?php echo $i?>">Subscribed Magazines</a></li>
<li  style="background:#CCCCCC"><a data-toggle="tab" href="#menu<?php echo $i?>">Subscribe New Magazines</a></li>
</ul>
<div class=" col-md-12 tab-content" style=" border:solid 5px #999999; display:inline-block; padding-bottom:5%;">
        <div id="home<?php echo $i?>" class="tab-pane fade in active">
                <h3>Subscribed Magazines</h3>
                <div  style="margin:5%;">
                        <form id="form<?php echo $i?>" action="<?php echo base_url()?>add_subscriber/addonlysubs0" method="post">
                                <input type="hidden" name="email" value="<?php echo $subscriber[$i]['email_id']?>" />
                                <input type="hidden" name="parentid" value="<?php echo $this->session->userdata['id']?>" />
                            	<div class="col-xs-6">   
                                        <select id="1mag<?php echo $i?>" name="submag" class="form-control" onchange="magprice0(this.id)">	
                                                <option value="">Subscribed Magazines</option>
                                                <?php  
                                                $var0 = $this->home_model->get_magazine($subscriber[$i]['email_id']);																										                 
                                                foreach( $var0 as $data0)
                                                {			
                                                $varx = $this->home_model->get_magbyid($data0['mag_id']);																																																					
                                                ?>  
                                                <option value="<?php echo $varx['mag_id']?>" data-id="<?php echo $varx['price']?>"><?php  echo $varx['name'];?></option>
                                                <?php
                                                }
                                                ?>
                                        </select>
                                </div>       
                            	<div class="col-xs-4">
                                        <select id="1magissue<?php echo $i?>" name="duration" class="form-control"  onchange="magprice1(this.id)">	
                                                <option value="">Select Number of Months</option>
                                                <?php for($count = 1; $count<=12; $count++)
                                                {
                                                ?>
                                                <option value="<?php echo $count?>"><?php echo $count?> month</option>
                                                <?php
                                                }
                                                ?>
                                        </select>                                                                                                            
                                </div> 
                            	<div class="col-xs-2">
                                		<input type="text" class="form-control" name="totalformag" id="1totalformag<?php echo $i?>" value=""  placeholder="Amount"	? />
                        		</div>
                            	<div class="form-group"  style="min-height:30px; border:solid 0px #ff0000;">
                                     <label for="inputPaym" class="col-sm-12 control-label" style="text-align:left; padding-top:20px;">Payment Method</label>
                                     <div class="col-sm-10"  style="margin:5%">
                                          <label  class="col-sm-3 control-label">Offline</label>
                                          <input type="radio" class="col-sm-3"  id="inputPaym1" name="paym" value="offline"  onclick="Paym(1)" onselect="Paym(1)">
                                           <label class="col-sm-3 control-label">Online</label>
                                          <input type="radio"  class="col-sm-3" checked="checked" id="inputPaym2"  name="paym" value="online" onClick="Paym(0)">
                                    </div>
                        		</div>
                            	<div class="offline">
                                        <div class="form-group" >
                                             <label class="col-sm-3 control-label">Money order</label>
                                              <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="MoneyOrder" onClick="Offline(1)" >     
                                              <label class="col-sm-3 control-label">Demand Draft</label>
                                              <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="DemandDraft"  onClick="Offline(2)" >
                                             <label  class="col-sm-3 control-label">Bank Deposite</label>
                                             <input type="radio" class="col-sm-1" id="inputOffline" name="offline" value="BankDeposite" onClick="Offline(3)">
                                        </div>   
                                </div>
                            	
                                <div class="inputOffline1">
                               
                                <div class="col-sm-12" style="min-height: 30px;">
                                        <label for="inputBank" class="col-sm-3 control-label">MO Date</label>
                                        <div class="col-sm-8">
                                                 <input type="text"  class="form-control" name="date" id="inputModate" placeholder="Money Date"  >
                                        </div>
                             </div>     
                              <div class="col-sm-12" style="min-height: 30px;">
                                        <label for="inputAmount" class="col-sm-3 control-label">Amount:</label>
                                        <div class="col-sm-8">
                                                 <input type="text"  class="form-control " name="amount" readonly="readonly" id="inputAmount1" placeholder="Amount"  >
                                        </div>
                             </div>     
                              <div class="col-sm-12" style="min-height: 30px;">
                                        <label for="inputSendername" class="col-sm-3 control-label">Sender name:</label>
                                        <div class="col-sm-8">
                                                 <input type="text"  class="form-control" name="sendername1" id="inputSendername" placeholder="Sender name"  >
                                        </div>
                             </div>     
                        </div>   
                            	<div class="inputOffline2" >                           
                                        <div class="col-sm-12" style="min-height: 30px;" >
                                        <label for="inputBank" class="col-sm-3 control-label">DD number:</label>
                                        <div class="col-sm-8">
                                         <input type="text"  class="form-control" name="ddnum" id="inputDDnumber" placeholder="DD number"  >
                                        </div>
                                 </div>
                             
                              <div class="col-sm-12"  style="min-height: 30px;">
                            <label for="inputAmount" class="col-sm-3 control-label">Amount:</label>
                            <div class="col-sm-8">
                             <input type="text"  class="form-control " name="amount" readonly="readonly" id="inputAmount<?php echo $i;echo $i;echo $i?>" placeholder="Amount"  >
                            </div>
                             </div>
                              
                              <div class="col-sm-12"  style="min-height: 30px;">
                            <label for="inputSendername" class="col-sm-3 control-label">Sender name:</label>
                            <div class="col-sm-8">
                             <input type="text"  class="form-control" name="sendername2" id="inputSendername1" placeholder="Sender name"  >
                            </div>
                             </div>
                             
                             </div>   
                       			<div class="inputOffline3" >
                              <div class="col-sm-12"  style="min-height: 30px;">
                                    <label for="inputDate" class="col-sm-3 control-label">Date:</label>
                                    <div class="col-sm-8">
                                     		<input type="text"  class="form-control " name="date2" id="inputMOdate<?php echo $i;echo $i;echo $i;echo $i;?>" placeholder="Enter Date"  >
                                    </div>
                             </div>
                             <div class="col-sm-12" style="min-height: 30px;" >            
                                            <label for="inputBank" class="col-sm-3 control-label">Transaction ID:</label>
                                            <div class="col-sm-8">
                                             <input type="text"  class="form-control" name="tensid" id="inputTransactionid" placeholder="Transaction ID"  >
                                            </div>
                              </div>                                                               
                             <div class="col-sm-12"  style="min-height: 30px;">
                                    <label for="inputAmount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-8">
                                     		<input type="text"  class="form-control " name="Amount" readonly="readonly" id="inputAmount<?php echo $i;echo $i;echo $i;echo $i;?>" placeholder="Amount"  >
                                    </div>
                             </div> 
                        </div>    
                            	<div class="col-md-12"  style="padding-top:8%; border:solid 0px #000000; text-align:center">
                        <button type="button" onclick="submitform(this.id)"  id="save<?php echo $i?>" class="btn btn-success"> Submit </button>
                        </div>
                </form>        
                </div>
        </div>       
		<div id="menu<?php echo $i?>" class="tab-pane fade">
				<h3>Subscribe New Magazines</h3>
				<form id="formnew<?php echo $i?>" action="<?php echo base_url()?>add_subscriber/addonlysubs" method="post">																			
<input type="hidden" name="email" value="<?php echo $subscriber[$i]['email_id']?>" />
<input type="hidden" name="frenchid" value="<?php echo $this->session->userdata['id']?>" />
<div id="newrow" class="col-md-12 repeatingSection<?php echo $i?>">
<div class="col-md-7 " style="border:solid 0px #FF0000">
<select name="newmag[]" class="form-control colx<?php echo $i ?>"  id="1newmag<?php echo $i?>" selectid = <?php echo $i?>   onchange="abc(this.id)">	
<option value=""> Subscribe new  Magazines</option>
<?php 																														
$var0 = $this->home_model->get_newmag($subscriber[$i]['email_id']);			
foreach($var0 as $data1)
{																							 																																																																																									
?>
<option value="<?php echo $data1['mag_id'];?>" data-id="<?php echo $data1['price'] ?>"><?php echo $data1['name'];?></option>
<?php 
}
?> 
</select>
</div>       
<div class="col-md-4">                                                                                                                                                                                                                        
<select id="1newissue<?php echo $i?>" name="issue[]" selectid="<?php echo $i?>" required class="form-control issue  coly<?php echo $i ?>" onchange="def(this.id , <?php echo $i?>)">
<option value=""> Select Time period in months</option>
<option value="1"> 1</option>
<option value="2"> 2</option>
<option value="3"> 3 </option>
<option value="4"> 4 </option>
<option value="5"> 5</option>
<option value="6"> 6</option>
<option value="7"> 7</option>
<option value="8"> 8</option>
<option value="9"> 9</option>
<option value="10">10 </option>
<option value="11"> 11</option>
<option value="12"> 12</option>
</select>

<input type="hidden" class="<?php echo $i?>  colz<?php echo $i ?>" id="1amount<?php echo $i?>" comid="1amount<?php echo $i?>" name="amount[]" value="0" />
</div>
<div class="col-md-1">
<input id="1delete<?php echo $i ?>"  onclick="remove1(this.id )" class="round  colw<?php echo $i ?>"  type="button"  style="width:30px;height:30px;border:none;background:url(<?php echo HTTP_IMAGES_PATH ?>delete.png);" >                                                                                 
</div> 

</div>
<div class="col-md-12" style="position:relative; border:solid 0px #000000; text-align:right">
<input type="button" id="add_new_code" style="width:30px;height:30px;border:none;background:url(<?php echo HTTP_IMAGES_PATH ?>add_new.png);" class="round" >                            															
</div>
<div class="col-md-12">
<div class="col-md-8"  style="text-align:right"><label>Total Amount:</label></div>
<div class="col-md-2"  style="text-align:right">
<input class="form-control" type="text" id="total<?php echo $i?>" name="total">                            															
</div>
</div>

<div class="form-group"  style="min-height: 30px;">
     <label for="inputPaym" class="col-sm-12 control-label">Payment Method</label>
     <div class="col-sm-12">
      <label  class="col-sm-3 control-label">Offline</label>
      <input type="radio" class="col-sm-1"  id="inputPaym1" name="paym" value="offline"  onclick="Paym(1)" onselect="Paym(1)">
       <label class="col-sm-3 control-label">Online</label>
      <input type="radio"  class="col-sm-1" checked="checked" id="inputPaym2"  name="paym" value="online" onClick="Paym(0)">
    </div>
   </div>
   <div class="offline"  style="min-height: 30px;">
   <div class="form-group" >
      <div class="col-sm-12">
     <label class="col-sm-2 control-label">Money order</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="MoneyOrder" onClick="Offline(1)" >
       
     
      <label class="col-sm-2 control-label">Demand Draft</label>
      <input type="radio"  class="col-sm-1" id="inputOffline" name="offline" value="DemandDraft"  onClick="Offline(2)" >
      
   
     <label  class="col-sm-2 control-label">Bank Deposite</label>
     <input type="radio" class="col-sm-1" id="inputOffline" name="offline" value="BankDeposite" onClick="Offline(3)"></div>
   
   </div></div>
  <div class="inputOffline1">
                               
                                <div class="col-sm-12" style="min-height: 30px;">
                                        <label for="inputBank" class="col-sm-3 control-label">MO Date</label>
                                        <div class="col-sm-8">
                                                 <input type="text"  class="form-control" name="date" id="inputModate<?php echo $i?>" placeholder="Money Date"  >
                                        </div>
                             </div>     
                              <div class="col-sm-12" style="min-height: 30px;">
                                        <label for="inputAmount" class="col-sm-3 control-label">Amount:</label>
                                        <div class="col-sm-8">
                                                 <input type="text"  class="form-control " name="amount" readonly="readonly" id="inputAmount<?php echo ($i+1)?>" placeholder="Amount"  >
                                        </div>
                             </div>     
                              <div class="col-sm-12" style="min-height: 30px;">
                                        <label for="inputSendername" class="col-sm-3 control-label">Sender name:</label>
                                        <div class="col-sm-8">
                                                 <input type="text"  class="form-control" name="sendername1" id="inputSendername<?php echo $i?>" placeholder="Sender name"  >
                                        </div>
                             </div>     
                        </div>   
  <div class="inputOffline2" >                           
                                        <div class="col-sm-12" style="min-height: 30px;" >
                                        <label for="inputBank" class="col-sm-3 control-label">DD number:</label>
                                        <div class="col-sm-8">
                                         <input type="text"  class="form-control" name="ddnum" id="inputDDnumber<?php echo $i?>" placeholder="DD number"  >
                                        </div>
                                 </div>
                             
                              <div class="col-sm-12"  style="min-height: 30px;">
                            <label for="inputAmount" class="col-sm-3 control-label">Amount:</label>
                            <div class="col-sm-8">
                             <input type="text"  class="form-control " name="amount" readonly="readonly" id="inputAmount<?php echo ($i+1)?>" placeholder="Amount"  >
                            </div>
                             </div>
                              
                              <div class="col-sm-12"  style="min-height: 30px;">
                            <label for="inputSendername" class="col-sm-3 control-label">Sender name:</label>
                            <div class="col-sm-8">
                             <input type="text"  class="form-control" name="sendername2" id="inputSendername<?php echo $i?><?php echo $i?>" placeholder="Sender name"  >
                            </div>
                             </div>
                             
                             </div>   
  <div class="inputOffline3" >
                              <div class="col-sm-12"  style="min-height: 30px;">
                                    <label for="inputDate" class="col-sm-3 control-label">Date:</label>
                                    <div class="col-sm-8">
                                     		<input type="text"  class="form-control " name="date2" id="inputMOdate<?php echo ($i+1)?>" placeholder="Enter Date"  >
                                    </div>
                             </div>
                             <div class="col-sm-12" style="min-height: 30px;" >            
                                            <label for="inputBank" class="col-sm-3 control-label">Transaction ID:</label>
                                            <div class="col-sm-8">
                                             <input type="text"  class="form-control" name="tensid" id="inputTransactionid<?php echo $i?>" placeholder="Transaction ID"  >
                                            </div>
                              </div>                                                               
                             <div class="col-sm-12"  style="min-height: 30px;">
                                    <label for="inputAmount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-8">
                                     		<input type="text"  class="form-control " name="Amount" readonly="readonly" id="inputAmount<?php echo ($i+1)?>" placeholder="Amount"  >
                                    </div>
                             </div> 
                        </div>
<div class="col-md-12"  style="position:relative; border:solid 0px #000000; text-align:center">
<button type="button" id="savenew<?php echo $i?>" onclick="submitform(this.id)" class="btn btn-success"> Submit </button>
</div>
</form>
		</div>                                                      
</div>
</td>                                        
</tr>
<?php
}
 } 
 
if( isset($subscriber) && (count($subscriber)==0)){?>
<tr>
<td>
<h3>NO DATA FOUND</h3>

</td>

</tr>

<?php } ?>                                                                     
</tbody>
</table>
</div>                                                               
<div class="clearfix">
</div>                        
</div>                        
</div>
</div>

<?php $this->load->view('vwFooter');?>
<script>
function changeqq(data)
{
		alert(123);
}
function  magprice0(data)
{
//alert(data);
var r = data.replace('mag','')
var s = r.split('');
//alert(s[0] +'  &    '+s[1]);
magprice(s[0],s[1]);
}
function  magprice1(data)
{
var r = data.replace('magissue','')
var s = r.split('');
//alert(s[0]+'   &  '+s[1]);
magprice(s[0],s[1]);
}
function magprice(data0, data1)
{
//alert($('#'+data0+'mag'+data1).find(':selected').data('id')); alert($('#'+data0+'magissue'+data1).val());
$('#'+data0+'totalformag'+data1).val($('#'+data0+'mag'+data1).find(':selected').data('id') * $('#'+data0+'magissue'+data1).val() );
$('#inputAmount'+data0).val($('#'+data0+'totalformag'+data1).val());
$('#inputAmount'+data1+data1+data1).val($('#'+data0+'totalformag'+data1).val());
$('#inputAmount'+data1+data1+data1+data1).val($('#'+data0+'totalformag'+data1).val());
}
function abc(data)
{
//alert(data);
var q = $('#'+data).attr('selectid');
var r = data.replace('newmag','')
var s =r.split('');
price(s[0],q);
}
function def(data1,data2)
{
//alert(data1);alert(data2);
var r = data1.replace('newissue','');
var s =r.split('');			
price(s[0],data2);
}
function price(data1,data2)
{	
///alert(data1);alert(data2);
var sum =0;
$('#'+data1+'amount'+data2).val($('#'+data1+'newmag'+data2).find(':selected').data('id') * $('#'+data1+'newissue'+data2).val());					
$("."+data2).each(function(){
sum += +$(this).val();
});
$("#total"+data2).val(sum);
alert($("#total"+data2).val());
$('#inputAmount'+data1).val($("#total"+data2).val());

}	
function addnewrow(data , data2){	 
var currentCount =  $('.repeatingSection'+data2).length;
var newCount = currentCount+1;
var lastRepeatingGroup = $('.repeatingSection'+data2).last();
var newSection = lastRepeatingGroup.clone();
newSection.insertAfter(lastRepeatingGroup);

newSection.find("input").each(function (index, input) {			
input.id = input.id.replace( currentCount, newCount);
input.name = input.name.replace(currentCount, newCount);
<!--	input.attr('data--->comid') = input.attr('data-comid').replace( currentCount, newCount);
input.value = '';
});

newSection.find("select").each(function (index, input) {

input.id = input.id.replace(currentCount, newCount);
});		
//alert(('#'+data2+'newissue'+newCount));

newSection.find("label").each(function (index, label) {
var l = $(label);
l.attr('for', l.attr('for').replace(currentCount, newCount));
});
return false;
};

function remove1(id)
{		
var r = id.replace('delete','');
var s =r.split('');
//alert(s[1]);

if($('.repeatingSection'+s[1]).length >= 1)
{		
$('#'+id).parent().parent().remove();
//alert($('.repeatingSection'+s[1]).length);
var i=1;
$('.colx'+s[1]).each(function (index, input) {								
input.id = i+'newmag'+s[1];	
i++;				
});
var i=1;
$('.coly'+s[1]).each(function (index, input) {								
input.id = i+'newissue'+s[1];	
i++;				
});
var i=1;
$('.colz'+s[1]).each(function (index, input) {								
input.id = i+'amount'+s[1];	
i++;				
});
var i=1;
$('.colw'+s[1]).each(function (index, input) {								
input.id = i+'delete'+s[1];	
i++;				
});							
var sum =0; 
$('.colz'+s[1]).each(function(){				 
sum += +$(this).val();
});
$("#total"+s[1]).val(sum);
$('#inputAmount'+s[0]).val($("#total"+data2).val());
}			 
}

function submitform(data)
{
var idq = data.replace('save','')
$('#form'+idq).submit();
}
</script>