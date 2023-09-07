<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Provider Setting</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('members/add/'.$member->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Rating</label>
                      <select name="frm[rating]" class="form-control">
                        <option value="0" <?=($member->rating == 0)?'selected':'';?>>0</option>
                        <option value="1" <?=($member->rating == 1)?'selected':'';?>>1</option>
                        <option value="2" <?=($member->rating == 2)?'selected':'';?>>2</option>
                        <option value="3" <?=($member->rating == 3)?'selected':'';?>>3</option>
                        <option value="4" <?=($member->rating == 4)?'selected':'';?>>4</option>
                        <option value="5" <?=($member->rating == 5)?'selected':'';?>>5</option>
                      </select>
                    </div>
                  </div>
                  
                </div>
         <!--        <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" name="frm[email]" value="<?=$member->email?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mobile</label>
                      <input type="text" name="frm[mobile]" value="<?=$member->mobile?>"class="form-control" id="exampleInputEmail1" placeholder="Enter Mobile">
                    </div>
                  </div>
                </div>
                
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option value="1" <?=($member->status == 1)?'selected':'';?>>Active</option>
                        <option value="0" <?=($member->status == 0)?'selected':'';?>>Inactive</option>
                      </select>
                    </div>
                  </div>
                </div> -->
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