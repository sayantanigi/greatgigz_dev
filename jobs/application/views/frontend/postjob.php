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
                <form method="post" action="<?= base_url('welcome/save_postjob')?>" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel-heading">Job Details</div>
                            <hr>
                            <div class="form-group col-md-6 p-l">
                                <label>Email<span style="color:red;">*</span></label>
                                <input type="email" name="job_email" class="form-control" value="<?= @$get_users->email ?>" required>
                            </div>
                            <div class="form-group col-md-6 p-r">
                                <label>Job Title<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="job_title" required/>
                            </div>
                            <div class="form-group col-md-6 p-l">
                                <label>Job Type<span style="color:red;">*</span></label>
                                <select class="form-control" name="job_type" required>
                                    <option value="">--- Choose a Type ---</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Freelancer">Freelancer</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 p-r">
                                <label>Job Category<span style="color:red;">*</span></label>
                                <select class="form-control selectpicker" name="category_id"  data-live-search="true" required style="height:200px!important;">
                                    <option value="" style="color:black;">--- Choose a Category ---</option>
                                    <?php if(!empty($get_category)) { 
                                    foreach($get_category as $cat) { ?>
                                    <option value="<?= $cat->id?>" style="color:black;"><?= ucwords($cat->category_name)?></option>
                                    <?php } }?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 p-l">
                                <label>Keywords <span>(Optional)</span></label>
                                <input type="text" class="form-control" placeholder="eg. Designer, Developer" data-role="tagsinput" name="job_tags" />
                            </div>
                            <div class="form-group col-md-6 p-r">
                                <label>Location <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="location" id="location" autocomplete="off" oninput="getsourceaddress();" required/>
                                <input type="hidden" name="latitude" id="latitude" />
                                <input type="hidden" name="longitude" id="longitude" />
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
                                    <label>Link:<input data-wysihtml5-dialog-field="href" value="http://"></label>
                                    <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                                </div>
                                <div data-wysihtml5-dialog="insertImage" style="display: none;">
                                    <label>Image:<input data-wysihtml5-dialog-field="src" value="http://"></label>
                                    <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                                </div>
                            </div>
                            <textarea id="wysihtml5-editor" spellcheck="false" placeholder="Enter something ..." name="description" required></textarea>
                        </div>

                        <div class="form-group col-md-6 p-l">
                            <label>Minimum Rate Per Hour <span>(Optional)</span></label>
                            <input type="text" class="form-control" name="minimum_rate" placeholder="eg $ 10" />
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>Maximum Rate Per Hour <span>(Optional)</span></label>
                            <input type="text" class="form-control" name="maximum_rate" placeholder="eg $ 16" />
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <label>Minimum Salary <span>(Optional)</span></label>
                            <input type="text" class="form-control" name="minimum_salary" placeholder="eg $ 2500" />
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>Maximum Salary <span>(Optional)</span></label>
                            <input type="text" class="form-control" name="maximum_salary" placeholder="eg $ 4500" />
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <label>Hours Per Week <span>(Optional)</span></label>
                            <input type="text" class="form-control" name="hours_per_week" placeholder="eg $ 45" />
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>Application Email/URL</label>
                            <input type="text" class="form-control" name="application_email_url" placeholder="Enter your email address or website URL" />
                        </div>
                        <div class="form-group col-md-12 p-l">
                            <div class="form-group col-md-4 p-l">
                                <label>Featured Job</label>
                                <div class="row">
                                    <div class="col-md-3"><input type="radio" name="featured_job" value="no" checked>No</div>
                                    <div class="col-md-3"><input type="radio" name="featured_job" value="yes">Yes</div>
                                </div>
                            </div>
                            <div class="form-group col-md-2"></div>
                            <div class="form-group col-md-6 p-r">
                                <label>Skills <span class="text-danger">*</span></label>
                                <select class="form-control selectpicker" name="key_skills[]" multiple data-live-search="true"required >
                                    <?php if(!empty($get_skills)) { foreach($get_skills as $key){?>
                                    <option value="<?= $key->skill?>" style="color:black;"><?= ucfirst($key->skill)?></option>
                                    <?php } }?>
                                </select>
                            </div>
                        </div>

                        <div class="borderfull-width"></div>
                        <div class="panel-heading">Company Information</div>
                        <hr>
                        <div class="form-group col-md-6 p-l">
                            <label>Company Name<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="company_name" value="<?= @$get_users->company ?>" required/>
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>Address<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="address" id="address" value="<?= !empty($get_users->address1)?@$get_users->address1:@$get_users->address2 ?>" required/>
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <label>Email<span style="color:red;">*</span></label>
                            <input type="email" class="form-control" name="company_email" value="<?= @$get_users->email ?>" required/>
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>Phone Number<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="company_phone" value="<?= @$get_users->mobile ?>" required/>
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <label>Website (Optional)</label>
                            <input type="text" class="form-control" name="website" placeholder="eg. www.example.com" />
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>Company Logo <span>(Optional)</span> <span>(max. file size 3MB)</span></label>
                            <input type="file" name="company_logo" class="form-control">
                        </div>
                        <div class="form-group social_icon col-md-6 p-l">
                            <label>Facebook <span>(Optional)</span></label>
                            <input type="text" class="form-control" name="facebbok" placeholder="Enter page URL" />
                            <a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                        </div>
                        <div class="form-group social_icon twiiter col-md-6 p-r">
                            <label>Twitter <span>(Optional)</span></label>
                            <input type="text" class="form-control" name="twitter" placeholder="@companyname" />
                            <a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                        </div>
                        <div class="form-group social_icon linkedin col-md-6 p-l">
                            <label>Linked in <span>(Optional)</span></label>
                            <input type="text" class="form-control" name="linked_in" placeholder="Enter page URL" />
                            <a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                        </div>
                        <div class="form-group social_icon google_plus col-md-6 p-r">
                            <label>Google + <span>(Optional)</span></label>
                            <input type="text" class="form-control" name="google" placeholder="Enter page URL" />
                            <a href="javascript:void(0)"><i class="fa fa-google"></i></a>
                        </div>
                        <div class="col-md-12 p-l">
                            <input type="hidden" name="employer_subscription_id" value="<?= @$get_employer->id ?>">
                            <?php //if(date('Y-m-d',strtotime(@$get_employer->expiry_date)) > date('Y-m-d') && @$get_employer->no_of_post > count(@$total_postjobs)){ ?>
                            <?php if(date('Y-m-d',strtotime(@$get_employer->expiry_date)) > date('Y-m-d')){?>
                            <button type="submit" class="btn btn-default pull-right">Submit</button>
                            <?php } else { ?>
                            <button type="button" class="btn btn-default pull-right" onclick="validation_postjob();">Submit</button>
                            <?php } ?>
                        </div>
                        <div class="col-md-12">
                            <p style="color:red"><marquee>Required Fields <span>*</span> : Email, Job Title, Job Type, Job Category, Location, Job Description, Skills,Company Name, Address, Phone</marquee></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
	
<script type="text/javascript">
function validation_postjob() {
    swal({   
        title: "Number of Post Jobs is over!",   
        type: "warning",
        confirmButtonColor: '#A5DC86',
        closeOnConfirm: true,   
    // closeOnCancel: true 
    }, function(isConfirm){   
        if (isConfirm) {  
            swal.close();   
        } 
    });
}
</script>

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/taginput/taginput.css')?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>