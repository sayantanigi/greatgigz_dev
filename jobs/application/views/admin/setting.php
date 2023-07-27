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
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active"><?= $heading?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Logo Setting</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Contact Setting</a></li>
                 <!--  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <form class="form-horizontal" action="<?= admin_url('setting/update_action')?>" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Website Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="website_name" id="website_name" value="<?= @$website_name?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="logo" id="logo" >
                           <br>
                        <?php
											if(!empty($logo))
											{
												if(!file_exists('uploads/logo/'.@$logo))
												{
													?>
											<img class="img-fluid" width="100px" height="100px" src="<?= base_url('uploads/no_image.png') ?>">
										<?php } else{?>

											<img class="img-fluid" width="100px" height="100px" src="<?= base_url('uploads/logo/'.@$logo) ?>">
										<?php } } else{ ?>

												<img class="img-fluid" width="100px" height="100px" src="<?= base_url('uploads/no_image.png') ?>">
											<?php } ?>
										<input type="hidden" name="old_logo" value="<?= @$logo?>">
                        </div>

                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Favicon</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="favicon" id="favicon" >
                           <br>
                        <?php
											if(!empty($favicon))
											{
												if(!file_exists('uploads/logo/'.@$favicon))
												{
													?>
											<img class="img-fluid" width="100px" height="100px" src="<?= base_url('uploads/no_image.png') ?>">
										<?php } else{?>

											<img class="img-fluid" width="100px" height="100px" src="<?= base_url('uploads/logo/'.@$favicon) ?>">
										<?php } } else{ ?>

												<img class="img-fluid" width="100px" height="100px" src="<?= base_url('uploads/no_image.png') ?>">
											<?php } ?>
											<input type="hidden" name="old_favicon" value="<?= @$favicon?>">
                        </div>

                      </div>
                     	<input type="hidden" name="id" value="<?= @$id?>">
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- tab panel -->

                  <div class="tab-pane" id="settings">
                  	 <form class="form-horizontal" action="<?= admin_url('setting/contact_setting')?>" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" id="email" value="<?= @$email?>" required >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Phone<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="phone" id="phone" value="<?= @$phone?>" maxlength="10" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Address<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                         <input type="text" name="address" class="form-control" value="<?= @$address ?>" required>
                        </div>
                      </div>
                      	<div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Facebook</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="facebook" id="facebook"  value="<?= @$facebook?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                       <label for="inputName" class="col-sm-2 col-form-label">Twitter</label>
                       <div class="col-sm-10">
                         <input type="text" class="form-control" name="twitter" id="twitter"  value="<?= @$twitter?>" required>
                       </div>
                     </div>
                     <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Linkedin</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="linkedin" id="linkedin" value="<?= @$linkedin?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                     <label for="inputName" class="col-sm-2 col-form-label">Instagram</label>
                     <div class="col-sm-10">
                       <input type="text" class="form-control" name="instagram" id="instagram"  value="<?= @$instagram?>" required>
                     </div>
                   </div>
                   <div class="form-group row">
                     <label for="inputName" class="col-sm-2 col-form-label">You Tube</label>
                     <div class="col-sm-10">
                       <input type="text" class="form-control" name="youtube" id="youtube"  value="<?= @$youtube?>" required>
                     </div>
                   </div>
                      <input type="hidden" name="setting_id" value="<?= @$id?>">

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
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
