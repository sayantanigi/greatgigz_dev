<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Faq Page</div>    
				</div>  
			</div>
		</div>
	</div>
	<main id="maincontent">
		<section class="manage">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<div class="page-heading">
							<h2>FREQUENTLY ASKED QUESTIONS</h2>
							<p><?= ucfirst(@$get_cms->description)?></p>
						</div>
					</div>
					<div class="col-md-7">
						<div class="page_accordian">
							<div class="panel-group" id="accordion">
								<?php if(!empty($list_faq)){ foreach($list_faq as $key){?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key->id?>"><?= $key->title?></a>
										</h4>
									</div>
									<div id="collapse<?= $key->id?>" class="panel-collapse collapse">
										<div class="panel-body">
											<p><?= $key->description ?></p>
										</div>
									</div>
								</div>
							<?php } }?>
								
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>