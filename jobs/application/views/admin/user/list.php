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

          <!-- /.card-header -->
          <div class="card-body">
            <!--  <a href="<?= admin_url('users/create')?>" class="btn btn-primary add-button ml-3"  style="float:right;">
            Add user
          </a> -->
             <div class="table-responsive"><br/>
              <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User Type</th>
                    <th>Full Name</th>
                    <th>Job Title</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                                  </tbody>
                                </table>
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


    <script>
    var url = '<?= admin_url('Users/ajax_manage_page')?>';
    var actioncolumn=6;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/user.js')?>"></script>
