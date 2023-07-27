
	<div class="page_banner banner employer-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">List of Application
						<div class="page-path"><a href="<?= base_url('')?>">Home</a> >> <span>List of Application</span></div>
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
							<div class="job_title">Manage Applications</div>
							<div class="row">
								<div class="col-md-4">
									<label>Job Title</label>
									<select class="form-control" name="job_title" id="job_title">
										<option value="">Select Job</option>
										<?php if(!empty($get_job)){ foreach($get_job as $key){?>
										<option value="<?= $key->id?>"><?= ucfirst($key->job_title)?></option>
									<?php } }?>
									</select>

								</div>
								<div class="col-md-3">
									<label>Start Date</label>
									<input type="date" class="form-control" name="start_date" id="start_date">

								</div>
								<div class="col-md-3">
									<label>End Date</label>
									<input type="date" class="form-control" name="end_date" id="end_date">

								</div>
								<div class="col-md-2">
									<label>&nbsp;</label>
									<a href="<?= base_url('applicant-list')?>" class="btn btn-primary btn-sm text-white" title="Refresh" style="margin-top: 30px;"><i class="fa fa-refresh"></i></a>
								</div>
							</div>  <!-- end row -->
							<table class="table">
								<thead class="">
									<tr>
										<th>Candidate Name</th>
										<th>Job Title</th>
										<th>Resume</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="applicant_list">

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
    $('#applicant_list').html(createSkeleton(5));
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
             var job_title = $('#job_title').val();
               var start_date = $('#start_date').val();
             var end_date = $('#end_date').val();
             $.ajax({
                 url:base_url+"dashboard/applicantlist_data/"+page,
                 method:"POST",
                 dataType:"JSON",
                 data:{action:action,job_title:job_title,start_date:start_date,end_date:end_date},
                 success:function(data)
                 {

                     $('#applicant_list').html(data.applicant_list);
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

       $('#job_title').on('change', function(){
         filter_data(1);
     });

  	 $('#start_date').on('change', function(){

       filter_data(1);
   });
  	  $('#end_date').on('change', function(){

       filter_data(1);
   });
     });

     </script>

		 <script type="text/javascript">
		 function delete_item(id)
		 {
			 var ask = confirm("Do you want to delete this record?");
	 if(ask==true)
 {
		$.ajax({
			 type:"POST",
			 url:'<?= base_url("user/user_dashboard/delete_applicant")?>',
			 data:{id:id},
			 cache:false,
			 success:function(returndata)
			 {
				 if(returndata==1){
				 location.reload();
		 }

			 }
		 });
 }
		 }
		 
		 function change_status(appliedjob_id )
      {
        var base_url=$('#base_url').val();
  swal({   
            title: "Are you sure want to change status ?",   
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#A5DC86',
            cancelButtonColor: '#0bc2f3',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No', 
            closeOnConfirm: false,   
            closeOnCancel: true 
        }, function(isConfirm){
            if (isConfirm) {
            $.ajax({
          type:"post",
          url:base_url+"user/user_dashboard/applied_changestatus",
          cache:false,

          data:{appliedjob_id :appliedjob_id },
          success:function(returndata)
          {
             if(returndata==1)
          {

            location.reload();
          }
      }
       });
            }
        });
      }
		</script>
