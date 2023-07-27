


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
        <div class="row">
          <!-- <div class="col-md-3">


          </div> -->
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Template New Message</h3>
              </div>
              <!-- /.card-header -->
              <?php if($button=='Update'){?>
               <form action="<?= admin_url('email_template/update_action')?>" method="post" enctype="multipart/form-data">
              <?php }else {?>
              <form action="<?= admin_url('email_template/create_action')?>" method="post" enctype="multipart/form-data">
                <?php }?>
              <div class="card-body">

                <div class="form-group">
                  <label>Subject <span class="text-danger">*</span></label>
                  <input class="form-control" placeholder="Subject:" name="subject" value="<?= @$subject?>" required autocomplete="off">
                </div>
                <div class="form-group">
                   <label>Body <span class="text-danger">*</span></label>
                    <textarea id="compose-textarea" class="form-control summernote" name="body" required><?= @$body?></textarea>
                </div>
                <div class="form-group">
                  <label>Attachment </label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="attachment">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text">Attachment</span>
                        </div>
                      </div>
                 <!--  <p class="help-block">Max. 32MB</p> -->
                 <?php if(!empty($attachment)){?>
                 <p><i class="fas fa-paperclip"></i><a href="<?= base_url('uploads/email/'.@$attachment)?>"><?= @$attachment?></a></p>
                 <?php }?>
                  <input type="hidden" name="old_attachment" value="<?= @$attachment?>">
                </div>
                <input type="hidden" name="id" value="<?= @$id?>">
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">

                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <a href="<?= admin_url('template')?>" class="btn btn-link">Cancel</a>
              </div>
              <!-- /.card-footer -->
              </form>
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
