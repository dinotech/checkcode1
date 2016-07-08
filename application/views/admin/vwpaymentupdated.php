<?php  
//echo'<pre>';print_r($newdata);die;print_r($newresult);
$this->load->view('admin/my_header.php');?>
<form class="form-horizontal" method="post" action="<?php echo BASE_URL ?>admin/Paymentupload/makepay">

<div class="content-section mail_sec">
    <div class="container-liquid">
        <div class="row">
            <div class="col-xs-12">
                <div class="sec-box">                   
                    <header>
                    	<h1 class="heading">Payment upload</h1>
                    </header>                    
                    <div class="contents">
                        <div class="table-responsive"> 
	                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Amount</td>
                                    <td>Trans. Id</td>
                                    <td>Customer/<?php echo'</br>';?>Franchise/<?php echo'</br>';?>Executive</td>
                                    <td>Email/<?php echo'</br>';?>Franchise code/<?php echo'</br>';?>Executive code</td>
                                    <td>Approve</td>
                                </tr>
                            </thead>
                            <?php 
                                if($newresult==0 && $newdata ==0)
                                {
                                    echo'<td colspan=6 style="text-align:center">No Data Matched</td>';
                                }else
                                {
                            ?>
                                    
                            <tbody>
                            		<td><?php if(isset($newresult['modate']) && $newresult['modate'] != NULL){echo $newresult['modate'];}else if(isset($newresult['date']) && $newresult['date'] != NULL){echo $newresult['date'];}?></td>
                                    <td><?php echo $newresult['amount']?></td>
                                    <td><?php echo $newresult['payid']?></td>
                                    <td><?php echo $newdata['role']?></td>
                                    <td><?php if($newdata['code']=='direct'){echo $newdata['email_id']; }else{echo $newdata['code']; }?></td>
                                    
                                    <td><a href="<?php echo base_url()?>admin/createlogin/update_status1?pay_id=<?php echo $newresult['payid']?>"<button class="btn btn-success">Approve</button></td>
									
                            </tbody>
                            <?php
                                }
                            ?>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php die;?>