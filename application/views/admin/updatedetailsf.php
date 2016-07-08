<?php 
//echo'<pre>';print_r($row);echo'<pre>';
$this->load->view('admin/my_header.php'); ?>

<div class="container-liquid">
        <div class="row">
                <div class="col-xs-12">
                        <div class="sec-box">                   
                        <header><h1 class="heading">Account Approvels</h1></header>
                         <div class="contents">
                                <table class="table table-striped" >
                                <thead>
                                        <tr>
                                                <th>Franchise-code</th>
                                                <th>Franchise-name</th>
                                                <th>Changed-date</th>                                                               
                                        </tr>
                                </thead>
                                <tbody>
                                <?php
									foreach($row as $rows)
									{
								?>
                                		<tr>
                                        		<td><a href="viewupdate?fcode=<?php echo $rows['temp_code']?>"><div><?php echo $rows['temp_code']?></div></a></td>
                                                <td><a href="viewupdate?fcode=<?php echo $rows['temp_code']?>"><div><?php echo $rows['temp_name']?></div></a></td>
                                                <td><a href="viewupdate?fcode=<?php echo $rows['temp_code']?>"><div><?php echo $rows['date']?></div></a></td>
                                        </tr>
                                <?php
									}
								?>        
                                </tbody>
                                </table>
                         </div>
                        <div class="clearfix"></div>
                        </div>
                </div>
        </div>
</div>

</body>
</html>
