
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">List of Applied Jobs
					<div class="page-path"><a href="<?= base_url('')?>">Home</a> >> <span>List of Applied Jobs</span></div>
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
							<div class="job_title">Manage Applications</div>
							<table class="table">
								<thead class="">
									<tr>
										<th>Job Title</th>
										<th>Job Type</th>
										<!-- <th>Action</th> -->
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($list_appliedjob)){ foreach($list_appliedjob as $key){
									if($key->job_type=='Full Time')
									{
										$jobtype='<td class="work-time">Full Time</td>';
									}
									if($key->job_type=='Part Time')
									{
										$jobtype='<td class="work-time part">Part Time</td>';
									}
									if($key->job_type=='Freelancer')
									{
										$jobtype='<td class="work-time Free">Freelancer</td>';
									}
									?>
									<tr>
										<td><h1><?= ucfirst($key->job_title)?><p><?= ucfirst($key->category_name)?></p></h1></td>
										<?= ucfirst($jobtype)?>
										<!-- <td><a href="javascript:void(0)" class="btn btn-success btn-sm text-white"><i class="fa fa-eye"></i></a> </td> -->
									</tr>
									<?php }} else{?>
									<tr>
										<td colspan="2"><center>Sorry,No data found</center></td>

									</tr>
									<?php } ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
