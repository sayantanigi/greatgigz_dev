<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add pages</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('cms/add/'.$pages->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
               
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="frm[title]" value="<?=$pages->title?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                   <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Title</label>
                      <input type="text" name="frm[meta_title]" value="<?=$pages->meta_title?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Meta Title">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Description</label>
                      <textarea name="frm[meta_description]"  id="editor1"><?=$pages->meta_description?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="frm[description]" id="editor2"><?=$pages->description?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <img src="<?=site_url('assets/images/cms/'.$pages->image)?>" onerror="this.src='<?=site_url()?>/assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Image</label>
                      <input type="file" name="image" value="<?=$pages->image?>" class="form-control" id="exampleInputEmail1">
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