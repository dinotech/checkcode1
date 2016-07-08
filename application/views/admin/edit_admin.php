
<?php  $this->load->view('admin/my_header.php');?>
<div class="error " >

<?php echo validation_errors(); ?>
</div>
            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                               <h1 class="heading">Edit Admin Profile </h1>
                               
                                <div class="contents">
                                   
                                    <form action="<?php echo base_url(); ?>admin/admin_profile/save_edit" enctype="multipart/form-data" method="post">
                                    
                                    <div class="table-box col-lg-10 col-lg-offset-1">
                                        <table class="table">
                                               <tbody>
                                            
                   <?php foreach($row as $rows)
				   {
					   
						//	echo '<pre>';print_r($rows);die;
					?>                         
                                                <tr>
                                                    <td class="col-md-4">Name</td>
                                                  <td class="col-md-8">
                                                  <input type="hidden" name="id"   value="<?php echo $rows['id'] ?>"/>
                                                  <input type="text" name="username" value="<?php echo $rows['username']?>" placeholder="" class="form-control"></td>
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Email</td>
                                                    <td class="col-md-8"><input type="text" name="email" value="<?php echo $rows['email']?>" placeholder="" class="form-control" readonly="readonly"></td>
                       
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Mobile No.</td>
                                                    <td class="col-md-8"><input type="text" name="mobile_no" value="<?php echo $rows['mobile_no']?>" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                <tr id="show">
                                                    <td class="col-md-4" colspan="2">Address  ( Click to view Address details)</td>
                                                </tr >
                                                 <tr class="hiddenq">
                                                    <td class="col-md-4">Address</td>
                                                    <td class="col-md-8"><input type="text" name="address" required="required" value="<?php echo $rows['address']?>" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr >
                                                  <tr class="hiddenq">
                                                    <td class="col-md-4">Country</td>
                                                    <td class="col-md-8"> <input type="text" name="country" required="required" value="<?php echo $rows['country']?>" placeholder="" class="form-control">
</td>
                                                        
                                                   
                                                </tr>
                                                 <tr class="hiddenq">
                                                    <td class="col-md-4">State</td>
                                                    <td class="col-md-8"><input type="text" name="state" required="required" value="<?php echo $rows['state']?>" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                <tr class="hiddenq">
                                                    <td class="col-md-4">District</td>
                                                    <td class="col-md-8"><input type="text" name="district"  value="<?php echo $rows['district']?>" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                
                                                 <tr class="hiddenq">
                                                    <td class="col-md-4">City</td>
                                                    <td class="col-md-8"> <input type="text" name="city"  required="required"value="<?php echo $rows['city']?>" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                 <tr id="show1">
                                                    <td colspan="2"> Change Password  (Click to Change Password )</td>                                                    
                                                </tr>
                                                 <tr class="hiddenq1">
                                                    <td class="col-md-4">Current Password</td>
                                                    <td class="col-md-8"><input type="text" name="password" value="" placeholder="Enter Current Password" class="form-control" ></td>                                                    
                                                </tr>
                                                 <tr class="hiddenq1">
                                                    <td class="col-md-4">New Password</td>
                                                    <td class="col-md-8"><input type="text" name="new_pass" value="" placeholder="Enter New Password If You Want To Change Existing Password !" class="form-control"></td>
                                                </tr>
                                               <?php /*?> <tr>
                                                    <td class="col-md-4">Role </td>
                                                    <td class="col-md-8"><select  name="role"  placeholder="" class="form-control">
            <option  value="co-admin" selected="selected">Co-admin</option>
           </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Status</td>
                                                    <td class="col-md-8">
            <select  name="status"  placeholder="" class="form-control">
            <option <?php  if($rows['status'] ==1){ echo 'selected="selected"'; }?> value="1">Active</option>
            <option <?php  if($rows['status'] ==0){echo 'selected="selected"'; }?> value="0">Inactive</option></select></td>                                                        
                                                </tr><?php */?>
                  <?php }?>                              
                                         
                                                    
                                                 <tr>
                                                 		<td colspan="2" style="text-align:center">
                                                            <input type="submit" value="submit" name="save" class="btn btn-success">
                                                        </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                        </div>
                                    </form>
                                    </div><!--<a style="float:right;font:Arial, Helvetica, sans-serif;font-size:18px;padding-right:20px;" href="datatables.php"><b>View</b></a>-->
                                    <div class="clearfix"></div>
                                    
                                </div>
                            </div>
                                                    </div>
                    </div>
                    <!-- Row End -->
                </div>
            </div>
            <!-- Content Section End -->
        </div>
        <!-- Right Section End -->
    </div>
</div>
<!-- Wrapper End -->

<!--<script>
$( document ).ready(function() {
   $( ".error p" ).addClass("bg-danger");
  
   
  });
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42761673-1', 'extracoding.com');
  ga('send', 'pageview');

</script>-->
<script type="text/javascript">     
 
            $('#show').click(function(e) {
				
            	$('.hiddenq').toggle(1000);	    
            });
			$('#show1').click(function(e) {
            	$('.hiddenq1').toggle(1000);	    
            });
    
</script>
</body>
</html>
