
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Edit Profile</div>
				</div>
			</div>
		</div>
	</div>
	<main id="maincontent">
		<section class="manage">
			<div class="container">
				<div class="row">
					<?php $this->load->view('common/sidebar')?>
					<div class="col-md-9">
						<div class="panel-body">
							<div class="job_title">Edit Employer Account Settings <span class="pull-right"><a href="<?= base_url('dashboard')?>"><i class="fa fa-arrow-left"></i> back</a></span></div>
							<div class="account-pnl">
								<form id="userform" method="post">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<h4>Your Information</h4>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>First Name<span style="color:red">*</span></label>
												<input type="text" class="form-control" name="firstname" id="first_name" required autocomplete="off" value="<?= @$getuser->firstname?>" onkeypress="only_alphabets(event)">
												<div class="search_icon"><span class="ti-user"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Last Name<span style="color:red">*</span></label>
												<input type="text" class="form-control" name="lastname" id="last_name" required autocomplete="off" value="<?= @$getuser->lastname?>" onkeypress="only_alphabets(event)">
												<div class="search_icon"><span class="ti-user"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Job Title<span style="color:red">*</span></label>
												<input type="text" class="form-control" name="job_title" id="job_title" required autocomplete="off" value="<?= @$getuser->job_title?>">
												<div class="search_icon"><span class="ti-user"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Email Address<span style="color:red">*</span><span id="err_email"></span></label>
												<input type="email" class="form-control" name="email" id="email_address" required autocomplete="off" value="<?= @$getuser->email?>">
												<div class="search_icon"><span class="ti-email"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Re-enter Email Address <span style="color:red">*</span><span id="check_email"></span></label>
												<input type="email" class="form-control" id="reemail_address" required autocomplete="off" value="<?= @$getuser->email?>">
												<div class="search_icon"><span class="ti-email"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Phone Number<span style="color:red">*</span><span id="err_phone"></span></label>
												<input type="text" class="form-control" name="mobile" id="phone_number" required autocomplete="off" value="<?= @$getuser->mobile?>" onkeypress="only_number(event)">
												<div class="search_icon"><span class="ti-mobile"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Ext</label>
												<input type="text" class="form-control" name="ext" id="ext"  autocomplete="off" value="<?= @$getuser->ext?>">
												<div class="search_icon"><span class="ti-world"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Fax Number</label>
												<input type="text" class="form-control" name="fax" id="fax_number"  autocomplete="off" value="<?= @$getuser->fax?>">
												<div class="search_icon"><span class="ti-printer"></span></div>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<h4>Your Company's Information</h4>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Company<span style="color:red">*</span></label>
												<input type="text" class="form-control" name="company" id="company" required autocomplete="off" value="<?= @$getuser->company?>">
												<div class="search_icon"><span class="ti-bag"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Organization Type</label>
												<select class="form-control" name="organization_type" id="organization_type">
													<option value="Ad Agency" <?php if($getuser->organization_type=='Ad Agency'){ echo "selected";}?>>Ad Agency</option>
												<option value="Employer"<?php if($getuser->organization_type=='Employer'){ echo "selected";}?>>Employer</option>
												<option value="Recruiting Firm"<?php if($getuser->organization_type=='Recruiting Firm'){ echo "selected";}?>>Recruiting Firm</option>
												</select>
												<div class="search_icon"><span class="ti-shine"></span></div>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Address 1<span style="color:red">*</span></label>
												<input type="text" class="form-control" name="address1" id="address" required autocomplete="off" value="<?= @$getuser->address1?>">
												<div class="search_icon"><span class="ti-pin"></span></div>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Address 2</label>
												<input type="text" class="form-control" name="address2" id="address2" autocomplete="off" value="<?= @$getuser->address2?>">
												<div class="search_icon"><span class="ti-pin"></span></div>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>City<span style="color:red">*</span></label>
												<input type="text" class="form-control" name="city" id="city" required autocomplete="off" value="<?= @$getuser->city?>">
												<div class="search_icon"><span class="ti-pin"></span></div>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>State / Province<span style="color:red">*</span></label>
												<select name="state" id="state_select" name="state_select" class="form-control" required>
													<option value="">select State</option>
													<?php if(!empty($get_state)){ foreach($get_state as $row){?>
											   <option value="<?= $row->name?>" <?php if($getuser->state==$row->name){ echo "selected";}?>><?= ucfirst($row->name)?></option>
											  <?php } }?>
												</select>
												<div class="search_icon"><span class="ti-pin"></span></div>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Other </label>
												<input type="text" class="form-control" name="other" id="other_state"  autocomplete="off" value="<?= @$getuser->other?>">
												<div class="search_icon"><span class="ti-pin"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Zip / Postal Code<span style="color:red">*</span></label>
												<input type="text" class="form-control" name="zipcode" id="zipcode" required autocomplete="off" value="<?= @$getuser->zipcode?>">
												<div class="search_icon"><span class="ti-pin"></span></div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Country<span style="color:red">*</span></label>
												<select id="country" name="country" class="form-control" required>
												   <option value="">Select Country</option>
												 <?php if(!empty($get_country)){ foreach($get_country as $row){?>
											   <option value="<?= $row->name?>" <?php if($getuser->country==$row->name){ echo "selected";}?>><?= ucfirst($row->name)?></option>
											  <?php } }?>

												</select>
												<div class="search_icon"><span class="ti-world"></span></div>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<label>Company Logo <span style="color:red">*</span></label>
											<input type="file" class="form-control" name="profilePic" required>
											<input type="hidden" class="form-control" name="old_profile" value="<?= @$getuser->profilePic?>">
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

											<?php if(!empty($getuser->profilePic) && file_exists('uploads/users/'.@$getuser->profilePic)){?>
													<img src="<?= base_url('uploads/users/'.@$getuser->profilePic)?>" width="80" height="80">
												<?php } else{?>
													<img src="<?= base_url('uploads/no_image.png')?>" width="80" height="80">
												<?php } ?>
										</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Company Overview</label>
												<textarea class="form-control" name="short_bio" rows="2" cols="2" placeholder="Company Overview"><?= ucfirst(@$getuser->short_bio)?></textarea>

											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<button type="submit" class="btn btn-larger"/>Update</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

	 <script type="text/javascript">
$(document).ready(function() {
$("#userform").submit(function(e) {
e.preventDefault();

if($('#email_address').val()!=$('#reemail_address').val())
{

    $('#check_email').html('Email does not match').css('color','red');
    setTimeout(function(){$("#check_email").html("&nbsp;");},8000)
    return null
}

var formData = new FormData(this);
$.ajax({
        type: "POST",
        url: "<?= base_url('dashboard/update_profile') ?>",
        data: formData,
         cache: false,
          contentType: false,
         processData: false,
         dataType:'json',
        success:function(returndata)
            {
                if(returndata.result==1)
                    {
                     window.location.href='<?= base_url('dashboard')?>';
                    }
                   if(returndata.result=='0')
				 {
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

                 }
            }
        });
});
});

</script>
