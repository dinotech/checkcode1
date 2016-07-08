
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
//$data['id']="pt";
$this->load->view('admin/vwHeader');
?>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
 <!--<option value="3" >Sales</option>
 <option value="4" >Stock Purchase</option>-->
 <option value="5" >Outward(stock in rent)<!--Stock In Rent(outword)--></option>
 <option value="6" >Shri cement stock</option>
 <!--<option value="7" >All Dealer Report</option>-->
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
 <?php if(isset($_POST['submit'])&& $_POST['numbers']==2){
	?>
    <!--<form name="select_godown" method="post" id="select_godown">-->
	
   
	<form name="select_godown" method="post" id="select_godown">
    <table align="center">
    <tr> 
    <th>Select Godown<br/><br/><br/><br/></th><td>
    <select name="selectg"  id="selectg">
    <option value="first">----Select----</option>
    <?php foreach($row as $rows){
		//onchange="change_val1(<?php echo $_POST['numbers'];)"
		?>
    <option value="<?php echo $rows['g_id'];?>"><?php echo $rows['g_name'];?></option>
	
	<?php }?>
    </select><br/><br/><br/><br/></td>
  <!--  Date From:<input type="text" id="datepicker" name="from"/>
    Date To:<input type="text" id="datepicker" name="to"/>-->
    <td>
    <input type="hidden" name="numbe" value="2" id="numbe"/></td></tr></table>
	 <div style="text-align:center">Date From:<input type="text" id="datepicker" name="from"/>
    Date To:<input type="text" id="datepicker1" name="to"/>
  
      <br/><br/><br/>
<!--    <input type="submit"  class="btn" id="src" name="submit2" value="submit" onclick="nextgodown()" />
-->    
<input type="button"  class="btn" id="src" name="submit2" value="submit" onclick="nextgodown()" />
</div></form>
	
	<?php } ?>
 <?php if(isset($_POST['submit']) && $_POST['numbers']==1){ ?> 
 <form name="select_deal" method="post" id="select_deal" >
 <table align="center">
 <tr>
 <th>Select Dealer<br/><br/><br/><br/></th>
 <td>
 <!--<form name="select_deal" method="post" id="select_deal" >-->
 <select name="selectr" id="selectr" >
  <option value="first">----Select----</option>
  <?php foreach($row as $rows){
	  
	  //onchange="change_val(<?php echo $_POST['numbers'] closephptag)"
	   ?><!--onchange="change_val(<?php echo $_POST['numbers'] ?>)"-->
  <option value="<?php echo $rows['dealer_id'];?>"><?php echo $rows['d_name'];?></option>
  <?php } ?>
 </select><br/><br/><br/><br/></td><td>
 <input type="hidden" name="numb" value="1" id="numb" />
 <!--</form>-->
 </td>
 </tr>
 </table>
  <div style="text-align:center">Date From:<input type="text" id="datepicker2" name="from"/>
    Date To:<input type="text" id="datepicker3" name="to"/><br/><br/><br/>
    <input type="button"  class="btn" id="src" name="submit3" value="submit" onclick="nextdealer()" />
    <!--<input type="submit"  class="btn" id="src" name="submit3" value="submit" />-->
    </div></form>
 
 
  
 <?php }
 if(isset($_POST['numbe'])&&$_POST['numbe']==2){
	 ?>
     <h4 style="margin-left: 27px; color: #C50808;">Godown Report :<?php echo $row[0]['g_name'];?></h4>
	 <?php if(!empty($row[0]['g_name'])){echo "&nbsp &nbsp &nbsp Godown Name: ";echo $row[0]['g_name']."<br/>"; }?>
     <?php if(!empty($row[0]['g_address'])){echo "&nbsp &nbsp &nbsp Address: "; echo $row[0]['g_address']."<br/>"; }?>
     <?php if(!empty($row[0]['ph_no']) && $row[0]['ph_no']!=0){ echo "&nbsp &nbsp &nbsp Phone No.: "; echo $row[0]['ph_no']."<br/>"; }?>
     <?php if(!empty($row[0]['mob']) && $row[0]['mob']!=0){ echo "&nbsp &nbsp &nbsp Mobile : "; echo $row[0]['mob']."<br/>"; }?>
     <?php if(!empty($row[0]['city'])){ echo "&nbsp &nbsp &nbsp City : "; echo $row[0]['city']."<br/>"; }?>
     <?php if(!empty($row[0]['state'])){ echo "&nbsp &nbsp &nbsp State : "; echo $row[0]['state']."<br/>"; }?>
   
      <br/><br/><br/>
	 <div id="ddata" class="rep"> 
      <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <!--<th>Dealer Name</th>-->
         <th>Date</th>
         <th>Party Name</th>
         <th>No. of Bags Inword</th>
         <th>No. of Bags Outword</th>
         <th>OPC/PPC</th>
         <th>Type</th>
         <th>Action</th>
         <!--<th>Pay Flow</th>
         <th>Purchase</th>
         <th>Sale</th>
         <th>Rent</th>-->
         </tr>
         </thead>
         <tbody>
         <?php
		 $sum=0;$opcin=0;$opcout=0;$ppcin=0;$ppcout=0;
				
		  foreach($inwardg as $inwardgs){
			 
			 ?>
			 <tr><td><?php 
			 
			 $originalDate = $inwardgs['date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
			 
			 echo $newDate;?></td>
             <td>SHREE CEMENT<?php //echo $inwardgs['d_name'];?></td>
             <td><?php $sum_in=$sum_in+$inwardgs['noofbags'];
			 echo $inwardgs['noofbags'];?></td>
             <td>-</td>
             <td><?php 
			 if($inwardgs['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}
			 if($inwardgs['opc_ppc']==0){$opcin=$opcin+$inwardgs['noofbags'];}else{$ppcin=$ppcin+$inwardgs['noofbags'];}
			 ?></td>
             <td>Shree Cement</td>
             <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a href="editinvert?id=<?php echo $inwardgs['id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
			 <!--<td>-</td>
             <td>-</td>             
             <td>-</td>--></tr>
			 <?php
			 }
		 
		  foreach($outwardg as $outwardgs){
			 
			 ?>
			 <tr><td><?php 
			 
			 $originalDate = $outwardgs['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
			 
			 echo $newDate;?></td>
             <td><?php echo $outwardgs['d_name'];?></td>
              <td>-</td>
              <td><?php $sum=$sum+$outwardgs['no_of_begs'];
			 echo $outwardgs['no_of_begs'];?></td>
             <!--<td>-</td>-->
             <td><?php if($outwardgs['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}
			 
			 if($outwardgs['opc_ppc']==0){$opcout=$opcout+$outwardgs['no_of_begs'];}else{$ppcout=$ppcout+$outwardgs['no_of_begs'];}
			 
			 ?></td>
			 <td><?php if($outwardgs['t_nt']==1){ echo "Cement";} if($outwardgs['t_nt']==2) { echo "Shree Cement"; }?></td>
             <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a href="editstockinrent?id=<?php echo $outwardgs['sr_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td><!--<td>-</td>
             <td>-</td>             
             <td><?php echo $outwardgs['r_price'];?></td>--></tr>
			 <?php
			 }
			 foreach($rentg as $rentgs){
			 ?>
         		 <tr>
        <td><?php 
		$originalDate = $rentgs['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		
		
		echo $newDate;  ?></td>
        <td><?php echo $rentgs['d_name'];?></td>
         <td>-</td>
         <td><?php 
		$sum=$sum-$rentgs['no_of_begs'];
		echo "-".$rentgs['no_of_begs'];?></td>
        <td><?php if($rentgs['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}
		//if($rentgs['opc_ppc']==0){$opcout=$opcout+$rentgs['no_of_begs'];}else{$ppcout=$ppcout+}
		
		
		?></td>
        <td><?php if($rentgs['t_nt']==1){ echo "Cement";} if($rentgs['t_nt']==2) { echo "Shree Cement"; }?></td>
        <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a href="editrent?id=<?php echo $rentgs['r_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
       <?php /*?> <td><?php if($rentgs['pay_flow']==1){ echo "Cash";} else if($rentgs['pay_flow']==2){ echo "Cheque";} else { echo "Credit";}?></td><?php */?>
<!--        <td>-</td>
        <td>-</td>
        <td><?php echo $rentgs['rprice'];?></td>-->
        </tr>
         <?php }
		 	 ?>
         </thead><?php  if(empty($saleg)&&empty($outwardg)&&empty($rentg)&&empty($purchaseg)&&empty($inwardg)){echo "<tr><td></td><td></td><td>No record found</td><td></td><td></td><td></td></tr>";}else{   ?>
        </tbody>
         <tr><td>Total:</td><td></td><td><?php echo $sum_in;$sum_in_m=$sum_in/20;echo "&nbsp&nbsp(".$sum_in_m." metricton)"; ?></td><td><?php echo $sum;$sum_m=$sum/20;echo "&nbsp&nbsp(".$sum_m." metricton)"; ?></td><td></td><td></td><td></td></tr><?php }?></table>
	 
	 <?php
     }
 
 if(isset($_POST['submit']) && $_POST['numbers']==7){
	 
?>
<h4 style="margin-left: 27px; color: #C50808;">All Dealer Report :</h4>
<div id="ddata" class="rep"> 
      <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Dealer Name</th>
         <th>Date</th>
         <th>Narration</th>
         <th>No. of Bags</th>
         <th>OPC/PPC</th>
         <th>Pay Flow</th>
         <th>Credit</th>
         <th>Debit</th>
         
         </tr>
        </thead><tbody>
     
<?php
	  $sum=0;$credit=0;$debit=0;$s=0;
	   foreach($stockinrent as $rows){?>
      <tr><td><?php echo $rows['d_name'];?></td><td><?php 
	  $originalDate = $rows['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
	  
	  echo $newDate;?></td>
      <td>-</td>
      <td><?php $sum=$sum+$rows['no_of_begs']; echo $rows['no_of_begs']; ?></td>
      <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
      <td>-</td>
      <td>-</td> <td><?php $s=$rows['r_price']*$rows['no_of_begs'];echo $s;$debit=$debit+$s;//echo $rows['r_price']; ?></td><td></td></tr>
      <?php } ?>
      <?php 
	  foreach($rent as $rents){
		?>
        <tr><td><?php echo $rents['d_name'];?></td>
        <td><?php 
		$originalDate = $rents['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		
		echo $newDate;  ?></td>
        <td><?php echo $rents['sit_id'];//echo $rents['s_name'];?></td>
        <td><?php 
		$sum=$sum-$rents['no_of_begs'];
		echo "-".$rents['no_of_begs'];?></td>
        <td><?php if($rents['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
        <td><?php if($rents['pay_flow']==1){ echo "Cash";} else if($rents['pay_flow']==2){ echo "Cheque";} else { echo "Credit";}?></td>
     
        <td><?php $s=0;$s=$rents['rprice']*$rents['no_of_begs'];echo $s;$credit=$credit+$s;//echo $rents['rprice'];?></td><td></td>
       </tr>
		<?php  }   if(empty($stockinrent)&&empty($rent)&&empty($sale)&&empty($stockpurchase)){echo "<tr><td></td><td></td><td>No records found</td><td></td><td></td><td></td></tr>";}else {?>
     </tbody> <tr><td>Total:</td><td></td><td></td><td><?php echo $sum;  $sum=$sum/20;echo "&nbsp&nbsp(".$sum." metricton)"; ?></td><td></td><td></td><td><?php echo $credit;?></td><td><?php echo $debit;?></td></tr>
      <?php }?></table>
<?php	 }
 
 if(isset($_POST['numb']) && $_POST['numb']==1 ){ ?>
 <h4 style="margin-left: 27px; color: #C50808;">Dealer Report :<?php echo $row[0]['d_name'];?></h4>
 <!--<div id="ddata" class="rep">-->
 <?php //print_r($stockpurchase);die;?>
         <?php if(!empty($row[0]['d_name'])){echo "&nbsp &nbsp &nbsp  Dealer Name: ";  echo $row[0]['d_name']."<br/>"; }?>
       <?php if(!empty($row[0]['d_address'])){ echo "&nbsp &nbsp &nbsp	Address: "; echo $row[0]['d_address']."<br/>"; }?>
       <?php if(!empty($row[0]['phone']) && $row[0]['phone']!=0){ echo "&nbsp &nbsp &nbsp Phone No.: "; echo $row[0]['phone']."<br/>"; }?>
       <?php if(!empty($row[0]['mobile']) && $row[0]['mobile']!=0){ echo "&nbsp &nbsp &nbsp	Mobile : "; echo $row[0]['mobile']."<br/>"; }?><br/><br/><br/><br/>
     <div id="ddata" class="rep"> 
      <table class="table table-hover tablesorter">
      <thead>
         <tr>
        
         <th>Date</th>
         <th>Narration</th>
         <th>No. of bags inward</th>
         <th>No. of bags outward</th>
         <th>Challan no.</th>
         <th>OPC/PPC</th>
         <th>Rent</th>
         <th>Action</th>
      </tr>
</thead>
<tbody>
      <?php
	  $sum=0;$debit=0;$credit=0;$a=0;$b=0;$opcin=0;$opcout=0;$ppcin=0;$ppcout=0;
	   foreach($stockinrent as $rows){?>
      <tr><td><?php 
	  $originalDate = $rows['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
	  
	  echo $newDate;?></td>
      <td>-</td>
      <td><?php $sum=$sum+$rows['no_of_begs']; echo $rows['no_of_begs'];
	  $a=$a+$rows['no_of_begs'];
	   ?></td><td>-</td>
      <td><?php echo $rows['challanno'];?></td>
      <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}
	  if($rows['opc_ppc']==0){$opcin=$opcin+$rows['no_of_begs'];}else{$ppcin=$ppcin+$rows['no_of_begs'];}
	  
	  ?></td>
      <td>-</td>
      <td>-</td>
      <?php ?>
      <td>
      <h5 style="color: darkblue;cursor: pointer;">
       
  <a href="editstockinrent?id=<?php echo $rows['sr_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5>
      </td>
      
      </tr>
      <?php } ?>
      <?php 
	  
	
	  foreach($rent as $rents){
		?>
        <tr>
        <td><?php 
		$originalDate = $rents['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		
		echo $newDate;  ?></td>
        <td><?php echo $rents['sit_id'];//echo $rents['s_name'];?></td>
        <td>-</td>
        <td><?php 
		$sum=$sum-$rents['no_of_begs'];
		
		echo $rents['no_of_begs'];
		$b=$b+$rents['no_of_begs'];
		?></td><td>-</td>
        <td><?php if($rents['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}
		if($rents['opc_ppc']==0){$opcout=$opcout+$rents['no_of_begs'];}else{$ppcout=$ppcout+$rents['no_of_begs'];}
		
		
		?></td>
        <td><?php if($rents['pay_flow']==1){ echo "Cash";} else if($rents['pay_flow']==2){ echo "Cheque";} else { echo "Credit";}?></td>
      
        <td><?php $s=$rents['rprice']*$rents['no_of_begs'];echo $s;$credit=$credit+$s;//echo $rents['rprice'];?></td>
        
        <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a href="editrent?id=<?php echo $rents['r_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
       </tr>
		<?php  }
      
	  if(empty($stockinrent)&&empty($rent)&&empty($sale)&&empty($stockpurchase)){echo "<tr><td></td><td></td><td>No records found</td><td></td><td></td><td></td></tr>";}else {?>
      <tr><td>Total:</td><td></td><td><?php echo $a;  $a=$a/20;echo "&nbsp&nbsp(".$a." metricton)"; ?></td><td><?php echo $b;  $b=$b/20;echo "&nbsp&nbsp(".$b." metricton)"; ?></td><td></td><td></td><td></td><td><?php echo $credit;?></td><td><?php echo $debit;?></td></tr></tbody></tr>
      <?php }?></table>
      </div><br/><br/><div style="width:50%;float:right;" id="ddata" class="rep">
      <table class="table table-hover tablesorter"><tr><th>OPC/PPC</th><th>IN</th><th>OUT</th><th>Total</th></tr>
      <td>OPC</td><td><?php echo $opcin;?></td><td><?php echo $opcout;?></td><td><?php $d=$opcin-$opcout;echo $d;?></td>
      </tr><tr><td>PPC</td><td><?php echo $ppcin;?></td><td><?php echo $ppcout;?></td><td><?php $pd=$ppcin-$ppcout;echo $pd;?></td>
      </tr><tr><td><strong>Total Stock</strong></td><td></td><td></td><td><?php $sum=$d+$pd;echo $sum;?></table></div>
            
  
<a href="<?php echo base_url(); ?>admin/report/csv/dealer" class="btn btn-success btn-xs">Report</a>

 <?php }if(isset($_POST['submit']) && $_POST['numbers']==20){?>
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
         </tr></thead><tbody>
        <?php $i=1;foreach($row as $rows){ ?> <tr>
         <td><?php echo $i;?></td>
         <td><?php echo $rows['g_name'];?></td>
         <td><?php echo $rows['g_address'];?></td>
         <td><?php echo $rows['ph_no'];?></td>
         <td><?php echo $rows['mob'];?></td>
         <td><?php echo $rows['city'];?></td>
         <td><?php echo $rows['state'];?></td>
         </tr><?php $i++;} ?></tbody></table></div> 
 
 <a href="<?php echo base_url(); ?>admin/report/csv/godown" class="btn btn-success btn-xs">Report</a>
 
 <?php } if(isset($_POST['submit']) && $_POST['numbers']==3){?>
 <h4 style="margin-left: 27px; color: #C50808;">Sales Report :</h4>
 <div id="sdata" class="rep"> <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Date</th>
         <th>Dealer Name</th>
         <th>No. Of Bags</th>
         <th>OPC/PPC</th>
         <th>Price</th>
      <th>Pay Flow</th>
         <th>Godown</th>
         </tr></thead><tbody>
         <?php $i=1;$sum=0; foreach($row as $rows){?>
         <tr>
       
         <td><?php 
		  $originalDate = $rows['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		 echo $newDate;
		 ?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php $sum=$sum+$rows['no_of_bags'];echo $rows['no_of_bags'];?></td>
         <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
         <td><?php echo $rows['prices'];?></td>
         
          <td><?php if($rows['pay_flow']==1){ echo "Cash";} else if($rows['pay_flow']==2){ echo "Cheque";} else { echo "Credit";}?></td>
         <td><?php echo $rows['g_name'];?></td></tr>
        <?php $i++;} if(empty($row)){echo "<tr><td></td><td></td><td>No Records Found</td><td></td><td></td></tr>";}else{?><tr><td>Total:</td><td></td><td><?php echo $sum;?></td><td></td><td></td><td></td></tr><?php } ?></tbody></table>
        </div>
        

<?php } if(isset($_POST['submit']) && $_POST['numbers']==4){ ?>
        <h4 style="margin-left: 27px; color: #C50808;">Stock Purchase Report :</h4>
 <div id="spdata" class="rep">
 <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Date</th>
         <th>Dealer Name</th>
         <th>No. Of Bags</th>
         <th>OPC/PPC</th>
         <th>Price</th>
         <th>Pay Flow</th>
         <th>Godown</th>
         </tr></thead><tbody>
         <?php $i=1;$sum=0;foreach($row as $rows){ ?>
         <tr>
        <td><?php 
		  $originalDate = $rows['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		 echo $newDate;
		 ?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php $sum=$sum+$rows['no_of_begs'];echo $rows['no_of_begs'];?></td>
         <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
         <td><?php echo $rows['price'];?></td>
         <td><?php if($rows['pay_flow']==1){ echo "Cash";} else if($rows['pay_flow']==2){ echo "Cheque";} else { echo "Credit";}?></td>
         <td><?php echo $rows['g_name'];?></td></tr> <?php $i++;} if(empty($row)){echo "<tr><td></td><td></td><td>No Records Found</td><td></td><td></td><td></td></tr>";}else{?><tr><td>Total:</td><td></td><td><?php echo $sum;?></td><td></td><td></td></tr><?php } ?></tbody></table>
 </div>
 
 <?php } if(isset($_POST['submit']) && $_POST['numbers']==5){ ?>
 <h4 style="margin-left: 27px; color: #C50808;"><!--Stock In Rent-->Outward Report :</h4>
 <div id="srdata" class="rep">
 <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Date</th>
         <th>Dealer Name</th>
         <th>No. Of Bags</th>
         <th>OPC/PPC</th>
         <th>Rent Price</th>
         <th>Action</th>
        </tr></thead><tbody>
         <?php $i=1;$sum=0; foreach($row as $rows){ ?>
         <tr>
         <td><?php 
		  $originalDate = $rows['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		 echo $newDate;
		 ?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php $sum=$sum+$rows['no_of_begs'];echo $rows['no_of_begs'];?></td>
         <td><?php if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
         <td><?php echo $rows['r_price'];?></td>
         <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a href="editstockinrent?id=<?php echo $rows['sr_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
       </tr></tbody>
        <?php $i++; } if(empty($row)){echo "<tr><td></td><td></td><td>No Records Found</td><td></td></tr>";}else{ ?><tr><td>Total:</td><td></td><td><?php echo $sum;?></td><td></td></tr><?php } ?> </table>
         </div>
        
<?php }
if(isset($_POST['submit']) && $_POST['numbers']==6){
	
?>
<form name="select_cement" method="post" id="select_cement" >
<div style="text-align:center">Date From:<input type="text" id="datepicker2" name="from"/>
    Date To:<input type="text" id="datepicker3" name="to"/>
    <input type="hidden" name="cement" value="1" id="cement" /><br/><br/><br/>
 <input type="submit"  class="btn" id="src" name="submit1" value="submit" /></div>   
</form>
<?php }if(isset($_POST['submit1']) && $_POST['cement']==1){
	$sum=$sum_in=0;?>
<h4 style="margin-left: 27px; color: #C50808;">Shree Cement Report :</h4>
 <div id="srdata" class="rep">
 <table class="table table-hover tablesorter">
      <thead>
         <tr>
          <th>Date</th>
         <th>Challan no.</th>
         <th>Bilty no.</th>
         <th>No. Of Bags Inword</th>
         <th>No. Of Bags Outward</th>
         <th>OPC/PPC</th>
         <th>Party name</th>
         <th>Action</th>
          </tr></thead>
          
          <tbody>
<?php $sum=0;$opcin=0;$opcout=0;$ppcin=0;$ppcout=0;$totalin=$totalout=$totalamtin=$totalamtout=0;?>
<?php  foreach($tinword as $inwords){
	$totalin=$totalin+$inwords['noofbags'];
	}?>
<?php  foreach($inword as $inwords){?>
 <tr>
          <td><?php echo date("d-M-Y", strtotime($inwords['date']));?></td>
          <td>-</td>
          <td><?php echo $inwords['builtyno']; ?></td>
          <td><?php 
		  if (substr($inwords['noofbags'], 0, 1) === '-') {$str=$inwords['noofbags'];
		   $str = ltrim($str, '-');
		   $sum=$sum-$str;
		   }else{ $sum=$sum+$inwords['noofbags'];}
		  echo $inwords['noofbags'];?></td><td>-</td>
          <td><?php
		  if($inwords['opc_ppc']==0){$opcin=$opcin+$inwords['noofbags'];}else{$ppcin=$ppcin+$inwords['noofbags'];}
		   if($inwords['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
           <td><?php echo "-";?></td>
          <td><h5 style="color: darkblue;cursor: pointer;">
       
     <a href="editinvert?id=<?php echo $inwords['id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
        </tr>
		 <?php }  ?>
         
       <?php  foreach($toutward as $outwords){
	$totalout=$totalout+$outwords['no_of_begs'];
	}?>
  <?php $sum1=0;
		foreach($outward as $rows){?>
         <tr>
         <td>
         <?php 
		 $originalDate = $rows['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		 echo $newDate;?></td>
         <td><?php echo $rows['challanno'];?></td>
         <td>-</td>
         <td>-</td><td><?php 
		 $sum1=$sum1+$rows['no_of_begs'];
		 echo $rows['no_of_begs'];?></td>
         <td><?php 
		 
		 if($rows['opc_ppc']==0){$opcout=$opcout+$rows['no_of_begs'];}else{$ppcout=$ppcout+$rows['no_of_begs'];}
		 if($rows['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a href="editstockinrent?id=<?php echo $rows['sr_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
          </tr><?php } ?>
		 <?php 
		if(empty($inword)&&empty($outward)){echo "<tr><td></td><td></td><td></td><td>No Records Found</td></tr>";}else{
	   ?></tbody><tr><td>Total:</td><td></td><td><?php //echo $sum_in; $sum_in=$sum_in/20; echo "&nbsp &nbsp(".$sum_in." metricton)"; ?></td><td><?php echo $sum; $sum=$sum/20; echo "&nbsp &nbsp(".$sum." metricton)"; ?></td><td><?php echo $sum1; $sum1=$sum1/20; echo "&nbsp &nbsp(".$sum1." metricton)"; ?></td></tr><?php } ?>
</table>
<?php

?></div>


<br/><br/><div style="width:50%;float:right;" id="ddata" class="rep">
      <table class="table table-hover tablesorter"><tr><th>OPC/PPC</th><th>IN</th><th>OUT</th><th>Total</th></tr>
      <td>OPC</td><td><?php echo $opcin;?></td><td><?php echo "- ".$opcout;?></td><td><?php $d=$opcin-$opcout;echo $d;?></td>
      </tr>
      <tr>
      <td>PPC</td><td><?php echo $ppcin;?></td><td><?php echo "- ".$ppcout;?></td><td><?php $pd=$ppcin-$ppcout;echo $pd;?></td>
      </tr>
      <tr>
      <td><strong>Total Stock</strong></td><td></td><td></td><td><?php $sum=$d+$pd;echo $sum;?></td>
      </tr>
       <tr>
      <td><strong>Whole Total Stock </strong></td><td><?php echo $totalin ?></td><td><?php echo "- ".$totalout?></td><td><?php echo $t = $totalin-$totalout; ?></td>
      </tr>
      </table></div>




<?php 
	}
?>

 <script type="text/javascript">
 
 function dt()
 { 
  $("#sd").val()=$("#sdate").val();
 }
 
 function validate()
 {  
	
	if($("#numbers").val() == 0){ 
	alert("Please select category");
     return false;
    } 
	if($("#numbers").val() == 3){ 
	
	
		
	$("#sd").val()=$("#sdate").val(); 
	$("#ed").val()=$("#edate").val(); 
	
	 } 
	if($("#numbers").val() == 4){ 
	
	
   
    } 
	if($("#numbers").val() == 5){ 
	
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


 
 
 function change_val(num){
 var val = $('#selectr').val();
 $('#numb').val(num);	
 $('#select_deal').submit();

 }
  function change_val1(num){
 var val = $('#selectg').val();
 $('#numbe').val(num);	
 $('#select_godown').submit();

 }
 
 function nextgodown(){
 if($('#selectg').val()=="first"){alert("Select a Godown");}else{
	 $('#select_godown').submit();
	 }
 }
 
 
 function nextdealer(){
 if($('#selectr').val()=="first"){alert("Select a Dealer");}else{
	 $('#select_deal').submit();
	 }
 }
 
 
 
 $(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( "#datepicker" ).datepicker({
	  changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
	
	$( "#datepicker" ).datepicker(
		'setDate', 'today'
		);
  
  

  
  /* This is the function that will get executed after the DOM is fully loaded */

    $( "#datepicker1" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
  $( "#datepicker1" ).datepicker(
		'setDate', 'today'
		);
  


  /* This is the function that will get executed after the DOM is fully loaded */
      $( "#datepicker2" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
	$( "#datepicker2" ).datepicker(
		'setDate', 'today'
		);
	
  }
  

);
 $(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( "#datepicker3" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
	$( "#datepicker3" ).datepicker(
		'setDate', 'today'
		);
	
  }
  

);
 </script>
 