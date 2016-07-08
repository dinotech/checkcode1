<?php 
//echo'<pre>';var_dump($use);echo'</pre>';
$this->load->view('admin/my_header.php'); ?>
<div class="error " >
	<?php echo validation_errors(); ?>
</div>
            <!-- Content Section Start -->
<div class="content-section">
    <div class="container-liquid">
        <div class="row">
            <div class="col-xs-12">
                <div class="sec-box">
                            <header>
                                <h1 class="heading">Business Report</h1>
                            </header>
                            <div class="container newsub" style="margin-bottom:5%">
                                <div class="row">
                                    <div class="col-md-8">            
                                                <div class="col-xs-4">
                                                    <label>Select a <?php if($use =='franchise'){ echo'Franchise';} else if($use =='executive'){ echo'Executive';}?></label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control" id="franchise" onChange="allq()">
                                                        <option value=""><------------   Select   -----------></option>
                                                        <?php foreach($user[0] as $data){?>
                                                        <option value="<?php echo $data['user_id']?>"><?php echo $data['name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div> 
                                        </div>        
                                        <div class="col-md-12" style="margin-top:20px;">
                                        
                                                <div class="col-sm-3">
                                                    <label>Select Time Period:</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" id="sdate" class="dpick form-control" name="startdate" placeholder="Enter Starting Date"  onchange="allqwidate()" />
                                                </div> 
                                                <div class="col-sm-1" style="text-align:center; padding-top:10px">
                                                    TO
                                                </div>
                                                <div class="col-sm-3">    
                                                    <input type="text" id="edate" class="dpick  form-control" name="enddate" placeholder="Enter Ending Date"  onchange="allqwidate()"/>
                                                </div>    
                                        </div>
                                    <input type="hidden" id="fid" name="fid" value="<?php echo $this->session->userdata('id')?>">
                                    <div align="center" class="col-md-12" style="margin-top:5%;">
                                                <table class="table " border="2" align="center">
                                                        <thead>
                                                            <tr>
                                                                    <th>MagazineName</th>
                                                                    <th>No of sub scribers</th>
                                                                    <th>No of issues </th>
                                                                    <th>Total amount</th>
                                                                    <th>Payback</th>                                        
                                                             </tr>                		
                                                        </thead>
                                                        <tbody class="result">                                                        
                                                           <tr style="border-top:solid 2px #000;border-bottom:solid 2px #000"><td colspan="5" style="text-align:center; font-size:16px"><h2>Please Select a Subscriber</h2></td></tr>     
                                                        </tbody>
                                                </table>
                                        </div>
                                </div>
                            </div>
                 </div>
			</div>
		</div>
	</div>
</div>                            
<script>
	function allq()
	{
		$('.result').html('');
			$.ajax({
						url: '<?php echo base_url(); ?>admin/datatables/findallrecords',
						type:'post',
						data:'fid='+$('#franchise').val(),
						success: function(data){		
								//alert(data);	
								var tmag=0; var tsubs=0;var tissue=0;var amount=0;	var tpayback=0;
								var abhi = jQuery.parseJSON(data);				
								var count = 0;
								if(data != 0)
								{
										jQuery.each(abhi, function(index, itemt) {	
																	tsubs += itemt.users;
																	tissue += itemt.dur;
																	amount += itemt.amt;
																	tpayback += 0;
																	count++;
												$('.result').append('<tr>'+'<td>'+index+'</td>'+'<td>'+itemt.users +'</td>'+'<td >'+itemt.dur+'</td>'+'<td >'+itemt.amt+'</td>'+'<td>'+'0'+'</td>');							
										})		
								}
								else if (data == 0)
								{
										$('.result').append('<tr>'+'<td colspan="5">'+'<h2 style="text-align:center">No Magazine Subscribed </h2>'+'</td>');								
								}
								$('.result').append('<tr style=" border-bottom:solid 2px #000;"><td>'+'<b>Total Magazine: </b>'+count+'</td>'+'<td>'+'<b>Total Subscriber: </b>'+tsubs+'</td>'+'<td >'+'<b>Total Issues: </b>'+tissue+'</td>'+'<td >'+'<b>Total Amount: </b>'+amount+'</td>'+'<td>'+'<b>Total Payback: </b>'+tpayback+'</td>');									
						},
						
				});
	}
function allqwidate()
	{
		var start = $('#sdate').val();
		var end = $('#edate').val();		
		$('.result').html('');
		if(start!='' && end!='')
		{
			$.ajax({
						url: '<?php echo base_url(); ?>admin/datatables/findallrecordswidate',
						type:'post',
						data:'fid='+$('#franchise').val()+'&sdate='+$('#sdate').val()+'&edate='+$('#edate').val(),
						success: function(data){		
						//alert(data);				
						var abhi = JSON.parse(data);						
						var count = abhi.length;
						var tmag=0; var tsubs=0;var tissue=0;var amount=0;	var tpayback=0;
						var count = 0;	
						if(data.length == 2)
						{
								$('.result').append(' <tr style=" border-bottom:solid 2px #000;"><td colspan="5"><h2 style="text-align:center">No Magazine Subscribed </h2></td></tr>')
						}
						else
						{		
								jQuery.each(abhi, function(index, itemt) {	
										tsubs += itemt.users;
										tissue += itemt.dur;
										amount += itemt.amt;
										tpayback += 0;
										count++;						
										$('.result').append('<tr>'+'<td>'+index+'</td>'+'<td>'+itemt.users +'</td>'+'<td >'+itemt.dur+'</td>'+'<td >'+itemt.amt+'</td>'+'<td>'+'0'+'</td>');
						})
						

						}	$('.result').append('<tr style=" border-bottom:solid 2px #000;"><td>'+'<b>Total Magazine: </b>'+count+'</td>'+'<td>'+'<b>Total Subscriber: </b>'+tsubs+'</td>'+'<td >'+'<b>Total Issues: </b>'+tissue+'</td>'+'<td >'+'<b>Total Amount: </b>'+amount+'</td>'+'<td>'+'<b>Total Payback: </b>'+tpayback+'</td></tr>');																																																			
					}		
				});
		}
		if(start!='' && end=='')
		{
			$.ajax({
						url: '<?php echo base_url(); ?>admin/datatables/findallrecordswidate',
						type:'post',
						data:'fid='+$('#franchise').val()+'&sdate='+$('#sdate').val()+'&edate='+$('#sdate').val(),
						success: function(data){												
								var abhi = JSON.parse(data);						
								var count = 0;
								var tmag=0; var tsubs=0;var tissue=0;var amount=0;	var tpayback=0;		
								if(data.length == 2)
								{
										$('.result').append('<tr style=" border-bottom:solid 2px #000;"><td colspan="5"><h2 style="text-align:center">No Magazine Subscribed </h2></td></tr>')
								}
								else
								{		
										jQuery.each(abhi, function(index, itemt) {	
											tsubs += itemt.users;
												tissue += itemt.dur;
												amount += itemt.amt;
												tpayback += 0;
												count++;								
												$('.result').append('<tr>'+'<td>'+index+'</td>'+'<td>'+itemt.users +'</td>'+'<td >'+itemt.dur+'</td>'+'<td >'+itemt.amt+'</td>'+'<td>'+'0'+'</td>');						
								})
								
								}	
								$('.result').append('<tr style=" border-bottom:solid 2px #000;"><td>'+'<b>Total Magazine: </b>'+count+'</td>'+'<td>'+'<b>Total Subscriber: </b>'+tsubs+'</td>'+'<td >'+'<b>Total Issues: </b>'+tissue+'</td>'+'<td >'+'<b>Total Amount: </b>'+amount+'</td>'+'<td>'+'<b>Total Payback: </b>'+tpayback+'</td>');																																																			
					}		
				});
		}
	}		$(document).ready(function() {
	      	$( ".dpick" ).datepicker({dateFormat: 'yy-mm-dd'});
    }); 
</script>
 