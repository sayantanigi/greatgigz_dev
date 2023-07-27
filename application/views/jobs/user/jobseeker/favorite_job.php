
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Bookmarked Jobs</div>    
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
							<div class="job_title">My Favorite Jobs</div>
							<table class="table">
								<thead class="">
									<tr>
										<th>Job Title</th>
										<th>Job Type</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($list_favoritejob)){ foreach($list_favoritejob as $key){
						$get_data=$this->Crud_model->get_single('applied_jobs',"job_id='".$key->postjob_id."' and user_id='".$_SESSION['commonUser']['userId']."'");
										if($key->job_type=='Full Time')
									{
										$jobtype='<td class="work-time">Full Time</td>';
									}
									if($key->job_type=='Part Time')
									{

									$jobtype='<td class="work-time Part">Part Time</td>';
									}
									if($key->job_type=='Freelancer')
									{
										$jobtype='<td class="work-time Free">Freelancer</td>';
									}
										?>
									<tr>
										<td><h1><?= ucwords($key->job_title)?><p><?= ucwords($key->category_name)?></p></h1></td>
										<?= ucwords($jobtype)?>
										<td>
											<?php if(!empty($get_data)){
									?>
									<a href="javascript:void(0)" class="btn btn-primary btn-sm text-white" onclick="return already_message()">Apply Now</a>
								<?php } else{?>
											<a href="javascript:void(0)" class="btn btn-primary btn-sm text-white" onclick="return get_value('<?= $key->postjob_id?>')">Apply Now</a>
										<?php } ?>
											<a href="<?= base_url('user/user_dashboard/Delete_favoritejob/'.$key->id)?>" class="btn btn-danger btn-sm text-white" onclick="if(confirm('Are you sure you want to Delete?')) commentDelete(1); return false">Delete</a>
										 </td>
									</tr>
									<?php } } else{?>
										<tr><td colspan="3"><center>Sorry,No Data Found</center></td></tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
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
                <label>Upload Your Resume <span style="color:red;">*</span><span id="err_resume"></span></label>
                <input class="form-control" type="file" name="resume" id="resume">
                <br>

              </div>
              <input type="hidden" name="job_id" id="job_id" value="">
             
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

  	function get_value(jobid)
  	{
  		$('#applyModal').modal('show');
  		 var job_id=$('#job_id').val(jobid);
  	}
  	
  </script>

   <script type="text/javascript" src="<?= base_url('assets/custom_js/applyjob.js')?>"></script>