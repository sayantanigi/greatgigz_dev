
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Employers Details</div>
				</div>
			</div>
		</div>
	</div>
	<main id="maincontent">
		<section class="resume">
			<div class="container">
				<div class="row">
					<div class="col-md-8 clearfix">
						<div class="col-md-3 p-l">
							<div class="block">

								<img src="<?= base_url('assets/images/job-logo.jpg')?>" alt="" class="img-responsive">
							</div>
						</div>
						<div class="col-md-9">
							<div class="job_title">
								<?= (@$get_employer->company)?ucwords(@$get_employer->company):@$get_employer->firstname.' '.@$get_employer->lastname?>
							</div>
							<!-- ShareThis BEGIN -->
						<div class="sharethis-inline-share-buttons"></div>
						<!-- ShareThis END -->
						</div>
					</div>
					<div class="col-md-4">
						<div class="contact_details">
						<?php if(!empty($get_employer->address1)){?>	<span><i class="fa fa-map"></i> <?= @$get_employer->address1?></span><?php } ?>
							<span><i class="fa fa-phone"></i> +<?= @$get_employer->mobile?></span>
							<span><i class="fa fa-envelope"></i><a href="javascript:void(0)"><?= @$get_employer->email?></a></span>
							<?php if(!empty($get_employer->ext)){?>
							<span><i class="fa fa-globe"></i><a href="javascript:void(0)"><?= @$get_employer->ext?></a></span>
						<?php } ?>
						</div>
					</div>
				</div>
				<br />
				<br />
				<div class="row">
					<div class="col-md-8">
						<div class="panel-body">
							<div class="page-heading">
								<h2>Company Overview</h2>
								<p><?= ucfirst(@$get_employer->short_bio)?></p>
							</div>

							<!-- <a href="javascript:void(0)" class="btn btn-default">Contact Now</a> -->
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel-body">
							<div class="job_title block1">
								Contact IFW Media
							</div>
							<p></p>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Full Name">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Email Address">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="phone Number">
							</div>
							<div class="form-group">
								<textarea type="text" class="form-control" placeholder="Message"></textarea>
							</div>
							<a href="javascript:void(0)" class="btn btn-default btn-block">Submit Message</a>
						</div>
						<div class="map">
							<?php if(!empty($get_employer->address1)){?>
							 <iframe width="260" height="100px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                            src="https://maps.google.it/maps?q=<?= @$get_employer->address1?>&output=embed" ></iframe>
																					<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
