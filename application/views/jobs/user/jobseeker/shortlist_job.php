
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Shortlisted Jobs</div>    
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
							<div class="job_title">Shortlisted Applications</div>
							<table class="table">
								<thead class="">
									<tr>
										<th>Job Title</th>
										<th>Job Type</th>
										<!-- <th>Action</th> -->
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($list_shortlistjob)){ foreach($list_shortlistjob as $key){?>
									<tr>
										<td><h1><?= ucwords($key->job_title)?> <p><?= ucwords($key->category_name)?></p></h1></td>
										<?php if($key->job_type=='Full Time'){
											echo "<td class='work-time'>Full Time</td>";
										} if($key->job_type=='Part Time')
										{

											echo "<td class='work-time Part'>Part Time</td>";
										}
										if($key->job_type=='Freelancer'){
											echo "<td class='work-time free'>Freelancer</td>";
										}
										?>
									</tr>
									<?php } }else{?>
										<tr><td colspan="2"><center>No Data Found</center></td></tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	