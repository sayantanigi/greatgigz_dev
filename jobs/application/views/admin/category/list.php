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
             <a data-target="#uploadData" title="Upload Excel" data-backdrop="static" data-keyboard="false"data-toggle="modal" class="btn btn-primary"> Import Excel</a>
              <a href="<?= base_url('uploads/bulk_excel/category.xlsx'); ?>" class="btn btn-danger"> Download sample format</a>
             <a href="#" class="btn btn-primary add-button ml-3" data-toggle="modal" data-target="#createModal" style="float:right;">
            Add category
          </a>
             <div class="table-responsive"><br/>
              <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Date</th>
                   
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
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
          <div class="card-body">

           <form action="#" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Category Name <span style="color:red;">*</span> <span id="category_err"></span></label>
                <input class="form-control" type="text" name="category_name" id="category_name">
              </div>
              <div class="form-group">
                <label>Category Image</label>
                <input class="form-control" type="file" name="category_image" id="category_image">
              </div>
              <div class="mt-4">
                <button class="btn btn-primary" type="button" onclick="return create_category();">Submit</button>
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
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
       
          <div class="card-body">

            <form action="#" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Category Name <span style="color:red;">*</span> <span id="edit_category_err"></span></label>
                <input class="form-control" type="text" name="category_name" id="edit_category_name">
              </div>
              <div class="form-group">
                <label>Category Image</label>
                <input class="form-control" type="file" name="category_image" id="edit_category_image">

              </div>
               <div id="show_img"> </div>

              <input type="hidden" name="old_image" id="old_image">
              <input type="hidden" name="id" id="id">
              <div class="mt-4">
                <button class="btn btn-primary" type="button" onclick="return update_category();">Save Changes</button>
                <a href="#" class="btn btn-link" data-dismiss="modal">Cancel</a>
              </div>
            </form>

          </div>
     
        </div>
      
      </div>
    </div>
  </div>
  <!--  end edit modal -->

  <!--IMport strart-->
<div class="modal inmodal" id="uploadData" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content animated bounceInRight">
            <form  action="<?= admin_url('category/import_excel')?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <span style="font-size:20px">Upload Sheet</span>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding-top: 3%">

                    <a download class="pull-right" href="<?php echo base_url('uploads/bulk_excel/category.xlsx'); ?>" style="font-size:10px">Download Sample Format</a>
                    <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xlsx,.xls" required>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="dis_btn" class="btn btn-info">Ok</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- end import modal -->


    <script>
    var url = '<?= admin_url('Category/ajax_manage_page')?>';
    var actioncolumn=3;
</script>

<script type="text/javascript" src="<?= base_url('dist/assets/custom_js/category.js')?>"></script> 