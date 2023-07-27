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
               <a  href="<?php echo admin_url('users'); ?>" class="btn btn-primary float-right">Back</a>
             </div>
              <div class="col-sm-4">
              <div class="form-group">
                <label>User Name :</label>
                <p><?= ucfirst($get_data->username); ?></p>
              </div>
              </div>
               <div class="col-sm-4">
              <div class="form-group">
                <label>Age :</label>
                <p><?= $get_data->age.' '.'Years'; ?></p>
              </div>
              </div>
               <div class="col-sm-4">
              <div class="form-group">
                <label>Gender :</label>
                <p><?= $get_data->gender; ?></p>
              </div>
							</div>
              <div class="col-sm-4">
             <div class="form-group">
               <label>Email :</label>
               <p><?= $get_data->email; ?></p>
             </div>
             </div>

             <div class="col-sm-4">
            <div class="form-group">
              <label>Country :</label>
              <p><?= $get_data->country_name; ?></p>
            </div>
           </div>
           <div class="col-sm-4">
          <div class="form-group">
            <label>State :</label>
            <p><?= $get_data->state_name; ?></p>
          </div>
          </div>
          <div class="col-sm-4">
         <div class="form-group">
           <label>City :</label>
           <p><?= $get_data->city_name; ?></p>
         </div>
         </div>
         <div class="col-sm-4">
        <div class="form-group">
          <label>User Type :</label>
          <p><?= ucfirst($get_data->user_type); ?></p>
        </div>
        </div>
        <div class="col-sm-4">
       <div class="form-group">
         <label>User Sub Type :</label>
         <p><?= ucfirst($user_subType); ?></p>
       </div>
       </div>
       <div class="col-sm-4">
      <div class="form-group">
        <label>Created Date :</label>
        <p><?= date('d-M-Y',strtotime($get_data->created)); ?></p>
      </div>
      </div>

					</div>
				</div>
          <!-- /.card-body -->
        </form>
        </div>
        <!-- /.card -->



      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
