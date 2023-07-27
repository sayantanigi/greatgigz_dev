
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Notifications
					<div class="page-path"><a href="<?= base_url('')?>">Home</a> >> <span>Notifications</span></div>
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
						<div class="panel-body notifications">
							<div class="job_title">Notifications</div>
							<div class="job-items">
								<?php if(!empty($get_notification)){ foreach($get_notification as $row){

									?>
								<div class="manage-content">
									<div class="row">
										<div class="col-lg-2 col-md-2 col-12">
											<div class="title-img">
												<div class="can-img">
												<?php if(!empty($row->company_logo) && file_exists('uploads/company_logo/'.$row->company_logo)){?>
													<img src="<?= base_url('uploads/company_logo/'.$row->company_logo)?>" alt="#">
												<?php } else{?>
													<img src="<?= base_url('uploads/no_image.png')?>" alt="#">
												<?php } ?>
												</div>
											</div>
										</div>
										<div class="col-lg-7 col-md-7 ">
											<p class="description"><?= ucwords($row->job_title
												)?></p>
										</div>
										<div class="col-lg-3 col-md-3">
											<div class="time">
												<p><i class="lni lni-timer"></i><?= date('d-M-Y g:i',strtotime($row->created_date));?></p>
											</div>
										</div>
									</div>
								</div>
							<?php } } else{?>
								<div class="manage-content">
									<div class="row">
										<p class="text-center">No Data Found</p>
									</div>
								</div>
							<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	