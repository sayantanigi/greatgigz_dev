
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">
					My Account
						<div class="page-path"><a href="<?= base_url('')?>">Home</a> >> <span>My account</span></div>
					</div>
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
							<div class="job_title">My Profile <span class="pull-right">
								<?php if(@$getuser->userType==1){
										echo '<a href="'.base_url('jobseeker-profile').'"><i class="fa fa-edit"></i> Edit</a>';
										}else if(@$getuser->userType==2){
										echo '<a href="'.base_url('profile').'"><i class="fa fa-edit"></i> Edit</a>';
										}
									?>
							</span></div>
							<div class="account-pnl">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Full name</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->firstname).' '.$getuser->lastname?></p>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Email</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= @$getuser->email?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Phone Number</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= @$getuser->mobile?></p>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Address</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= !empty(@$getuser->address)?@$getuser->address:@$getuser->address2; ?></p>
									</div>
								</div>
							    <div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Country</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->country_name) ?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>State</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->state_name) ?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>City</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->city) ?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Zip Code</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->zip) ?></p>
									</div>
								</div>
								<?php if(@$getuser->userType==1){?>
								<?php if(!empty($getuser->professional_title)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Professional Title</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->professional_title) ?></p>
									</div>
								</div>
							<?php } ?>
							<?php if(@$getuser->dob!='0000-00-00' || @$getuser->dob!='NULL'){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>DOB</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= @$getuser->dob ?></p>
									</div>
								</div>
							<?php } ?>
							<?php if(!empty($getuser->category_name)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Job Category</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucwords(@$getuser->category_name) ?></p>
									</div>
								</div>
							<?php } ?>
							<?php if(!empty($getuser->job_title)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Job Title</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucwords(@$getuser->job_title) ?></p>
									</div>
								</div>
							<?php } ?>
							<?php if(!empty($getuser->get_skill)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Skills</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?php foreach($get_skill as $key){ echo $key->skill; echo ", ";}?></p>
									</div>
								</div>
							<?php } ?>
							<?php if(!empty($getuser->job_type)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Job Type</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucwords(@$getuser->job_type) ?></p>
									</div>
								</div>
							<?php } ?>
							<?php if(!empty($getuser->experience)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Experience</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucwords(@$getuser->experience) ?></p>
									</div>
								</div>
							<?php } ?>
							<?php if(!empty($getuser->salary)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Salary</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucwords(@$getuser->salary) ?></p>
									</div>
								</div>
							<?php } ?>
							<?php if(!empty($getuser->jobseeker_resume) && file_exists('uploads/jobseeker_resume/'.@$getuser->jobseeker_resume)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Salary</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p>
									<a href="<?= base_url('uploads/jobseeker_resume/'.@$getuser->jobseeker_resume)?>"><?= @$getuser->jobseeker_resume?></a>
										</p>
									</div>
								</div>
							<?php } } else if(@$getuser->userType==2){?>

							<?php if(!empty($getuser->ext)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Ext</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucwords(@$getuser->ext) ?></p>
									</div>
								</div>
							<?php } ?>
							<?php if(!empty($getuser->fax)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Fax Number</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucwords(@$getuser->fax) ?></p>
									</div>
								</div>
							<?php } if(!empty($getuser->company)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Company</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= @$getuser->company?></p>
									</div>
								</div>
							<?php }if(!empty($getuser->organization_type)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Organization Type</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= @$getuser->organization_type?></p>
									</div>
								</div>
							<?php } } ?>
								<?php if(!empty($getuser->short_bio)){?>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Overview</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucwords(@$getuser->short_bio) ?></p>
									</div>
								</div>
							<?php } ?>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
										<div class="job_title text-center">
											<hr/>Deactivate Account? <br/><button class="btn read_more mrgn-30-top" pd-popup-open="popupNew">Click Here</button>
										</div>
									</div>
									<!-- Modal -->
									<div class="popup" pd-popup="popupNew">
										<div class="popup-inner">
											<h1>Deactivate my account</h1>
											<p>Are you sure you want to deactivate your account?</p>
											<button class="btn btn-block read_more" onclick="return deactivate_user(<?= @$getuser->userId ?>);">Deactivate my account</button>
											<p class="mrgn-30-top"><a pd-popup-close="popupNew" href="#">No, don't deactivate my account</a></p>
											<a class="popup-close" pd-popup-close="popupNew" href="#"> </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
<script>
	$(function() {
    //----- OPEN
		$('[pd-popup-open]').on('click', function(e)  {
			var targeted_popup_class = jQuery(this).attr('pd-popup-open');
			$('[pd-popup="' + targeted_popup_class + '"]').fadeIn(100);

			e.preventDefault();
		});

		//----- CLOSE
		$('[pd-popup-close]').on('click', function(e)  {
			var targeted_popup_class = jQuery(this).attr('pd-popup-close');
			$('[pd-popup="' + targeted_popup_class + '"]').fadeOut(200);

			e.preventDefault();
		});
	});
	</script>
	
	<script type="text/javascript">
		function deactivate_user(user_id)
		{

			$.ajax({
        type: "POST",
        url: "<?= base_url('user/login/deactivate_user') ?>",
        data: {user_id:user_id},
         cache: false,
        success:function(returndata)
            {
            	if(returndata==1)
          {
            	swal({   
            title: "Deactivate Account successfully !",   
             type: "success",
                   confirmButtonColor: '#A5DC86',
                   confirmButtonText: 'ok',
                   closeOnConfirm: false, 
        }, function(isConfirm){
            if (isConfirm) {
               window.location.href='<?= base_url('login') ?>';
            }
        });

            }
            	
            }
        });
		}
	</script>
