<?php $phone=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($setting->phone)), 2);?>
	<div class="page_banner banner post-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Post A Job</div>
				</div>
			</div>
		</div>
	</div>
	<main>
		<section class="resume">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="page-heading">
							<h2>Post / Create A Job</h2>
							<p>Use the form below to post your job opening. If you have any questions or encounter any problems, please contact us at <?= @$phone?>.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<form method="post" action="<?= base_url('user/user_dashboard/update_postjob')?>" enctype="multipart/form-data">
					<div class="col-md-12">
						<div class="panel-body">
							<div class="panel-heading">Job Details</div>
							<hr>
							<div class="form-group col-md-6 p-l">
								<label>Email<span style="color:red;">*</span></label>
								<input type="email" name="job_email" class="form-control" value="<?= @$get_postjob->job_email ?>" required>
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Job Title<span style="color:red;">*</span></label>
								<input type="text" class="form-control" name="job_title" required value="<?= @$get_postjob->job_title ?>"/>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Job Type<span style="color:red;">*</span></label>
								<select class="form-control" name="job_type" required>
									 <option value="">--- Choose a Type ---</option>
									 <option value="Full Time" <?php if(@$get_postjob->job_type=='Full Time'){ echo "selected";}?>>Full Time</option>
									 <option value="Part Time" <?php if(@$get_postjob->job_type=='Part Time'){ echo "selected";}?>>Part Time</option>
									 <option value="Free Lancer" <?php if(@$get_postjob->job_type=='Free Lancer'){ echo "selected";}?>>Free Lancer</option>
								</select>
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Job Category<span style="color:red;">*</span></label>
							<select class="form-control selectpicker" name="category" data-live-search="true" >
									 <option value="" style="color:black;">--- Choose a Category ---</option>
									 <?php if(!empty($get_category)){ foreach($get_category as $cat){?>
									 <option value="<?= $cat->id?>" <?php if(@$get_postjob->category_id==$cat->id){ echo "selected";}?>  style="color:black;"><?= ucfirst($cat->category_name)?></option>
									<?php } }?>
								</select>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Keywords <span>(Optional)</span></label>
								<input type="text" class="form-control" data-role="tagsinput" name="job_tags" value="<?= @$get_postjob->job_tags?>"/>
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Location<span style="color:red;">*</span></label>
								<input type="text" class="form-control" name="location" id="location" autocomplete="off" oninput="getsourceaddress();" value="<?= @$get_postjob->location ?>" required/>
								<input type="hidden" name="latitude" id="latitude" value="<?= @$get_postjob->latitude ?>"/>
								<input type="hidden" name="longitude" id="longitude" value="<?= @$get_postjob->longitude ?>"/>
							</div>
							<div class="form-group col-md-12 p-l p-r">
								<label>Job Description<span style="color:red;">*</span></label>
								<div id="wysihtml5-editor-toolbar">
								<header>
									<ul class="commands">
										<li data-wysihtml5-command="bold" title="Make text bold (CTRL + B)" class="command"></li>
										<li data-wysihtml5-command="italic" title="Make text italic (CTRL + I)" class="command"></li>
										<li data-wysihtml5-command="insertUnorderedList" title="Insert an unordered list" class="command"></li>
										<li data-wysihtml5-command="insertOrderedList" title="Insert an ordered list" class="command"></li>
										<li data-wysihtml5-command="createLink" title="Insert a link" class="command"></li>
										<li data-wysihtml5-command="insertImage" title="Insert an image" class="command"></li>
										<li data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" title="Insert headline 1" class="command"></li>
										<li data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" title="Insert headline 2" class="command"></li>
										<li data-wysihtml5-command-group="foreColor" class="fore-color command" title="Color the selected text" >
										<ul>
											<li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="silver"></li>
											<li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="gray"></li>
											<li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="maroon"></li>
											<li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red"></li>
											<li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="purple"></li>
											<li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green"></li>
											<li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="olive"></li>
											<li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="navy"></li>
											<li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue"></li>
										</ul>
										</li>
										<li data-wysihtml5-command="insertSpeech" title="Insert speech" class="command"></li>
										<li data-wysihtml5-action="change_view" title="Show HTML" class="action"></li>
									</ul>
							</header>
							<div data-wysihtml5-dialog="createLink" style="display: none;">
								<label>
									Link:
									<input data-wysihtml5-dialog-field="href" value="http://">
								</label>
								<a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
							</div>
							<div data-wysihtml5-dialog="insertImage" style="display: none;">
								<label>
									Image:
									<input data-wysihtml5-dialog-field="src" value="http://">
								</label>
								<a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
							</div>
							</div>
							<textarea id="wysihtml5-editor" spellcheck="false" placeholder="Enter something ..." name="description" required><?= @$get_postjob->description ?></textarea>
							</div>
						    	<div class="form-group col-md-6 p-l">
									<label>Minimum Rate Per Hour <span>(Optional)</span></label>
									<input type="text" class="form-control" name="minimum_rate" placeholder="eg $ 10" value="<?=@$get_postjob->minimum_rate ?>" />
								</div>
								<div class="form-group col-md-6 p-r">
									<label>Maximum Rate Per Hour <span>(Optional)</span></label>
									<input type="text" class="form-control" name="maximum_rate" placeholder="eg $ 16" value="<?=@$get_postjob->maximum_rate ?>"  />
								</div>
								<div class="form-group col-md-6 p-l">
									<label>Minimum Salary <span>(Optional)</span></label>
									<input type="text" class="form-control" name="minimum_salary" placeholder="eg $ 2500" value="<?=@$get_postjob->minimum_salary ?>" />
								</div>
								<div class="form-group col-md-6 p-r">
									<label>Maximum Salary <span>(Optional)</span></label>
									<input type="text" class="form-control" name="maximum_salary" placeholder="eg $ 4500" value="<?=@$get_postjob->maximum_salary ?>" />
								</div>
								<div class="form-group col-md-6 p-l">
									<label>Hours Per Week <span>(Optional)</span></label>
									<input type="text" class="form-control" name="hours_per_week" placeholder="eg $ 45"value="<?=@$get_postjob->hours_per_week ?>"  />
								</div>
								<div class="form-group col-md-6 p-r">
									<label>Application Email/URL</label>
									<input type="text" class="form-control" name="application_email_url" placeholder="Enter your email address or website URL" value="<?= @$get_postjob->application_email_url?>"/>
								</div>
								<div class="form-group col-md-12 p-l">
									<div class="form-group col-md-4 p-l">
										<label>Featured Job</label>
										<div class="row">
											<div class="col-md-3">
												<input type="radio" name="featured_job" value="no" <?= (@$get_postjob->featured_job=='no')?'checked':'';?>>No
											</div>
											<div class="col-md-3">
												<input type="radio" name="featured_job" value="yes"  <?= (@$get_postjob->featured_job=='yes')?'checked':'';?>>Yes
											</div>
										</div>
									</div>
									<div class="form-group col-md-2"></div>
									<div class="form-group col-md-6 p-r">
										<label>Skills <span class="text-danger">*</span></label>
										<select class="form-control selectpicker" name="key_skills[]" multiple data-live-search="true" required>
										<?php $skill_id = explode(",", $get_postjob->required_key_skills);?>
										<?php if(!empty($get_skills)){ foreach($get_skills as $key){?>
											<option value="<?= $key->skill?>" style="color:black;" <?php if(in_array($key->skill, $skill_id)) { echo "selected"; } ?> ><?= ucfirst($key->skill)?></option>
										<?php } }?>
										</select>
									</div>
								</div>
							<div class="borderfull-width"></div>
							<div class="panel-heading">Company Information</div>
							<hr>
							<div class="form-group col-md-6 p-l">
								<label>Company Name<span style="color:red;">*</span></label>
								<input type="text" class="form-control" name="company_name" value="<?= @$get_postjob->company_name ?>" required/>
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Address<span style="color:red;">*</span></label>
								<input type="text" class="form-control" name="address" id="address" value="<?= @$get_postjob->address ?>" required/>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Email<span style="color:red;">*</span></label>
								<input type="email" class="form-control" name="company_email" value="<?= @$get_postjob->company_email ?>" required/>
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Phone Number<span style="color:red;">*</span></label>
								<input type="text" class="form-control" name="company_phone" value="<?= @$get_postjob->company_phone ?>" required/>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Website (Optional)</label>
								<input type="text" class="form-control" name="website" placeholder="eg. www.example.com" value="<?= @$get_postjob->website ?>"/>
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Company Logo <span>(Optional)</span> <span>(max. file size 3MB)</span></label>
								<input type="file" name="company_logo" class="form-control">
								<?php if(!empty($get_postjob->company_logo) && file_exists('uploads/company_logo/'.@$get_postjob->company_logo)){?>
									<img src="<?= base_url('uploads/company_logo/'.@$get_postjob->company_logo)?>" class="img-responsive" style="max-width:100%; height:100px;">
								<?php } else{?>
									<img src="<?= base_url('uploads/no_image.png')?>" class="img-responsive"style="max-width:100%; height:100px;">
								<?php } ?>
								<input type="hidden" name="old_logo" value="<?= @$get_postjob->company_logo ?>">
							</div>
							<div class="form-group social_icon col-md-6 p-l">
								<label>Facebook <span>(Optional)</span></label>
								<input type="text" class="form-control" name="facebbok" placeholder="Enter page URL" value="<?= @$get_postjob->facebbok ?>"/>
								<a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
							</div>
							<div class="form-group social_icon twiiter col-md-6 p-r">
								<label>Twitter <span>(Optional)</span></label>
								<input type="text" class="form-control" name="twitter" placeholder="@companyname" value="<?= @$get_postjob->twitter ?>"/>
								<a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
							</div>
							<div class="form-group social_icon linkedin col-md-6 p-l">
								<label>Linked in <span>(Optional)</span></label>
								<input type="text" class="form-control" name="linked_in" placeholder="Enter page URL" value="<?= @$get_postjob->linked_in ?>" />
								<a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
							</div>
							<div class="form-group social_icon google_plus col-md-6 p-r">
								<label>Google + <span>(Optional)</span></label>
								<input type="text" class="form-control" name="google" placeholder="Enter page URL" value="<?= @$get_postjob->google ?>" />
								<a href="javascript:void(0)"><i class="fa fa-google"></i></a>
							</div>
							<input type="hidden" name="id" value="<?= @$get_postjob->id?>">
							<input type="hidden" name="employer_subscription_id" value="<?= @$get_postjob->employer_subscription_id?>">
       
							<div class="col-md-12 p-l">
								<!--<a href="javascript:void(0)" class="btn btn-default">Preview Your Resume</a>-->
								<button type="submit" class="btn btn-default pull-right">Submit</button>
							</div>
							<div class="col-md-12">
								<p style="color:red"><marquee>Required Fields <span>*</span> : Email, Job Title, Job Type, Job Category, Location, Job Description, Skills,Company Name, Address, Phone</marquee></p>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</section>
	</main>
   <link rel="stylesheet" type="text/css" href="<?= base_url('assets/taginput/taginput.css')?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>


<script>

$('.selectpicker').selectpicker();

</script>