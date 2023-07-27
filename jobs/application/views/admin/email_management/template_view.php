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
               <a  href="<?php echo admin_url('template'); ?>" class="btn btn-primary float-right">Back</a>
             </div>
              <div class="col-sm-6">
              <div class="form-group">
                <label>Subject :</label>
                <p><?= ucfirst(@$subject); ?></p>
              </div>
              </div>
               <div class="col-sm-6">
              <div class="form-group">
                <?php if(!empty($attachment)){?>
                <label>Attachment :</label>
                <p><i class="fas fa-paperclip"></i> <a href="<?= base_url('uploads/email/'.@$attachment)?>"><?= @$attachment?></a></p>
              <?php }?>
              </div>
              </div>

               <div class="col-sm-12">
              <div class="form-group">
                <label>Body :</label>
                <p><?= $body; ?></p>
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
