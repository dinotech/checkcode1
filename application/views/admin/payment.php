<?php 

//echo'<pre>';print_r($row);die;
$this->load->view('admin/my_header.php'); ?>

<div class="container-liquid">
<div class="row">
<div class="col-xs-12">
<div class="sec-box">                   
<header>
<h1 class="heading"><?php if($_GET['user']=='subscriber'){?>Direct Payment<?php } else if($_GET['user']=='franchise'){?>Franchise  Payment<?php }  else if($_GET['user']=='executive'){?>Executive Payment<?php } ?></h1>
</header>
<div class="contents"> 

<table id="dtable" class="table table-striped" >
<thead>
<tr>
<th><?php if($_GET['user']=='subscriber'){?>Email<?php }elseif($_GET['user']=='franchise'){?>Franchise code<?php } elseif($_GET['user']=='executive'){?>Executive code<?php } ?></th>
<th>Pay Id</th>
<th>Date</th>
<th>Amount</th>
<th>Bank/DD/MO</th>
<th>Transaction Id/DD num/Sender Name</th>
<th>Approved Payment/Not Received</th>
<th>&nbsp;</th>

</tr>
</thead>
<tbody>
<?php  
if(sizeof($row)==0){ 
echo "<tr><td colspan='9' align='center'><h3>NO PAYMENT DETAILS</h3></td></tr>";
}
if($row != NULL)
{
foreach($row as $rows)
{
	//echo'<pre>';print_r($rows);
	$value = $this->payment_model->findetail($rows['user_id']);
	$var1 = unserialize($rows['payment_details']); 
//print_r($var1);die;	
	 
?>
	<tr >          
		<td><?php  if($_GET['user']=='subscriber'){echo $value[0]['email_id'];}else if($_GET['user']=='franchise'){echo $value[0]['code'];}else if($_GET['user']=='executive'){echo $value[0]['code'];}?></td>
		<td><?php echo $rows['payment_id']?></td>
		<td><?php if($rows['date']!=''){echo $rows['date'];}else{echo $rows['start_time'];}?></td>
		<td><?php if($var1['amount']!=''){echo $var1['amount'];}else{echo $rows['amount'];}?></td>
		<td><?php echo $var1['offline']?></td>
		<?php   
        if($var1['offline']=='MoneyOrder')
        {
        ?>
            <td> <?php echo $var1['sname'];	?></td>
        <?php 
        } 
        else if($var1['offline']=='DemandDraft')
        {
        ?>
            <td><?php echo $var1['ddnum']; 	?></td>
        <?php 
        } 
        else if($var1['offline']=='BankDeposite')
        {
        ?>
            <td><?php if(isset($var1['txid']) && $var1['txid'] != NULL){echo $var1['txid'];}else if(isset($var1['tensid']) && $var1['tensid'] != NULL){echo $var1['tensid'];} 	?></td>
        <?php 
        }
        else
        {
        ?>
            <td><?php echo ' ';?></td>
		<?php 
        } 
        ?>
<td>

<?php if($rows['status']==1){ ?>
<form method="post" action="<?php echo BASE_URL ?>admin/payment/change_state" >
    <input type="hidden" name="pay_id" value="<?php echo $rows['pay_id']?>"  />
    <input type="hidden" name="user" value="<?php echo $_GET['user']?>"  />
<?php if(isset($rows['pay_id']) && $rows['pay_id'] != NULL){?>
    <input type="submit" name="act" class="btn btn-success" value="Approve">
<?php }else{echo 'Payment Not Done';}?>
</form>
<?php }else if($rows['status']==2){echo "Payment Approved";} else if($rows['status']==0){?>
<form method="post" action="<?php echo BASE_URL ?>admin/payment/change_state" >
    <input type="hidden" name="pay_id" value="<?php echo $rows['pay_id']?>"  />
    <input type="hidden" name="user" value="<?php echo $_GET['user']?>"  />
    <input type="submit" name="act" class="btn btn-success" value="Payment Not Done">
</form>
}?>
</td>





</tr>
<?php } }?>

</tbody>

 
</table>

<?php

// Check if delete button active, start this
if(isset($_POST['delete'])){
for($i=0;$i<count($_POST['checkbox']);$i++){
$del_id=$_POST['checkbox'][$i];
$sql = "DELETE FROM payments WHERE payment_id=$del_id";
$result = mysql_query($sql);
}
// if successful redirect to delete_multiple.php
if($result){
redirect('admin/payment');

}
}
}
?>

 

</div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
<script type="application/javascript" src="<?php echo HTTP_JS_PATH ?>jquery.dataTables.min.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH ?>jquery.dataTables.css">

<script>
$(document).ready(function(){
    $('#dtable').DataTable();
});
</script>