<head>
<?php  $this->load->view('admin/my_header.php');?>
<!-- Content Section Start -->
<div class="content-section">
    <div class="container-liquid">
        <div class="row">
            <div class="col-xs-12">
                <div class="sec-box">                   
                   
                        <h1 class="heading">Add New Magazine </h1>
                    
                    <div class="contents">                       
                        <form action="<?php echo base_url(); ?>admin/magazine/add_magazine" method="post"  enctype="multipart/form-data">
                        
                        
                            <div class="table-box">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th class="col-md-4">Description</th>
                                            <th class="col-md-8">Form Elements</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	                                    <tr>                                        	
                                            <input type="hidden" name="mag_id" value="" >
                                            <td class="col-md-4">Magazine Name</td>
                                            <td class="col-md-8"><input type="text" required="required" name="name" value="" placeholder="Enter Magazine Name" class="form-control"></td>
                                        </tr>
                                        <tr>                                        	
                                            <td class="col-md-4">Frequency</td>
                                            <td class="col-md-8">
                                            <select name="freq" class="form-control">
                                            	<option value="">Select Frequency of Magazine</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="weekly">Weekly</option>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>                                        	
                                            <td class="col-md-4">Price per Issue</td>
                                            <td class="col-md-8"><input type="text" required="required" name="price" value="" placeholder="Enter Magazine Price" class="form-control"></td>
                                        </tr>
                                        <tr>                                        	
                                            <td class="col-md-4">Publishing Starting Date</td>
                                            <td class="col-md-8"><input id="datepicker" name="date" class="datepicker form-control" data-date-format="mm/dd/yyyy"></td>
                                        </tr>
                                        
                                        <tr>                                        	
                                            <td class="col-md-4">Magzine Category</td>
                                            <td class="col-md-8"><input type="text" name="magcat" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-4">Description</td>
                                            <td class="col-md-8">
                                            <textarea class="form-control" name="desc"></textarea>                                            
                                        </tr>
                                        <tr>
                                            <td class="col-md-4">status</td>
                                            <td class="col-md-8">
                                                <select  name="status" placeholder="" class="form-control">
                                                    <option><---------------- Select -------------------></option>
                                                    <option  value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr>                                        	
                                            <td class="col-md-4">Magazine Image</td>
                                            <td class="col-md-8">
                                            	<input type="file" name="magimg" required="required" class="form-control" >
                                            </td>
                                        </tr>    
                                        	<td>                                        
                                            <div class="form-group has-success">
                                                <input type="submit" value="submit" name="save" class="form-control">
                                            </div>
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
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
</body>
</html>
