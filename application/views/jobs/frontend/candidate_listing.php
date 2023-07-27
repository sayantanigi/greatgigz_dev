
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Browse Candidates</div>    
				</div>  
			</div>
		</div>
	</div>
	<main id="maincontent">
		<section class="resume">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="job-search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Job title / keywords" name="title" id="title_keyword">
									<div class="search_icon"><span class="ti-briefcase"></span></div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="City / zip code" name="location" id="location" oninput="getsourceaddress();">
								<div class="search_icon"><span class="ti-location-pin"></span></div>
							</div>
							<!-- <a href="javascript:void(0)" class="btn btn-default">Search Job Results</a> -->
						</div>
						<div class="job_title">Categories</div>
						<div class="borderfull-width"></div>
						<div class="clearfix"></div>
						<div class="page-heading">
							<?php if(!empty($get_category)){ foreach($get_category as $cat){?>
							<div class="category">
							<div class="col-md-1 p-l p-r">
							   <input type="checkbox" class="common_selector category" id="Accounting<?= $cat->id?>"  value="<?= $cat->id?>">
							</div>
							<div class="col-md-11 p-l p-r">
								 <label for="Accounting<?= $cat->id?>"><?= ucfirst($cat->category_name)?></label>
							</div>
						</div>
						<?php } }?>
						
						</div>
						<div class="job_title">Skills</div>
						<div class="borderfull-width"></div>
						<div class="page-heading">
							<?php if(!empty($get_skills)){ foreach($get_skills as $row){?>
						<div class="category">
							<div class="col-md-1 p-l p-r">
							   <input type="checkbox" id="PHP<?= $row->id?>" class="common_selector skill" name="skill" value="<?= $row->id?>"> 
							</div>
							<div class="col-md-11 p-l p-r">
								 <label for="PHP<?= $row->id?>"><?= ucwords($row->skill)?></label> 
							</div>
						</div>
						  <?php } }?> 
						</div>
						<div class="job_title">Job Type</div>
						<div class="borderfull-width"></div>
						<div class="page-heading">
						<div class="category">
							<div class="col-md-1 p-l p-r">
							   <input type="checkbox" id="cb_9" class="common_selector jobtype" name="jobtype" value="All"> 
							</div>
							<div class="col-md-11 p-l p-r">
								 <label for="cb_9">All Type</label>
							</div>
						</div>
						<div class="category">
							<div class="col-md-1 p-l p-r">
							   <input type="checkbox" id="cb_8" class="common_selector jobtype" name="jobtype" value="Full Time">
							</div>
							<div class="col-md-11 p-l p-r">
								 <label for="cb_8">Full Time</label>
							</div>
						</div>
						<div class="category">
							<div class="col-md-1 p-l p-r">
							   <input type="checkbox" id="cb_7" class="common_selector jobtype" name="jobtype" value="Part Time">
							</div>
							<div class="col-md-11 p-l p-r">
								 <label for="cb_7">part Time</label>
							</div>
						</div>
						<div class="category">
							<div class="col-md-1 p-l p-r">
							   <input type="checkbox" id="cb_6" class="common_selector jobtype" name="jobtype" value="Freelancer">
							</div>
							<div class="col-md-11 p-l p-r">
								 <label for="cb_6">Freelancer</label>
							</div>
						</div> 
						</div>
						<div class="job_title">Rate / Hr</div>
						<div class="borderfull-width"></div>
						<div class="page-heading">
						<div class="category">
							<div class="col-md-1 p-l p-r">
							   <input type="checkbox" id="cb_5" class="common_selector price" name="price" value="0-25">
							</div>
							<div class="col-md-11 p-l p-r">
								 <label for="cb_5">$0 - $25 (231)</label>
							</div>
						</div>
						<div class="category">
							<div class="col-md-1 p-l p-r">
							   <input type="checkbox" id="cb_4" class="common_selector price" name="price" value="25-50">
							</div>
							<div class="col-md-11 p-l p-r">
								 <label for="cb_4">$25 - $50 (297)</label>
							</div>
						</div>
						<div class="category">
							<div class="col-md-1 p-l p-r">
							   <input type="checkbox" id="cb_3" class="common_selector price" name="price" value="50-100">
							</div>
							<div class="col-md-11 p-l p-r">
								 <label for="cb_3">$50 - $100 (78)</label>
							</div>
						</div>
							<div class="category">
							<div class="col-md-1 p-l p-r">
							  <input type="checkbox" id="cb_2" class="common_selector price" name="price" value="100-200">
							</div>
							<div class="col-md-11 p-l p-r">
								<label for="cb_2">$100 - $200 (98)</label>
							</div>
						</div>
						<div class="category">
							<div class="col-md-1 p-l p-r">
								<input type="checkbox" id="cb_1" class="common_selector price" name="price" value="200-1000">
							</div>
							<div class="col-md-11 p-l p-r">
								<label for="cb_1">$200+ (21)</label>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="col-md-7 col-sm-7 p-l">
							<div class="page-heading">
								<p>Showing 1-8 of 254</p>
							</div>
						</div>  
						<div class="col-md-5 col-sm-5 filter p-r text-right">
							<div class="col-md-7 col-sm-5"><p>Short by:</p></div>
							<div class="col-md-5 col-sm-7 p-r">
								<div class="dropdown">
									<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">By Default <span class="caret"></span></button>
											<ul class="dropdown-menu pull-right">
												<li><a href="javascript:void(0)">Executive</a></li>
												<li><a href="javascript:void(0)">SEO</a></li>
												<li><a href="javascript:void(0)">Java Developer</a></li>
											</ul>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="page_listing candidate" id="candidatelist">
								
						</div>
							<ul class="pagination pull-right" id="pagination_link">
								  
							</ul>
					</div>
				</div>
			</div>
		</section>
	</main>
    
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">


           <script>
     $(document).ready(function(){

         filter_data(1);

         function filter_data(page)
         {
              var base_url = $("#base_url").val();
    $('#candidatelist').html(createSkeleton(5));
     function createSkeleton(limit){
 var skeletonHTML = '';
 for(var i = 0; i < limit; i++){
 skeletonHTML += '<div class="ph-item">';
 skeletonHTML += '<div class="ph-col-4">';
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
             var action = 'fetch_data';
             var title_keyword = $('#title_keyword').val();
             var category_id = get_filter('category');
             var skill_id = get_filter('skill');
             var jobtype = get_filter('jobtype');
             var location = $('#location').val();
              var price = get_filter('price');
             $.ajax({
                 url:base_url+"home/list_candidate_data/"+page,
                 method:"POST",
                 dataType:"JSON",
                 data:{action:action, title_keyword:title_keyword,category_id:category_id, location:location,price:price,skill_id:skill_id,jobtype:jobtype},
                 success:function(data)
                 {
                   
                     $('#candidatelist').html(data.candidatelist);
                     $('#pagination_link').html(data.pagination_link);
                 }
             })
         }

          function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

         $(document).on('click', '.pagination li a', function(event){
             event.preventDefault();
             var page = $(this).data('ci-pagination-page');
             filter_data(page);
         });

        $('.common_selector').click(function(){

        filter_data(1);
    });


         $('#title_keyword').keydown(function(){
           filter_data(1);
       });
       $('#location').on('change', function(){
         filter_data(1);
     });

  
     });

     </script>