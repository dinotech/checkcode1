<?php $this->load->view('vwHeader');?>
<style>td,th{padding:15px;}#delete1{display:none;	}</style>
<div class="heading">
<h3>Daily Report</h3>
</div>
<div class="container newsub">
	<div class="row">        
            <div class="col-md-8" style="margin-top:2%;">
            		<input type="hidden" id="ddate" value="<?php echo $date = $this->home_model->find_date();?>">
                    <div class="col-xs-3">
                    <label>Select Date:</label>
                    </div>
                    <div class="col-sm-4">
                    <input type="text" id="sdate" class="dpick form-control" name="startdate" placeholder="Enter Date" onchange="chang(this.value)" />
                    </div>                       
                    </div>
               <input type="hidden" id="fid" name="fid" value="<?php echo $this->session->userdata['id']?>">
               <div class="col-md-12" style="margin-top:5%;padding-bottom:5%;">
            		  <div class="col-md-12">
                              <table class="form" border="1" align="left" style="float:left; margin-right:5%">
                                <thead>
                                <tr>                        
                                    <th colspan="3" style="text-align:center">Subscriptions</th>                            
                                </tr>
                                <tr>
                                    <th>Magazine</th>
                                    <th>No of issues</th>
                                    <th>No of subscriptions</th>
                                </tr>
                                </thead>
                                <tbody class="b1">
                                </tbody>
                                </table>
                              <table class="form" border="1" style="float:left">
                                <thead>
                                <tr>                        
                                    <th colspan="3" style="text-align:center">Renewals</th>                            
                                </tr>
                                <tr>
                                    <th>Magazine</th>
                                    <th>No of issues</th>
                                    <th>No of subscriptions</th>
                                </tr>
                                </thead>
                                <tbody class="b2">
                                </tbody>
                            </table>
                      </div> 
                      <div class="col-md-12"  style="margin-top:2%">
                        <table class="form" border="1" style="float:left; margin-right:8%;">
                                    <thead>
                                    <tr>                        
                                        <th colspan="2" style="text-align:center">Payments</th>                            
                                    </tr>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Payable amount</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody class="b3">
                                    </tbody>                                </table>	
                         
                        <table class="form" border="1"  style="float:left; margin-right:8%;">
                                    <thead>
                                    <tr>                        
                                        <th colspan="2" style="text-align:center"> Pending payments	  </th>                            
                                    </tr>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Amount</th>                            
                                    </tr>
                                    </thead>
                                    <tbody class="b4">
                                  </tbody>
                                </table>
                                            
                        <table class="form" border="1"  style="float:left;">
                                    <thead>
                                    <tr>                        
                                        <th colspan="2" style="text-align:center">Paybacks </th>                            
                                    </tr>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>                            
                                    </tr>
                                    </thead>
                                    <tbody class="b5">
                                  </tbody>
                                </table>
                        
                        </div>
                      <div class="col-sm-6" style="margin-top:2%;">                      
                      		<button class="btn btn-success" onclick="ab()">View subscriber List</button>                      
                      </div>  
                      <?php  ?>
                      <div id="dow" class="col-sm-11" style="margin-top:2%; display:none">
                      		<table  class="col-sm-12 " border="1">
                            		<thead>
                                    		<tr>
                                            		<td><b>email</b> </td>
                                                    <td><b>Name</b></td>
                                                    <td><b>Magazine</b></td>
                                                    <td><b>No issues</b></td>
                                                    <td><b>Mobile num</b></td>
                                                   
                                            </tr>
                                    </thead>
                                    <tbody  class="b6">
                                    <tr>
                                    		<td colspan="6" style=" text-align:center"><h5><b>Please Select Date</b></h5></td>
                                    </tr>
                            </table>                          
                      </div>
               </div>
                   </div>
</div>                   
<?php $this->load->view('vwFooter');?>
<script>

	$('#sdate').datepicker({
  			minDate: $('#ddate').val(),
			dateFormat: 'yy-mm-dd',
	});
	function ab()
	{
		$('#dow').toggle(1000);	
	}
	function changei(dats)
	{ 
	var dats2 = $('#'+dats).val();	
		$.ajax({
			url:'mysubscription/check',
			type:'post',
			data:'email='+dats2,
			success:function(data){
				var w = $.trim(data);
				if(w==1)
				{
					alert('This Email-id is already registered, please Subscribe with other Email-id ');
					$('#'+dats).val('');
				}
				else
				{
					var id =$('#'+dats).data('id');
					//alert(id);
					$('#id'+dats).show();
				}
			}
		});
	}
	function eiting(data)
	{
		if($('#'+data).val() != '')
		{
			var newemail = $('#'+data).val();
			var uid = $('#'+data).data('id');
			$.ajax({
					url:'mysubscription/updatemail',
					type:'post',
					data:'mail='+newemail+'&uid='+uid,
			});
		}
		else
		{
			alert('Please enter Email-id');
		}
	}
	function chang(data)
	{
		$('.b1').html('');
		$('.b2').html('');
		$('.b3').html('');
		$('.b4').html('');
		$('.b5').html('');
		$('.b6').html('');
		$.ajax({
			url:'mysubscription/detail',
			type:'post',
			data:'data='+data,
			success:function(data){
					var abhi = JSON.parse(data);
console.log(abhi);
					jQuery.each(abhi, function(index, itemt) {																		
						if(index ==0)
						{
							var count1 = abhi[0].length; 
							//alert(count1);						
								jQuery.each(abhi[0], function(index, itemt) {																																											
								$('.b1').append('<tr><td>'+itemt.name+'</td><td>'+itemt.duration+'</td><td>'+itemt.subscription+'</td></tr>');																										
								});
						}
						if(index ==1)
						{
							var count2 = abhi[1].length; 
													
								jQuery.each(abhi[1], function(index, itemt) {																																											
								$('.b2').append('<tr><td>'+itemt.name+'</td><td>'+itemt.duration+'</td><td>'+itemt.subscription+'</td></tr>');																										
								});
						}
						if(index ==2)
						{
							var count3 = abhi[2].length; 
												
								jQuery.each(abhi[2], function(index, itemt) {																																											
								$('.b3').append('<tr><td>'+itemt.pay_id+'</td><td>'+itemt.amount+'</td></tr>');																										
								});
						}
						if(index ==3)
						{
							var count4 = abhi[3].length; 
												
								jQuery.each(abhi[3], function(index, itemt) {																																											
								$('.b4').append('<tr><td>'+itemt.payment_id+'</td><td>'+itemt.amount+'</td></tr>');																										
								});
						}
						if(index ==4)
						{
							var count5 = abhi[4].length; 
												
								jQuery.each(abhi[4], function(index, itemt) {																																											
								$('.b5').append('<tr><td>'+itemt.tid+'</td><td>'+itemt.amount+'</td></tr>');																										
								});
						}
						if(index ==5)
						{
							var count6 = abhi[5].length; 
												
								jQuery.each(abhi[5], function(index, itemt) {		
								//alert(itemt)	;																																				
								$('.b6').append('<tr><td><input type="text" class="form-control" required=required data-id="'+itemt.email_id+'" id="'+itemt.user_id+'" onchange="changei('+itemt.user_id+')"  value="'+itemt.email_id+'"></td><td>'+itemt.name+'</td><td>'+itemt.mag_name+'</td><td>'+itemt.duration+' Months'+'</td><td>'+itemt.mobile+'</td><td  id="id'+itemt.user_id+'" style="display:none"><button  class="btn btn-success" onclick="eiting('+itemt.user_id+')">Update</button></td></tr>');																										
								});
						}
					})	;	
			}			
		});
	}
</script>