<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add City</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('city/add_neigh/'.$pages->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">State Name</label>
                      <select name="frm[parent_city]" class="form-control" required>
                        <option value="">--Select State--</option>
                        <?php if(is_array($city) && count($city)>0){
                          foreach ($city as $c) {
                            ?>
                            <option value="<?=$c->id?>" <?php if($pages->parent_city ==$c->id){ echo "selected";} ?>><?=$c->name?></option>
                            <?php
                          }
                        } ?>
                        
                      </select>
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">City Name</label>
                      <input type="text" name="frm[name]" value="<?=$pages->name?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
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