<?php 
//echo'<pre>';print_r($user);echo'</pre>';die;
$this->load->view('admin/my_header.php'); ?>

<div class="error " >
<?php echo validation_errors(); ?>
</div>
<!-- Content Section Start -->
<div class="content-section">
<div class="container-liquid">
<div class="row">
<div class="col-xs-12">
<div class="sec-box">

<h1 class="heading">Add <?php if($user=='franchise'){?>Franchise<?php }else if($user=='executive'){?>Executive<?php } ?> </h1>
<div class="contents">
<form action="<?php echo base_url(); ?>admin/datatables/add_userdata1" method="post">

<table class="table">
<thead>
<tr>
<th class="col-md-4">Description</th>
<th class="col-md-8">Form Elements</th>
</tr>
</thead>
<tbody>
<tr>      
<input type="hidden" name="rolename" value="<?php echo $user?>" />                                                                      
<td class="col-md-4"><?php if($user=='franchise'){?>Franchise<?php }else if($user=='executive'){?>Executive<?php } ?>  Code</td>
<?php ?><td class="col-md-8"><input type="text" readonly name="fcode" 
value="<?php if($user=='franchise'){
echo $seq[0]['code'];
//print_r($seq);
}else if($user=='executive'){ 
echo $seq[0]['code'];
//print_r($seq);
} ?>" class="form-control"></td>
<?php /*?>
<td class="col-md-8"><input type="text" readonly name="fcode" value="<?php echo $seq[0]['code']; ?>" class="form-control"></td>
<?php */?>
</tr>
<tr>                                                		
<td class="col-md-4"><?php if($user=='franchise'){?>Franchise<?php }else if($user=='executive'){?>Executive<?php } ?> Name</td>
<td class="col-md-8"><input type="text" required="required" name="fname" value="" placeholder="" class="form-control"></td>
</tr>                                          
<tr>
<td class="col-md-4">Email Id</td>
<td class="col-md-8"><input type="text" required="required" name="emailid1" value="" placeholder="" class="form-control"></td>
</tr> 
<tr>
<td class="col-md-4">Address</td>
<td class="col-md-8"><input type="text" required="required" name="addr1" value="" placeholder="" class="form-control"></td>
</tr>                                                 
<td class="col-md-4">Country<span>*</span></td>
<td class="col-md-4">
<select name="country" class="countries form-control"  required="required" id="countryId">
<option value="">Select Country</option>
</select>
</td>
</tr>
<tr>
<td class="col-md-4">State</td>
<td class="col-md-4">
<select name="state" class="states form-control" required="required" id="stateId">
<option value="">Select State</option>
</select>
</td>
</tr>
<tr>
<td class="col-md-4">City</td>
<td class="col-md-4">

<select name="city" class="cities form-control" id="cityId">
<option></option>
</select>
</td>
</tr>    
<tr>
<td class="col-md-4">Mobile no</td>
<td class="col-md-8"><input type="text" name="fmob1"  required="required" value="" placeholder="" class="form-control"></td>
</tr>
<?php if($user=='franchise'){?>
<tr>
<td><h2>Proprietor Contact</h2></td>
</tr>
<tr>                                                		
<td class="col-md-4">Franchise Name</td>
<td class="col-md-8"><input type="text" name="fname2" required="required" value="" placeholder="" class="form-control"></td>
</tr>
<tr>
<td class="col-md-4">Mobile no</td>
<td class="col-md-8"><input type="text" required="required" name="fmob2" value="" placeholder="" class="form-control"></td>
</tr>  
<tr>
<td class="col-md-4">Email Id</td>
<td class="col-md-8"><input type="text" required="required" name="femailid2" value="" placeholder="" class="form-control"></td>
</tr> 
<tr>
<td class="col-md-4">Address</td>
<td class="col-md-8"><input type="text" required="required" name="faddr2" value="" placeholder="" class="form-control"></td>
</tr>  
<tr>
<td><h2>Bank account</h2></td>
</tr>
<tr>
<td class="col-md-4">Account Name</td>
<td class="col-md-8"><input type="text" required="required" name="faccname" value="" placeholder="" class="form-control"></td>                                                   
</tr>
<tr>
<td class="col-md-4">Number</td>
<td class="col-md-8"><input type="text" required="required" name="faccno" value="" placeholder="" class="form-control"></td>                                                   
</tr>
<tr>
<td class="col-md-4">Bank Name</td>
<td class="col-md-8"><input type="text" required="required" name="fbankname" value="" placeholder="" class="form-control"></td>                                                   
</tr>
<tr>
<td class="col-md-4">Branch</td>
<td class="col-md-8"><input type="text" required="required" name="fbbranch" value="" placeholder="" class="form-control"></td>                                                   
</tr>
<tr>
<td class="col-md-4">IFSC</td>
<td class="col-md-8"><input type="text" required="required" name="fifsc" value="" placeholder="" class="form-control"></td>                                                   
</tr>  
<?php } if($user=='executive' && $user!='franchise'){ ?>       
<tr>
<td class="col-md-4">Alternate contact num</td>
<td class="col-md-8"><input type="text" required="required" name="fmob3" value="" placeholder="" class="form-control"></td>
</tr>  
<?php } ?>
</tbody>                                          
</table>                                        

<div class="col-lg-12" style="text-align:center; margin-top:20px;; margin-bottom:50px;"><button class="btn btn-success">Submit</button></div>
</form>
</div><!--<a style="float:right;font:Arial, Helvetica, sans-serif;font-size:18px;padding-right:20px;" href="datatables.php"><b>View</b></a>-->
<div class="clearfix"></div>

</div>
</div>
</div>
</div>
<!-- Row End -->
</div>

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
