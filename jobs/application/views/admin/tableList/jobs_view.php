<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $heading?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $heading?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->

				<div class="card">
					<div class="card-body">

							<div class="row">
                 <div class="col-sm-12 ">
               <a  href="<?php echo admin_url('jobs'); ?>" class="btn btn-primary float-right">Back</a>
             </div>
              <div class="col-sm-4">
              <div class="form-group">
                <label>Full Name :</label>
                <p><?= ucwords(@$get_data->firstname.' '.@$get_data->lastname); ?></p>
              </div>
              </div>
               <div class="col-sm-4">
              <div class="form-group">
                <label>Category Name :</label>
                <p><?= ucwords(@$get_data->category_name); ?></p>
              </div>
              </div>
               <div class="col-sm-4">
              <div class="form-group">
                <label>Job Title :</label>
                <p><?= ucwords(@$get_data->job_title); ?></p>
              </div>
              </div>
               <div class="col-sm-4">
              <div class="form-group">
                <label>Job Type :</label>
                <p><?= @$get_data->job_type; ?></p>
              </div>
							</div>
              <div class="col-sm-4">
              <div class="form-group">
                <label>Job Tags :</label>
                <p><?= ucwords(@$get_data->job_tags); ?></p>
              </div>
              </div>
              <div class="col-sm-4">
             <div class="form-group">
               <label>Company Name :</label>
               <p><?= @$get_data->company_name; ?></p>
             </div>
             </div>
              <div class="col-sm-4">
             <div class="form-group">
               <label>Website :</label>
               <p><?= @$get_data->website; ?></p>
             </div>
             </div>
             
              <div class="col-sm-4">
             <div class="form-group">
               <label>Company Logo :</label>
               <p>
                 <?php if(!empty($get_data->company_logo) && file_exists('uploads/company_logo/'.@$get_data->company_logo)){?>
                  <img src="<?= base_url('uploads/company_logo/'.@$get_data->company_logo)?>" width="100px" height="100px">
                   <?php } else{?>
                     <img src="<?= base_url('uploads/no_image.png')?>" width="100px" height="100px">
                   <?php } ?>
               </p>
             </div>
             </div>
              <div class="col-sm-4">
             <div class="form-group">
               <label>Featured Job :</label>
               <p><?= ucwords(@$get_data->featured_job); ?></p>
             </div>
             </div>
             <div class="col-sm-12">
             <div class="form-group">
               <label>Description :</label>
               <p><?= @$get_data->description; ?></p>
             </div>
             </div>
            
					</div>
				</div>
          <!-- /.card-body -->
      
        </div>
        <!-- /.card -->



      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
