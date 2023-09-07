<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Search Message</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('searchmsg/add/'.$pages->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Search Time For All</label>
                      <input type="text" name="s_time" value="<?=$pages->s_time?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Search Time" required>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Search Message Name</label>
                      <input type="text" name="frm[name]" value="<?=$pages->name?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                  <!-- <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Reason of search</label>
                      <input type="text" name="frm[reason]" value="<?=$pages->reason?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Reason">
                    </div>
                  </div> -->
                </div>

                <!-- <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <img src="<?=site_url('assets/images/partners/'.$pages->image)?>" onerror="this.src='/assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Image</label>
                      <input type="file" name="image" value="<?=$pages->image?>" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div>
                </div> -->
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