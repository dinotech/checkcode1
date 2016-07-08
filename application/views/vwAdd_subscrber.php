<?php $this->load->view('vwHeader');?>
 <style>
  td, th {
    padding: 15px;
}
#delete1{
	display:none;	
}
</style>
<div class="heading">
	<h3>Add Subscriber</h3>
</div>

<div class="container newsub">
	<div class="row">        
    <!---->
      
     <form action="<?php echo base_url()?>add_subscriber/addsubs" method="post">
        <table class="form ">
            <tr> 
                <td class="col-lg-2">Email id<span style="color:red">*</span></td> 
                <td class="col-lg-2">Mobile</td>
                <td class="col-lg-2">Name<span style="color:red">*</span></td>
                <td class="col-lg-2">Magazine<span style="color:red">*</span></td>
                <td class="col-lg-2">language</td>
                <td class="col-lg-2">No of Months<span style="color:red">*</span></td>
                <td class="col-lg-2">&nbsp; </td>
            </tr>
            <tr class="data repeatingSection" >            
            <input type="hidden" name="parentid" value="<?php echo $this->session->userdata['id']?>" />
                <td class="col-lg-2">                    
                    <input type="email" class="form-control" id="email1" required="required" onchange="checkunique(this.id , this.value)" name="email[]">                   
                </td>
                <td class="col-lg-2">
                    <input type="text" class="form-control" id="mobile1" name="mobile[]" >
                </td>                
                <td class="col-lg-2"> 
                    <input type="text" class="form-control" id="name1" required="required" name="name[]" >
                </td>                
                <td class="col-lg-2">                 
                  <select id="magazineid1" name="magazine[]" required class="form-control magazine"  onchange="abc(this.id)">
                    <option value="">Select Magazine</option>
                    <?php foreach($magazines as $k=>$v){ ?>
                    <option value="<?php echo $v['mag_id'] ?>" data-id="<?php echo $v['price'] ?>"><?php echo $v['name'] ?></option>
                    <?php } ?>
                    </select>
                </td>
                <td class="col-lg-2">
                    <input type="text" readonly="readonly" class="form-control" id="lang1" value="en"  name="lang[]" />                    
                </td>                      
                <td class="col-lg-2">
                    <select id="1" name="issue[]" required class="form-control issue" onchange="price(this.id)">
                        <option value="">Select Issue</option>
                        <?php
                            for($i=1;$i<=12;$i++)
                            {
                        ?>
                        <option value="<?php echo $i?>"><?php echo $i?></option>
                        <?php
                            }
                        ?>
                    </select>
                </td>       
                <td class="col-lg-2"> 
                    <input type="hidden" class="form-control 1" id="total1" name="total[]" value="0"  >
                </td>           
                <td class="col-lg-2">
                    <input id="delete1" onclick="remove1(this.id)" type="button"  style="width:30px;height:30px;border:none;background:url(<?php echo HTTP_IMAGES_PATH ?>delete.png);" class="round" >
                </td>   
                 
            </tr>
            <tr style="margin-top:40px;">
            	<td colspan="5" style="text-align:right">
                  <label class="col-lg-4">Total payable amount:</label> 
                  </td>
                  <td colspan="1">               
                   <input  id="finaltotal_amount" name="finaltotal_amount"  class="form-control total" type="text" value="0"  >                </td>
                   <td> <input type="button" id="add_new_code" style="width:30px;height:30px;border:none;background:url(<?php echo HTTP_IMAGES_PATH ?>add_new.png); position:relative; left:202%;" class="round" > </td>
            </tr>
            </table>
     <?php  if($this->session->userdata['role']=='frenchise'){?>       
      <div class="form-group"  style="min-height: 30px;">
     <label for="inputPaym" class="col-sm-2 control-label">Payment Method</label>
     <div class="col-sm-10">
      <label  class="col-sm-1 control-label">Offline</label>
      <input type="radio" class="col-sm-1"  id="inputPaym1" name="paym" value="offline"  onclick="Paym(1)" onselect="Paym(1)">
       <label class="col-sm-1 control-label">Online</label>
      <input type="radio"  class="col-sm-1" checked="checked" id="inputPaym2"  name="paym" value="online" onClick="Paym(0)">
    </div>
   </div>
   <div id="offline"  style="min-height: 30px;">
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
    <div class="form-group" style="min-height: 30px;">
    <label for="inputBank" class="col-sm-2 control-label">MO Date :
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="modate" id="inputModate" placeholder="Money Date"  >
    </div>
     </div>
     
      <div class="form-group" style="min-height: 30px;">
    <label for="inputAmount" class="col-sm-2 control-label">Amount:
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control " name="amount" readonly="readonly" id="inputAmount1" placeholder="Amount"  >
    </div>
     </div>
     
      <div class="form-group" style="min-height: 30px;">
    <label for="inputSendername" class="col-sm-2 control-label">Sender name:</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="sendername1" id="inputSendername" placeholder="Sender name"  >
    </div>
     </div>
     
     </div>
   
     <div id="inputOffline2" >
   <label>DEMAND DRAFT</label>
    <div class="form-group" style="min-height: 30px;" >
    <label for="inputBank" class="col-sm-2 control-label">DD number:</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="ddnum" id="inputDDnumber" placeholder="DD number"  >
    </div>
     </div>
     
      <div class="form-group"  style="min-height: 30px;">
    <label for="inputAmount" class="col-sm-2 control-label">Amount:
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control " name="amount" readonly="readonly" id="inputAmount2" placeholder="Amount"  >
    </div>
     </div>
      
      <div class="form-group"  style="min-height: 30px;">
    <label for="inputSendername" class="col-sm-2 control-label">Sender name:</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="sendername2" id="inputSendername" placeholder="Sender name"  >
    </div>
     </div>
     
     </div>
   
<div id="inputOffline3" >
   <label> Bank deposit:</label>
    <div class="form-group" style="min-height: 30px;" >
    <label for="inputBank" class="col-sm-2 control-label">Transaction ID:
</label>
    <div class="col-sm-10">
     <input type="text"  class="form-control" name="tensid" id="inputTransactionid" placeholder="Transaction ID"  >
    </div>
     </div>
    
     </div>
 
       <?php } ?><!--  End If(checking if user is franchise)-->          
          <div class="col-sm-12" style="min-height: 30px; text-align:center;" >
            	    	<input type="submit" name="save" class="btn btn-success btn-lg" value="<?php if($this->session->userdata['role']=='executive'){?>Submit<?php } else{?>Genrate Payment Id<?php } ?>" />
                        </div>
              
     </form>     
    
        </div>
	</div>
</div>

<?php $this->load->view('vwFooter');?>


<script>

function abc(data)
	{
		var q = data.replace('magazineid','')
		price(q);
	}
   $('#add_new_code').click(function(){	 
		var currentCount =  $('.repeatingSection').length;
		var newCount = currentCount+1;
		var lastRepeatingGroup = $('.repeatingSection').last();
		var newSection = lastRepeatingGroup.clone();
		newSection.insertAfter(lastRepeatingGroup);
		newSection.find("input").each(function (index, input) {
					input.id = input.id.replace( currentCount, newCount);
					input.name = input.name.replace(currentCount, newCount);					
				});
		newSection.find("select").each(function (index, input) {
			//alert(input);
					input.id = input.id.replace(currentCount, newCount);
				});		
				
		$('#email'+newCount).val("");
		$('#mobile'+newCount).val("");
		$('#name'+newCount).val("");
		$('#total'+newCount).val("");
		newSection.find("label").each(function (index, label) {
					var l = $(label);
					l.attr('for', l.attr('for').replace(currentCount, newCount));
				});
		return false;
	});
	
	function checkunique(id,data)
	{
		$.ajax({
			url:'add_subscriber/checkuser',
			data:'email='+data,
			type:'post',
			success:function(data)
			{				
				if($.trim(data)=='1')
				{
					alert('This E-mail-id is alresdy Subscribed, please enter different E-mail id');
					$('#'+id).val('');
				}
			}
		});
	}
	
	function remove1(id)
	{
		if(id=='delete1')
		{			
			$('#email1').val('');
			$('#mobile1').val('');
			$('#name1').val('');
			$('#magazineid1').val('');
			$('#lang1').val('');
			$('#1').val('');
			$('#total1').val('');
			$('#finaltotal_amount').val('');
			
		}
		if(id!='delete1')
		{
			$('.total').val(parseFloat($('.total').val()) - parseFloat($('#total'+id.replace('delete','')).val()))
			$('#'+id).parent().parent().remove();
		}
	}
	
	function price(data)
	{
		  var sum =0;
		$('#total'+data).val($('#magazineid'+data).find(':selected').data('id') * $('#'+data).val());		
		
		 $(".1").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
	$('#inputAmount1').val(sum);
	$('#inputAmount2').val(sum);
	
	
	    //$('#finaltotal_amount').val(parseFloat($('#finaltotal_amount').val())+parseFloat($('#total'+data).val()))
	}
	
	/*function select_mag(val){
		 
		var mag =  $('#'+val).val();
		 var sp = val.split("_");
		 alert(sp[2]);
		 duration =12;var i=0; var final_total=0;
		 $.ajax({
		 url:"<?php echo BASE_URL ?>getamount?q="+mag+"&p="+duration,
	     success: function(result){
          // alert(result);
		   $('#total_id_'+sp[2]).val(result);
		   for(i=1;i<=sp[2];i++){
			   var value =$("#total_id_"+i).val();
			   alert(value);
		   var final_total=parseFloat(final_total) + parseFloat($('#total_id_'+i).val());
		   }
		 //  alert(final_total);
		   $('#finaltotal_amount').val(final_total);
         }
		 });
		 }*/
	
  </script>
 