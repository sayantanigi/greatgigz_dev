<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">FAQS</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('faqs/add/'.$faq->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <!-- <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Images</label>
                      <input type="file" name="image" value="<?=$faq->image?>"class="form-control">
                    </div>
                  </div>
                </div> -->
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="frm[title]" value="<?=$faq->title?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="frm[description]" class="form-control" id="editor1" ><?=$faq->description?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option value="1" <?php if($faq->status==1){echo 'selected';} ?>>Active</option>
                        <option value="0"  <?php if($faq->status==0){echo 'selected';} ?>>Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>