
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Subscription Plans</div>    
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
							<!--<div class="job_title">Products / Pricing</div>-->
							<div class="account-pnl">
								<div class="row">
					<div class="col-md-12">
						<div class="page-heading">
						<h2><?= ucwords(@$cms_pricing->title)?></h2>
							<?= @$cms_pricing->description ?>
						</div>
					</div>
				</div>
				<!--<div class="row">-->
				<!--	<div class="col-md-12">-->
				<!--		<div class="oth-head">-->
				<!--			<h4>Prices start at $0! Put your job or exclusive banner in our next Job Flash™ Email to Philly Hire Professionals to increase candidates by up to 500%!</h4>-->
				<!--			<p>Options to attract diverse candidates, veterans, and maximize distribution to job aggregator websites & social media now available during checkout.</p>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
				<div class="row">
					<?php if(!empty($list_subscription)){ foreach($list_subscription as $key){
						$get_service=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$key->subscription_id."'");
						$total_postjobs=$this->Crud_model->GetData('postjob','',"user_id='".$_SESSION['commonUser']['userId']."' and employer_subscription_id='".$key->id."'");
						?>
					<div class="col-md-4 text-center">
						<div class="panel-pricing">
							<div class="panel-heading">
							<h3><?= ucwords($key->subscription_name)?></h3>
								<h5><?= $key->subscription_duration ?> Month</h5>
								<h5><?= $key->no_of_post ?> Job Posting</h5>
							</div>
							<ul class="list-group text-center">
								<?php if(!empty($get_service)){ foreach($get_service as $row){?>
								<li class="list-group-item"> <?= ucwords($row->service)?></li>
								
							<?php } }?>
							</ul>
							<div class="panel-footer">
								<div class="display-2">
									<h3><span class="currency">$</span><?= $key->subscription_amount?><span class="period">/Member</span></h3>
									<?php if($key->subscription_name=='free'){?>
										<a class="btn btn-lg btn-block btn-default" href="<?= base_url('pricing')?>"> Upgrade </a> 
									<?php } else if($key->subscription_name=='paid'){?>
							<?php if(date('Y-m-d',strtotime($key->end_date)) > date('Y-m-d') && $key->no_of_post > count($total_postjobs)){?>
									<a class="btn btn-lg btn-block btn-default" href="<?= base_url('pricing')?>"> Upgrade </a> 
								<?php } else{?>
									<span class="btn btn-link" onclick="return renew_subscription('<?= $key->subscription_id?>')">Expire</span>/
									<span><a href="<?= base_url('pricing')?>" class="btn btn-link">upgrade</a></span>
								<?php }} ?>
								
								</div>
							</div>
						</div>
					</div>
						<?php } }?>
				</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	
	
<script type="text/javascript" src="<?= base_url('assets/custom_js/subscription.js')?>"></script>