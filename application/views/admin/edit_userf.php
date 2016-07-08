<?php 
//echo'<pre>';print_r($row);die;
$this->load->view('admin/my_header.php'); ?>
            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="sec-box">
                              
                                    
<?php 
	if($row[0]['role']=='franchise')
	{ 
?>
		<h1 class="heading">Franchise Profile</h1> 
<?php	}else if($row[0]['role']=='executive')
	{
?> 
	<h1 class="heading">Executive Profile</h1> 
<?php
	} 
?>
                                
                                <div class="contents">
                                   
                                    <form action="<?php echo base_url(); ?>admin/datatables/save_edit" enctype="multipart/form-data" method="post">
                                    <div class="table-box" >
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Description</th>
                                                    <th class="col-md-8">Form Elements</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                   <?php foreach($row as $rows){?>                         
                                                <tr><input type="hidden" name="user_id" value="<?php echo $rows['user_id']?>" >
                                                    <td class="col-md-4">F_code </td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="fcode" value="<?php echo $rows['code']?>" placeholder="" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">F_name</td>
                                                  <td class="col-md-8"><input type="text" readonly="readonly" name="fname" value="<?php echo $rows['name']?>" placeholder="" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Email Id</td>
                                                  <td class="col-md-8"><input type="text" readonly="readonly" name="emailid" value="<?php echo $rows['email_id']?>" placeholder="" class="form-control"></td>
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Address line</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="address" value="<?php echo $rows['address']?>" placeholder="" class="form-control"></td>                                                     
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">City</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="city" value="<?php echo $rows['city']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">State</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="state" value="<?php echo $rows['state']?>" placeholder="" class="form-control"></td>   
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Country</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="country" value="<?php echo $rows['country']?>" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Phone</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="mob" value="<?php echo $rows['mobile']?>" placeholder="" class="form-control"></td>
                                                 </tr>
<?php if($row[0]['role']=='franchise'){?>
                                                 <tr><td colspan="2"><h2>Proprietor Contact</h2></td></tr>
                                                  <tr>
                                                    <td class="col-md-4">Name</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="propname" value="<?php echo $rows['fr_Name']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Mobile</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="propmob" value="<?php echo $rows['fr_mobile']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                  <tr>
                                                    <td class="col-md-4">Email</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="propemail" value="<?php echo $rows['fr_email']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                  <tr>
                                                    <td class="col-md-4">Address</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="propadddr" value="<?php echo $rows['fr_address']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                 <tr><td><h2>Bank Account</h2></td></tr>
                                                 <tr>
                                                    <td class="col-md-4">Account Name</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="paymethod" value="<?php echo $rows['fr_accname']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Number</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="paymethod" value="<?php echo $rows['fr_accno']?>" placeholder="" class="form-control"></td>                                                   
                                                 </tr>
                                                 <tr>
                                                    <td class="col-md-4">Bank Name</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="paymethod" value="<?php echo $rows['fr_bankname']?>" placeholder="" class="form-control"></td>                                                   
                                                 </tr>
                                                 <tr>
                                                    <td class="col-md-4">Branch</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="paymethod" value="<?php echo $rows['fr_branch']?>" placeholder="" class="form-control"></td>                                                   
                                                 </tr>
                                                 <tr>
                                                    <td class="col-md-4">IFSC</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="paymethod" value="<?php echo $rows['fr_ifsc']?>" placeholder="" class="form-control"></td>                                                   
                                                 </tr>                                                 
                  <?php }}if($row[0]['role']=='executive'){?>                        
                                                 <tr>
                                                    <td class="col-md-4">Alternate Contact no</td>
                                                    <td class="col-md-8"><input type="text" readonly="readonly" name="paymethod" value="<?php echo $rows['Altnum']?>" placeholder="" class="form-control"></td>                                                   
                                                 </tr>  
                  <?php } ?>                                             
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                 </div> <div class="clearfix"></div>
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
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42761673-1', 'extracoding.com');
  ga('send', 'pageview');

</script>
-->
</body>
</html>
