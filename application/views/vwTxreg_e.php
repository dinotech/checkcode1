<?php 
$this->load->view('vwHeader');
?>

 <style>td,th{padding:15px;}#delete1{display:none;	}</style>
<div class="heading">
	<h3>Transaction Register</h3>
</div>

<div class="container newsub">
	<div class="row">        
            <div class="col-md-12" style="margin-top:2%">            
                    <div class="col-xs-2">
                        <label>Select Date:</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="sdate" class="dpick form-control" name="startdate" placeholder="Enter Starting Date" onChange="dateq()" />
                    </div> 
                    <div class="col-xs-1" style="text-align:center">
                        TO
                    </div>
                    <div class="col-sm-3">    
                        <input type="text" id="edate" class="dpick  form-control" name="enddate" placeholder="Enter Ending Date" onChange="dateq()"/>
                    </div>    
            </div>
            <div class="col-sm-12" style="margin-top:2%">
            	<label class="col-sm-2">Sort by</label>
                <div class="col-sm-2"><input type="text" class="form-control" name="search1" id="search1" /></div>
                <button class="btn btn-primary">Subscription</button>
                <button class="btn btn-primary">Payment approved</button>
                <button class="btn btn-primary">Payments rejected</button>
                <button  class="btn btn-primary">Payments pending</button>
                <button class="btn btn-primary">All</button>
            </div>
            <div align="center" class="col-md-12" style="margin-top:5%;margin-bottom:5%;">
            		<table class="form " border="2" align="center">
                    		<thead>
                            	<tr>
                                		<th>Date</th>
                                        <th>No of subscriptions joined</th>
                                        <th>Approved pay details</th>
                                        <th>Rejected pay</th>
                                        <th>Pending payment</th>                                        
                                 </tr>                		
                            </thead>
                    		<tbody class="result">                            
                        		   <tr>
                                   		<td colspan="5" style="text-align:center">
                                        		<h3>Please select dates</h3>
                                        </td>
                                   </tr>              
                        	</tbody>
                    </table>
            </div>
	</div>
</div>

<?php $this->load->view('vwFooter');?>


<script>
	$(function() {
		
			$( ".dpick" ).datepicker({dateFormat: 'yy-mm-dd'});
	});
	function dateq(){ 
		var i = $('#sdate').val();
		var j = $('#edate').val();
		if(i!='' && j!='')
		{ 	
		$('.result').html('');
				$.ajax({
						url: '<?php echo base_url(); ?>Updatepay/abcd',
						type:'post',
						data:'sdate='+i+'&edate='+j,
						success: function(data){						
								var abhi = JSON.parse(data);
								console.log(abhi);							
								jQuery.each(abhi, function(index, itemt)
								{ 
var count = itemt.length;
									$('.result').append('<tr><td>'+index+'</td><td id="s'+index+'">'+count+'</td><td id="a'+index+'"></td><td id="r'+index+'"></td><td id="p'+index+'"></td></tr>');
										jQuery.each(itemt, function(index1, itemt1)
										{  
											if(itemt1.status==2)
											{
												$('#a'+index).append('<div>PayId: '+itemt1.payment_id+'</div><div>Amount: '+itemt1.amount+'</div><div>Mode of payment : '+itemt1.payment_mode+'</div></br>');																						
											}
											else if(itemt1.status==0)
											{
												$('#p'+index).append('<div>PayId: '+itemt1.payment_id+'</div><div>Amount: '+itemt1.amount+'</div><div>Mode of payment : '+itemt1.payment_mode+'</div></br>');	
											}
										});	
								});
						}		
				});
		}
	}
				/*if(i!='' && j=='')
				{
					//alert(2);
				}
				if(i=='' && j!='')
				{
					//alert(3);
				}*/
	//}
</script>
 