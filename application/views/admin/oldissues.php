<?php  $this->load->view('admin/my_header.php');?>
<!-- Content Section Start -->
<div class="content-section">
    <div class="container-liquid">
        <div class="row">
            <div class="col-xs-12">
                <div class="sec-box">                   
                    <header>
                        <h1 class="heading">View Issues of Magazine </h1>
                    </header>
                    <div class="contents">                       
                        <input type="hidden" id="parentid" name="parentid" value="<?php echo $_GET['magzid']?>" />
                        
                        
                            <div class="table-box">
                                <table class="table">
                                    <tbody>
	                                	 <tr class="col-md-6 col-md-offset-2">                                          
                                                <td><select id="volume" name="volume" required="required"  placeholder="" class="form-control">
                                                    <option value="" style="text-align:center"><---- Select the Volume of Magazine fgdfg----></option>                                                    
                                                <?php
													foreach($row as $data){
												?>
                                                    <option value="<?php echo $data['vol_num'];?>"><?php echo $data['vol_num'];?></option>
                                                <?php
													}
												?>
                                                </select></td>
                                         
                                        </tr>
                                        <tr class="col-md-6 col-md-offset-2">
                                        	
                                                <td><select id='issue' name="issue" required class="form-control">
                                                    <option value=""><--- Select the Issue of the Magazine ---></option>												                               
                                                <?php
												if(isset($issue))
												  {
													foreach($issue as $data1){
												?>
                                                    <option class="new" value="<?php echo $data1['issue_num'];?>"><?php echo $data1['issue_num'];?></option>
                                                <?php
													}
												  }
												?>
                                                </select></td>
                                            </tr>
                                       
                                        <tr class="col-md-4 col-md-offset-4">
                                        
                                          <td>   <button type="button" id="formcheck" onclick="check()" class="btn btn-success"><b>View</b></button>
                                            </td></tr>
                                         <input type="hidden" id='magid' value="<?php echo $_GET['magzid']?>">                                                                   
                                    </tbody>
                            	</table>
                            </div>
                                                                        
                        <div class="clearfix">
                        </div>                        
                    </div>
                </div>
             </div>
        </div>
        <!-- Row End -->
    </div>
</div>
<!-- Wrapper End -->
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script>

    $('#volume').change(function(e) {	
		$('#issue').find("option.new").remove();	
		var volid=$('#volume').val();
		var parentid = $('#parentid').val();
		//alert(parentid);
		$.ajax({
			url: '<?php echo base_url(); ?>admin/magazine/volumedetails',
			type:'POST',
			data:'volid='+volid+'&parentid='+parentid,
			success:function(data){
				$.each(data, function(i, data){
            $('#issue').append("<option class='new' value='"+data.issue_num+"'>"+data.issue_num+"</option>");
            });
				
			}
		});
    });


function check(){
//alert($('#magid').val()+' & '+$('#issue').val()+' & '+$('#volume').val());
$.ajax({
	url:'<?php echo base_url(); ?>admin/magazine/particularmag',
	type:'post',
	data:'mag='+$('#magid').val()+'&vol='+$('#volume').val()+'&issue='+$('#issue').val(),
	success:function(data)
	{
                var q = $.parseJSON(data);
//alert(q);
		window.location.href = "<?php echo base_url()?>admin/read?mag="+q.issue_name+"&action=read";
	}
});

}
</script>
</body>
</html>
