<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Partners Logo</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('partner/add/'.$product->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Partner Name</label>
                      <input type="text" name="frm[title]" value="<?=$product->title?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="frm[description]" id="editor1"><?=$product->description?></textarea>
                    </div>
                  </div>
                </div>
        
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <img src="<?=site_url('assets/images/partners/'.$product->image)?>" onerror="this.src='http://localhost/learning/assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Image</label>
                      <input type="file" name="image" value="<?=$product->image?>" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>