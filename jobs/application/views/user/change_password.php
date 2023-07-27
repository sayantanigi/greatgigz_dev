
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Change Password
					<div class="page-path"><a href="<?= base_url('')?>">Home</a> >> <span>Change Password</span></div>
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
							<div class="job_title">Change Password</div>
							<div class="account-pnl">
								<form id="userform" method="post">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<label>Current Password<span style="color:red;">*</span> <span id="err_current"></span></label>
														<input type="password" class="form-control" id="password"  autocomplete="off">
														<div class="search_icon"><span class="ti-lock"></span></div>
													</div>
													<div class="form-group">
														<label>New Password<span style="color:red;">*</span> <span id="err_new"></span></label>
														<input type="password" class="form-control" id="npassword"  autocomplete="off">
														<div class="search_icon"><span class="ti-lock"></span></div>
													</div>
													<div class="form-group">
														<label>Confirm New Password<span style="color:red;">*</span> <span id="err_confirm"></span></label>
														<input type="password" class="form-control" id="cpassword"  autocomplete="off">
														<div class="search_icon"><span class="ti-lock"></span></div>
													</div>
													<div class="form-group"><span id="matchPass1"></span></div>
												</div>
											</div>
										</div>							
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<button  type="button" onclick="return change_password()" class="btn btn-larger"/>Update</button>
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
	