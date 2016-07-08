<?php  $this->load->view('admin/my_header.php');?>
    <div class="content-section mail_sec">
    <div class="container-liquid">
    <div class="row">
    <div class="col-xs-12">
    <div class="sec-box">                   
    <header>
    <h1 class="heading">Online Subscriptions</h1>
    </header>
    <div class="contents"> 
    <table class="table table-striped dtable">
    <thead>
    <tr>
    <th>Date</th>
    <th>Franchise code</th>
    <th>Franchise name</th>
    <th>Payment ID</th>
    <th>Transaction ID</th>
    <th>Amount</th>
     </tr>
     </thead>
     <tbody>
    <?php foreach($payouts as $k=>$v){ ?>
     <tr>
    <td><?php echo date('d M Y',strtotime($v['date'])); ?></td>
    <td><?php echo $v['f_code']; ?></td>
    <td><?php echo $v['f_name']; ?></td>
    <td><?php echo $v['payid']; ?></td>
    <td><?php echo $v['tid']; ?></td>
    <td><?php echo $v['amount']; ?></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <div style="padding:10px">  
<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
Add new Payout
</button>
</div>
</div>
<div class="clearfix"></div>
</div></div>
</div></div></div></div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add new payout</h4>
      </div>
      <form class="form-horizontal"  method="post" action="<?php echo BASE_URL ?>admin/payouts/insert_data">
      <div class="form-group">
      <label for="date" class="col-sm-2 control-label">date</label>
      <div class="col-sm-10">
      <input type="text" class="form-control datepicker" id="datepicker" placeholder="date" name="date">
      </div>
      </div>
      <div class="form-group">
      <label for="f_code" class="col-sm-2 control-label">Franchise code</label>
      <div class="col-sm-10">
      <select class="form-control" id="f_code"  name="f_code">
      <option value="">Select Franchise</option>
      <?php  foreach($franchise as $k=>$v){?>
      <option value="<?php echo $v['code'] ?>"><?php echo  $v['name']." ( ".$v['code']." ) ";?></option>
      <?php } ?>
      </select>
      </div>
      </div>
      <div class="form-group">
      <label for="f_code" class="col-sm-2 control-label">Payment Id</label>
      <div class="col-sm-10">
      <select class="form-control" id="pay_id"  name="pay_id">
      <option value="">Select Payment Id</option>
      
      </select>
      </div>
      </div>
      
      <div class="form-group">
      <label for="f_code" class="col-sm-2 control-label">Transaction ID</label>
      <div class="col-sm-10">
      <input type="text" name="transid" class="form-control" />
      </div>
      </div>
      
      <div class="form-group">
      <label for="f_code" class="col-sm-2 control-label">Amount</label>
      <div class="col-sm-10">
      <input type="text" name="amount"  class="form-control"/>
      </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-success">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
   <script type="application/javascript" src="<?php echo HTTP_JS_PATH ?>jquery.dataTables.min.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH ?>jquery.dataTables.css">
<script>
$(document).ready(function(){
    $('.dtable').DataTable();
$('.datepicker').datepicker();
});
$('#f_code').change(function(e) {
	if(fcode==''){
		alert('Please select Franchise')
		}
	var fcode = this.value;
	$('#pay_id').html('');
	$.ajax({
	url:'<?php echo BASE_URL ?>admin/payouts/get_payid',
	type:'post',
	data:{fc:fcode},
	 success: function(data){
		
   var dt = $.parseJSON(data); 
  // alert(dt.length);
   if(dt.length==0){
   $('#pay_id').html('<option value="">No payment id regarding this </option>')
   }
   else{
   $.each(dt, function(i,item) {
   $('#pay_id').append('<option value="'+item.payment_id+'">'+item.payment_id+'</option>');
   });
   }
	  }
});
	
});
</script>