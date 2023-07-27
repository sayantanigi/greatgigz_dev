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
              <li class="breadcrumb-item active">User <?= $heading?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php if(!empty($get_data->image)){
                    if(!file_exists('uploads/logo/'.$get_data->image)){
                    ?>
                    <img class="profile-user-img img-fluid img-circle"
                         src="<?= base_url('uploads/admin.png')?>"
                         alt="Admin profile picture">
                       <?php } else{?>
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?= base_url('uploads/logo/'.@$get_data->image)?>"
                       alt="User profile picture">

                     <?php } } else{?>
                       <img class="profile-user-img img-fluid img-circle"
                            src="<?= base_url('uploads/admin.png')?>"
                            alt="Admin profile picture">
                     <?php } ?>
                </div>

                <h3 class="profile-username text-center"><?= @$get_data->name?></h3>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile</a></li>
                  <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <form class="form-horizontal" action="<?= admin_url('login/update_Profile')?>" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= @$get_data->name?>" required onkeypress="only_alphabets(event)">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= @$get_data->username?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= @$get_data->email?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Profile Image</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="image" id="image" >
                        </div>
                      </div>
                      <input type="hidden" name="id" value="<?= $get_data->userId ?>">
                      <input type="hidden" name="old_image" value="<?= @$get_data->image?>">

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>


                  <div class="tab-pane" id="settings">

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
