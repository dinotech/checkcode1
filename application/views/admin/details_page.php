<?php  $this->load->view('admin/my_header.php');?>
<div class="content-section">
<div class="container-liquid">
<div class="row">
<div class="col-xs-12">
<div class="sec-box">
<header><h3 class="heading">Subscription Detials</h3></header>

<table class="table">
<tr>
<th>Email ID</th>
<td><?php echo $row[0]['email_id']; ?></td>
</tr>


<tr>
<th>Sub ID</th>
<td><?php echo $row[0]['sub_id']; ?></td>
</tr>


<tr>
<th>Name</th>
<td><?php echo $row[0]['name']; ?></td>
</tr>


<tr>
<th>Mobile</th>
<td><?php echo $row[0]['mobile']; ?></td>
</tr>

<tr>
<th>Sub Started Date</th>
<td><?php echo date('d M Y',strtotime($row[0]['start_time'])); ?></td>
</tr>

<tr>
<th>Last Renewal Date</th>
<td><?php if(isset($row[0]['renew_details']['renew_start_time'])){ echo $row[0]['renew_details']['renew_start_time']; }
else { echo "<b>No renewal</b>";} ?></td>
</tr>

<tr>
<th>Sub Magazines</th>
<td><?php
foreach($row[0]['mag_subs'] as $m=>$s){
echo $s['issue_name']." (<b>Expire on </b>-".date('d M Y',strtotime($row[0]['end_time'])).")
"."<br />";
}
?></td>

</tr>

<tr>
<th>Address</th>
<td><?php echo $row[0]['address']; ?></td>
</tr>

</table>

</div>
</div>
</div>
</div>
</div>
