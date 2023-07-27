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
               <a  href="<?php echo admin_url('jobseekers'); ?>" class="btn btn-primary float-right">Back</a>
             </div>
             <?php if(!empty($get_userdata->profilePic) && file_exists('uploads/users/'.@$get_userdata->profilePic)){?>
             <div class="col-sm-4">
              <div class="form-group">
                <label>Profile :</label>
                <p><img src="<?= base_url('uploads/users/'.@$get_userdata->profilePic)?>" width="100px" height="100px"></p>
              </div>
              </div>
            <?php } ?>
              <div class="col-sm-4">
              <div class="form-group">
                <label>Full Name :</label>
                <p><?= ucwords(@$get_userdata->firstname.' '.@$get_userdata->lastname); ?></p>
              </div>
              </div>
              
               <div class="col-sm-4">
              <div class="form-group">
                <label>Email ID :</label>
                <p><?= @$get_userdata->email; ?></p>
              </div>
							</div>
              <div class="col-sm-4">
             <div class="form-group">
               <label>Phone Number :</label>
               <p><?= @$get_userdata->mobile; ?></p>
             </div>
             </div>
              <?php if(!empty($get_userdata->country_name)){?>
             <div class="col-sm-4">
            <div class="form-group">
              <label>Country :</label>
              <p><?= @$get_userdata->country_name; ?></p>
            </div>
           </div>
         <?php } if(!empty($get_userdata->state_name)){?>
           <div class="col-sm-4">
          <div class="form-group">
            <label>State :</label>
            <p><?= @$get_userdata->state_name; ?></p>
          </div>
          </div>
        <?php } if(!empty($get_userdata->city)){?>
          <div class="col-sm-4">
         <div class="form-group">
           <label>City :</label>
           <p><?= @$get_userdata->city; ?></p>
         </div>
         </div>
       <?php } if(!empty($get_userdata->zipcode)){?>
         <div class="col-sm-4">
        <div class="form-group">
          <label>ZipCode :</label>
          <p><?= @$get_userdata->zipcode; ?></p>
        </div>
        </div>
       <?php } if(!empty($get_userdata->professional_title)){?>
             <div class="col-sm-4">
             <div class="form-group">
               <label>Professional Title :</label>
               <p><?= ucwords(@$get_userdata->professional_title); ?></p>
             </div>
             </div>
           
         <?php } if(!empty($get_userdata->job_title)){?>
             <div class="col-sm-4">
             <div class="form-group">
               <label>Job Title :</label>
               <p><?= ucwords(@$get_userdata->job_title); ?></p>
             </div>
             </div>
           <?php }  if(@$get_userdata->dob!='0000-00-00' || @$get_userdata->dob!='NULL'){?>
       <div class="col-sm-4">
        <div class="form-group">
          <label>Date Of Birth :</label>
          <p><?= @$get_userdata->dob; ?></p>
        </div>
        </div>
      <?php } if(!empty($get_skill)){?>
       <div class="col-sm-4">
        <div class="form-group">
          <label>Skills :</label>
          <p><?php foreach($get_skill as $key){ echo $key->skill; echo ", ";}?></p>
        </div>
        </div>

      <?php }  if(!empty($get_userdata->job_type)){?>
       
       <div class="col-sm-4">
        <div class="form-group">
          <label>Job Type :</label>
          <p><?= @$get_userdata->job_type; ?></p>
        </div>
        </div>
       <?php } if(!empty($get_userdata->experience)){?>
       
       <div class="col-sm-4">
        <div class="form-group">
          <label>Experience :</label>
          <p><?= @$get_userdata->experience; ?></p>
        </div>
        </div>
       <?php } if(!empty($get_userdata->category_id)){?>
       
       <div class="col-sm-4">
        <div class="form-group">
          <label>Job Category :</label>
          <p><?= ucwords(@$get_category->category_name); ?></p>
        </div>
        </div>
       <?php } if(!empty($get_userdata->salary)){?>
       
       <div class="col-sm-4">
        <div class="form-group">
          <label>Salary :</label>
          <p><?= @$get_userdata->salary; ?></p>
        </div>
        </div>
       <?php }?>
        <?php if(!empty($get_userdata->jobseeker_resume) && file_exists('uploads/jobseeker_resume/'.@$get_userdata->jobseeker_resume)){?>
       
       <div class="col-sm-4">
        <div class="form-group">
          <label>CV :</label>
          <p>
            <a href="<?= base_url('uploads/jobseeker_resume/'.@$get_userdata->jobseeker_resume)?>">
              <?= @$get_userdata->jobseeker_resume ?>
            </a>
          </p>
        </div>
        </div>
       <?php }?>
       <?php if(!empty($get_userdata->address1)){?>

             <div class="col-sm-12">
             <div class="form-group">
               <label>Address :</label>
               <p><?= @$get_userdata->address1; ?></p>
             </div>
             </div>
        
       <?php } if(!empty($get_userdata->short_bio)){?>
       
       <div class="col-sm-12">
        <div class="form-group">
          <label>About Yourself :</label>
          <p><?= @$get_userdata->short_bio; ?></p>
        </div>
        </div>

      <?php } ?>

       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Education Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Basic/Institute</th>
                      <th>University/Institute</th>
                      <th>Marks</th>
                      <th>Passing of Year</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($list_education)){ 
                      $i=1;
                      foreach($list_education as $key){?>
                    <tr>
                      <td><?= $i;?></td>
                      <td><?= ucwords($key->education) ?></td>
                      <td><?= ucwords($key->university_institute) ?></td>
                      <td><span class="badge bg-primary"><?= $key->marks?></span></td>
                      <td><span class="badge bg-warning"><?= $key->year?></span></td>
                    </tr>
                  <?php $i++;} } else{?>
                    <tr><td colspan="5"><center>Sorry,No Data found</center></td></tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
             
            </div>
            <!-- /.card -->  
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Work Experience Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Employer/Company Name</th>
                      <th>Status</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Designation</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($list_workexperience)){ 
                      $i=1;
                      foreach($list_workexperience as $key){?>
                    <tr>
                      <td><?= $i;?></td>
                      <td><?= ucwords($key->employer_name) ?></td>
                      <td>
                        <?php if($key->status=='Prevoius Employer'){
                          echo '<span class="badge bg-success">'.ucwords($key->status).'</span>';
                        }
                          else if($key->status=='Current Employer'){
                          echo '<span class="badge bg-danger">'.ucwords($key->status).'</span>';

                          }
                          ?>
                         
                        </td>
                      <td><?= date('d-M-Y',strtotime($key->start_date))?></td>
                      <td><?= date('d-M-Y',strtotime($key->end_date))?></td>
                      <td><?= ucwords($key->designation)?></td>
                    </tr>
                  <?php $i++; }} else{?>
                    <tr><td colspan="6"><center>Sorry,No Data found</center></td></tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
             
            </div>
            <!-- /.card -->  
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
