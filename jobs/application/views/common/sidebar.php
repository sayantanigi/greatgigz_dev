<?php
if(empty($_SESSION['commonUser']['userId']))
{
redirect(base_url('login'));
}
$seg1=$this->uri->segment(1);
?>

<div class="col-md-3">
						<div class="Resume">
							<ul class="unstyled">
								<li class="<?php if($seg1=='dashboard' || $seg1=='profile'){ echo 'active';}?>"><a href="<?=base_url('dashboard')?>"><i class="fa fa-caret-right"></i> My Account</a></li>
							
								<?php if($_SESSION['commonUser']['userType']==2){?>
									<li class="<?php if($seg1=='subscription'){ echo 'active';}?>"><a href="<?= base_url('subscription')?>"><i class="fa fa-caret-right"></i> Subscription Plans</a></li>
								<li class="<?php if($seg1=='post-job'){ echo 'active';}?>"><a href="<?= base_url('post-job')?>"><i class="fa fa-caret-right"></i> Post a Job</a></li>

								<li class="<?php if($seg1=='my-jobs'){ echo 'active';}?>"><a href="<?= base_url('my-jobs')?>"><i class="fa fa-caret-right"></i> My Jobs</a></li>
									<li class="<?php if($seg1=='applicant-list'){ echo 'active';}?>"><a href="<?= base_url('applicant-list')?>"><i class="fa fa-caret-right"></i> List of Applications</a></li>
									<li class="<?php if($seg1=='jobseeker-list'){ echo 'active';}?>"><a href="<?= base_url('jobseeker-list')?>"><i class="fa fa-caret-right"></i> Candidate List</a></li>
									<?php } ?>
								<li class="<?php if($seg1=='notification'){ echo 'active';}?>"><a href="<?= base_url('notification')?>"><i class="fa fa-caret-right"></i> Notifications</a></li>
										<?php if($_SESSION['commonUser']['userType']==1){?>
								<li class="<?php if($seg1=='favorite-job'){ echo 'active';}?>"><a href="<?= base_url('favorite-job')?>"><i class="fa fa-caret-right"></i> My Favorite Jobs</a></li>
								<li class="<?php if($seg1=='applied-job'){ echo 'active';}?>"><a href="<?= base_url('applied-job')?>"><i class="fa fa-caret-right"></i> Applied jobs</a></li>
							<li class="<?php if($seg1=='shortlist-job'){ echo 'active';}?>"><a href="<?= base_url('shortlist-job')?>"><i class="fa fa-caret-right"></i> Shortlisted jobs</a></li>
							<?php } ?>
								<li class="<?php if($seg1=='change-password'){ echo 'active';}?>"><a href="<?= base_url('change-password')?>"><i class="fa fa-caret-right"></i> Change Password</a></li>
							<li class="<?php if($seg1=='help'){ echo 'active';}?>"><a href="<?= base_url('help')?>"><i class="fa fa-caret-right"></i> Help</a></li>
								<li class="border-none"><a href="<?= base_url('logout')?>"><i class="fa fa-caret-right"></i> Sign Out</a></li>
							</ul>
						</div>
					</div>
