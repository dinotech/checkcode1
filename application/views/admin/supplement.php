
<?php //echo'<pre>';print_r($row); echo'</pre>';
$this->load->view('admin/my_header.php'); ?>
<!-- Content Section Start -->
<div class="content-section">
    <div class="container-liquid">
        <div class="row">
            <div class="col-xs-12">
                <div class="sec-box">                   
                    <header>
                        <h1 class="heading">Supplement</h1>
                    </header>
                    <div class="contents">                       
                        <form action="<?php echo base_url(); ?>admin/magazine/supplemented" enctype="multipart/form-data" method="post">
                        <input type="hidden" id="parentid" name="parentid" value="<?php echo $_GET['magzid']?>" />
                            <div class="table-box">
                                <table class="table">
                                    <tbody class="col-md-11 col-md-offset-1">
                                        <tr>
                                        	<td class="col-md-1">Supplement Name</td>
                                            <td class="col-md-5"><input type="text" class="form-control" required="required" name="supname"></td>
                                        </tr>
                                        <tr class="col-md-12">
                                            <td class="col-md-1">Supplement with</td>                                            
                                            <td class="col-md-3">
                                                <select id="volume" name="volume" required class="form-control" >
                                                    <option style="text-align:center" value=""><--- Select the Volume of Magazine ---></option>                                                    
                                                <?php
													foreach($row as $data){
												?>
                                                    <option value="<?php echo $data['vol_num'];?>"><?php echo $data['vol_num'];?></option>
                                                <?php
													}
												?>
                                                </select>
                                            </td>
                                            <td class="col-md-3">
                                                <select id='issue' name="issue" required  placeholder="" class="form-control">
                                                    <option value=""><--- Select the Issue of the Magazine ---></option>												                               
                                                <?php
												if(isset($issue))
												  {
													foreach($issue as $data1)
													{
												?>
                                                    <option class="new" value="<?php echo $data1['issue_num'];?>"><?php echo $data1['issue_num'];?></option>
                                                <?php
													}
												  }
												?>
                                                </select>
                                            </td>
                                        </tr>                                        
                                        <tr class="col-md-12">
                                            <td>Magazine Image</td>
                                            <td><input type="file" required="required" name="magvolimg"></td>
                                        </tr>
                                        <tr class="col-md-12">
                                            <td>Magazine</td>
                                            <td><input type="file" required="required" name="magvol" id="magvol" ></td>
                                        </tr>
                                        <tr>    
                                        	<td class="col-md-offset-2">                                                                                    
                                                <button name="submit" class="btn btn-success">Preview</button>                                            
                                            </td>
                                        </tr>                                
                                    </tbody>
                            	</table>
                            </div>
                        </form>                                                
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
<script>
$(document).ready(function(e) {
    $('#volume').change(function(e) {	
		$('#issue').find("option.new").remove();	
		var volid=$('#volume').val();
		var parentid = $('#parentid').val();
		
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
});

</script>
</body>
</html>
