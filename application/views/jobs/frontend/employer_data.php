<div id="<?= @$alpha?>" class="tab-pane fade in">
	<?php if(!empty($get_employerData)){
		$count=1;
		foreach($get_employerData as $row){
		?>
								<div class="col-md-3 p-l">
									<div class="list">
									<a href="<?= base_url('employer-detail/'.$row->slug_url)?>">	
										<span><?= $count?>. <?= ucwords($row->firstname.' '.$row->lastname) ?></span>
									</a>	
									</div>
								</div>
								<?php $count++;} } else{?>
									<div class="col-md-12 p-l">
										<h2><center>Sorry,No Employer Found for this alphabetic</center></h2>
									</div>
								<?php }?>
							</div>