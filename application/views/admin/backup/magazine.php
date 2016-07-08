
<?php  $this->load->view('admin/my_header.php');?>

                                <div class="contents">
     
                                       <form name="form1" method="post" action="" onSubmit="return validate();">
                        <input name="delete" type="submit" id="delete" value="Delete" class="btn btn-info" role="button" style="float:right; margin-right:10px;margin-left:10px; margin-top:5px;">
                       <a href="<?php echo base_url(); ?>admin/magazine/add_data" class="btn btn-info" role="button" style="float:right;margin-top:5px;">Add</a>
                                
                                   <!-- <a class="togglethis">Toggle</a>-->
                                    <div class="table-box">
                                    	<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.dataTables.min.js"></script>
                                 
                                        <table class="display table" id="example">
                                            <thead>
                                                <tr>
                                                <th></th>
                                                    <th>Magazine Id</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    
                                                    <th>Status</th>
                                                    
                                                      
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="gradeX">
             <?php foreach($row as $rows){
		
	//	echo '<pre>';print_r($rows);die;
		?>
           
            <tr><td><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $rows['mag_id']; ?>"></td>
              <td><?php echo $rows['mag_id']?></td>
              <td><?php echo $rows['name']?></td>
              <td><?php echo $rows['description']?></td>
              <td> <?php  if($rows['status'] ==1){echo 'Active';}else{echo 'Inctive';}?></td>
              
            
             <td><a href="<?php echo base_url(); ?>admin/magazine/edit_mag?id=<?php echo $rows['mag_id']?>">Edit</a></td>
            
              
                        
            </tr>
               <?php } ?>
        
        
                                                   
                                                </tr>
                                           
                                            </tbody>
                                           <tfoot>
<?php

// Check if delete button active, start this
if(isset($_POST['delete'])){
for($i=0;$i<count($_POST['checkbox']);$i++){
$del_id=$_POST['checkbox'][$i];
$sql = "DELETE FROM magazine WHERE mag_id=$del_id";
$result = mysql_query($sql);
}
// if successful redirect to delete_multiple.php
if($result){
 redirect('admin/magazine');
//echo "<meta http-equiv=\"refresh\" content=\"0;URL=datatables.php\">";
}
}

?>
<!--
                                                <tr>
                                                    <th><input type="text" name="search_engine" value="Search engines" class="search_init" /></th>
                                                    <th><input type="text" name="search_browser" value="Search browsers" class="search_init" /></th>
                                                    <th><input type="text" name="search_platform" value="Search platforms" class="search_init" /></th>
                                                    <th><input type="text" name="search_version" value="Search versions" class="search_init" /></th>
                                                    <th><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
                                                </tr>-->
                                            </tfoot>
                                        </table></form>
                                        <script>
                                        	var asInitVals = new Array();			
											$(document).ready(function() {
												var oTable = $('#example').dataTable( {
													"oLanguage": {
														"sSearch": "Search all columns:"
													}
												} );
												
												$("tfoot input").keyup( function () {
													/* Filter on the column (the index) of this element */
													oTable.fnFilter( this.value, $("tfoot input").index(this) );
												} );
												
												
												
												/*
												 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
												 * the footer
												 */
												$("tfoot input").each( function (i) {
													asInitVals[i] = this.value;
												} );
												
												$("tfoot input").focus( function () {
													if ( this.className == "search_init" )
													{
														this.className = "";
														this.value = "";
													}
												} );
												
												$("tfoot input").blur( function (i) {
													if ( this.value == "" )
													{
														this.className = "search_init";
														this.value = asInitVals[$("tfoot input").index(this)];
													}
												} );
											} );

                                        </script>
                                    </div>
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

</script>-->

</body>
</html>
