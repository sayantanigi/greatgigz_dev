<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">View Order</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <?php 
              $ser = $this->db->get_where('service',array('id'=>$detail->service))->row();
              $sub = $this->db->get_where('sub_service',array('id'=>$detail->subservice))->row();
              $city = $this->db->get_where('city',array('id'=>$detail->city))->row();
              $neighbour = $this->db->get_where('city',array('id'=>$detail->neighbour))->row();
           ?>
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" value="<?=$detail->name?>" class="form-control" id="exampleInputEmail1">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" value="<?=$detail->email?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mobile</label>
                      <input type="text"  value="<?=$detail->mobile?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Address</label>
                      <textarea class="form-control"><?=$detail->address?></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service</label>
                      <input type="text"  value="<?=$ser->title?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub Service</label>
                      <input type="text"  value="<?=$sub->name?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">City</label>
                      <input type="text"  value="<?=$city->name?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Locality</label>
                      <input type="text"  value="<?=$neighbour->name?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Date</label>
                      <input type="text"  value="<?=date('d M, Y',strtotime($detail->ser_date));?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Time</label>
                      <input type="text"  value="<?=date('h:i A',strtotime($detail->ser_time));?>" class="form-control" id="exampleInputEmail1" >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <a href="<?=admin_url('orders')?>" class="btn btn-primary">Go Back</a>
          </div>
        
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>