
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
       <?php $this->load->view('admin/email_management/sidebar_list')?>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
             
              <div class="card-body">
                <div class="row">
                   <div class="col-sm-6">
                <div class="form-group">
                  <label>Subject </label>
                  <p><?= ucfirst(@$subject); ?></p>
                </div>
              </div>
              <div class="col-sm-6">
              <div class="form-group">
                <?php if(!empty($attachment)){?>
                <label>Attachment :</label>
                <p><i class="fas fa-paperclip"></i> <a href="<?= base_url('uploads/composeemail_attachment/'.@$attachment)?>"><?= @$attachment?></a></p>
              <?php }?>
              </div>
              </div>

               <div class="col-sm-12">
              <div class="form-group">
                <label>Description :</label>
                <p><?= $body; ?></p>
              </div>
              </div>
               
                <?php if(!empty($get_employer)){ ?>
                <div class="col-md-12">
                  <div class="form-group">
                  <label>Employers : </label>
                  <p>
                     <?php foreach($get_employer as $key){?>
                    <span class="badge badge-primary" style="font-size:15px;"><?=  $key->email.' ('.ucwords($key->firstname.' '.$key->lastname).') '; ", ";?></span>
                    <?php } ?>
                  </p>
                </div>
              </div>
            <?php } ?>
             <?php if(!empty($get_jobseeker)){?>
                <div class="col-md-12">
                  <div class="form-group">
                  <label>JobSeekers : </label>
                  <p>
                    <?php foreach($get_jobseeker as $key){?>
                    <span class="badge badge-success" style="font-size:15px;"><?=  $key->email.' ('.ucwords($key->firstname.' '.$key->lastname).') '; ", ";?></span>
                  <?php  }?>
                  </p>
                </div>
              </div>
            <?php } if(!empty($subscriber_email)){?>
                <div class="col-md-12">
                   <div class="form-group">
                  <label>Subscribrs : </label>
                  <p><span class="badge badge-warning" style="font-size:15px;"><?= @$subscriber_email?></span></p>
                </div>
              </div>
              <?php } ?>

               </div>  <!-- end row -->
              </div>
              <!-- /.card-body -->
              
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

   <script>
    var url = '';
    var actioncolumn='';

</script>

