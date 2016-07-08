
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
$data['id']="pt";
$this->load->view('admin/vwHeader',$data);
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
 <option value="3" >Sales</option>
 <option value="4" >Stock Purchase</option>
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
  <form name="select_godown" method="post" id="select_godown">
    <table align="center">
    <tr> 
    <th>Select Godown<br/><br/><br/><br/></th><td>
    <select name="selectg"  id="selectg">
    <option value="first">----Select----</option>
    <?php foreach($row as $rows){	//onchange="change_val1(<?php echo $_POST['numbers'];)"
		?>
    <option value="<?php echo $rows['g_id'];?>"><?php echo $rows['g_name'];?></option>
	
	<?php }?>
    </select><br/><br/><br/><br/></td>
    <td>
    <input type="hidden" name="numbe" value="2" id="numbe"/></td></tr></table>
	 <div style="text-align:center">Date From:<input type="text" id="datepicker" name="from"/>
    Date To:<input type="text" id="datepicker1" name="to"/>
   <br/><br/><br/>

<input type="button"  class="btn" id="src" name="submit2" value="submit" onclick="nextgodown()" />
</div></form>
	
	<?php } ?>
 <?php if(isset($_POST['submit']) && $_POST['numbers']==1){ ?> 
 <form name="select_deal" method="post" id="select_deal" >
 <table align="center">
 <tr>
 <th>Select Dealer<br/><br/><br/><br/></th>
 <td>
 <select name="selectr" id="selectr" >
  <option value="first">----Select----</option>
  <?php foreach($row as $rows){ ?>
  <option value="<?php echo $rows['dealer_id'];?>"><?php echo $rows['d_name'];?></option>
  <?php } ?>
 </select><br/><br/><br/><br/></td><td>
 <input type="hidden" name="numb" value="1" id="numb" />
 </td>
 </tr>
 </table>
  <div style="text-align:center">Date From:<input type="text" id="datepicker2" name="from"/>
    Date To:<input type="text" id="datepicker3" name="to"/><br/><br/><br/>
    <input type="button"  class="btn" id="src" name="submit3" value="submit" onclick="nextdealer()" />
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
        <th>Date</th>
         <th>Transaction</th>
         <th>Party Name</th>
         <th>No. of Bags Inword</th>
         <th>No. of Bags Outword</th>
         <th>OPC/PPC</th>
         <th>Type</th>
         <th>Action</th>
         </tr>
         </thead><tbody>
         <?php
		 $sum=0;$credit=0;$debit=0;$s=0;$opcin=0;$opcout=0;$ppcin=0;$ppcout=0;
			foreach($saleg as $salegs){?>
         <tr><td><?php 
		 $originalDate = $salegs['other_date'];
$newDate = date("d-M-Y", strtotime($originalDate));
		 
		 echo $newDate;?></td><td>Sale</td>
          <td><?php echo $salegs['d_name'];?></td>
           <td>-</td>
           <td><?php 
		  $sum=$sum+$salegs['no_of_bags'];
	
		  echo $salegs['no_of_bags'];
		  ?></td>
          <td><?php if($salegs['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}
		  if($salegs['opc_ppc']==0){$opcout=$opcout+$salegs['no_of_bags'];}else{$ppcout=$ppcout+$salegs['no_of_bags'];}
		  
		  ?></td>
          <td><?php if($salegs['t_nt']==1){ echo "Cement";} if($salegs['t_nt']==2) { echo "Shree Cement"; }?></td>
          <td><h5 style="color: darkblue;cursor: pointer;">
         <a target="_blank" href="editsales?id=<?php echo $salegs['sales_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
         </tr>
         
         <?php } 
		 $sum1=0;
		 foreach($purchaseg as $purchasegs){
			 ?>
             <tr>
      <td><?php 
	  $originalDate = $purchasegs['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
	  
	  echo $newDate; ?></td><td>Purchase</td>
      <td><?php echo $purchasegs['d_name'];?></td>
       <td><?php 
	  $sum1=$sum1+$purchasegs['no_of_begs'];
	  echo $purchasegs['no_of_begs'];?></td>
      <td>-</td>
      <td><?php if($purchasegs['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}
	  if($purchasegs['opc_ppc']==0){$opcin=$opcin+$purchasegs['no_of_begs'];}else{$ppcin=$ppcin+$purchasegs['no_of_begs'];}
	  
	  
	  ?></td>
      <td><?php if($purchasegs['t_nt']==1){ echo "Cement";} if($purchasegs['t_nt']==2) { echo "Shree Cement"; }?></td>
      <td><h5 style="color: darkblue;cursor: pointer;">
      <a target="_blank" href="editstockpurchase?id=<?php echo $purchasegs['source_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
      <?php } ?>
      </tbody>
        <?php  if(empty($saleg)&&empty($outwardg)&&empty($rentg)&&empty($purchaseg)){echo "<tr><td></td><td></td><td>No record found</td><td></td><td></td><td></td></tr>";}else{   ?>
         <tr><td>Total:</td><td></td><td></td><td><?php echo $sum1;$sum1m=$sum1/20;echo "&nbsp&nbsp(".$sum1m." metricton)"; ?></td><td><?php echo $sum;$sum_m=$sum/20;echo "&nbsp&nbsp(".$sum_m." metricton)"; ?></td><td></td><td></td></tr><?php }?></tr></table>
	 </div>
            <br/><br/><div style="width:50%;float:right;" id="ddata" class="rep">
      <table class="table table-hover tablesorter"><tr><th>OPC/PPC</th><th>IN</th><th>OUT</th><th>Total</th></tr>
      <td>OPC</td><td><?php echo $opcin;?></td><td><?php echo $opcout;?></td><td><?php $d=$opcin-$opcout;echo $d;?></td>
      </tr><tr><td>PPC</td><td><?php echo $ppcin;?></td><td><?php echo $ppcout;?></td><td><?php $pd=$ppcin-$ppcout;echo $pd;?></td>
      </tr><tr><td><strong>Total Stock</strong></td><td></td><td></td><td><?php $sum=$d+$pd;echo $sum;?></table></div>
            
            
	 <?php
     }
 if(isset($_POST['submit']) && $_POST['numbers']==7){?>
 <h4 style="margin-left: 27px; color: #C50808;">All Party Report :</h4>
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
         <th>Purchase</th>
         <th>Sale</th>
         <th>Rent</th>
         </tr>
      </thead>
      <tbody>
 <?php    foreach($sale as $sales){
		  ?>
		  <tr><td><?php echo $sales['d_name'];?></td><td><?php 
		  $originalDate = $sales['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		  
		  echo $newDate;?></td>
          <td>-</td>
          <td><?php 
		  $sum=$sum-$sales['no_of_bags'];
		  echo "-".$sales['no_of_bags'];?></td>
          <td><?php if($sales['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
          <td><?php if($sales['pay_flow']==1){ echo "Cash";} else if($sales['pay_flow']==2){ echo "Cheque";} else { echo "Credit";}?></td>
          <td>-</td>
          <td><?php echo $sales['prices'];?></td>
          <td>-</td>
          </tr>
		  <?php }
	  
	  foreach($stockpurchase as $stockpurchases){
		  
	  ?><tr>
      <td><?php echo $stockpurchases['d_name'];?></td>
      <td><?php 
	  $originalDate = $stockpurchases['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
	  
	  echo $newDate; ?></td>
      <td>-</td>
      <td><?php 
	  $sum=$sum+$stockpurchases['no_of_begs'];
	  echo $stockpurchases['no_of_begs'];?></td>
      <td><?php if($stockpurchases['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
      <td><?php if($stockpurchases['pay_flow']==1){ echo "Cash";} else if($stockpurchases['pay_flow']==2){ echo "Cheque";} else { echo "Credit";}?></td>
      <td><?php echo $stockpurchases['price']; ?></td>
      <td>-</td>
      <td>-</td>
    
      </tr></tbody>
      <?php } if(empty($stockinrent)&&empty($rent)&&empty($sale)&&empty($stockpurchase)){echo "<tr><td></td><td></td><td>No records found</td><td></td><td></td><td></td></tr>";}else {?>
      <tr><td>Total:</td><td></td><td></td><td><?php echo $sum;  $sum=$sum/20;echo "&nbsp&nbsp(".$sum." metricton)"; ?></td><td></td><td></td><td></td></tr>
      <?php }?></table>
            
 </div>
 
 
 <?php }
 if(isset($_POST['numb']) && $_POST['numb']==1 ){ ?>
 <h4 style="margin-left: 27px; color: #C50808;">Dealer Report :<?php echo $row[0]['d_name'];?></h4>
  <?php if(!empty($row[0]['d_name'])){echo "&nbsp &nbsp &nbsp  Dealer Name: ";  echo $row[0]['d_name']."<br/>"; }?>
       <?php if(!empty($row[0]['d_address'])){ echo "&nbsp &nbsp &nbsp	Address: "; echo $row[0]['d_address']."<br/>"; }?>
       <?php if(!empty($row[0]['phone']) && $row[0]['phone']!=0){ echo "&nbsp &nbsp &nbsp Phone No.: "; echo $row[0]['phone']."<br/>"; }?>
       <?php if(!empty($row[0]['mobile']) && $row[0]['mobile']!=0){ echo "&nbsp &nbsp &nbsp	Mobile : "; echo $row[0]['mobile']."<br/>"; }?><br/><br/><br/><br/>
     <div id="ddata" class="rep"> 
      <table id="myTable" class="tablesorter table table-hover " >
      <thead>
         <tr>
        
         <th>Date</th>
         <th>Transaction</th>
         <th>No. of bags Inward</th>
         <th>No. of bags Outward</th>
         <th>OPC/PPC</th>
        
         <th>Debit</th>
         <th>Credit</th>
         <th>Action</th>
         
         </tr></thead>
         <tbody>
       
         
       <?php
	  $sum=0;$credit=0;$debit=0;$sum1=0;$opcin=0;$opcout=0;$ppcin=0;$ppcout=0;$opccredit=0;$opcdebit=0;$ppccredit=0;$ppcdebit=0;
	  foreach($sale as $sales){
		  ?>
		  <tr><td><?php 
		  $originalDate = $sales['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		  
		  echo $newDate;?></td>
          <td>Sale</td><td>-</td>
          <td><?php 
		  $sum1=$sum1+$sales['no_of_bags'];
		  
		  echo $sales['no_of_bags'];
		  ?></td>
          <td><?php if($sales['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
          <td><?php $s=$sales['prices']*$sales['no_of_bags'];echo $s;$credit=$credit+$s; 
		  if($sales['opc_ppc']==0){$opcout=$opcout+$sales['no_of_bags'];$opccredit=$opccredit+$s;}else{$ppcout=$ppcout+$sales['no_of_bags'];$ppccredit=$ppccredit+$s;}
		  
		  ?></td><td>-</td>
          <td><h5 style="color: darkblue;cursor: pointer;">
          <a target="_blank" href="editsales?id=<?php echo $sales['sales_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
          </tr>
		  <?php }
	  
	  foreach($stockpurchase as $stockpurchases){
		  
	  ?><tr>
      <td><?php 
	  $originalDate = $stockpurchases['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
	  
	  echo $newDate; ?></td>
      <td>Purchase</td>
      <td><?php 
	  $sum=$sum+$stockpurchases['no_of_begs'];
	  echo $stockpurchases['no_of_begs'];?></td><td></td>
      <td><?php if($stockpurchases['opc_ppc']==0){ echo "OPC";} else { echo "PPC";}?></td>
      <td>-</td>
      <td><?php $s=$stockpurchases['price']*$stockpurchases['no_of_begs'];echo $s;$debit=$debit+$s; 
	  if($stockpurchases['opc_ppc']==0){$opcin=$opcin+$stockpurchases['no_of_begs'];$opcdebit=$opcdebit+$s;}else{$ppcin=$ppcin+$stockpurchases['no_of_begs'];$ppcdebit=$ppcdebit+$s;}
	  
	  ?></td>
      <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a target="_blank" href="editstockpurchase?id=<?php echo $stockpurchases['source_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5>
      </td>
      </tr><?php } foreach($preceived as $preceive){ ?>
      <tr>
      <td><?php 
	  $originalDate = $preceive['date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
	  
	  echo $newDate; ?></td><td>Payment Received</td><td>-</td><td>-</td><td>-</td><td>-</td><td><?php echo $preceive['price'];$debit=$debit+$preceive['price'];?></td>
      <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a target="_blank" href="editpaymentr?id=<?php echo $preceive['id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
      </tr><?php }foreach($ppayed as $pay){ ?>
      
      <tr>
      <td><?php 
	  $originalDate = $pay['date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
	  
	  echo $newDate; ?></td><td>Payment Paid</td><td>-</td><td>-</td><td>-</td><td><?php echo $pay['price'];$credit=$credit+$pay['price'];?></td><td>-</td>
      <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a target="_blank" href="editpaymentp?id=<?php echo $pay['id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
    
      </tr>
      
      </tbody>
      
      <?php } if(empty($stockinrent)&&empty($rent)&&empty($sale)&&empty($stockpurchase)){echo "<tr><td></td><td></td><td>No records found</td><td></td><td></td><td></td></tr>";}else {?>
      <tr><td>Total:</td><td></td><td><?php echo $sum;  $sum=$sum/20;echo "&nbsp&nbsp(".$sum." metricton)"; ?></td><td><?php echo $sum1;  $sum1=$sum1/20;echo "&nbsp&nbsp(".$sum1." metricton)"; ?></td><td>-</td><td><?php echo $credit;?></td><td><?php echo $debit;?></td><td></td></tr>
      <?php }?></table></div>     
            
            <br/><br/><div style="width:50%;float:right;" id="ddata" class="rep">
      <table  class="table table-hover tablesorter"><tr><th>OPC/PPC</th><th>IN</th><th>OUT</th><th>Total</th></tr>
      <tr><td>OPC</td><td><?php echo $opcin;?></td><td><?php echo $opcout;?></td><td><?php $d=$opcin-$opcout;echo $d;?></td>
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
         <th>Action</th>
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
         <td><?php echo $rows['g_name'];?></td>
         <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a target="_blank" href="editsales?id=<?php echo $rows['sales_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5>
         </td>
         
         </tr></tbody>
        <?php $i++;} if(empty($row)){echo "<tr><td></td><td></td><td>No Records Found</td><td></td><td></td></tr>";}else{?><tr><td>Total:</td><td></td><td><?php echo $sum;?></td><td></td><td></td><td></td></tr><?php } ?> </table>
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
         <th>Action</th>
         </tr></thead>
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
         <td><?php echo $rows['g_name'];?></td>
         <td><h5 style="color: darkblue;cursor: pointer;">
       
  <a target="_blank" href="editstockpurchase?id=<?php echo $rows['source_id']; ?>" class="btn btn-success btn-xs">Edit</a></h5></td>
         </tr> <?php $i++;} if(empty($row)){echo "<tr><td></td><td></td><td>No Records Found</td><td></td><td></td><td></td></tr>";}else{?><tr><td>Total:</td><td></td><td><?php echo $sum;?></td><td></td><td></td></tr><?php } ?></table>
 </div>
 
 <?php } if(isset($_POST['submit']) && $_POST['numbers']==5){ ?>
 <h4 style="margin-left: 27px; color: #C50808;">Stock In Rent Report :</h4>
 <div id="srdata" class="rep">
 <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Date</th>
         <th>Dealer Name</th>
         <th>No. Of Bags</th>
         <th>Rent Price</th>
         </tr></thead>
         <?php $i=1;$sum=0; foreach($row as $rows){ ?>
         <tr>
        <td><?php 
		  $originalDate = $rows['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		 echo $newDate;
		 ?></td>
         <td><?php echo $rows['d_name'];?></td>
         <td><?php $sum=$sum+$rows['no_of_begs'];echo $rows['no_of_begs'];?></td>
         <td><?php echo $rows['r_price'];?></td>
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
<?php }

if(isset($_POST['submit1']) && $_POST['cement']==1){
	$sum=$sum_in=0;
	?>
<h4 style="margin-left: 27px; color: #C50808;">Shree Cement Report :</h4>
 <div id="srdata" class="rep">
 <table class="table table-hover tablesorter">
      <thead>
         <tr>
         <th>Date</th>
         <th>Challan no.</th>
         <th>Bilty no.</th>
         <th>No. Of Bags</th>
         <th>Party name</th>
         </tr>
         </thead><tbody>
         
<?php $sum=0;?>
 
 <?php 
	  foreach($inword as $inwords){
		  ?>
		  <tr><td><?php 
		  
		  
		  echo date("d-M-Y", strtotime($inwords['date']));?></td>
          <td>-</td>
          <td><?php echo $inwords['builtyno']; ?></td>
          <td><?php 
		  if (substr($inwords['noofbags'], 0, 1) === '-') {$str=$inwords['noofbags'];
		   $str = ltrim($str, '-');
		
		  $sum=$sum-$str;
		   }else{ $sum=$sum+$inwords['noofbags'];}
		  
		  echo $inwords['noofbags'];?></td><td><?php echo "-";?></td>
      
          </tr>
		  
		 <?php  }  ?>
 
 
 
 
 
<?php	foreach($outward as $rows){?>
         <tr>
        <td>
         <?php 
		 $originalDate = $rows['other_date'];//"2010-03-21";
$newDate = date("d-M-Y", strtotime($originalDate));
		 echo $newDate;?></td>
         <td><?php echo $rows['challanno'];?></td>
         <td>-</td>
        <td><?php 
		 $sum=$sum+$rows['no_of_begs'];
		 echo $rows['no_of_begs'];?></td>
         <td><?php echo $rows['d_name'];?></td>
              </tr><?php }   ?>
		 <?php 
		  if(empty($inword)&&empty($outward)){echo "<tr><td></td><td></td><td></td><td>No Records Found</td></tr>";}else{
	   ?></tbody><tr><td>Total:</td><td></td><td><?php echo $sum_in; $sum_in=$sum_in/20; echo "&nbsp &nbsp(".$sum_in." metricton)"; ?></td><td><?php echo $sum; $sum=$sum/20; echo "&nbsp &nbsp(".$sum." metricton)"; ?></td></tr><?php } ?>
</table>
<?php

}
?>

<?php 
	
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
 