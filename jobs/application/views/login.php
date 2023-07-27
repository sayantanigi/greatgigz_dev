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
										<div class="form-group text-center">
											<span class="text-danger text-center f-25">
												<?php if($this->session->flashdata('message')) {
													echo $this->session->flashdata('message');
													unset($_SESSION['message']);
												} ?>
											</span>
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
											<a href="<?= base_url('forgot-password')?>">Forgot your password or having trouble logging in?</a>
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
											<label>User Type<span id="err_usertype"></span></label>
											<div class="row">
												<div class="col-md-3">
													<input type="radio" name="userType" id="radiobutton1"  value="1" checked>Job Seeker
												</div>
												<div class="col-md-3">
													<input type="radio" name="userType" id="radiobutton2" value="2">Employer
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>First Name<span style="color:red">*</span><span id="err_fname"></span></label>
											<input type="text" class="form-control" name="firstname" id="first_name"  autocomplete="off" onkeypress="only_alphabets(event)">
											<div class="search_icon"><span class="ti-user"></span></div>
										</div>
										<div class="form-group">
											<label>Last Name<span style="color:red">*</span><span id="err_lname"></span></label>
											<input type="text" class="form-control" name="lastname" id="last_name"  autocomplete="off" onkeypress="only_alphabets(event)">
											<div class="search_icon"><span class="ti-user"></span></div>
										</div>
										<div class="form-group">
											<label>Email Address<span style="color:red">*</span><span id="err_email"></span></label>
											<input type="email" class="form-control" name="email" id="email_address" autocomplete="off"  >
											<div class="search_icon"><span class="ti-email"></span></div>
										</div>
										<div class="form-group">
											<label>Phone Number<span style="color:red">*</span> <span id="err_phone"></span></label>
											<input type="text" class="form-control" name="mobile" id="phone_number"  autocomplete="off" onkeypress="only_number(event)" maxlength="10">
											<div class="search_icon"><span class="ti-mobile"></span></div>
										</div>
										<div class="form-group" id="hide_company" style="display:none;" >
											<h4>Your Company's Information</h4>
										</div>
										<div class="form-group" id="hide_company" style="display:none;">
											<label>Company<span style="color:red">*</span><span id="err_company"></span></label>
											<input type="text" class="form-control" name="company" id="company"  autocomplete="off">
											<div class="search_icon"><span class="ti-bag"></span></div>
										</div>
										<div class="form-group" id="hide_Organization" style="display:none;">
											<label>Organization Type<span style="color:red">*</span><span id="err_organization_type"></span></label>
											<select class="form-control" name="organization_type" id="organization_type" >
												<option value="">--Select Type--</option>
												<option value="Ad Agency">Ad Agency</option>
												<option value="Employer">Employer</option>
												<option value="Recruiting Firm">Recruiting Firm</option>
												<option value="Other">Other</option>
											</select>
											<div class="search_icon"><span class="ti-shine"></span></div>
										</div>
										<div class="form-group">
											<label>Country<span style="color:red">*</span><span id="err_country"></span></label>
											<select id="country" name="country" class="form-control"  onchange="get_state(this.value)">
												<option value="">Select Country</option>
												<?php if(!empty($get_country)){ foreach($get_country as $row){?>
												<option value="<?= $row->id ?>" <?php if($row->id==233){ echo "selected";}?>><?= ucwords($row->name)?></option>
												<?php } }?>
											</select>
											<div class="search_icon"><span class="ti-world"></span></div>
										</div>
										<div class="form-group">
											<label>State / Province<span style="color:red">*</span><span id="err_state"></span></label>
											<select id="state_id" name="state" class="form-control"  onchange="getcity(this.value)">
												<?php if(!empty($get_state)){ foreach($get_state as $row){?>
												<option value="<?= $row->id ?>" <?php if($row->id==1422){ echo "selected";}?>><?= ucwords($row->name)?></option>
												<?php } }?>
											</select>
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>
										<div class="form-group">
											<label>City<span style="color:red">*</span><span id="err_city"></span></label>
											<select id="city_id" name="city" class="form-control" >
												<?php if(!empty($get_city)){ foreach($get_city as $row){?>
												<option value="<?= $row->id ?>"><?= ucwords($row->name)?></option>
												<?php } }?>
											</select>
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>
										<div class="form-group">
											<label>Address<span style="color:red">*</span><span id="err_address"></span></label>
											<input type="text" class="form-control" name="address1" autocomplete="off" id="location" oninput="getsourceaddress();" >
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>									
										<div class="form-group">
											<label>Zip / Postal Code<span style="color:red">*</span><span id="err_zipcode"></span></label>
											<input type="text" class="form-control" name="zipcode" id="zipcode"  autocomplete="off">
											<div class="search_icon"><span class="ti-pin"></span></div>
										</div>										
										<div class="form-group">
											<h4>Security</h4>
											<p>Passwords must be between 6 and 25 characters</p>
										</div>
										<div class="form-group">
											<label>Password<span style="color:red;">*</span> <span id="err_pass"></span></label>
											<input type="password" class="form-control" name="password" id="password"  autocomplete="off">
											<div class="search_icon"><span class="ti-lock"></span></div>
										</div>
										<div class="form-group">
											<label>Confirm Password<span style="color:red">*</span><span id="err_cpass"></span></label>
											<input type="password" class="form-control" id="confirm_password"  autocomplete="off">
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
$(document).ready(function(){
	$("input[name='userType']").click(function() {
		if ($('#radiobutton1').is(':checked')) {
			$('#hide_Organization').hide(300);
			$('#hide_company').hide(300);
		} else if ($('#radiobutton2').is(':checked')) {
			$('#hide_Organization').show(300);
			$('#hide_company').show(300);
		}
	})
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	$("#signup_form").submit(function(e) {
		e.preventDefault();
		var first_name=$('#first_name').val();	
		if(first_name=='') {
    		$("#err_fname").fadeIn().html("Required").css('color','red');
        	setTimeout(function(){$("#err_fname").html("&nbsp;");},3000)
    		$("#first_name").focus();
     		return false;
		}
		var last_name=$('#last_name').val();	
		if(last_name=='') {
    		$("#err_lname").fadeIn().html("Required").css('color','red');
        	setTimeout(function(){$("#err_lname").html("&nbsp;");},3000)
    		$("#last_name").focus();
     		return false;
		}
		var email_address=$('#email_address').val();	
		if(email_address=='') {
			$("#err_email").fadeIn().html("Required").css('color','red');
			setTimeout(function(){$("#err_email").html("&nbsp;");},3000)
			$("#email_address").focus();
			return false;
		}
		var phone_number=$('#phone_number').val();	
		if(phone_number=='') {
    		$("#err_phone").fadeIn().html("Required").css('color','red');
        	setTimeout(function(){$("#err_phone").html("&nbsp;");},3000)
    		$("#phone_number").focus();
     		return false;
		}
		var usertype=$('input[type="radio"]:checked').val();
		if(usertype=='2') {
			var company=$('#company').val();	
			if(company=='') {
				$("#err_company").fadeIn().html("Required").css('color','red');
				setTimeout(function(){$("#err_company").html("&nbsp;");},3000)
				$("#company").focus();
				return false;
			}
			var organization_type=$('#organization_type').val();	
			if(organization_type=='') {
				$("#err_organization_type").fadeIn().html("Required").css('color','red');
				setTimeout(function(){$("#err_organization_type").html("&nbsp;");},3000)
				$("#organization_type").focus();
				return false;
			}
		}
		var country=$('#country').val();	
		if(country=='') {
			$("#err_country").fadeIn().html("Required").css('color','red');
			setTimeout(function(){$("#err_country").html("&nbsp;");},3000)
			$("#country").focus();
			return false;
		}
		var state_id=$('#state_id').val();	
		if(state_id=='') {
			$("#err_state").fadeIn().html("Required").css('color','red');
			setTimeout(function(){$("#err_state").html("&nbsp;");},3000)
			$("#state_id").focus();
			return false;
		}
		var city_id=$('#city_id').val();	
		if(city_id=='') {
			$("#err_city").fadeIn().html("Required").css('color','red');
			countrysetTimeout(function(){$("#err_city").html("&nbsp;");},3000)
			$("#city_id").focus();
			return false;
		}
		var address=$('#location').val();	
		if(address=='') {
			$("#err_address").fadeIn().html("Required").css('color','red');
			setTimeout(function(){$("#err_address").html("&nbsp;");},3000)
			$("#location").focus();
			return false;
		}
		var zipcode=$('#zipcode').val();	
		if(zipcode=='') {
			$("#err_zipcode").fadeIn().html("Required").css('color','red');
			setTimeout(function(){$("#err_zipcode").html("&nbsp;");},3000)
			$("#zipcode").focus();
			return false;
		}
		var password=$('#password').val();
		if(password=='') {
			$("#err_pass").fadeIn().html("Required").css('color','red');
			setTimeout(function(){$("#err_pass").html("&nbsp;");},3000)
			$("#password").focus();
			return false;
		}
		if(password.length<6) {
			$("#err_pass").fadeIn().html("please enter at least 6 character").css('color','red');
			setTimeout(function(){$("#err_pass").html("&nbsp;");},3000)
			$("#password").focus();
			return false;
		}
		var re_password=$('#confirm_password').val();
		if(re_password=='') {
			$("#err_cpass").fadeIn().html("Required").css('color','red');
			setTimeout(function(){$("#err_cpass").html("&nbsp;");},3000)
			$("#confirm_password").focus();
			return false;
		}
		if(password!=re_password) {
			$('#check_password').html('password does not match').css('color','red');
			setTimeout(function(){$("#check_password").html("&nbsp;");},3000)
			return null;
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
        	success:function(returndata) {
                if(returndata.result==1) {
					window.location.href='<?= base_url('login')?>';
				}
				if(returndata.result=='0') {
				 	if(returndata.data=='email') {
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
					if(returndata.data=='phone') {
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
				}
            }
        });
	});
});

function validation(){
	var email = $("#login_email").val().trim();
	var password = $("#login_password").val().trim();
	if(email =='') {
		$("#error_email").fadeIn().html("please enter email").css("color","red");
		setTimeout(function(){$("#error_email").fadeOut("&nbsp;");},2000)
		$("#login_email").focus();
		return false;
	}
	if(password =='') {
		$("#error_password").fadeIn().html("please enter password").css("color","red");
		setTimeout(function(){$("#error_password").fadeOut("&nbsp;");},2000)
		$("#login_password").focus();
		return false;
	}
}
</script>
