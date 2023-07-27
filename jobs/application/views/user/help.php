
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Need Help
					<div class="page-path"><a href="<?= base_url('')?>">Home</a> >> <span>Help</span></div>
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
							<div class="job_title">Help Desk</div>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="contact-box">
										<h2>Contact Us</h2>
										 <?php $phone=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim(@$get_user->mobile)), 2);?>
										<p>Call us- <?= @$phone?> </p>
										<p>Email Us- <a href="javascript:void(0)"><?= @$get_user->email?></a></p>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="contact-box">
										<h2>Chat with us</h2>
										<p>Skype Chat- <?= @$settings->email?></p>
										<p>Start Chat- <a href="javascript:void(0)">Click Here</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	