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
          <!--   <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal" style="float:right;">-->
          <!--  Add Our Service-->
          <!--</a>-->
             <div class="table-responsive"><br/>
              <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
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

   <!--  Add mmodal -->
    <div id="createModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Our Service</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <!-- <div class="card"> -->
         <!--  <div class="card-body"> -->

            <form action="#" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                   <div class="form-group">
                <label>Title <span style="color:red;">*</span> <span id="title_err"></span></label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Enter Title">
              </div>
                </div>
                
                <div class="col-md-12">
                   <div class="form-group">
                <label>Description <span style="color:red;">*</span> <span id="description_err"></span></label>
                <textarea class="form-control summernote" name="description" id="description"></textarea>
              </div>
                </div>


              </div>   <!-- end row -->

              <div class="mt-4">
                <button class="btn btn-primary" type="button" onclick="return create_service();">Submit</button>
                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
              </div>
            </form>

         <!--  </div> -->
       <!--  </div> -->
        </div>

      </div>
    </div>
  </div>
  <!--  end add modal -->

    <!--  edit mmodal -->
    <div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Our service</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         

            <form action="#" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                   <div class="form-group">
                <label>Title <span style="color:red;">*</span> <span id="edit_title_err"></span></label>
                <input class="form-control" type="text" name="title" id="edit_title" >
              </div>
                </div>
                
                <div class="col-md-12">
                 <div class="form-group">
                <label>Description <span style="color:red;">*</span> <span id="edit_description_err"></span></label>
                <textarea class="form-control summernote" name="description" id="edit_description"></textarea>
              </div>
              </div>


              </div>
             

              <input type="hidden" name="id" id="id">
             
              <div class="mt-4">
                <button class="btn btn-primary" type="button" onclick="return update_service();">Submit</button>
                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
              </div>
            </form>

        </div>

      </div>
    </div>
  </div>
  <!--  end edit modal -->


    <script>
    var url = '<?= admin_url('manage_home/our_services/ajax_manage_page')?>';
    var actioncolumn=3;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/our_service.js')?>"></script>
 