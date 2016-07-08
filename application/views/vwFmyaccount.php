<?php 
//echo'<pre>';print_r($propdata);echo'</pre>';
$this->load->view('vwHeader');?>
<div class="container">
        <div class="row">
                <table class="table table-hover">
                        <tbody>
                        		<tr>
                                        <td>
                                                <div class="col-sm-4">
                                                        <label  class="control-label">Franchise Code</label>
                                                </div>
                                                <div class="col-sm-6">
                                                        <input type="text" value="<?php echo $userdata['code']?>" readonly="readonly"  class="form-control"/>
                                                </div>        
                                        </td>
                                        <td>
                                                <div class="col-sm-4">
                                                        <label  class="control-label">Franchise Name</label>
                                                </div>
                                                 <div class="col-sm-6">
                                                        <input type="text" value="<?php echo $userdata['name']?>"  readonly="readonly"  class="form-control"/>
                                                </div>  
                                         </td>
                                </tr>                        
                                <tr>
                                        <td>
                                                <div class="col-sm-4">
                                                        <label  class="control-label">Email ID</label>
                                                </div>
                                                <div class="col-sm-6">
                                                        <input type="text" value="<?php echo $userdata['email_id']?>"   class="form-control" readonly="readonly"/>
                                                </div>        
                                        </td>
                                        <td>
                                                <div class="col-sm-4">
                                                        <label  class="control-label">Mobile Num</label>
                                                </div>
                                                 <div class="col-sm-6">
                                                        <input type="text" value="<?php echo $userdata['mobile']?>"   class="form-control"  readonly="readonly"/>
                                                </div>  
                                         </td>
                                </tr>
                                <tr>
                                        <td colspan="2">
                                            <div class="col-sm-2">
                                                    <label  class="control-label">Address</label>
                                            </div>
                                             <div class="col-sm-9">
                                                    <textarea class="form-control"  readonly="readonly" style="text-align:left"><?php echo $userdata['address']; echo '&nbsp;';echo '&nbsp;';echo $userdata['city']; echo '&nbsp;';echo '&nbsp;';echo $userdata['district']; echo '&nbsp;';echo '&nbsp;';echo $userdata['state']; echo '&nbsp;';echo '&nbsp;';echo $userdata['country']; echo '&nbsp;';echo '&nbsp;';echo $userdata['pincode']; ?></textarea>
                                            </div>  
                                        </td>
                                </tr>
                                <tr>
                                        <td colspan="2">
                                                <div class="col-sm-2">
                                                        <label  class="control-label">Franchise Owner</label>
                                                </div>
                                                 <div class="col-sm-9">
                                                        <input type="text" value="<?php echo $propdata['fr_Name']?>" readonly="readonly"  class="form-control"/>
                                                </div>  
                                         </td>       
                                </tr>
                                <tr>
                                		<td colspan="2">
                                                <div class="col-sm-2">
                                                        <label  class="control-label">Mobile</label>
                                                </div>
                                                 <div class="col-sm-9">
                                                       <input type="text"  value="<?php echo $propdata['fr_mobile']?>"  readonly="readonly"  class="form-control"/>
                                                </div> 
                                        </td>       
                                </tr>
                                <tr>
                                        <td colspan="2">
                                                <div class="col-sm-2">
                                                        <label  class="control-label">Email</label>
                                                </div>
                                                 <div class="col-sm-9">
                                                        <input type="text"  value="<?php echo $propdata['fr_email']?>"  readonly="readonly"  class="form-control"/>
                                                </div>
                                        </td>            
                                </tr>
                                 <tr>
                                        <td colspan="2">
                                            <div class="col-sm-2">
                                                    <label  class="control-label">Address</label>
                                            </div>
                                             <div class="col-sm-9">
                                                    <textarea class="form-control" readonly="readonly"><?php echo $propdata['fr_address']; echo '&nbsp;'; ?>
                                                    </textarea>
                                            </div>  
                                        </td>
                                </tr>   
                        <form action="<?php echo base_url()?>admin/createlogin/updatedetails" method="post">                            
                                <tr>
                                        <td colspan="2">
                              
                                                <div class="col-sm-2">
                                                        <label  class="control-label">Bank Account </label>
                                                </div>
                                                 <div class="col-sm-9">
                                                        <input type="text" name="acno" class="form-control" value="<?php echo $propdata['fr_accno']; ?>"/>
                                                         		<input type="hidden" name="idf" value="<?php echo $userdata['code']; ?>" />
                                								<input type="hidden" name="namef" value="<?php echo $userdata['name']; ?>" />
                                                </div>
                                         </td>         
                                </tr>
                               <tr>
                                        <td colspan="2">
                                                <div class="col-sm-2">
                                                        <label  class="control-label">Bank Name</label>
                                                </div>
                                                 <div class="col-sm-9">
                                                       <input type="text" name="bank" class="form-control" value="<?php echo $propdata['fr_bankname']; ?>"/>
                                                </div>  
                                         </td>       
                                </tr>
                                <tr>
                                        <td colspan="2">
                                                <div class="col-sm-2">
                                                        <label  class="control-label">Branch Name</label>
                                                </div>
                                                 <div class="col-sm-9">
                                                        <input type="text" name="branch" class="form-control" value="<?php echo $propdata['fr_branch']; ?>"/>
                                                </div>
                                         </td>         
                                </tr>
                               <tr>
                                        <td colspan="2">
                                                <div class="col-sm-2">
                                                        <label  class="control-label">Account Name</label>
                                                </div>
                                                 <div class="col-sm-9">
                                                        <input type="text" name="nameofacc" class="form-control" value="<?php echo $propdata['fr_accname']; ?>"/>
                                                </div>  
                                          </td>      
                                </tr>
                               <?php /*?> <tr>
                                        <td colspan="2">
                                                <div class="col-sm-2">
                                                        <label  class="control-label">Type of account</label>
                                                </div>
                                                 <div class="col-sm-9">
                                                        <input type="text" name="typeofacc"  class="form-control" value="<?php echo $propdata['fr_address']; ?>"/>
                                                </div> 
                                         </td>       
                                </tr><?php */?>
                               <tr>
                                        <td colspan="2">
                                                <div class="col-sm-2">
                                                        <label  class="control-label">IFSC</label>
                                                </div>
                                                 <div class="col-sm-9">
                                                        <input type="text" name="ifsc" class="form-control" value="<?php echo $propdata['fr_ifsc']; ?>"/>
                                                </div>  
                                         </td>       
                                </tr>
                                <tr>
                                	<td colspan="2" style="text-align:center;">
                                    	<button class="btn btn-success" value="Save">Edit / Update</button>
                                    </td>
                                </tr>
                        </form>        
                        </tbody>
                </table>
        </div>
</div>


<?php $this->load->view('vwFooter');?>