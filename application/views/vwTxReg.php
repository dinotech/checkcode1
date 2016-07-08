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
            <input type="hidden" id="fid" name="fid" value="<?php echo $this->session->userdata['id']?>">
            <div align="center" class="col-md-12" style="margin-top:5%;margin-bottom:5%;">
            		<table class="form " border="2" align="center">
                    		<thead>
                            	<tr>
                                		<th>Date</th>
                                        <th>PaymentID</th>
                                        <th>Payable Amt</th>
                                        <th>Received payments</th>
                                        <th>Pending Payments</th>
                                        <th>paybacks</th>
                                        <th>TransactionID</th>
                                 </tr>                		
                            </thead>
                    		<tbody class="result">                            
                        		   <tr>
                                   		<td colspan="7" style="text-align:center">
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
		var frenchid = $('#fid').val();
		if(i!='' && j!='')
		{ 	
		$('.result').html('');
				$.ajax({
						url: '<?php echo base_url(); ?>Updatepay/abc',
						type:'post',
						data:'sdate='+i+'&fid='+frenchid+'&edate='+j,
						success: function(data){						
						var abhi = JSON.parse(data);						
						var count = abhi.length;
						jQuery.each(abhi, function(index, itemt) {	
						//alert(itemt.payouts); 						
									if(itemt.status=='2')
									{
										if(itemt.payouts==null){
											$('.result').append('<tr>'+'<td>'+itemt.start_time+'</td>'+'<td>'+itemt.payment_id+'</td>'+'<td >'+itemt.amount+'</td>'+'<td >'+itemt.payment_id+'</td>'+'<td>'+'0'+'</td>'+'<td >'+'0'+'</td>'+'<td >'+'Onlinepart later'+'</td>'+'</tr>');
										}else{
											$('.result').append('<tr>'+'<td>'+itemt.start_time+'</td>'+'<td>'+itemt.payment_id+'</td>'+'<td >'+itemt.amount+'</td>'+'<td >'+itemt.payment_id+'</td>'+'<td>'+'0'+'</td>'+'<td >'+itemt.payouts+'</td>'+'<td >'+'Onlinepart later'+'</td>'+'</tr>');
										}
									}else
									{
										if(itemt.payouts==null){
											$('.result').append('<tr>'+'<td>'+itemt.start_time+'</td>'+'<td>'+itemt.payment_id+'</td>'+'<td >'+itemt.amount+'</td>'+'<td >'+'0'+'</td>'+' <td >'+itemt.payment_id+'</td>'+'<td >'+'0'+'</td>'+'<td >'+'Onlinepart later'+'</td>'+'</tr>');
										}else{
											$('.result').append('<tr>'+'<td>'+itemt.start_time+'</td>'+'<td>'+itemt.payment_id+'</td>'+'<td >'+itemt.amount+'</td>'+'<td >'+'0'+'</td>'+' <td >'+itemt.payment_id+'</td>'+'<td >'+itemt.payouts+'</td>'+'<td >'+'Onlinepart later'+'</td>'+'</tr>');
										}
										
												
										
									}
									
						})																																												
					}		
				});
		}
				if(i!='' && j=='')
				{
					//alert(2);
				}
				if(i=='' && j!='')
				{
					//alert(3);
				}
	}
</script>
 