<?php $this->load->view('vwHeader');?>

<div class="heading">
<h3>My Account</h3>
</div>
<div class="container myaccount">
<div class="row">
<h3><strong>Edit Profile</strong></h3>

<div class="error">
<?php if(isset($error)){ 
echo "<p>".$error."</p>";
 } ?>
</div>

<?php if(isset($success)){ 
echo "<div class='bg-success'><p>".$sucess."</p><div>";
 } ?>
<div class="row">

<form action="<?php echo BASE_URL."editprofile/edit"; ?>" method="post" />
<table class="table table-hover">
 <tbody>
<tr><?php //echo "<pre>";print_r($userdata); ?>
<th><label  class="col-sm-4 control-label">NAME</label></th>
<td><input type="text" name="name" id="name" class="form-control" value="<?php echo $userdata['name'];?>" />
<input  type="hidden" name="user_id" value="<?php echo $userdata['user_id']; ?>"  />

</td>

</tr>

<tr>
<th><label  class="col-sm-4 control-label">GENDER</label></th>
<td>

<label  class="control-label">Male</label>
<input type="radio" name="gender" id="gender" value="Male"
<?php  if($userdata['gender']=='Male'){?> checked="checked" <?php } ?> />
<label class="control-label">Female</label>
<input type="radio" name="gender" id="gender" value="Female" 
<?php  if($userdata['gender']=='Female'){?> checked="checked" <?php } ?>/>
<label class="control-label">Other</label>
<input type="radio" name="gender" id="gender" value="Other" 
<?php  if($userdata['gender']=='Other'){?> checked="checked" <?php } ?>/>

</td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">CONTACT MAIL</label></th>
<td><input type="text" name="contect_mail" class="form-control" id="contect_mail" value="<?php echo $userdata['contect_mail'];?>" /></td>

</tr>

<tr>
<th><label  class="col-sm-4 control-label">DOB</label></th>
<td>
<input type="text" name="dob" id="datepicker" class="form-control datepicker" value="<?php echo $userdata['dob'];?>" />
</td>

</tr>

<tr>
<th><label  class="col-sm-4 control-label">MOBILE</label></th>
<td>
<input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $userdata['mobile'];?>" />
</td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">ADDRESS</label></th>
<td>
<input type="text" name="address" id="address" class="form-control" value="<?php echo $userdata['address'];?>" />
</td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">COUNTRY</label></th>
<td>
<input type="hidden" id="countryname" value="<?php echo $userdata['country'];?>" />
<select name="country" class="countries form-control " id="countryId">
<option  selected="selected" id="country_sel" value=""></option>
</select>
</td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">STATE</label></th>
<td>
<select name="state" class="states form-control " id="stateId">
<option  selected="selected" value="<?php echo $userdata['state'];?>"><?php echo $userdata['state'];?></option>
</select>
</td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">CITY</label></th>
<td>
<select name="city" class="cities form-control " id="cityId">
<option selected="selected" value="<?php echo $userdata['city'];?>"><?php echo $userdata['city'];?></option>
</select>
</td>
</tr>

<tr>
<th><label  class="col-sm-4 control-label">DISTRICT</label></th>
<td>
<input type="text" name="district" class="form-control" id="district" value="<?php echo $userdata['district'];?>" />
</td>
</tr>



<tr>
<th><label  class="col-sm-4 control-label">PINCODE</label></th>
<td>
<input type="text" name="pincode" class="form-control" id="pincode" value="<?php echo $userdata['pincode'];?>" />
</td>
</tr>



<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
<input type="submit" name="submit" class="btn btn-primary" id="submit" value="Edit Details" />
</td>
</tr>


 </tbody>
 </table>
 </form>
 </div>
 </div></div>
<?php $this->load->view('vwFooter');?>
<script>
$('#datepicker').datepicker();

</script>
<script>

    function ajaxCall() {
        this.send = function(data, url, method, success, type) {
          type = type||'json';
          var successRes = function(data) {
              success(data);
          }

          var errorRes = function(e) {
              console.log(e);
             // alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);
              $('#loader').modal('hide');
          }
            $.ajax({
                url: url,
                type: method,
                data: data,
                success: successRes,
                error: errorRes,
                dataType: type,
                timeout: 60000
            });

          }

        }

function locationInfo() {
    var rootUrl = "http://lab.iamrohit.in/php_ajax_country_state_city_dropdown/api.php";
    var call = new ajaxCall();
    this.getCities = function(id) {
        $(".cities option:gt(0)").remove();
        var url = rootUrl+'?type=getCities&stateId=' + id;
        var method = "post";
        var data = {};
        $('.cities').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
            $('.cities').find("option:eq(0)").html("Select City");
            if(data.tp == 1){
                $.each(data['result'], function(key, val) {
                    var option = $('<option />');
                    option.attr('value', val).text(val);
                     option.attr('cityid', key);
                    $('.cities').append(option);
                });
                $(".cities").prop("disabled",false);
            }
            else{
                 alert(data.msg);
            }
        });
    };

    this.getStates = function(id) {
        $(".states option:gt(0)").remove(); 
        $(".cities option:gt(0)").remove(); 
        var url = rootUrl+'?type=getStates&countryId=' + id;
        var method = "post";
        var data = {};
        $('.states').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
            $('.states').find("option:eq(0)").html("Select State");
            if(data.tp == 1){
                $.each(data['result'], function(key, val) {
                    var option = $('<option />');
                        option.attr('value', val).text(val);
                        option.attr('stateid', key);
                    $('.states').append(option);
                });
                $(".states").prop("disabled",false);
            }
            else{
                alert(data.msg);
            }
        }); 
    };

    this.getCountries = function() {
        var url = rootUrl+'?type=getCountries';
        var method = "post";
        var data = {};
        $('.countries').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
			var countryname = $('#countryname').val();
           $('.countries').find("option:eq(0)").html(countryname);
            console.log(data);
            if(data.tp == 1){
                $.each(data['result'], function(key, val) {
                    var option = $('<option />');
                    option.attr('value', val).text(val);
                     option.attr('countryid', key);
                    $('.countries').append(option);
                });
                $(".countries").prop("disabled",false);
            }
            else{
                alert(data.msg);
            }
        }); 
    };

}

$(function() {
var loc = new locationInfo();
loc.getCountries();
 $(".countries").on("change", function(ev) {
        var countryId = $("option:selected", this).attr('countryid');
        if(countryId != ''){
        loc.getStates(countryId);
        }
        else{
            $(".states option:gt(0)").remove();
        }
    });
 $(".states").on("change", function(ev) {
        var stateId = $("option:selected", this).attr('stateid');
        if(stateId != ''){
        loc.getCities(stateId);
        }
        else{
            $(".cities option:gt(0)").remove();
        }
    });
});

</script>