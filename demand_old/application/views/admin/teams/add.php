<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Banner</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('teams/add/'.$product->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" name="frm[name]" value="<?=$product->name?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Heading">
                    </div>
                  </div>
                  
                </div>

                <!-- <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Position</label>
                      <textarea name="frm[position]" class="form-control" placeholder="Enter Position"><?=$product->position?></textarea>
                      
                    </div>
                  </div>
                </div>
                 <div class="col-sm-10"> 
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="frm[descr]" class="form-control" placeholder="Enter Description"><?=$product->descr?></textarea>
                      
                    </div>
                  </div>
                </div>  -->              
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <img src="<?=site_url('assets/images/teams/'.$product->img)?>" onerror="this.src='<?=site_url()?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Image</label>
                      <input type="file" name="img" value="<?=$product->img?>" class="form-control" id="exampleInputEmail1">

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