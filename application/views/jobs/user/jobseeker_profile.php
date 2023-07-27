
	<div class="page_banner banner resume-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Submit Resume</div>
				</div>
			</div>
		</div>
	</div>
	<main id="maincontent">
		<section class="resume">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="page-heading">
							<h2>Create Your Profile</h2>
							<!-- <p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia.</p> -->
						</div>
					</div>
				</div>
				<form action="#" method="post" enctype="multipart/form-data" id="jobseeker_form">
				<div class="row">
					<div class="col-md-12">
						<div class="panel-body">
							<div class="panel-heading">Contact Information
							<hr>
							<input type="hidden" name="userid" value="<?= @$get_jobseeker->userId?>">
							<div class="panel-heading">
							<?php if(!empty($get_jobseeker->profilePic) && file_exists('uploads/users/'.@$get_jobseeker->profilePic)){?>
									<img src="<?= base_url('uploads/users/'.@$get_jobseeker->profilePic)?>" class="img-responsive" style="max-width:100%; height:100px;">
								<?php } else{?>
									<img src="<?= base_url('uploads/no_profile.jpg')?>" class="img-responsive"style="max-width:100%; height:100px;">
								<?php } ?>
								</div>
							<div class="form-group col-md-6 p-l">
								<label>Photo <span>(optional)</span></label>
								<input type="file" name="profile" class="file form-control">
								 <input type="text" name="profile" class="form-control" />
								<span class="input-group-btn text-right">
									<button class="browse btn btn-default input-lg" type="button"> Post</button>
								</span>
								<input type="hidden" name="old_profile" value="<?= @$get_jobseeker->profilePic?>">
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Professional Title</label>
								<input type="text" class="form-control" name="professional_title" value="<?= @$get_jobseeker->professional_title?>" autocomplete="off"/>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>First Name<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="firstname" value="<?= @$get_jobseeker->firstname?>" onkeypress="only_alphabets(event)" required autocomplete="off"/>
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Last name<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="lastname" value="<?= @$get_jobseeker->lastname?>" onkeypress="only_alphabets(event)" autocomplete="off" required/>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Email<span style="color:red">*</span></label>
								<input type="text" class="form-control"name="email" value="<?= @$get_jobseeker->email?>" required/>
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Phone Number<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="mobile" value="<?= @$get_jobseeker->mobile?>" onkeypress="only_number(event)"/>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Date Of Birth</label>
								<input type="date" class="form-control" name="dob" value="<?= @$get_jobseeker->dob ?>" />
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Address<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="address1" id="location" oninput="getsourceaddress();" value="<?= @$get_jobseeker->address1?>" required/>
							</div>
							<div class="borderfull-width"></div>
							<div class="panel-heading">Basic Information</div>
							<hr>
							<div class="form-group col-md-6 p-l">
								<label>Job Title<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="job_title" value="<?= @$get_jobseeker->job_title?>" required/>
							</div>
							<div class="form-group col-md-6 p-r">
									<label>Skills<span style="color:red">*</span></label>
									<select class="form-control selectpicker" name="skill_id[]" multiple data-live-search="true" required >
											<?php  $skill_id = explode(",", $get_jobseeker->skill_id);?>
											 <?php if(!empty($get_skills)){ foreach($get_skills as $key){?>
											 <option value="<?= $key->id?>" style="color:black;"
											 	 <?php if(in_array($key->id, $skill_id))
	                                   {
	                                    echo "selected";
	                                   }?>
											 	><?= ucfirst($key->skill)?></option>
											<?php } }?>
										</select>
								</div>
								<div class="form-group col-md-6 p-l">
									<label>Position</label>
									<input type="text" class="form-control" name="position" value="<?= @$get_jobseeker->position ?>" />
								</div>
								<div class="form-group col-md-6 p-r">
									<label>Job Type<span style="color:red">*</span></label>
										<select class="form-control" name="job_type" required>
											 <option value="">--- Choose a JobType ---</option>
											 <option value="Full Time" <?= (@$get_jobseeker->job_type=='Full Time')?'selected':'';?>>Full Time</option>
										 <option value="Part Time" <?= (@$get_jobseeker->job_type=='Part Time')?'selected':'';?>>Part Time</option>
										 <option value="Freelancer" <?= (@$get_jobseeker->job_type=='Freelancer')?'selected':'';?>>Freelancer</option>
										</select>
								</div>
							<div class="form-group col-md-6 p-l">
								<label>Years of Experience</label>
								<input type="text" class="form-control" name="experience" value="<?= @$get_jobseeker->experience?>" />
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Job Category</label>
								<select class="form-control" name="category_id">
									 <option>--- Choose a Category ---</option>
									 <?php if(!empty($get_category)){ foreach($get_category as $key){?>
									 <option value="<?= $key->id?>" <?php if(@$get_jobseeker->category_id==$key->id){ echo "selected";}?>><?= ucfirst($key->category_name)?></option>
									<?php } } ?>
								</select>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Expected Job Category</label>
								<select class="form-control" name="expected_category">
									 <option>--- Choose a Category ---</option>
									 <?php if(!empty($get_category)){ foreach($get_category as $row){?>
									 <option value="<?= $row->id?>" <?php if(@$get_jobseeker->expected_category==$row->id){ echo "selected";}?>><?= ucfirst($row->category_name)?></option>
									<?php } } ?>
								</select>
							</div>
							<div class="form-group col-md-6 p-r">
								<label>Expected Salary Package</label>
								<input type="text" class="form-control" name="salary" value="<?= @$get_jobseeker->salary ?>" />
							</div>
							<div class="form-group col-md-12 p-l p-r">
								<label>Description About Yourself</label>
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
							<textarea id="wysihtml5-editor" spellcheck="false" placeholder="Enter something ..." name="short_bio"><?= @$get_jobseeker->short_bio?></textarea>
							</div>
							<div class="borderfull-width"></div>
							<div class="panel-heading">Education Details</div>
							<hr>
							<div class="col-md-12">
									<button type="button" class="btn btn-click" onclick="add_class()"><i class="fa fa-plus-circle"></i>Add Class </button>
								</div>
							<div class="row" id="addmore_class">
								<?php if(!empty($get_education)){ foreach($get_education as $key){?>
								<div class="col-md-12">
							<!-- <div id="demo" class="collapse"> -->
							<div class="form-group col-md-6 p-l">
								<label>Basic / Institute<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="education[]" required value="<?= $key->education?>" />
							</div>
							<div class="form-group col-md-6 p-l">
								<label>University / Institute<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="university_institute[]" required value="<?= $key->university_institute?>"/>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Marks<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="marks[]" required value="<?= $key->marks?>"/>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Year<span style="color:red">*</span></label>
								<select class="form-control" name="year[]" required>
									 <option value="">--Select Year--</option>
									 <?php   for($i = 1950 ; $i < date('Y'); $i++){ ?>
                                   <option value="<?= $i?>"<?php if($key->year==$i){ echo "selected";}?>><?= $i?></option>
                                         <?php } ?>
								</select>
							</div>
							 </div>
							<?php } } else{ ?>
								<div class="form-group col-md-6 p-l">
								<label>Basic / Institute<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="education[]" required />
							</div>
							<div class="form-group col-md-6 p-l">
								<label>University / Institute<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="university_institute[]" required />
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Marks<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="marks[]" required />
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Year<span style="color:red">*</span></label>
								<select class="form-control" name="year[]" required>
									 <option value="">--Select Year--</option>
									 <?php   for($i = 1950 ; $i < date('Y'); $i++){ ?>
                                   <option value="<?= $i?>"><?= $i?></option>
                                         <?php } ?>
								</select>
							</div>
							<?php } ?>

							</div>

							<div class="borderfull-width"></div>
							<div class="panel-heading">Employer/Designation</div>
							<hr>
							<div class="row" id="clonetable_feedback1">
								<?php if(!empty($get_workexperience)){ foreach($get_workexperience as $row){?>
								<div class="col-md-12">
							<div class="form-group col-md-6 p-l">
								<label>Employer Name</label>
								<input type="text" class="form-control" name="employer_name[]"  value="<?= $row->employer_name?>" />
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Status</label>
								<select class="form-control" name="status[]" >
									 <option value="Current Employer" <?php if($row->status=='Current Employer'){ echo "selected";}?>>Current Employer</option>
									 <option value="Prevoius Employer" <?php if($row->status=='Prevoius Employer'){ echo "selected";}?>>Previous Employer</option>

								</select>
							</div>
							<div class="form-group col-md-3 p-l">
								<label>Duration<span style="color:red">*</span></label>
								<input type="date" class="form-control" placeholder="15 January 2014" name="start_date[]" required value="<?= $row->start_date?>"/>
							</div>
							<div class="form-group col-md-3 p-l">
								<label>&nbsp;</label>
								<input type="date" class="form-control" placeholder="15 January 2014" name="end_date[]" required value="<?= $row->end_date?>"/>
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Designation<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="designation[]" required value="<?= $row->designation?>"/>
							</div>
							<div class="form-group col-md-12 p-l">
								<label>Job Profile</label>
								<textarea type="text" class="form-control" name="job_profile[]" ><?= $row->job_profile?></textarea>
							</div>
								</div>
							<?php } } else{?>
								<div class="form-group col-md-6 p-l">
								<label>Employer Name</label>
								<input type="text" class="form-control" name="employer_name[]" />
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Status</label>
								<select class="form-control" name="status[]" >
									 <option value="Current Employer" >Current Employer</option>
									 <option value="Prevoius Employer" >Previous Employer</option>

								</select>
							</div>
							<div class="form-group col-md-3 p-l">
								<label>Duration<span style="color:red">*</span></label>
								<input type="date" class="form-control" placeholder="15 January 2014" name="start_date[]" required />
							</div>
							<div class="form-group col-md-3 p-l">
								<label>&nbsp;</label>
								<input type="date" class="form-control" placeholder="15 January 2014" name="end_date[]" required />
							</div>
							<div class="form-group col-md-6 p-l">
								<label>Designation<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="designation[]" required />
							</div>
							<div class="form-group col-md-12 p-l">
								<label>Job Profile</label>
								<textarea type="text" class="form-control" name="job_profile[]" ></textarea>
							</div>
							<?php } ?>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="button" class="btn btn-click" onclick="add_row()" ><i class="fa fa-plus-circle"></i>Add More</button>

								</div>
							</div>
							<div class="col-md-4 p-l">
								<button type="submit" class="btn btn-default btn-block">Update</a>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</section>
	</main>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>


<script>

$('.selectpicker').selectpicker();

</script>

<script >

  function add_row()
  {
    	 var html  = "";
        html += '<div class="col-md-12">';
        html += '<div class="form-group col-md-6 p-l"><label>Employer Name</label><input type="text" class="form-control" name="employer_name[]"  /></div>';
        html += '<div class="form-group col-md-6 p-l"><label>Status</label><select class="form-control" name="status[]" ><option value="Current Employer">Current Employer</option><option value="Prevoius Employer">Previous Employer</option></select></div>';
        html += '<div class="form-group col-md-3 p-l"><label>Duration</label><input type="date" class="form-control" placeholder="15 January 2014" name="start_date[]"  /></div>';
        html += '<div class="form-group col-md-3 p-l"><label>&nbsp;</label><input type="date" class="form-control" placeholder="15 January 2014" name="end_date[]"  /></div>';
        html += '<div class="form-group col-md-6 p-l"><label>Designation</label><input type="text" class="form-control" name="designation"  /></div>';
        html += '<div class="form-group col-md-12 p-l"><label>Job Profile</label><textarea type="text" class="form-control" name="job_profile[]" ></textarea></div>';
        html += '<div class="col-md-12"><a href="javascript:void(0);" class="btn btn-danger" onclick="remove(this)"><i class="fa fa-remove"></i> Remove</a></div>';
        html += '</div>';

        $("#clonetable_feedback1").append(html);

  }

   function remove(e)
   {
   	$(e).parents("#clonetable_feedback1 div").remove();

   }

   function add_class()
   {
   	var html  = "";
        html += '<div class="col-md-12">';
        html += '<div class="form-group col-md-6 p-l"><label>Basic / Institute</label><input type="text" class="form-control" name="education[]" /></div>';
        html += '<div class="form-group col-md-6 p-l"><label>University / Institute</label><input type="text" class="form-control" name="university_institute[]" /></div>';
        html += '<div class="form-group col-md-6 p-l"><label>Marks</label><input type="text" class="form-control" name="marks[]" /></div>';
        html += '<div class="form-group col-md-6 p-l"><label>Year</label><select class="form-control" name="year[]"><option value="">--Select Year--</option><?php   for($i = 1950 ; $i < date('Y'); $i++){ ?><option value="<?= $i?>" ><?= $i?></option> <?php } ?>
								</select></div>';
        html += '<div class="col-md-12"><a href="javascript:void(0);" class="btn btn-danger" onclick="delete_item(this)"><i class="fa fa-remove"></i> Remove</a></div>';
        html += '</div>';

        $("#addmore_class").append(html);
   }
   function delete_item(e)
   {
   	$(e).parents("#addmore_class div").remove();

   }

</script>

<script type="text/javascript">
$(document).ready(function() {
$("#jobseeker_form").submit(function(e) {
e.preventDefault();

var formData = new FormData(this);
$.ajax({
        type: "POST",
        url: "<?= base_url('dashboard/update_jobseekerprofile') ?>",
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
