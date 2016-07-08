<?php  $this->load->view('admin/my_header.php');?>

                          <div class="container-liquid">
    <div class="row">
    <div class="col-xs-12">
    <div class="sec-box">                   
    <header>
    <h1 class="heading">Transaction Register</h1>
    </header>
    <div class="contents"> 
                   
                     <table class="table table-striped dtable " >
                     <thead>
                     <tr>
                     <th>Date</th>
                     <th>Time</th>
                     <th>User Code</th>
                     <th>event</th>
                     </tr>
                     </thead>
                     <tbody>
                     <?php foreach($row as $key=>$rows){  ?>
                     <tr>
                     <td><?php echo date('d M Y',strtotime($rows['date'])) ?></td>
                     <td><?php echo $rows['time'] ?></td>
                     <td><?php echo $rows['usercode'] ?></td>
                     <td><?php echo $rows['event'] ?></td>
                     </tr>
                     <?php } ?>
                     </tbody>
                     </table>
                    


                                           


                </div>
                <div class="clearfix"></div>
                </div>
                
 <script type="application/javascript" src="<?php echo HTTP_JS_PATH ?>jquery.dataTables.min.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS_PATH ?>jquery.dataTables.css">
<script>
$(document).ready(function(){
    $('.dtable').DataTable();
});
</script>

</body>
</html>
