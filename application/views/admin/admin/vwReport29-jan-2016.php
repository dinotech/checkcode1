
<style type="text/css">

#adduser{
	    width: 100%;
    height: 1092px;
    position: absolute;
	        top: 0;
			
    background-color: rgba(0,0,0,.4);
	z-index: 99999999;
}

#userform table tr td {
	    padding: 10px;
}

#userform{
	text-align: -webkit-center;
	padding: 34px;
	position: relative;
    margin: 64px 329px 29px 110px;;
    z-index: 99999999999999;
	background-color: whitesmoke;
}
.tab-res
{
	float: right;
    margin-right: 20px;
    padding-top: 12px;
}
.rep{
	border: 1px solid #DA9999;
    width: 96%;
    margin: auto;}
#numbers{ height: 32px;}

#ds { float:left; display:none; margin-left:6px;}
#src { margin-top: 0px ;
    width: 100px;     color: #fff;
    background-color: #428bca; }
</style>

<?php
$this->load->view('admin/vwHeader');
?>

 <div id="page-wrapper">
  <div class="row">
          <div class="col-lg-12" style="float:left; width:20%;">
            <h2><small style="color: brown;">Manage Report</small></h2>
            </div>
            
            <div class="tab-res" >
      
  <form method="post" enctype="multipart/form-data" action="" onsubmit="return validate()">
 <div class="mdiv" style="float:left;">
 
 <select name='numbers' id='numbers' >
 <option value='0' selected='selected'>-- Select Category --</option>
 <option value="1" >Dealer</option>
  <option value="2" >Godown</option>
   <option value="3" >Sales</option>
    <option value="4" >Stock Purchase</option>
     <option value="5" >Stock In Rent</option>
  </select></div>&nbsp;
 <div id="ds" >
<input type="date" id="sdate" placeholder="Start Date" name="startdate" onchange="dt();"/>
<input type="date" id="edate" placeholder="End Date" name="enddate"/>
 </div>
 <input type="submit"  class="btn" id="src" name="submit" value="Search" />
 </form>
 </div>
         </div>   <hr/>
</div>
 
 <?php if(isset($_POST['submit'])){ if($_POST['numbers']==1){ ?> 
 <h4 style="margin-left: 27px; color: #C50808;">Dealer Report :</h4>
 <div id="ddata" class="rep">
  <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Sr.No.</th>
         <th>Dealer Name</th>
         <th>Address</th>
         <th>Phone No.</th>
         <th>Mobile</th></tr></thead>
    <?php $i=1;foreach($row as $rows){ ?>
      <tr>
         <td><?php echo $i;?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php echo $rows['d_address'];?></td>
         <td><?php echo $rows['phone'];?></td>
         <td><?php echo $rows['mobile'];?></td>
      </tr><?php $i++;} ?>
      </table>      
 </div>
  
<a href="<?php echo base_url(); ?>admin/report/csv/dealer" class="btn btn-success btn-xs">Report</a>

 <?php }if($_POST['numbers']==2){?>
 <h4 style="margin-left: 27px; color: #C50808;">Godown Report :</h4>
 <div id="gdata" class="rep"><table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Sr No.</th>
         <th>Godown Name</th>
         <th>Address</th>
         <th>Phone No.</th>
         <th>Mobile</th>
         <th>City</th>
         <th>State</th>
         </tr></thead>
        <?php $i=1;foreach($row as $rows){ ?> <tr>
         <td><?php echo $i;?></td>
         <td><?php echo $rows['g_name'];?></td>
         <td><?php echo $rows['g_address'];?></td>
         <td><?php echo $rows['ph_no'];?></td>
         <td><?php echo $rows['mob'];?></td>
         <td><?php echo $rows['city'];?></td>
         <td><?php echo $rows['state'];?></td>
         </tr><?php $i++;} ?></table></div> 
 
 <a href="<?php echo base_url(); ?>admin/report/csv/godown" class="btn btn-success btn-xs">Report</a>
 
 <?php } if($_POST['numbers']==3){?>
 <h4 style="margin-left: 27px; color: #C50808;">Sales Report :</h4>
 <div id="sdata" class="rep"> <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Sr No.</th>
         <th>Dealer Name</th>
         <th>Price</th>
         <th>No. Of Bags</th>
         <th>OPC/PPC</th>
         <th>T/NT</th>
         <th>Date & Time</th>
         <th>Godown</th>
         </tr></thead>
         <?php $i=1; foreach($row as $rows){?>
         <tr>
         <td><?php echo $i;?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php echo $rows['prices'];?></td>
         <td><?php echo $rows['no_of_bags'];?></td>
         <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
         <td><?php if($rows['t_nt']==1){ echo "Trading";} if($rows['t_nt']==2) { echo "non trading"; }?></td>
         <td><?php echo $rows['date'];?></td>
         <td><?php echo $rows['g_name'];?></td></tr>
        <?php $i++;} ?> </table>
        </div>
        
<a href="<?php echo base_url(); ?>admin/report/csv/sales" class="btn btn-success btn-xs">Report</a>

<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/report/csv/sales" >
<input type="hidden" id="sad" placeholder="Start Date" name="startdate"/>
<input type="hidden" id="ed" placeholder="End Date" name="enddate"/>
<input type="submit"  class="btn"  name="submit" value="Report" />

<?php } if($_POST['numbers']==4){ ?>
        <h4 style="margin-left: 27px; color: #C50808;">Stock Purchase Report :</h4>
 <div id="spdata" class="rep">
 <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Sr No.</th>
         <th>Source Name</th>
         <th>Price</th>
         <th>No. Of Bags</th>
         <th>OPC/PPC</th>
         <th>T/NT</th>
         <th>Date & Time</th>
         <th>Godown</th>
         </tr></thead>
         <?php $i=1;foreach($row as $rows){ ?>
         <tr>
         <td><?php echo $i;?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php echo $rows['price'];?></td>
         <td><?php echo $rows['no_of_begs'];?></td>
         <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
         <td><?php if($rows['t_nt']==1){ echo "Trading";} if($rows['t_nt']==2) { echo "non trading"; }?></td>
         <td><?php echo $rows['date_time'];?></td>
         <td><?php echo $rows['g_name'];?></td></tr> <?php $i++;} ?></table>
 </div>
 
 <?php } if($_POST['numbers']==5){ ?>
 <h4 style="margin-left: 27px; color: #C50808;">Stock In Rent Report :</h4>
 <div id="srdata" class="rep">
 <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Sr No.</th>
         <th>Dealer Name</th>
         <th>Rent Price</th>
         <th>No. Of Bags</th>
         <th>OPC/PPC</th>
         <th>T/NT</th>
         <th>Date & Time</th>
         <th>Godown</th>
         </tr></thead>
         <?php $i=1; foreach($row as $rows){ ?>
         <tr>
         <td><?php echo $i;?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php echo $rows['r_price'];?></td>
         <td><?php echo $rows['no_of_begs'];?></td>
         <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
         <td><?php if($rows['t_nt']==1){ echo "Trading";} if($rows['t_nt']==2) { echo "non trading"; }?></td>
         <td><?php echo $rows['date'];?></td>
         <td><?php echo $rows['g_name'];?></td></tr>
        <?php $i++; } ?> </table>
         </div>
<?php } }?>

 <script type="text/javascript">
 
 function dt()
 { alert("gfhfh"); $("#sd").val()=$("#sdate").val();
 }
 
 function validate()
 {  
	a=$("#sdate").val(); 
    b=$("#edate").val(); 
    //alert(a);
	if($("#numbers").val() == 0){ 
	alert("Please select category");
     return false;
    } 
	if($("#numbers").val() == 3){ 
	
		if(a=="")
		{
		alert("Please select Start Date");
		return false;
		}
		if(b=="")
		{
		 alert("Please select End Date");
		 return false;
		}
	$("#sd").val()=$("#sdate").val(); 
	$("#ed").val()=$("#edate").val(); 
	
	 } 
	if($("#numbers").val() == 4){ 
	
	if(a=="")
	{
	alert("Please select Start Date");
	return false;
	}
	if(b=="")
	{
	 alert("Please select End Date");
	 return false;
		}
   
    } 
	if($("#numbers").val() == 5){ 
	if(a=="")
	{
	alert("Please select Start Date");
	return false;
	}
	if(b=="")
	{
	 alert("Please select End Date");
	 return false;
		}
    } 
}

   $('#numbers').change(function(){ 
    if($(this).val() == 1){
      $('#ds').hide();
    }
    if($(this).val() == 2){
       $('#ds').hide();
    }
	 if($(this).val() == 3){
      $('#ds').show();
    }
	 if($(this).val() == 4){
       $('#ds').show();
    }
	 if($(this).val() == 5){
       $('#ds').show();
    }

});

 /*$('#add').click(function(){
	 $('#adduser').show();
 });
 
 $('#close').click(function(){
	 $('#adduser').hide();
 });*/
 
 </script>
 