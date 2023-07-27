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
              <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal" style="float:right;">
            Add cms
          </a> 
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
          <h4 class="modal-title">Add CMS</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <div class="card-body">

            <form action="#" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Title <span style="color:red;">*</span> <span id="title_err"></span></label>
                <input class="form-control" type="text" name="title" id="title">
              </div>
               <div class="form-group">
                <label>Description <span style="color:red;">*</span> <span id="description_err"></span></label>
                <textarea class="form-control" name="description" id="description"></textarea>
              </div>
              <div class="form-group">
                <label>Image</label>
                <input class="form-control" type="file" name="image" id="image">
              </div>
              <div class="mt-4">
                <button class="btn btn-primary" type="button" onclick="return create_cms();">Submit</button>
                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
              </div>
            </form>

          </div>

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
          <h4 class="modal-title">Edit cms</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <div class="card-body">

            <form action="#" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Title <span style="color:red;">*</span> <span id="edit_title_err"></span></label>
                <input class="form-control" type="text" name="title" id="edit_title">
              </div>
              <div class="form-group">
                <label>Description <span style="color:red;">*</span> <span id="edit_description_err"></span></label>
                <textarea class="form-control" name="description1" id="edit_description"></textarea>
              </div>
               <div class="form-group">
                <label>Image</label>
                <input class="form-control" type="file" name="image" id="edit_image">
                <br>
                <div id="show_img"></div>
              </div>
              <input type="hidden" name="id" id="id">
              <input type="hidden" name="old_image" id="old_image">
              <div class="mt-4">
                <button class="btn btn-primary" type="button" onclick="return update_cms();">Save Changes</button>
                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
              </div>
            </form>

          </div>

        </div>

      </div>
    </div>
  </div>
  <!--  end edit modal -->

  <!--  view mmodal -->
    <div id="viewModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View cms</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="card">
          <div class="card-body">
            <div id="show_description"></div>
          </div>
        </div>
        </div>

      </div>
    </div>
  </div>
  <!--  end view modal -->


    <script>
    var url = '<?= admin_url('cms/ajax_manage_page')?>';
    var actioncolumn=3;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/cms.js')?>"></script>
 <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
 <script>
       CKEDITOR.replace('description');
       CKEDITOR.replace('description1');
    </script>
