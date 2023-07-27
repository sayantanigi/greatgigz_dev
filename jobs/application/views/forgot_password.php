<div class="page_banner banner price-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Forgot Password</div>
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
									
								</ul>
								<div class="tab-content">
								<div class="tab-pane fade active in" id="login">
									<form id="login_form" method="post" action="<?= base_url('user/login/forgotpass_action')?>">
										<div class="form-group">
									 <span class="text-success f-30"><?=$this->session->flashdata('success');  ?></span>
										 <span class="text-danger text-center f-30"><?=$this->session->flashdata('error');  ?></span>
                                      </div>
										<div class="form-group">
											<label>E-mail<span style="color:red">*</span><span id="error_email"></span></label>
											<input type="email" class="form-control" name="email" id="email"  autocomplete="off" required>
											<div class="search_icon"><span class="ti-user"></span></div>
										</div>
										
										
										<div class="mrgn-30-top">
											<button type="submit" class="btn btn-larger btn-block"/>Submit</button>
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

	
