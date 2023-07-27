<div class="page_banner banner price-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Login / Sign Up</div>
				</div>
			</div>
		</div>
	</div>
	<main>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="page-tab">
						<div id="form">
							<div id="userform">
								<ul class="nav nav-tabs nav-justified" role="tablist">
									<li class="active border-right"><a href="#login"  role="tab" data-toggle="tab">Log in</a></li>
									<li><a href="#signup" role="tab" data-toggle="tab">Sign up</a></li>
								</ul>
								<div class="tab-content">
								<div class="tab-pane fade active in" id="login">
									<form id="login_form" method="post" action="<?= base_url('user/login/actionLogin')?>">
										<div class="form-group">
										 <span class="text-danger text-center f-25"><?=$this->session->flashdata('error');  ?></span>
                                      </div>
										<div class="form-group">
											<label>E-mail<span style="color:red">*</span><span id="error_email"></span></label>
											<input type="email" class="form-control" name="login_email" id="login_email"  autocomplete="off">
											<div class="search_icon"><span class="ti-user"></span></div>
										</div>
										<div class="form-group">
											<label>Password<span style="color:red">*</span><span id="error_password"></span></label>
											<input type="password" class="form-control"  name="login_password" id="login_password"autocomplete="off">
											<div class="search_icon"><span class="ti-lock"></span></div>
											<a href="javascript:void(0)">Forgot your password or having trouble logging in?</a>
										</div>
										<div class="form-group form-check">
											<input type="checkbox" class="form-check-input" id="exampleCheck1">
											<label class="form-check-label" for="exampleCheck1">Save my login information</label>
										</div>
										<div class="mrgn-30-top">
											<button type="submit" class="btn btn-larger btn-block" onclick="return validation()" />Log in</button>
										</div>
									</form>
								</div>
								<div class="tab-pane fade" id="signup">
									<form id="signup_form" action="#" method="post">
										<div class="form-group">
											<h4>Your Information</h4>
										</div>
										<div class="form-group">
											<label>First Name<span style="color:red">*</span></label>
											<input type="text" class="form-control" name="firstname" id="first_name" required autocomplete="off" onkeypress="only_alphabets(event)">
											<div class="search_icon"><span class="ti-user"></span></div>
										</div>
										<div class="form-group">
											<label>Last Name<span style="color:red">*</span></label>
											<input type="text" class="form-control" name="lastname" id="last_name" required autocomplete="off" onkeypress="only_alphabets(event)">
											<div class="search_icon"><span class="ti-user"></span></div>
										</div>
										<div class="form-group">
											<label>Job Title<span style="color:red">*</span></label>
											<input type="text" class="form-control" name="job_title" id="job_title" required >
											 <div class="search_icon"><span class="ti-user"></span></div>
										</div>
										<div class="form-group">
											<label>Email Address<span style="color:red">*</span> <span id="err_email"></span></label>
											<input type="email" class="form-control" name="email" id="email_address" autocomplete="off" required >
											<div class="search_icon"><span class="ti-email"></span></div>
										</div>
										<div class="form-group">
											<label>Re-enter Email Address<span style="color:red">*</span></label>
											<input type="email" class="form-control" id="reemail_address" required autocomplete="off">
											<div class="search_icon"><span class="ti-email"></span></div>
										</div>
											<div class="form-group">
											<label id="check_email"></label>
										</div>
										<div class="form-group">
											<label>Phone Number<span style="color:red">*</span> <span id="err_phone"></span></label>
											<input type="text" class="form-control" name="mobile" id="phone_number" required autocomplete="off" onkeypress="only_number(event)" maxlength="10">
											<div class="search_icon"><span class="ti-mobile"></span></div>
										</div>
										<div class="form-group">
											<label>Ext</label>
											<input type="text" class="form-control" name="ext" id="ext"  autocomplete="off">
											<div class="search_icon"><span class="ti-world"></span></div>
										</div>
										<div class="form-group">
											<label>Fax Number</label>
											<input type="text" class="form-control"name="" faxid="fax_number"  autocomplete="off">
											<div class="search_icon"><span class="ti-printer"></span></div>
										</div>
										<div class="form-group">
											<h4>Your Company's Information</h4>
										</div>
										<div class="form-group">
											<label>User Type<span style="color:red">*</span> <span id="err_usertype"></span></label>
											<div class="row">
												<div class="col-md-3">
												<input type="radio" name="userType" value="1" checked>
												Job Seeker
												</div>
												<div class="col-md-3">
												<input type="radio" name="userType" value="2">
												Employer
												</div>

											</div>
										</div>
										<div class="form-group">
											<label>Company</label>
											<input type="text" class="form-control" name="company" id="company"  autocomplete="off">
											<div class="search_icon"><span class="ti-bag"></span></div>
										</div>
										<div class="form-group">
											<label>Organization Type</label>
											<select class="form-control" name="organization_type" id="last_name" >
												<option value="Ad Agency">Ad Agency</option>
												<option value="Employer">Employer</option>
												<option value="Recruiting Firm">Recruiting Firm</option>
											</select>
											<div class="search_icon"><span class="ti-shine"></span></div>
										</div>
										<div class="form-group">
											<label>Address <span class="text-danger"></span></label>
											<input type="text" class="form-control" name="address1" id="location" oninput="getsourceaddress();"  autocomplete="off" required>
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>
										<div class="form-group">
											<label>Address 2</label>
											<input type="text" class="form-control" name="address2" id="address2" autocomplete="off">
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>
										<div class="form-group">
											<label>City<span style="color:red">*</span></label>
											<input type="text" class="form-control" name="city" id="city" required  autocomplete="off">
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>
										<div class="form-group">
											<label>State / Province<span style="color:red">*</span></label>
											<select id="state_select" name="state" class="form-control" required>
												 <option value="">Select State</option>
											<?php if(!empty($get_state)){ foreach($get_state as $row){?>
											   <option value="<?= $row->name?>"><?= ucfirst($row->name)?></option>
											  <?php } }?>

											</select>
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>
										<div class="form-group">
											<label>Other </label>
											<input type="text" class="form-control" name="other" id="other_state"  autocomplete="off">
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>
										<div class="form-group">
											<label>Zip / Postal Code<span style="color:red">*</span></label>
											<input type="text" class="form-control" name="zipcode" id="zipcode" required autocomplete="off">
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>
										<div class="form-group">
											<label>Country<span style="color:red">*</span></label>
										<select id="country" name="country" class="form-control" required>
											 <option value="">Select Country</option>
											<?php if(!empty($get_country)){ foreach($get_country as $row){?>
											   <option value="<?= $row->name?>"><?= ucfirst($row->name)?></option>
											  <?php } }?>
											</select>
											<div class="search_icon"><span class="ti-world"></span></div>
										</div>
										<div class="form-group">
											<h4>Security</h4>
											<p>Passwords must be between 6 and 25 characters</p>
										</div>
										<div class="form-group">
											<label>Password<span style="color:red;">*</span> <span id="err_pass"></span></label>
											<input type="password" class="form-control" name="password" id="password" required autocomplete="off">
											<div class="search_icon"><span class="ti-lock"></span></div>
										</div>
										<div class="form-group">
											<label>Confirm Password<span style="color:red">*</span></label>
											<input type="password" class="form-control" id="confirm_password"required  autocomplete="off">
											<div class="search_icon"><span class="ti-lock"></span></div>
										</div>
										<div class="form-group">
											<label id="check_password"></label>
										</div>
										<div class="mrgn-30-top">
											<button type="submit" class="btn btn-larger btn-block"/>Sign up</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</main>


  <script type="text/javascript">
$(document).ready(function() {
$("#signup_form").submit(function(e) {
e.preventDefault();

if($('#email_address').val()!=$('#reemail_address').val())
{

	swal({
title: "Email does not match !",
type: "warning",
confirmButtonColor: '#A5DC86',
confirmButtonText: 'ok',
closeOnConfirm: false,
}, function(isConfirm){
if (isConfirm) {
swal.close();

}
});
}
var password=$('#password').val();

if(password.length<6)
{
    $("#err_pass").fadeIn().html("please enter at least 6 character").css('color','red');
        setTimeout(function(){$("#err_pass").html("&nbsp;");},3000)
    $("#password").focus();
     return false;
}
var re_password=$('#confirm_password').val();
if(password!=re_password)
{
    $('#check_password').html('password does not match').css('color','red');
    setTimeout(function(){$("#check_password").html("&nbsp;");},3000)
    return null
}
var formData = new FormData(this);
$.ajax({
        type: "POST",
        url: "<?= base_url('user/login/register') ?>",
        data: formData,
         cache: false,
          contentType: false,
         processData: false,
         dataType:'json',
        success:function(returndata)
            {
                if(returndata.result==1)
                    {
                     window.location.href='<?= base_url('login')?>';
                    }
                   if(returndata.result=='0')
				 {
				 		if(returndata.data=='phone')
							 {
								 swal({
            title: "Phone number already exits !",
            type: "warning",
            confirmButtonColor: '#A5DC86',
            confirmButtonText: 'ok',
            closeOnConfirm: false,
        }, function(isConfirm){
            if (isConfirm) {
                swal.close();

            }
        });
				return false;
								}
                   if(returndata.data=='email'){
										 swal({
 						title: "Email Id Already exits !",
 						type: "warning",
 						confirmButtonColor: '#A5DC86',
 						confirmButtonText: 'ok',
 						closeOnConfirm: false,
 				}, function(isConfirm){
 						if (isConfirm) {
 								swal.close();
 						}
 				});
					return false;
                    }
                 }
            }
        });
});
});

</script>

 <script type="text/javascript">
    function validation(){


        var email = $("#login_email").val().trim();
        var password = $("#login_password").val().trim();
        if(email =='')
        {
          $("#error_email").fadeIn().html("please enter email").css("color","red");
          setTimeout(function(){$("#error_email").fadeOut("&nbsp;");},2000)
          $("#login_email").focus();
          return false;
        }


        if(password =='')
        {
          $("#error_password").fadeIn().html("please enter password").css("color","red");
          setTimeout(function(){$("#error_password").fadeOut("&nbsp;");},2000)
          $("#login_password").focus();
          return false;
        }

}
  </script>
