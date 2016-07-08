<?php 
//echo'<pre>';print_r($row);die;
$this->load->view('admin/my_header.php'); 
?>
<div class=" container">
<div class="row">

<?php if(($abt_to_expire!=1) && ($expired!=1) && ($all_subs!=1)){ ?>
<h1 class="heading">Manage subscribers</h1>

<div name="blk_btn" style="margin-top:2%; ">
<a href="<?php echo BASE_URL; ?>admin/subscription/abt_to_expire" type="button" class="btn btn-success" style="margin:3%;">About to expire subscription</a>
<a href="<?php echo BASE_URL; ?>admin/subscription/expired" type="button" class="btn btn-success" style="margin:3%;">Expired Subscriptions</a>
<a href="<?php echo BASE_URL; ?>admin/subscription/all_subs" type="button" class="btn btn-success" style="margin:3%;">View all subscribers</a>
</div>
</div>
</div>
<?php } if(isset($abt_to_expire) && ($abt_to_expire==1)){?>	
<h3 class="heading">About to expire subscriptions</h3>
<div class="table-box" align="center" style="margin-top:3%">
<div   style="margin-bottom:3%">
<div class="col-sm-12" style="margin-bottom:3%"><label class="col-sm-2">Search by</label><div class="col-sm-6"><input type="text" class="form-control" id="searched" /></div></div>
<div class="col-sm-12">
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="fr" name="fr" onclick="searching(this.id)">Franchise</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="ex" name="ex" onclick="searching(this.id)">Executive</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="St" name="State" onclick="searching(this.id)">State</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success"  id="Ci" name="City" onclick="searching(this.id)">City</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success"  id="noi" name="noi" onclick="searching(this.id)">No of issues</button></div>
</div>
<input type="hidden" name="action" id="act" value="1" />
</div>
<table class="table allsub" >
<thead>
<tr>
<th>Email</th>
<th>Magazine</th>
<th>Remaining issues</th>
<th>Name</th>
<th>Mobile</th>
</tr>
</thead>
<tbody class="result1" >
<?php foreach($row as $key=>$val){	
//echo "<pre>";print_r($val);
if((strtotime("now")<=strtotime($val['end_time'])) && (date('Y',strtotime('now'))==date('Y',strtotime($val['end_time'])))){?>
<tr href="<?php echo BASE_URL.'admin/subscription/details_page?user='.$val['user_id'].""; ?>">
<td><?php echo $val['email_id']; ?></td>
<td><?php $name=$this->subscribers_model->get_magbyid($val['mag_id']);
echo $name['name'];
?></td>
<td>
<?php 
$datestr = $val['end_time'];
$date=strtotime($datestr);//Converted to a PHP date (a second count)

//Calculate difference
$diff=$date-time();//time returns current time in seconds

$days=ceil($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=ceil(($diff-$days*60*60*24)/(60*60));
$months=ceil($days/30);
//Report
echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$months Issues<br />";


 ?></td>
<td><?php echo $val['name']; ?></td>
<td><?php echo $val['mobile']; ?></td>

</tr>
<?php } }?>
</tbody>
</table>
<?php }elseif(isset($expired) && $expired==1){?>
<h3 class="heading">Expired Subscriptions</h3>
<div style="margin-bottom:3%">
<div class="col-sm-12" style="margin-bottom:3%"><label class="col-sm-2">Search by</label><div class="col-sm-10"><input type="text" class="form-control" id="searched" /></div></div>
<div class="col-sm-12" style="margin-bottom:3%">
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="mag1" name="mag1" onclick="searching(this.id)">Magazine</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="fr" name="fr" onclick="searching(this.id)">Franchise</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="ex" name="ex" onclick="searching(this.id)">Executive</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="St" name="State" onclick="searching(this.id)">State</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success"  id="Ci" name="City" onclick="searching(this.id)">City</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success"  id="exp" name="exp" onclick="searching(this.id)">Expired Date</button></div>
</div>
<input type="hidden" id="act" name="action" value="2" />
</div>
<table class="table allsub " >
<thead>
<tr>
<th>Email</th>
<th>Magazine</th>
<th>Expired date</th>
<th>Name</th>
<th>Mobile</th>
<th>Hide from list</th>
</tr>
</thead>
<tbody  class="result2">
<?php 
foreach($row as $key=>$val){
//echo "<pre>";print_r($val);
//echo date('d-M-Y',strtotime("now")), "\n";
if(strtotime("now")>strtotime($val['end_time'])){?>
<tr href="<?php echo BASE_URL.'admin/subscription/details_page?user='.$val['user_id'].""; ?>">
<td><?php echo $val['email_id']; ?></td>
<td><?php $name = $this->subscribers_model->get_magbyid($val['mag_id']);
echo $name['name']; ?></td>
<td><?php echo date('d-M-Y',strtotime($val['end_time'])); ?></td>
<td><?php echo $val['name']; ?></td>
<td><?php echo $val['mobile']; ?></td>
<td>
<form action="<?php echo BASE_URL ?>admin/subscription/hide_row" method="post">
<button type="submit" name="subid" value="<?php echo $val['sub_id'] ?>" class="btn btn-success">Hide</button>
</form></td>
</a>
</tr>
<?php }} ?>
</tbody>
</table>
</div>
<?php }elseif(isset($all_subs) && $all_subs==1){?>	
<h3 class="heading">All subscribers</h3>
<div   style="margin-bottom:3%">
<div class="col-sm-12" style="margin-bottom:3%"><label class="col-sm-2">Search by</label><div class="col-sm-10"><input type="text" class="form-control" id="searched" /></div></div>
<div class="col-sm-12" style="margin-bottom:3%">
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="mag2" name="mag2" onclick="searching(this.id)">Magazine</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="fr" name="fr" onclick="searching(this.id)">Franchise</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="ex" name="ex" onclick="searching(this.id)">Executive</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success" id="St" name="State" onclick="searching(this.id)">State</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success"  id="Ci" name="City" onclick="searching(this.id)">City</button></div>
<div style="margin-left:8px; float:left"><button class="btn btn-success"  id="exp" name="exp" onclick="searching(this.id)">Expired Date</button></div>
</div>
<input type="hidden" name="action" id="act" value="3" />
</div>
<table class="table allsub">
<thead>
<tr>
<th>Email</th>
<th>Sub-magazines</th>
<th>Name</th>
<th>Mobile</th>
</tr>
</thead>
<tbody class="result3" >
<?php foreach($row as $key=>$val){
//echo "<pre>";print_r($val);?>
<tr href="<?php echo BASE_URL.'admin/subscription/details_page?user='.$val['user_id'].""; ?>">
<td><?php echo $val['email_id']; ?></td>
<td><?php
$c=0;
$name = $this->subscribers_model->get_edibyid($val['mag_id']);
foreach($name as $n=>$m){
if((strtotime($m['publish_date'])<=strtotime($val['end_time'])) && (strtotime($m['publish_date'])>=strtotime($val['start_time']))){
	echo $m['issue_name']."<br>";
$c++;
}
}
if($c==0){ echo "<h5 style='color:red'>Sorry!!No edition published during subscription duration</h5>";}	
?></td>
<td><?php echo $val['name']; ?></td>
<td><?php echo $val['mobile']; ?></td>
</tr>
<?php  } ?>
</tbody>
</table>

<?php } ?>

<script type="application/javascript" src="<?php echo HTTP_JS_PATH ?>jquery.dataTables.min.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH ?>jquery.dataTables.css">
<script>
$.extend( true, $.fn.dataTable.defaults, {
    "searching": false,
    "ordering": false,
});
 
$(document).ready(function(){
$('.allsub').DataTable();
});

</script>
<script>
function  searching(obj)
{
var items = $('#searched').val();
var user = 'subscriber';
$('.result1').html('');
$('.result2').html('');
$('.result3').html('');
$('.dataTables_info').html('');
var act =$('#act').val();
$('.result').html('');
$.ajax({
url:'<?php echo base_url()?>admin/subscription/search',
type:'post',
data:'obj='+obj+'&item='+items+'&user='+user+'&act='+act,
success:function(data)
{
	
	
var abhi = JSON.parse(data);
	if(abhi.length==0){
	if(act==1){		
$('.result1').append('<tr>'+'<td colspan="5">'+'No data found'+'</td></tr>');
	}if(act==2){
$('.result2').append('<tr>'+'<td colspan="6">'+'No data found'+'</td>'+'</tr>');
	}if(act==3){
$('.result3').append('<tr>'+'<td colspan="4">'+'No data found'+'</td></tr>');
}}
							
var count = abhi.length;
jQuery.each(abhi, function(index, itemt) {
if(act==1){		
$('.result1').append('<tr>'+'<td>'+itemt.email_id +'</td>'+'<td >'+itemt.mag_name+'</td>'+'<td >'+itemt.remain+'</td>'+'<td >'+itemt.name+'</td>'+'<td>'+itemt.mobile+'</td></tr>');
	}if(act==2){
$('.result2').append('<tr>'+'<td>'+itemt.email_id +'</td>'+'<td >'+itemt.mag_name+'</td>'+'<td >'+itemt.end_time+'</td>'+'<td >'+itemt.name+'</td>'+'<td>'+itemt.mobile+'</td>'+'<td>'+'<button type="submit" name="subid" value="'+itemt.sub_id+'"class="btn btn-success">Hide</button>'+'</td>'+'</tr>');
	}if(act==3){
$('.result3').append('<tr>'+'<td>'+itemt.email_id +'</td>'+'<td >'+itemt.mag_name+'</td>'+'<td >'+itemt.name+'</td>'+'<td>'+itemt.mobile+'</td></tr>');
}
})		
},				
});			
}

$(document).ready(function(){
    $('table tr').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
});
</script>
<style>
table tr {
    cursor: pointer;
}
</style>