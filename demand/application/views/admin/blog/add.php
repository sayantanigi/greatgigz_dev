<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add News & Blog</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('blog/add/'.$blog->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" name="frm[title]" value="<?=$blog->title?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                   <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Upoaded by</label>
                      <input type="text" name="frm[uploaded_by]" value="<?=$blog->uploaded_by?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                  
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Full Description</label>
                      <textarea name="frm[description]" value="<?=$blog->description?>" id="editor1"><?=$blog->description?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Type</label>
                      <select name="frm[popular]" class="form-control">
                        <option value="0" <?php if($blog->popular==0){echo 'selected';} ?>>Blog</option>
                        <option value="1" <?php if($blog->popular==1){echo 'selected';} ?>>News</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option value="0" <?php if($blog->status==0){echo 'selected';} ?>>Inactive</option>
                        <option value="1" <?php if($blog->status==1){echo 'selected';} ?>>Active</option>
                      </select>
                      
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <img src="<?=site_url('assets/images/blog/'.$blog->image)?>" onerror="this.src='http://localhost/learning/assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Image</label>
                      <input type="file" name="image" value="<?=$blog->image?>" class="form-control" id="exampleInputEmail1">
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