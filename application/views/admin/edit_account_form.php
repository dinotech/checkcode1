<?php //echo'<pre>';  print_r($row);echo'</pre>';die;
$this->load->view('admin/my_header.php'); ?>

                                <div class="contents">
<form name="form1" method="post" action="<?php echo base_url()?>admin/admin_profile/useraccess" onSubmit="return validate();">
<!--<input name="delete" type="submit" id="delete" value="Delete" class="btn btn-info" role="button" style="float:right; margin-right:10px;margin-left:10px; margin-top:5px;">-->
<!--<a href="<?php echo base_url(); ?>admin/admin_profile/add_data" class="btn btn-info" role="button" style="float:right;margin-top:5px;">Add</a>-->

<!-- <a class="togglethis">Toggle</a>-->
<div class="table-box col-lg-8 col-lg-offset-2">
<!--	<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.dataTables.min.js"></script>-->
<table class="display table" >
        <thead  style="font-size:14px">
                <tr>
                        <th>Grant Access to</th>
                        <input type="hidden" value="<?php echo $row[0][0]['username']?> " name="name" />                        
                        <input type="hidden" value="<?php echo $row[0][0]['email']?> " name="email" />
                        <th><?php echo $row[0][0]['username']?></th>
                </tr>
                <tr>        
                        <th>Email:</th>
                        <th><?php echo $row[0][0]['email']?></th>
                <!--  <th class="center">CSS grade</th>-->
                </tr>          
        </thead>
        <tbody>                                       
		<tr>
        		<td colspan="4">                                      
                        <div class="checkbox">
                                <label><input name="checkbox[]"  <?php if(isset($row[1][0]['Direct_Payment']) &&  $row[1][0]['Direct_Payment']== '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]"  value="Direct_Payment">Direct Payment</label>                     
                      </div>
                </td>
        </tr>
    <tr><td colspan="4">
            <div class="checkbox">
            		<label><input name="checkbox[]" <?php if(isset( $row[1][0]['Franchise_Payments']) && $row[1][0]['Franchise_Payments'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Franchise_Payments">Franchise Payments</label>
            </div>
        </td></tr>           
        <tr><td colspan="4">
            <div class="checkbox ">
            		<label><input name="checkbox[]" <?php if(isset( $row[1][0]['Executive_Payments']) && $row[1][0]['Executive_Payments'] ==  '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Executive_Payments">Executive Payments</label>
            </div>
        </td></tr>
        <tr><td colspan="4">
                <div class="checkbox">
                		<label><input name="checkbox[]" <?php if(isset( $row[1][0]['Direct_Subscription']) && $row[1][0]['Direct_Subscription'] ==  '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Direct_Subscription">Direct Subscription</label>
                </div>
        </td></tr>
        <tr><td colspan="4">
                <div class="checkbox">
                		<label><input name="checkbox[]" <?php  if(isset( $row[1][0]['Online_Subscription']) && $row[1][0]['Online_Subscription'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Online_Subscription">Online subscriptions</label>
                </div>
        </td></tr>        
        <tr><td colspan="4">
                <div class="checkbox">
                		<label><input name="checkbox[]" <?php if(isset( $row[1][0]['Franchise_Subscription']) && $row[1][0]['Franchise_Subscription'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Franchise_Subscription">Franchise Subscription</label>
                </div>
        </td></tr>
        <tr><td colspan="4">
                <div class="checkbox ">
               			<label><input name="checkbox[]" <?php if(isset( $row[1][0]['Executive_Subscription']) && $row[1][0]['Executive_Subscription'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Executive_Subscription">Executive Subscription</label>
                </div>
        </td></tr>
        <tr><td colspan="4">
                <div class="checkbox">
                           <label><input name="checkbox[]" <?php if(isset( $row[1][0]['Manage_Subscriber']) && $row[1][0]['Manage_Subscriber'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Manage_Subscriber">Manage Subscriber </label>
                </div>
        </td></tr>
        <tr><td colspan="4">
                <div class="checkbox">
                		<label><input name="checkbox[]" <?php if(isset( $row[1][0]['Manage_Franchise']) && $row[1][0]['Manage_Franchise'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Manage_Franchise">Manage Franchise</label>
                </div>
        </td></tr>
        <tr><td colspan="4">
                <div class="checkbox ">
                		<label><input name="checkbox[]" <?php if(isset( $row[1][0]['Manage_Executive']) && $row[1][0]['Manage_Executive'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Manage_Executive">Manage Executive</label>
                </div>
        </td></tr>
        <tr><td colspan="4">        
                <div class="checkbox ">
                		<label><input name="checkbox[]" <?php if(isset( $row[1][0]['Payment_Upload']) && $row[1][0]['Payment_Upload'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Payment_Upload">Payment Upload</label>
                </div>
        </td></tr>
        <tr><td colspan="4">
                <div class="checkbox ">
                		<label><input name="checkbox[]" <?php if(isset( $row[1][0]['Pay_Outs']) && $row[1][0]['Pay_Outs'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Pay_Outs">Pay-Outs</label>
                </div>
        </td></tr>
        <tr><td colspan="4">
            <div class="checkbox ">        
            <label><h3>Manage Magazines</h3></label>
            <ul style="list-style:none;">
                    <li><input name="checkbox[]"<?php if(isset( $row[1][0]['Publish_magazine']) && $row[1][0]['Publish_magazine'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Publish_magazine">Publish a magazine</li>
                    <li><input name="checkbox[]" <?php if(isset( $row[1][0]['Stop_publishing']) && $row[1][0]['Stop_publishing'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Stop_publishing">Stop publishing</li>
                    <li><input name="checkbox[]" <?php if(isset( $row[1][0]['Archived_publications']) && $row[1][0]['Archived_publications'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Archived_publications">Archived publications</li>            
            </ul>
        	</div>
        </td></tr>
        <tr><td colspan="4">
        <div class="checkbox ">        
        <label><h3>Co-Admins</h3></label>
                <ul style="list-style:none;">
                        <li><input name="checkbox[]" <?php if(isset( $row[1][0]['Admin_Create']) && $row[1][0]['Admin_Create'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Admin_Create">Create</li>
                        <li><input name="checkbox[]" <?php if(isset( $row[1][0]['Admin_Manage']) && $row[1][0]['Admin_Manage'] == '1') {?>checked="checked" <?php } ?> type="checkbox" id="checkbox[]" value="Admin_Manage">Manage</li>        
                </ul>
        </div>
        </td></tr>
        <tr><td colspan="4">
        <div class="checkbox ">        
        <label><h3>Activity Registers</h3></label>
                <ul style="list-style:none;">
                        <li><input name="checkbox[]" <?php if(isset( $row[1][0]['Act_reg_View']) && $row[1][0]['Act_reg_View'] == '1') {?>checked="checked" <?php }?> type="checkbox" id="checkbox[]" value="Act_reg_View">View</li>
                        <li><input name="checkbox[]" <?php if(isset( $row[1][0]['Act_reg_Edit']) && $row[1][0]['Act_reg_Edit'] == '1') {?>checked="checked" <?php }?> type="checkbox" id="checkbox[]" value="Act_reg_Edit">Edit</li>                
                </ul>
        </div>
        </td></tr>                    
        <tr><td colspan="4" style="text-align:center">           
                    <button  name="save" class="btn btn-success btn-lg">submit</button>
          </td></tr> 
         
        </tbody>
</table>
</form>
<?php

// Check if delete button active, start this
if(isset($_POST['save'])){ 
$this->admin_model->access_control($_POST);






}

?>

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

</script>-->

</body>
</html>
