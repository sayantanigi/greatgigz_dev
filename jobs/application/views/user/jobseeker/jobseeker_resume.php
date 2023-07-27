
	<div class="page_banner banner resume-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Resume Page</div>
				</div>
			</div>
		</div>
	</div>
	<main id="maincontent">
		<section class="resume2">
			<div class="container">
				<div class="row">
					<div class="col-md-3 author">
						<div class="panel-body">
							<a href="javascript:void(0)">
								<?php if(!empty($get_user->profilePic) && file_exists('uploads/users/'.@$get_user->profilePic)){ ?>
    		<img src="<?= base_url('uploads/users/'.@$get_user->profilePic)?>" class="img-responsive" alt="" style="max-width:100%; height:100px;"/>
                               <?php } else{ ?>
          <img src="<?= base_url('uploads/no_profile.jpg')?>" class="img-responsive" alt="" style="max-width:100%; height:100px;"/>';
                              <?php } ?>

							</a>
							<div class="job_title">
								<p></p>
								Hi, <?= ucfirst(@$get_user->firstname.' '.@$get_user->lastname)?>
								<a href="javascript:void(0)"><?= ucfirst(@$get_user->job_title)?></a>
							</div>
							<div class="contact_details">
								<span><i class="fa fa-envelope"></i><a href="javascript:void(0)"><?= @$get_user->email?></a></span>
								<span><i class="fa fa-phone"></i><?= @$get_user->mobile?></span>
								<span><i class="fa fa-map-marker"></i> <?= !empty($get_user->address1)?$get_user->address1:$get_user->address2 ?></span>
								<a href="<?= base_url('uploads/jobseeker_resume/'.@$get_appliedjob->resume)?>" class="btn btn-primary" download><i class="fa fa-file-pdf-o"></i> Download Resume</a>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="panel-body">
							<div class="page-heading"><h2>Basic Information</h2>
							<div class="contact_details col-md-6 p-l">
								<span><strong>Job Title:</strong> <?= ucfirst($get_user->job_title)?></span>
							</div>
							<div class="contact_details col-md-6 p-l">
								<span><strong>Job Type:</strong> <?= ucfirst(@$get_appliedjob->job_type)?></span>
							</div>
							<div class="contact_details col-md-6 p-l">
								<span><strong>Position:</strong><?= ucfirst(@$get_user->position)?></span>
							</div>
							<div class="contact_details col-md-6 p-l">
								<span><strong>Job Category:</strong> <?= ucfirst(@$get_category->category_name)?></span>
							</div>
							<div class="contact_details col-md-6 p-l">
								<span><strong>Experience:</strong> <?= @$get_user->experience?></span>
							</div>
							<div class="contact_details col-md-6 p-l">
								<span><strong>Salary Package:</strong> <?= @$get_user->salary?></span>
							</div>
							</div>

							<div class="job_title">About Me:</div>
							<div class="page-heading">
								<p><?= ucfirst(@$get_user->short_bio)?></p>

							<div class="borderfull-width"></div>
							</div>
							<div class="page-heading">
								<h2>Education Information</h2>
								<?php if(!empty($list_education)){ foreach($list_education as $key){?>
								<div class="contact_details col-md-6 p-l">
									<span><strong><?= ucfirst($key->university_institute)?></strong></span>
									<span><?= ucfirst($key->education)?></span>
									<span><?= $key->year.' '.'Year'?></span>
									<span><?= $key->marks.' '.'Marks'?></span>
								</div>
							<?php } } ?>
								<!-- <div class="contact_details col-md-6 p-l">
									<span><strong>Graphic Design Institute, Canada</strong></span>
									<span>UI/UX Graphic Designer</span>
									<span>2008 - 2010</span>
									<span>57%</span>
								</div> -->
								<div class="borderfull-width"></div>
							</div>
							<div class="page-heading">
								<h2>Employer/Designation</h2>
								<?php if(!empty($list_workexperience)){ foreach($list_workexperience as $row){?>
								<div class="contact_details">
									<span><strong><?= ucfirst($row->employer_name)?></strong></span>
									<span><?= ucfirst($row->status)?></span>
									<span><?= ucfirst($row->designation)?></span>
								</div>
								<div class="job_title">Job Profile:</div>
							<div class="page-heading padding-bottom">
								<p><?= ucfirst($row->job_profile)?></p>
							</div>
							<?php } } ?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
