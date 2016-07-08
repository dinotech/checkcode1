
<?php  $this->load->view('admin/my_header.php');?>

            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                               <h1 class="heading">Edit Payment </h1>
                          
                                <div class="contents">
                                   
                                    <form action="<?php echo base_url(); ?>admin/payment/save_edit" enctype="multipart/form-data" method="post">
                                    <div class="table-box">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Description</th>
                                                    <th class="col-md-8">Form Elements</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                   <?php foreach($row as $rows){
		 $var1 = unserialize($rows['payment_details']);  
		//echo '<pre>';print_r($rows);die;
		?>                         
                                                <tr>
                                                    <td class="col-md-4">Email</td>
                                                    <td class="col-md-8"><input readonly="readonly" type="text" name="email_id" value="<?php echo $rows['email_id']?>" placeholder="" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Pay Id</td>
                                                  <td class="col-md-8"><input readonly="readonly" type="text" name="pay_id" value="<?php echo $rows['pay_id']?>" placeholder="" class="form-control" readonly="readonly"></td>
                                                </tr>

                                               
                                               
                                                <tr>
                                                    <td class="col-md-4">Date</td>
                                                  <td class="col-md-8"><input readonly="readonly" type="text" name="date" value="<?php echo $rows['date']?>" placeholder="" class="form-control"></td>
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Amount</td>
                                                    <td class="col-md-8"><input  readonly="readonly" type="text" name="amount" value="<?php echo $var1['amount']?>" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Bank/DD/MO</td>
                                                    <td class="col-md-8"><input readonly="readonly" type="text" name="offline" value="<?php echo $var1['offline']?>" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Transaction Id/DD num/Sender Name</td>
                                                   
                                                     <?php  
				 if($var1['offline']=='MoneyOrder '){?>
			  <td class="col-md-8"><input type="text" name="city" readonly="readonly" value="<?php  echo $var1['sendername']; 	?>" placeholder="" class="form-control"></td>
			   <?php } else if($var1['offline']=='DemandDraft'){?>
		 <td class="col-md-8"><input type="text" name="city" readonly="readonly" value="<?php echo $var1['ddnum']; 	?>" placeholder="" class="form-control"></td>
			   <?php } else if($var1['offline']=='BankDeposite'){?>
			 <td class="col-md-8"><input type="text" name="city" readonly="readonly" value="<?php echo $var1['tensid']; 	?>" placeholder="" class="form-control"></td>
			   <?php }else{?><td><?php echo 'No Data Found';?></td>
               <?php } ?>
                                                        
                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Approved Payment/Not Received</td>
                                                   <td class="col-md-8">

            <select  name="status"  placeholder="" class="form-control">
            <option <?php  if($rows['status'] ==1){ echo 'selected="selected"'; }?> value="1">Waiting For Approve</option>
            <option <?php  if($rows['status'] ==0){echo 'selected="selected"'; }?> value="0">Waiting For Payment</option>
            <option <?php  if($rows['status'] ==2){echo 'selected="selected"'; }?> value="2">Payment Approved</option></select></td>
                                                        
                                                   
                                                </tr>
                                                
                                                
                  <?php }?>                              
                                         
                                                    
                                                    <td colspan="2" style="text-align:center">
                                                            <input type="submit" value="submit" name="save" class="btn btn-success">
                                                    </tr>
                                                
                                            </tbody>
                                        </table>
                                        </div></form>
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
