
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">List of JobSeekers
						<div class="page-path"><a href="<?= base_url('')?>">Home</a> >> <span>List of JobSeekers</span></div>
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
							<div class="job_title">List of JobSeekers</div>
						
							<table class="table">
								<thead class="">
									<tr>
										<th>Candidate Name</th>
										<th>Job Title</th>
										<th>Location</th>
                    <th>Skills</th>
									</tr>
								</thead>
								<tbody id="jobseeker_list">
										
								</tbody>
							</table>
							<ul class="pagination pull-right" id="pagination_link">
							
							</ul>
						</div>
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
    $('#jobseeker_list').html(createSkeleton(5));
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
            
             $.ajax({
                 url:base_url+"dashboard/jobseekerlist_data/"+page,
                 method:"POST",
                 dataType:"JSON",
                 data:{action:action},
                 success:function(data)
                 {
                    
                     $('#jobseeker_list').html(data.jobseeker_list);
                     $('#pagination_link').html(data.pagination_link);
                 }
             })
         }

         $(document).on('click', '.pagination li a', function(event){
             event.preventDefault();
             var page = $(this).data('ci-pagination-page');
             filter_data(page);
         });

     });

     </script>

    