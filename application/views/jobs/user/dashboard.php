
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Manage Profile</div>
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
										<p><strong>Job Title</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->job_title) ?></p>
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
										<p><strong>Company</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= @$getuser->company?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Organization Type</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= @$getuser->organization_type?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Address</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= !empty(@$getuser->address1)?@$getuser->address1:@$getuser->address2; ?></p>
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
										<p><strong>State</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->state) ?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Country</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->country) ?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<p><strong>Zip Code</strong></p>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
										<p><?= ucfirst(@$getuser->zipcode) ?></p>
									</div>
								</div>
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
											<button class="btn btn-block read_more">Deactivate my account</button>
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
