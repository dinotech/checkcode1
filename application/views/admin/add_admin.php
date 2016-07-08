<?php  $this->load->view('admin/my_header.php');?>

            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                               <div class="error " >

<?php echo validation_errors(); ?>
</div>
                                <h3 class="heading">Add Admin </h3>
                                
                                <div class="contents">
                                   
                                    <form action="<?php echo base_url(); ?>admin/admin_profile/add_admin" enctype="multipart/form-data" method="post">
                                    <div class="table-box col-lg-10 col-lg-offset-1" >
                                        <table class="table datatable ">
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-4">Email</td>
                                                    <td class="col-md-8"><input type="text" id="email" name="email" value=""  required class="form-control"></td>
                                                </tr>
                                               
                                               
                                                <tr>
                                                    <td class="col-md-4">Password</td>
                                                  <td class="col-md-8"><input type="text" name="password" value=""  required class="form-control"></td>
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Confirm Password</td>
                                                    <td class="col-md-8"><input type="text" name="confirm_password" value=""  required class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Name</td>
                                                    <td class="col-md-8"><input type="text" name="name" value=""  required class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Mobile Number</td>
                                                    <td class="col-md-8"><input type="text" name="mob_no" value=""  required class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Address</td>
                                                    <td class="col-md-8"><input type="text" name="address" value=""  required class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                  <tr>
                                                    <td class="col-md-4">Country</td>
                                                    <td class="col-md-8"> 
                                                    <select name="country"  required class="countries form-control " id="countryId">
		                                                    <option value="">Select Country</option>
                                                    </select>
</td>
                                                </tr>
                                                  <tr>
                                                    <td class="col-md-4">State</td>
                                                    <td class="col-md-8">
                                                    <select name="state" required class="states form-control " id="stateId">
		                                                    <option value="">Select State</option>
                                                    </select>
</td>
                                                </tr>                                                
                                                  <tr>
                                                    <td class="col-md-4">City</td>
                                                    <td class="col-md-8">  
                                                    <select name="city" required class="cities form-control" id="cityId">
		                                                    <option value="">Select City</option>
                                                    </select>
</td>
                                                </tr>
                                                  <tr>
                                                    <td class="col-md-4">Pincode</td>
                                                    <td class="col-md-8"><input type="text" name="pincode" value="" required="required" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Role</td>
                                                    <td class="col-md-8">
                                                    <select  name="role" required class="form-control">
                                                            <option  value="co-admin" selected="selected">Admin</option>                                                                                                                                                                                                                                                                     
                                                     </select>       
                                                </tr>
                                               
                                                 <tr>
                                                    <td class="col-md-4">status</td>
                                                    <td class="col-md-8"> <select  name="status" required class="form-control">
            <option value="1" >Active</option>
            <option value="0" >InActive</option></select></td>                                           
                                                   
                                                </tr>
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

<script>
$( document ).ready(function() {
   $( ".error p" ).addClass("bg-danger");
  $('#email').focusout(function(e) {
	  $( ".error " ).html('');
		var email = $('#email').val();
		console.log(email);
		$.ajax({
			url: '<?php echo base_url(); ?>admin/admin_profile/uniquemail',
			type:'POST',
			data:'email='+email,
			success:function(data){
					console.log(data);
					if(data > 0)
					{
						var q = 'Email-id already Registered Please Enter different Email-id';
						$( ".error " ).append('<p>'+q+'</p>')
						$('#email').val('');
					}
			}
		});
});  
   
  });
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42761673-1', 'extracoding.com');
  ga('send', 'pageview');

</script>

</body>
</html>
