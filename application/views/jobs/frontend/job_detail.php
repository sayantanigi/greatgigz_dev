
	<section class="resume">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel-body">
						<div class="col-md-2 p-l">
							<div class="block">
								<?php if(!empty($jobdetail->company_logo) && file_exists('uploads/company_logo/'.@$jobdetail->company_logo)){ ?>
								<img src="<?= base_url('uploads/company_logo/'.@$jobdetail->company_logo)?>" alt="" class="img-responsive" style="max-width: 100%;height:100px;">
							<?php } else{?>
								<img src="<?=base_url('uploads/no_image.png')?>" class="img-responsive" alt="" style="max-width: 100%;height:100px;"/>
							<?php } ?>
							</div>
						</div>
						<div class="col-md-8">
							<div class="job_title">
							<?= ucfirst(@$jobdetail->job_title)?>
							</div>
							<div class="col-md-6 p-l">
								<div class="packege">
									<i class="fa fa-briefcase"></i><?= ucfirst(@$jobdetail->company_name)?>
								</div>
							</div>
							<div class="col-md-6 p-l">
							   <div class="packege">
									<i class="fa fa-globe"></i>
									<?= ucfirst(@$jobdetail->location)?>
								</div>
							</div>
							<div class="col-md-12 p-l">
								<div class="packege">
									<i class="fa fa-clock-o"></i>
									17 hours ago
								</div>
							</div>
						</div>
						<div class="col-md-2 p-l">
							<div class="block">
								<div class="opt-job">
									<a href="javascript:void(0)"><span class="fa fa-star-o"></span></a>
									<a href="javascript:void(0)"><span class="fa fa-share"></span></a>
									<a href="javascript:void(0)"><span class="fa fa-print"></span></a>
								</div>
								<?php if(!empty($get_appliedjob)){
										?>
										<a href="javascript:void(0)" class="btn read_more btn-block" onclick="return already_message()">Apply Now</a>
									<?php } else{?>
									<a href="javascript:void(0)" class="btn read_more btn-block" onclick="return get_value()">Apply Now</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="panel-body">
						<div class="page-heading">
							<h2>Job Description</h2>
							<P><?= ucfirst(@$jobdetail->description)?></P>

						</div>
						<?php
							if(!empty($get_appliedjob)){
							?>
						<a href="javascript:void(0)" class="btn btn-default" onclick="return already_message()">Apply For This Job</a>

							<?php } else{?>
									<a href="javascript:void(0)" class="btn btn-default" onclick="return get_value()">Apply For This Job</a>
									<?php } ?>

							<a href="javascript:void(0)" class="btn btn-default" onclick="return favorite_job(<?= @$jobdetail->id ?>)">Favorite Jobs</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel-body">
						<div class="job_title block1">
							Job Information
						</div>
						<div class="contact_details">
							<table class="table">
								<tr>
									<td class="p-l">Job ID:</td>
									<td><?= @$jobdetail->id?></td>
								</tr>
								<tr>
									<td class="p-l">Location:</td>
									<td><?= ucfirst(@$jobdetail->location)?></td>
								</tr>
								<tr>
									<td class="p-l">Position Title:</td>
									<td><?= ucfirst(@$jobdetail->job_title)?></td>
								</tr>
								<tr>
									<td class="p-l">Company Name:</td>
									<td><?= ucfirst(@$jobdetail->company_name)?></td>
								</tr>
								<tr>
									<td class="p-l">Job Function:</td>
									<td style="text-transform: uppercase;"><?= ucfirst(@$jobdetail->job_tags)?></td>
								</tr>
								<tr>
									<td class="p-l">Job Type:</td>
									<td><?= ucfirst(@$jobdetail->job_type)?></td>
								</tr>

							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p>Share On :</p>
					<div class="social_button col-md-4 text-center p-l">
						<!-- ShareThis BEGIN -->
						<div class="sharethis-inline-share-buttons"></div>
						<!-- ShareThis END -->
					</div>

					<div class="clearfix"></div>
					<div class="page-heading">
						<h2>Similar Jobs</h2>
					</div>
					<div class="table-bg">
						<table class="table">
							<tbody>
								<?php if(!empty($list_similarjob)){ foreach($list_similarjob as $key){
	                                    $get_category=$this->Crud_model->get_single('category',"id='".$key->category_id."'");
	                                    if(strlen($key->location)>45)
	                                    {
	                                        $location=substr($key->location, 0,45).'...';
	                                    }
	                                    else{
	                                        $location=$key->location;
	                                    }

	                                        ?>
									<tr>
										<td><div class="tab-image">
											 <?php if(!empty($key->company_logo) && file_exists('uploads/company_logo/'.$key->company_logo)){?>
	                                            <img src="<?= base_url('uploads/company_logo/'.$key->company_logo)?>" alt="" class="img-responsive" width="70" height="70"/>
	                                        <?php } else{?>
	                                             <img src="<?= base_url('uploads/no_image.png')?>" alt="" class="img-responsive" width="70" height="70"/>
	                                        <?php } ?>
										</div><h1><?= ucfirst($key->job_title)?> <p><?= ucfirst($get_category->category_name) ?></p></h1></td>
										  <?php if($key->job_type=='Full Time'){?>
	                                        <td class="work-time"><?= ucfirst($key->job_type)?></td>
	                                    <?php } if($key->job_type=='Part Time'){?>
	                                        <td class="work-time part"><?= ucfirst($key->job_type)?></td>
	                                    <?php } if($key->job_type=='Freelancer'){?>
	                                        <td class="work-time Free"><?= ucfirst($key->job_type)?></td>
	                                    <?php } ?>
	                                        <td><span class="ti-location-pin"></span> <?= ucfirst($location)?></td>
	                                        <td><a href="<?= base_url('job-detail/'.$key->post_slug_url)?>" class="table-btn-default">View Job</a></td>
	                                    </tr>
	                                   <?php }}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-------------- open  apply now modal ------------------->
	 <div id="applyModal" class="modal fade" role="dialog">
	 <div class="modal-dialog modal-dialog-centered">
		 <div class="modal-content">
			 <div class="modal-header">
				 <h4 class="modal-title">Apply Job</h4>
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
			 </div>
			 <div class="modal-body">

				 <div class="card-body">

					<form action="#" method="post" enctype="multipart/form-data">

						 <div class="form-group">
							 <label>Upload Your Resume <span style="color:red;">*</span></label>
							 <input class="form-control" type="file" name="resume" id="resume">
							 <br>

						 </div>
						 <input type="hidden" name="job_id" id="job_id" value="<?= @$jobdetail->id?>">

						 <div class="mt-4">
							 <button class="btn btn-default" type="button" onclick="return apply_now()">Submit</button>
							<!--  <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a> -->
						 </div>
					 </form>

				 </div>

			 </div>

		 </div>
	 </div>
 </div>
 <!-------------- end  apply now modal ------------------->

	<script type="text/javascript">
	  	 function get_value()
	    {
	        var base_url=$('#base_url').val();
	        <?php if(!empty($_SESSION['commonUser']['userId']) && $_SESSION['commonUser']['userType']==1)
	         {
	         	$session_value=$_SESSION['commonUser']['userType'];
	         }else{
	         	$session_value='';
	         }?>
	       var checkSession='<?= $session_value ?>';
	       if(checkSession =='')
	       {
	        swal({
	            title: "Only for Jobseeker!",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonColor: '#A5DC86',
	            cancelButtonColor: '#0bc2f3',
	            confirmButtonText: 'Yes, Login!',
	            cancelButtonText: 'Ok, cancel',
	            closeOnConfirm: false,
	            closeOnCancel: true
	        }, function(isConfirm){
	            if (isConfirm) {
	                window.location.href =base_url+"login";
	            }
	        });

	       }
	       else{
	       $('#applyModal').modal('show');
	    }

	    }
	  </script>


	  <script type="text/javascript">
	     	function favorite_job(postid)
	     	{
	     		var base_url=$('#base_url').val();
	         <?php if(!empty($_SESSION['commonUser']['userId']) && $_SESSION['commonUser']['userType']==1)
	         {
	         	$session_value=$_SESSION['commonUser']['userType'];
	         }else{
	         	$session_value='';
	         }?>
	       var checkSession='<?= $session_value ?>';

	       if(checkSession =='')
	       {
	         swal({
	            title: "Only for Jobseeker!",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonColor: '#A5DC86',
	            cancelButtonColor: '#0bc2f3',
	            confirmButtonText: 'Yes, Login!',
	            cancelButtonText: 'Ok, cancel',
	            closeOnConfirm: false,
	            closeOnCancel: true
	        }, function(isConfirm){
	            if (isConfirm) {
	                
	                window.location.href =base_url+"login";
	            }
	        });

	       }
	        else{
	      	 $.ajax({
	          type:"post",
	          url:base_url+"welcome/add_favoritejob",
	          cache:false,

	          data:{postid:postid},
	          success:function(returndata)
	          {
	          	 if(returndata==1)
	          {

	            swal({
	                   title: "Added successfully!",
	                   type: "success",
	                   confirmButtonColor: '#A5DC86',
	                   confirmButtonText: 'ok',
	                   closeOnConfirm: false,
	               }, function(isConfirm){
	                   if (isConfirm) {
	                       swal.close();

	                   }
	               });
	          }

	           else if(returndata==0){
	          swal({
	                   title: "This Job already exits!",
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

	            });

	    }


	    }


	     </script>

	     <script type="text/javascript" src="<?= base_url('assets/custom_js/applyjob.js')?>"></script>
