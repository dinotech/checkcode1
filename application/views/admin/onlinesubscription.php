<?php  $this->load->view('admin/my_header.php');?>
    <div class="content-section mail_sec">
    <div class="container-liquid">
    <div class="row">
    <div class="col-xs-12">
    <div class="sec-box">                   
    <header>
    <h1 class="heading">Online</h1>
    </header>
    <div class="contents"> 
    <table class="table table-striped">
    <tr>
    <th>Date</th>
    <th>Sub-code</th>
    <th>Name</th>
    <th>Mobile Number</th>
    <th>Mail</th>
    <th>Magazine</th>
    <th>No of issue</th>
    </tr>
    <?php foreach($online as $k=>$v){ 
	
	//echo "<pre>";
	//print_r($v);?>
     <tr>
    <td><?php echo date('d M Y',strtotime($v['date'])); ?></td>
    <td><?php echo $v['payid']; ?></td>
    <td><?php echo $v['name']; ?></td>
    <td><?php echo $v['mobile']; ?></td>
    <td><?php echo $v['email_id']; ?></td>
    <td><?php $mag = $this->online_model->getmagbyid($v['subscription']); echo $mag['name']; ?></td>
    <td><?php echo $v['duration'] ?></td>
    </tr>
    <?php } ?>
    </table>
    </div>
    </div></div></div></div></div>