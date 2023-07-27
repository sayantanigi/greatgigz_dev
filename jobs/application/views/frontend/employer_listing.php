
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Employers List</div>    
				</div>  
			</div>
		</div>
	</div>
	<main id="maincontent">
		<section class="employe_list">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="nav nav-tabs2">
							<li class="active"><a data-toggle="tab" href="#Top" onclick="return get_data();">Top</a></li>
							<li><a data-toggle="tab" href="#A" onclick="return get_value('A');">A</a></li>
							<li><a data-toggle="tab" href="#B" onclick="return get_value('B');">B</a></li>
							<li><a data-toggle="tab" href="#C" onclick="return get_value('C');">C</a></li>
							<li><a data-toggle="tab" href="#D" onclick="return get_value('D');">D</a></li>
							<li><a data-toggle="tab" href="#E" onclick="return get_value('E');">E</a></li>
							<li><a data-toggle="tab" href="#F" onclick="return get_value('F');">F</a></li>
							<li><a data-toggle="tab" href="#G" onclick="return get_value('G');">G</a></li>
							<li><a data-toggle="tab" href="#H" onclick="return get_value('H');">H</a></li>
							<li><a data-toggle="tab" href="#I" onclick="return get_value('I');">I</a></li>
							<li><a data-toggle="tab" href="#J" onclick="return get_value('J');">J</a></li>
							<li><a data-toggle="tab" href="#K" onclick="return get_value('K');">K</a></li>
							<li><a data-toggle="tab" href="#L" onclick="return get_value('L');">L</a></li>
							<li><a data-toggle="tab" href="#M" onclick="return get_value('M');">M</a></li>
							<li><a data-toggle="tab" href="#N" onclick="return get_value('N');">N</a></li>
							<li><a data-toggle="tab" href="#O" onclick="return get_value('O');">O</a></li>
							<li><a data-toggle="tab" href="#P" onclick="return get_value('P');">P</a></li>
							<li><a data-toggle="tab" href="#Q" onclick="return get_value('Q');">Q</a></li>
							<li><a data-toggle="tab" href="#R" onclick="return get_value('R');">R</a></li>
							<li><a data-toggle="tab" href="#S" onclick="return get_value('S');">S</a></li>
							<li><a data-toggle="tab" href="#T" onclick="return get_value('T');">T</a></li>
							<li><a data-toggle="tab" href="#U" onclick="return get_value('U');">U</a></li>
							<li><a data-toggle="tab" href="#V" onclick="return get_value('V');">V</a></li>
							<li><a data-toggle="tab" href="#W" onclick="return get_value('W');">W</a></li>
							<li><a data-toggle="tab" href="#X" onclick="return get_value('X');">X</a></li>
							<li><a data-toggle="tab" href="#Y" onclick="return get_value('Y');">Y</a></li>
							<li><a data-toggle="tab" href="#Z" onclick="return get_value('Z');">Z</a></li>
						</ul>
						<div class="tab-content">
							<div id="Top" class="tab-pane fade in active">
							<?php if(!empty($list_employer)){ 
								$i=1;
								foreach($list_employer as $key){?>
								<div class="col-md-3 p-l">
									<div class="list">
										<a href="<?= base_url('employer-detail/'.$key->slug_url)?>"><span><?= $i?>. <?= ucwords($key->firstname.' '.$key->lastname)?></span></a>
										
									</div>
								</div>
								<?php $i++;} }?>
							</div>
							 <div id="list-employer"></div> 


							
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
<link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
	<script type="text/javascript">
		function get_value(value)
		{
			var base_url=$('#base_url').val();
			$('#list-employer').html(createSkeleton(5));
		  function createSkeleton(limit){
  var skeletonHTML = '';
  for(var i = 0; i < limit; i++){
	skeletonHTML += '<div class="ph-item">';
	skeletonHTML += '<div class="ph-col-12">';
	skeletonHTML += '<div class="ph-picture"></div>';
	skeletonHTML += '</div>';
	skeletonHTML += '<div>';
	skeletonHTML += '<div class="ph-row">';
	skeletonHTML += '<div class="ph-col-12 big"></div>';
	skeletonHTML += '<div class="ph-col-12"></div>';
	skeletonHTML += '<div class="ph-col-12"></div>';
	skeletonHTML += '<div class="ph-col-12"></div>';
	skeletonHTML += '<div class="ph-col-12"></div>';
	skeletonHTML += '</div>';
	skeletonHTML += '</div>';
	skeletonHTML += '</div>';
  }
  return skeletonHTML;
}
			 $.ajax({
                   type:"post",
                   cache:false,
                   url:base_url+"home/get_emplyerData",
                   data:{
                       value:value
                   },
                  
                   success:function(returndata)
                   {
                   	if(returndata)
                   	{
                   		$('#Top').hide();
                   		$('#list-employer').show();
                   $('#list-employer').html(returndata);
               }
               
               }
       });
	}

	function get_data()
	{
		
		$('#Top').show();
		$('#list-employer').hide();
	}
	
	</script>
   