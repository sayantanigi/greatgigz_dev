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
               <a  href="<?php echo admin_url('orders'); ?>" class="btn btn-primary float-right">Back</a>
             </div>
              <div class="col-sm-4">
              <div class="form-group">
                <label>Full Name :</label>
                <p><?= ucwords(@$get_data->firstname.' '.@$get_data->lastname); ?></p>
              </div>
              </div>
               <div class="col-sm-4">
              <div class="form-group">
                <label>Email :</label>
                <p><?= @$get_data->userEmail; ?></p>
              </div>
              </div>
               <div class="col-sm-4">
              <div class="form-group">
                <label>Subscription Name :</label>
                <p><?= ucwords(@$get_data->subscription_name); ?></p>
              </div>
              </div>
               <div class="col-sm-4">
              <div class="form-group">
                <label>No of Post :</label>
                <p><?= @$get_data->no_of_post; ?></p>
              </div>
							</div>
              <div class="col-sm-4">
              <div class="form-group">
                <label>Price :</label>
                <p><?= @$get_data->amount; ?></p>
              </div>
              </div>
              <div class="col-sm-4">
             <div class="form-group">
               <label>Start Date :</label>
               <p><?= date('Y-m-d',strtotime(@$get_data->payment_date)); ?></p>
             </div>
             </div>
              <div class="col-sm-4">
             <div class="form-group">
               <label>End Date :</label>
               <p><?= date('Y-m-d',strtotime(@$get_data->end_date)); ?></p>
             </div>
             </div>
             
              <div class="col-sm-4">
             <div class="form-group">
               <label>Payment Status :</label>
               <p>
                <?php 
                 if(@$get_data->payment_status=='pending')
            {
              echo '<span class="badge badge-danger">Pending</span>';
            }
            elseif(@$get_data->payment_status=='succeeded'){
              echo '<span class="badge badge-success">Completed</span>';
            }
                ?>
               </p>
             </div>
             </div>
              
            <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Subscription Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Service</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($list_of_service)){ 
                      $i=1;
                      foreach($list_of_service as $key){?>
                    <tr>
                      <td><?= $i;?></td>
                      <td><?= ucwords($key->service) ?></td>
                     
                    </tr>
                  <?php $i++;} } else{?>
                    <tr><td colspan="2"><center>Sorry,No Data found</center></td></tr>
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
