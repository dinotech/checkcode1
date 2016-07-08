<?php 
//echo'<pre>';print_r($user);echo'</pre>';
$this->load->view('admin/my_header.php'); ?>
            <!-- Content Section Start -->
<div class="content-section">
    <div class="container-liquid">
        <div class="row">
            <div class="col-sm-12">
                <div class="sec-box">
                    <header>
                        <h1 class="heading"><?php if($user=='franchise'){?>Franchise Profile<?php }else if($user=='executive'){?>Executive Profile<?php } ?> </h1>
                    </header>
                    <div class="contents">                   
							<div class="table-box" style="margin-top:3%">
									<div class="col-sm-10 col-sm-offset-1"  style="margin-bottom:3%">
                                        <div class="col-sm-6"><label class="col-sm-3">Search by</label><div class="col-sm-8"><input type="text" class="form-control" id="searched" /></div></div>
                                        <div style="margin-left:10px; float:left"><button class="btn btn-success" id="Co" name="Country" onclick="searching(this.id)">Country</button></div>
                                        <div style="margin-left:10px; float:left"><button class="btn btn-success" id="St" name="State" onclick="searching(this.id)">State</button></div>
                                        <div style="margin-left:10px; float:left"><button class="btn btn-success"  id="Ci" name="City" onclick="searching(this.id)">City</button></div>
                                        <div style="margin-left:10px; float:left"><button class="btn btn-success"  id="Ac" name="Active" onclick="searching(this.id)">Active</button></div>
                                        <div style="margin-left:10px; float:left"><button class="btn btn-success"  id="In" name="In" onclick="searching(this.id)">Inactive</button></div>
							</div>
							<input type="hidden" id="subsc" value="<?php echo $user?>" />
							<table class="col-lg-10 table table-bordered" id="example">
                                        <thead>
                                                <tr>                              
                                                        <th><?php if($user=='franchise'){?>Franchise <?php }else if($user=='executive'){?>Executive <?php } ?>Code</th>
                                                        <th><?php if($user=='franchise'){?>Franchise<?php }else if($user=='executive'){?>Executive<?php } ?>_name</th>
                                                        <th>City</th>
                                                        <th>Deactivate / Inactive</th>
                                                </tr>
                                        </thead>
                                        <tbody class="result">
                                        <?php foreach($row as $rows){?>
                                                <tr>
                                                        <td><a href="<?php echo base_url()?>admin/createlogin/showprofile?id=<?php echo $rows['user_id']?>"><div><?php echo $rows['code']?></div></a></td>
                                                        <td><a href="<?php echo base_url()?>admin/createlogin/showprofile?id=<?php echo $rows['user_id']?>"><div><?php echo $rows['name']?></div></a></td>
                                                        <td><a href="<?php echo base_url()?>admin/createlogin/showprofile?id=<?php echo $rows['user_id']?>"><div><?php echo $rows['city']?></div></a></td>                                
                                                        
                                                        <td><div><?php  if($rows['status'] ==1){ echo 'Active ';echo '&nbsp;'?><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#myModal" onclick="sendid(<?php echo $rows['user_id']?>)"><?php echo 'Inactive?'?></button><?php }else if($rows['status'] ==0){ echo'Waiting for Approval';} else  if($rows['status'] ==3){echo 'Inactive'; }?></div></td>                                                              
                                                        <?php /*echo base_url(); ?>admin/datatables/edit_user?id=<?php echo $rows['user_id']?>"><button type="button" class="btn btn-success">Edit</button></a></td>                                */?>
                                                </tr>
                                                <?php } ?>                                            
                                        </tbody>
                                </table>
								
                    </div>
                </div><div class="clearfix"  style="padding-bottom:5%;"></div>
            </div>
        </div>
    </div>    							
</div>
	 
</div>
<div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                                    <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Confirmation</h4>
                                                    </div>
                                                    <div class="modal-body">
	                                                      <p>Are You sure to  Make the <?php if($user=='franchise'){?>Franchise<?php }else if($user=='executive'){?>Executive<?php } ?> Inactive</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="<?php echo base_url()?>admin/createlogin/eidtuser">
                                                                <input type="hidden" id="exeid" name="exeid" />
                                                                  <button type="submit" class="btn btn-success" >Yes</button>          
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                         </form> 
                                                    </div>
                                          </div>
                                        </div>
							   </div>
<script>
function sendid(id)
{
	$('#exeid').val(id)
}
	function  searching(obj)
	{
		var items = $('#searched').val();
		var user = $('#subsc').val();
		$('.result').html('');
			$.ajax({
				url:'<?php echo base_url()?>admin/createlogin/search',
				type:'post',
				data:'obj='+obj+'&item='+items+'&user='+user,
				success:function(data)
				{
						var abhi = JSON.parse(data);						
						var count = abhi.length;
						jQuery.each(abhi, function(index, itemt) {		
						if(itemt.status==1){					
								$('.result').append('<tr>'+'<td>'+itemt.code +'</td>'+'<td >'+itemt.name+'</td>'+'<td >'+itemt.city+'</td>'+'<td>'+'<button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModal" onclick="sendid('+itemt.user_id+')">Active</button>'+'</td>');
						}
						if(itemt.status==3){
									$('.result').append('<tr>'+'<td>'+itemt.code +'</td>'+'<td >'+itemt.name+'</td>'+'<td >'+itemt.city+'</td>'+'<td>'+'Inactive'+'</td>');
						}	
						})		
				},				
			});			
	}
</script>
</body>
</html>
