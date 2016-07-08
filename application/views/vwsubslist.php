<?php $this->load->view('vwHeader');?>
<style>td,th{padding:15px;}#delete1{display:none;	}</style>
<div class="heading">
<h3>Subscriber List</h3>
</div>
<div class="container newsub">

	<div class="row"><div id="results" class="col-sm-8 col-sm-offset-2" style="text-align:center; font-size:18px"></div>        
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
            	     <div id="dow" class="col-sm-11" style="margin-top:2%;">
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
	function changei(dats)
	{ 
	var dats2 = $('#'+dats).val();	
		$.ajax({
			url:'<?php echo base_url()?>mysubscription/check',
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
					url:'<?php echo base_url()?>mysubscription/updatemail',
					type:'post',
					data:'mail='+newemail+'&uid='+uid,
					success:function(data)
					{
						$('#results').css('background-color',"#CCC")
						$('#results').html('Request for Email updation added Successfully !!!');
					}
			});
		}
		else
		{
			alert('Please enter Email-id');
		}
	}

	function chang(data)
	{
$('.b6').html('');
		$.ajax({
			url:'detail',
			type:'post',
			data:'data='+data,
			success:function(data){
					var abhi = JSON.parse(data);
					jQuery.each(abhi, function(index, itemt) {																		
						if(index ==0)
						{
							var count6 = abhi[0].length; 
												
								jQuery.each(abhi[0], function(index, itemt) {		
								//alert(itemt)	;																																				
								$('.b6').append('<tr><td><input type="text" class="form-control" required=required data-id="'+itemt.email_id+'" id="'+itemt.user_id+'" onchange="changei('+itemt.user_id+')"  value="'+itemt.email_id+'"></td><td>'+itemt.name+'</td><td>'+itemt.mag_name+'</td><td>'+itemt.duration+' Months'+'</td><td>'+itemt.mobile+'</td><td  id="id'+itemt.user_id+'" style="display:none"><button  class="btn btn-success" onclick="eiting('+itemt.user_id+')">Update</button></td></tr>');																										
								});
						}
					})	;	
			}			
		});
	}
</script>