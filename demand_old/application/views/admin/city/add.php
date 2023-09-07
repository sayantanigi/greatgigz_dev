<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add State</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('city/add/'.$pages->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">State Name</label>
                      <input type="text" name="frm[name]" value="<?=$pages->name?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                       <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
               
              </div>
            </div>
          </div>
          
        </form>

        <!-- form start -->
        <form action="<?=admin_url('city/upload_file')?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                   <?php if($status =='Error'){
                      echo '<div class="alert alert-danger">'.$status.'</div>';
                  }  elseif($status =='Success'){
              echo '<div class="alert alert-success">'.$status.'</div>';
                   }elseif($status =='Invalid file'){
                     echo '<div class="alert alert-danger">'.$status.'</div>';
                   }
                  ?>

                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Import CSV File For Neighbourhood</label>
                      <input type="file" name="file" />
                    </div>
                  </div>
                   <div class="box-footer">
                  <button type="submit" name="importSubmit" class="btn btn-primary">Import</button>
                </div>
                </div>
         
              </div>
            </div>
          </div>
         
        </form>
      <!-- /.box -->
    </div>
  </div>
</section>