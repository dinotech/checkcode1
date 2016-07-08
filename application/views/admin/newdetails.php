<?php 
//echo'<pre>';print_r($row);echo'</pre>';
$this->load->view('admin/my_header.php'); ?>
            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="sec-box">
                                <header>
                                    <h1 class="heading">Franchise  New  Profile </h1>
                                </header>
                                <div class="contents">
                                   
                                  
                                    <div class="table-box" >
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Description</th>
                                                    <th class="col-md-8">Form Elements</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-4">F_code </td>
                                                    <td class="col-md-8"><input type="text" readonly name="fcode" value="<?php echo $row[1][0]['code']?>" placeholder="" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">F_name</td>
                                                  <td class="col-md-8"><input type="text" readonly name="fname" value="<?php echo $row[1][0]['name']?>" placeholder="" class="form-control" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Email Id</td>
                                                  <td class="col-md-8"><input type="text" readonly name="emailid" value="<?php echo $row[1][0]['email_id']?>" placeholder="" class="form-control"></td>
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Address line</td>
                                                    <td class="col-md-8"><input type="text" readonly name="address" value="<?php echo $row[1][0]['address']?>" placeholder="" class="form-control"></td>                                                     
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">City</td>
                                                    <td class="col-md-8"><input type="text" readonly name="city" value="<?php echo $row[1][0]['city']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">State</td>
                                                    <td class="col-md-8"><input type="text" readonly name="state" value="<?php echo $row[1][0]['state']?>" placeholder="" class="form-control"></td>   
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Country</td>
                                                    <td class="col-md-8"><input type="text" readonly name="country" value="<?php echo $row[1][0]['country']?>" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Phone</td>
                                                    <td class="col-md-8"><input type="text" readonly name="mob" value="<?php echo $row[1][0]['mobile']?>" placeholder="" class="form-control"></td>
                                                 </tr>
                                                 <tr><td colspan="2"><h2>Proprietor Contact</h2></td></tr>
                                                  <tr>
                                                    <td class="col-md-4">Name</td>
                                                    <td class="col-md-8"><input type="text" readonly name="propname" value="<?php echo $row[0][0]['fr_Name']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Mobile</td>
                                                    <td class="col-md-8"><input type="text" readonly name="propmob" value="<?php echo $row[0][0]['fr_mobile']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                  <tr>
                                                    <td class="col-md-4">Email</td>
                                                    <td class="col-md-8"><input type="text" readonly name="propemail" value="<?php echo $row[0][0]['fr_email']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                  <tr>
                                                    <td class="col-md-4">Address</td>
                                                    <td class="col-md-8"><input type="text" readonly name="propadddr" value="<?php echo $row[0][0]['fr_address']?>" placeholder="" class="form-control"></td>                                                   
                                                </tr>
                                                 <tr>
                                                 	<td>
                                                    		<div class="col-sm-12" style=" border:solid 2px #000; padding-bottom:20px;">
                                                            		<div style=" border-bottom:solid 2px #000">Old </div>
                                                                    <div><label>Bank Account</label></div>
                                                                    <div><label>Account Name:</label><?php echo $row[0][0]['fr_accname']?></div>
                                                                    <div><label>Number:</label><?php echo $row[0][0]['fr_accno']?></div>
                                                                    <div><label>Bank name:</label><?php echo $row[0][0]['fr_bankname']?></div>
                                                                    <div><label>Branch:</label><?php echo $row[0][0]['fr_branch']?></div>
                                                                    <div><label>IFSC:</label><?php echo $row[0][0]['fr_ifsc']?></div>
                                                                    
                                                                    </div>
                                                            </div>
                                                    </td>
                                                    <td>
                                                    <div class="col-sm-6" style=" border:solid 2px #000; padding-bottom:20px;">
                                                    		<div style=" border-bottom:solid 2px #000">New </div>
                                                      
                                                            <div><label>Bank Account</label></div>
                                                            <div><label>Account Name:</label><?php echo $row[0][0]['temp_accname']?></div>
                                                            <div><label>Number:</label><?php echo $row[0][0]['temp_accno']?></div>
                                                            <div><label>Bank name:</label><?php echo $row[0][0]['temp_bankname']?></div>
                                                            <div><label>Branch:</label><?php echo $row[0][0]['temp_bankbranch']?></div>
                                                            <div><label>IFSC:</label><?php echo $row[0][0]['temp_bankifsc']?></div>
                                                      <form id="form456" action="frenchiseupd" method="post">     
                                                           			<input type="hidden" name="updid" value="<?php echo $row[1][0]['code']?>" >
                                                                    <input type="hidden" name="newaccname" value="<?php echo $row[0][0]['temp_accname']?>" >
                                                                    <input type="hidden" name="newaccno" value="<?php echo $row[0][0]['temp_accno']?>" >
                                                                    <input type="hidden" name="newbnkname" value="<?php echo $row[0][0]['temp_bankname']?>" >
                                                                    <input type="hidden" name="newbrnch" value="<?php echo $row[0][0]['temp_bankbranch']?>" >
                                                                    <input type="hidden" name="newifsc" value="<?php echo $row[0][0]['temp_bankifsc']?>" >
                                                            		<input type="submit" class="btn btn-success" name="action" value="Approve">  /                                                                                                                                                             			      
                                                                    <input type="submit" class="btn btn-danger" name="action"  value="Reject">
                                                           </form>
                                                    </div>
                                                    </td>
                                                 </tr>                                                                                                                               
                                            </tbody>
                                    
                                </div>
                            </div>
                                                    </div>
                    </div>
                    <!-- row[0] End -->
                </div>
            </div>
            <!-- Content Section End -->
        </div>
        <!-- Right Section End -->
    </div>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
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
<script>
	function submiting()
	{
			$('#form456').submit();	
	}
</script>
</body>
</html>
