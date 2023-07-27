<?php
  $seg2=$this->uri->segment(2);
    if($seg2=='category')
    {
      $category_url=$this->uri->segment(3);
      $getcategory=$this->Crud_model->get_single('category',"slug_url='".$category_url."'");
    }
    else{
      $category_url='';
    }
    if($seg2=='company')
    {
      $company_url=$this->uri->segment(3);
      $getcompany=$this->Crud_model->get_single('postjob',"post_slug_url='".$company_url."' and is_delete='0'");
    }
    else{
      $company_url='';
    }
    if($seg2=='location')
    {
      $location_url=$this->uri->segment(3);
      $getlocation=$this->Crud_model->get_single('postjob',"post_slug_url='".$location_url."' and is_delete='0'");
    }
    else{
      $location_url='';
    }
          ?>
	<main>
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
								<input type="text" class="form-control" placeholder="City" name="location" id="location" oninput="getsourceaddress();">
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

						<?php  if(isset($_POST['search_title']) &&!empty($_POST['search_title']) || isset($_POST['search_location']) &&!empty($_POST['search_location']) ){ ?>
                <input type="hidden" name="search_title" id="search_title" value="<?= @$_POST['search_title']?>">
                 <input type="hidden" name="search_location" id="search_location" value="<?= @$_POST['search_location']?>">
            <?php } else{?>
              <input type="hidden" name="search_title" id="search_title" value="">
              <input type="hidden" name="search_location" id="search_location" value="">
             <?php  } ?>
             
              <input type="hidden" name="category_url" id="category_url" value="<?= !empty($getcategory->id)?$getcategory->id:'';?>">
              <input type="hidden" name="company_url" id="company_url" value="<?= !empty($getcompany->company_name)?$getcompany->company_name:'';?>">
              <input type="hidden" name="location_url" id="location_url" value="<?= !empty($getlocation->location)?$getlocation->location:'';?>">
					</div>
					<div class="col-md-9">
						<div class="col-md-7 col-sm-7 p-l">
							<div class="page-heading">
								<!-- <p>Showing 1-8 of 254</p> -->
							</div>
						</div>
						<div class="col-md-5 col-sm-5 filter p-r text-right">
							<div class="col-md-7 col-sm-5"><p>Sort by:</p></div>
							<div class="col-md-5 col-sm-7 p-r">
								<div class="dropdown">
									<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Recent Jobs
										<span class="caret"></span></button>
											<ul class="dropdown-menu pull-right" >
												<li><a href="javascript:void(0)" class="sortjob">Web Developer</a></li>
												<li><a href="javascript:void(0)" class="sortjob">MySQL Developers</a></li>
												<li><a href="javascript:void(0)" class="sortjob">Web Designer</a></li>
											</ul>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="page_listing" id="joblist">

						</div>
							<ul class="pagination pull-right" id="pagination_link">
								<!-- <li class="active"><a href="javascript:void(0)"><i class="fa fa-angle-left"></i></a></li>
								<li><a href="javascript:void(0)">1</a></li>


								<li class="active"><a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>   -->
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
    $('#joblist').html(createSkeleton(5));
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
             var location = $('#location').val();
              var jobtype = get_filter('jobtype');
              var price = get_filter('price');
             // console.log(jobtype); return false;
               var search_title = $('#search_title').val();
             var search_location = $('#search_location').val();
             var category_url = $('#category_url').val();
             var company_url = $('#company_url').val();
             var location_url = $('#location_url').val();
             
            
             $.ajax({
                 url:base_url+"jobs/home/fetch_data/"+page,
                 method:"POST",
                 dataType:"JSON",
                 data:{action:action, title_keyword:title_keyword,category_id:category_id, location:location,search_title:search_title,search_location:search_location,jobtype:jobtype,price:price,category_url:category_url,company_url:company_url,location_url:location_url},
                 success:function(data)
                 {
                     //$('#title_keyword').val(data.keyword);
                      //$('#location').val(data.keyword_location);
                     $('#joblist').html(data.joblist);
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
		 <script type="text/javascript">
		 function favorite_job(postid)
		 {
			 var base_url=$('#base_url').val();
				<?php if(!empty($_SESSION['commonUser']['userId']) && $_SESSION['commonUser']['userType']==1)
				{
				 $session_value=$_SESSION['commonUser']['userType'];
				}else{
				 $session_value='';
				}?>
			var checkSession='<?= $session_value ?>';

			if(checkSession =='')
			{
				swal({
					 title: "Only for Jobseeker!",
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
							 swal.close();

							 window.location.href =base_url+"login";
					 }
			 });

			}

			else{
				$.ajax({
				 type:"post",
				 url:base_url+"jobs/welcome/add_favoritejob",
				 cache:false,

				 data:{postid:postid},
				 success:function(returndata)
				 {
						if(returndata==1)
				 {

					 swal({
									title: "Added successfully!",
									type: "success",
									confirmButtonColor: '#A5DC86',
									confirmButtonText: 'ok',
									closeOnConfirm: false,
							}, function(isConfirm){
									if (isConfirm) {
											swal.close();

									}
							});
				 }

					else if(returndata==0){
				 swal({
									title: "This Job already exits!",
									type: "warning",
									confirmButtonColor: '#A5DC86',
									confirmButtonText: 'ok',
									closeOnConfirm: false,
							}, function(isConfirm){
									if (isConfirm) {
											swal.close();

									}
							});
								 return false;
				 }

				 }

					 });

	 }


		 }
		</script>
