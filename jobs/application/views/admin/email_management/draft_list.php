
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
      <div class="row">
       <?php $this->load->view('admin/email_management/sidebar_list')?>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
           
            <div class="card-body p-0">
               <div class="table-responsive"><br/>
              <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Subject</th>
                    <th>Recipients</th>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
   <!--  Add mmodal -->
    <div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">List of Recipients</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="recipient_list">
        
         
       
        </div>
       
      </div>
    </div>
  </div>
  <!--  end add modal -->
 <script>
    var url = '<?= admin_url('mailer/ajax_manage_page')?>';
    var actioncolumn=4;
</script>
    
   
<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/send_mail.js')?>"></script>