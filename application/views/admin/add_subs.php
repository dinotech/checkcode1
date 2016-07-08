
<?php  $this->load->view('admin/my_header.php');?>

            <!-- Content Section Start -->
            <div class="content-section">
                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                               
                               
                                    <h1 class="heading">Add Subscription </h1>
                               
                                <div class="contents">
                                   
                                    <form action="<?php echo base_url(); ?>admin/subscription/add_subscription" enctype="multipart/form-data" method="post">
                                    <div class="table-box">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Description</th>
                                                    <th class="col-md-8">Form Elements</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                    
                                                <tr><input type="hidden" name="user_id" value="" >
                                                    <td class="col-md-4">User</td>
                                                    <td class="col-md-8">
                                                     <!--<input type="text" name="user_id" value="" placeholder="" class="form-control">-->
                                                   <select name="user_id" class="form-control" >
<?php foreach($users as $k=>$v){ ?>                  
<option value="<?php echo $v['user_id'] ?>"><?php echo $v['name'] ?></option>
<?php }?>
                                                    </select>
                                                    </td>
                                                </tr>
                                               
                                               
                                                <tr>
                                                    <td class="col-md-4">Magazine</td>
                                                  <td class="col-md-8">
           <!--<input type="text" name="mag_id" value="" placeholder="" class="form-control"> -->
           <select name="mag_id" class="form-control" >
<?php foreach($magazines as $k=>$v){ ?>                  
<option value="<?php echo $v['mag_id']?>"><?php echo $v['name'] ?></option>
<?php }?>
                                                    </select>
                                                  </td>
                                                </tr>
                                               <!--  <tr>
                                                    <td class="col-md-4">Edition Id</td>
                                                    <td class="col-md-8">
                                                    <input type="text" name="edition_id" value="" placeholder="" class="form-control">
                                                    </td>
                                                        
                                                   
                                                </tr>-->
                                                 <tr>
                                                    <td class="col-md-4">Start Time</td>
                                                    <td class="col-md-8">
                                                    <input id="datepicker" type="text" name="start_time" value="" placeholder="" class="form-control">
                                                    </td>
                                                        
                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">End Time</td>
                                                    <td class="col-md-8"><input id="datepicker" type="text" name="end_time" value="" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">duration</td>
                                                    <td class="col-md-8"><input type="number" name="duration" value="" placeholder="" class="form-control"></td>
                                                        
                                                   
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">status</td>
                                                    <td class="col-md-8"><select  name="status"  placeholder="" class="form-control">
            <option  value="1">Active</option>
            <option value="0">Inactive</option></select></td>
                                                        
                                                   
                                                </tr>
                                                 
                                                
                                                
                                           
                                         
                                                    
                                                    <td colspan="2" style="text-align:center">
                                                            <input type="submit" value="submit" name="save" class="btn btn-success">
                                                     </td>       
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42761673-1', 'extracoding.com');
  ga('send', 'pageview');

</script>

</body>
</html>
