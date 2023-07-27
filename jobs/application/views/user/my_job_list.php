
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">List od My Jobs
					<div class="page-path"><a href="<?= base_url('')?>">Home</a> >> <span>List od My Jobs</span></div>
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
							<div class="job_title">Manage Jobs</div>
							<table class="table">
								<thead class="">
									<tr>
										<th>Job ID</th>
										<th>Job Title</th>
										<th>Status</th>
									 <th width="110">Action</th> 
									</tr>
								</thead>
								<tbody>
                  <?php

                      if(!empty($get_postjob)){
                         $i=1;
                        foreach ($get_postjob as $key)
                   {?>
									<tr>
										<td><a href="#">#FED<?= $key->id?></a></td>
										<td><?= ucfirst($key->job_title)?></td>
										<!-- <td><a href="employer-candidates-for-single-job.html">18</a></td>
										<td>24 Jan 2017</td>
										<td>18 Feb 2017</td> -->
										<td>
											<?php if($key->is_delete==0){?>
                      <span class="text-success">Open</span>
										<?php } else{?>
											<span class="text-danger">Closed</span>
										<?php } ?>
                    </td>
									 <td><a href="" class="btn"><i class="fa fa-edit"></i></a>
										 <a href="<?= base_url('user/user_dashboard/delete_post/'.$key->id);?>" class="btn" onclick="if(confirm('Are you sure you want to Delete?')) commentDelete(1); return false"><i class="fa fa-trash"></i></a></td>
									</tr>
                <?php } } else{?>
                  <tr>
                    <td colspan="4"><center>No Data Found</center></td>
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
