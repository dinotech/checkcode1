
<?php //echo'<pre>';print_r($row); echo'</pre>';
$this->load->view('admin/my_header.php'); ?>
<!-- Content Section Start -->
<div class="content-section">
    <div class="container-liquid">
        <div class="row">
            <div class="col-xs-12">
                <div class="sec-box">                   
                    <header>
                        <h1 class="heading">Stop Publishing Magazine </h1>
                    </header>
                    <div class="contents">                       
                        <form action="<?php echo base_url(); ?>admin/magazine/stopped" enctype="multipart/form-data" method="post">
                        <?php echo validation_errors(); ?>  
         				 
                            <div class="table-box">
                                <table class="table">
                                    <tbody class="col-md-11 col-md-offset-1">
                                        <tr>
                                            <td class="col-md-4">Select a Magazine</td>
                                            <td class="col-md-6">
                                                <select  name="magid"  placeholder="" class="form-control">
                                                    <option value=""><---------------- Select -------------------></option>
                                                    <?php
														foreach($row as $data){
													?>
                                                    <option  value="<?php echo $data['mag_id']?>"><?php echo $data['name']?></option>                                                    
                                                	<?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-4">Reason for Stopping</td>
                                            <td class="col-md-6">
                                            <textarea class="form-control" required name="desc"></textarea>                                            
                                        </tr>
                                        <tr>    
                                        	<td class="col-md-offset-2">                                                                                    
                                                <button name="submit" class="btn btn-success">Confirm</button>                                            
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
</body>
</html>
