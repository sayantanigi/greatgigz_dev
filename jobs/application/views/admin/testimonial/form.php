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
        <div class="card card-default">
         
              <?php if($button=='Update'){?>
                 <form  action="<?= admin_url('testimonial/update_action'); ?>" method="post" enctype="multipart/form-data">
                <?php }else{ ?>
                   <form  action="<?= admin_url('testimonial/create_action'); ?>" method="post" enctype="multipart/form-data">
                <?php }?>
           
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
               <div class="form-group">
          <label>Name <span style="color:red;">*</span></label>
      <input type="text" class="form-control"  name="name" value="<?= @$name ?>" required onkeypress="only_alphabets(event)">
        </div>

              </div>
               <div class="col-md-6">

               <div class="form-group">
                        <label>Designation<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="designation" value="<?= @$designation?>" required onkeypress="only_alphabets(event)">
                      </div>
              </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description<span style="color:red;">*</span></label>
                        <textarea name="description" class="form-control summernote"><?= @$description ?></textarea>
                      </div>
                    </div>
                     
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control"  name="image" >
                        <br>
                        <?php
                        if($button=='Update'){ 
                        if(!empty($image) && file_exists('uploads/testimonial/'.$image)){?>
                          <img src="<?= base_url('uploads/testimonial/'.$image)?>" width="100" height="100">
                        <?php } else{?>
                           <img src="<?= base_url('uploads/no_profile.jpg')?>" width="100" height="100">
                        <?php } }?>
                        <input type="hidden" name="old_image" value="<?= @$image?>">
                      </div>
                    </div>
                    
                      <input type="hidden" name="id" value="<?= @$id?>">
              <div class="col-md-12">
                    <button type="submit" class="btn btn-info" style="float: right">Submit</button>
          <a href="<?php echo admin_url('testimonial') ?>" class="btn btn-link">Cancel</a>
          </div>
              <!-- /.col -->

            </div>
            <!-- /.row -->



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

 
