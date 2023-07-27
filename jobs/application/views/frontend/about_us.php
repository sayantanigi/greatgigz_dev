
	<div class="page_banner about">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">About Us</div>
				</div>
			</div>
		</div>
	</div>
	<main id="maincontent">
		<div class="container">
			<div class="about_us">
				<div class="row">
					<div class="col-md-4">
						<div class="page-heading">
							<span>Introduction</span>
							<h2><?= ucwords(@$get_about->title)?></h2>
							<hr>
							<strong><?= ucwords(@$get_about2->title)?></strong>
						</div>

					</div>
					<div class="col-md-8">
						<div class="about_right">
							<span><?= @$get_about->description ?></span>
							<p><?= @$get_about2->description ?></p>
						</div>
					</div>
				</div>
				<div class="row mrgn-30-top">
					<div class="col-md-6">
						<div class="video-sec">
							<div class="embed-responsive embed-responsive-16by9">
								<!-- <iframe id="player_1" src="https://fast.wistia.com/embed/iframe/t4yniozocs?controlsVisibleOnLoad=true&amp;playerColor=474745&amp;version=v1&amp;videoHeight=366&amp;videoWidth=650&amp;volumeControl=true&amp;videoFoam=true" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" width="100%" height="350"></iframe> -->
							<?php	 if(!empty($get_about3->video) && file_exists('uploads/video/'.$get_about3->video)){ ?>
								<video width="200" controls>
           <source src="<?= base_url('uploads/video/'.$get_about3->video)?>" style="width:50px;height:50px;" type="video/mp4"> </video>
           <?php } ?>
							</div>
							</div>
						</div>
					<div class="col-md-6">
						<div class="page-heading">
							<h2><?= ucwords(@$get_about3->title)?></h2>
							<hr>
							<p><?= @$get_about3->description ?></p>
							
						</div>
					</div>
					</div>
				</div>
			</div>
		<section class="featured">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<div class="page-heading">
							<h2><?= ucwords(@$get_about4->title)?></h2>
							<p><?= @$get_about4->description ?></p>
						</div>
					</div>
				</div>
				<div class="row">
					<?php if(!empty($list_ourservices)){ foreach($list_ourservices as $key){?>
					<div class="col-md-4">
						<div class="icon-feature"><span class="<?= $key->icon ?>"></span></div>
						<div class="overflow feature_block">
							<h2><?= ucwords($key->title)?></h2>
							<p><?= ucfirst($key->description)?></p>
						</div>
					</div>
				<?php } } ?>
				</div>
				
			</div>
		</section>
		<section class="success_story">
			<div class="container">
				<div class="row">
					<div class="col-md-4 text-right">
						<div class="page-heading2">
							<h1>Phillyhire</h1>
							<strong>success stories</strong>
						</div>
					</div>
					<div class="col-md-8">
						<div class="testi-slider">
							<ul class="slides list-inline">
								<?php if(!empty($list_testimonial)){ foreach($list_testimonial as $key){?>
								<li>
									<div class="testi-box clearfix text-center">
										<?php if(!empty($key->image) && file_exists('uploads/testimonial/'.$key->image)){?>
										<img src="<?= base_url('uploads/testimonial/'.$key->image)?>" alt="" class="img-responsive">
									<?php } ?>

										<div class="content">
											<p><?= ucfirst($key->description)?></p>
											<div class="content-hr"></div>
											<h4><?= ucwords($key->name)?></h4>
											<span><?= ucwords($key->designation)?></span>
										</div>
									</div>
								</li>
								<?php } }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	</main>
