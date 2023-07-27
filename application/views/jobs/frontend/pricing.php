
	<div class="page_banner banner price-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Products / Pricing</div>
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
					<?php if(!empty($get_pricing)){ foreach($get_pricing as $key){
					$list_service=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$key->id."'");
					$get_employer=$this->Crud_model->get_single('employer_subscription',"subscription_id='".$key->id."'");
					// print_r($get_employer->employer_id); exit;
					if($key->subscription_name=='free' && @$_SESSION['commonUser']['userId']==@$get_employer->employer_id)
					{
						$freeplan_hide="none";
					}
					else{
						$freeplan_hide="";
					}
					?>
					<div class="col-md-4 text-center" style="display: <?= $freeplan_hide?>;">
						<div class="panel-pricing">
							<div class="panel-heading">
								<h3><?= ucwords($key->subscription_name)?></h3>
								<h5><?= $key->subscription_duration ?> Month</h5>
									<h5><?= $key->no_of_post ?> Job Posting</h5>
							</div>
							<ul class="list-group text-center">
								<?php if(!empty($list_service)){ foreach($list_service as $row){?>
								<li class="list-group-item"> <?= ucwords($row->service)?></li>
								<?php }}?>
							</ul>
							<div class="panel-footer">
								<div class="display-2">
									<h3><span class="currency">$</span><?= $key->subscription_amount?><span class="period">/Member</span></h3>
									<a class="btn btn-lg btn-block btn-default" href="javascript:void(0)" onclick="return buysubscription('<?= $key->id?>')">Get Started</a>
								</div>
							</div>
						</div>
					</div>
					<?php }}?>

				</div>
			</div>
		</section>
	</main>
	<script type="text/javascript">
		 function buysubscription(subscription_id)
		 {
			 var base_url=$('#base_url').val();
			 <?php if(!empty($_SESSION['commonUser']['userId']) && $_SESSION['commonUser']['userType']==2)
				{
				 $session_value=$_SESSION['commonUser']['userType'];
				}else{
				 $session_value='';
				}?>
			var checkSession='<?= $session_value ?>';
			if(checkSession =='')
			{
			 swal({
					 title: "Only for Employer!",
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
				 url:base_url+"user/user_dashboard/purchase_subscription",
				 cache:false,

				 data:{subscription_id:subscription_id},
				 success:function(returndata)
				 {
						if(returndata==1)
				 {

					 swal({
									title: "Thank you! Get subscription plan successfully ",
									type: "success",
									confirmButtonColor: '#A5DC86',
									confirmButtonText: 'ok',
									closeOnConfirm: false,
							}, function(isConfirm){
									if (isConfirm) {

										window.location.href =base_url+"subscription";
									}
							});
				 }

				 }

					 });
	 }
		 }
		</script>
