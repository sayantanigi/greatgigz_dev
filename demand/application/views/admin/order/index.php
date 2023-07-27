<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Order List</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th style="width: 10px">#</th>
              <th>Name</th>
              <th>Mobile</th>
              <th>Email</th>
              <th>Service</th>
              <th>Date</th>
              <th>Status</th>
              <th style="width: 40px">Action</th>
            </tr>
            <?php
            if(is_array($pages) && count($pages)>0){
              $i=1;
              foreach ($pages as $pr) {
                $ser = $this->db->get_where('service',array('id'=>$pr->service))->row();
                ?>
                <tr>
                  <td><?=$i?></td>
                  <td><?=$pr->name?></td>
                  <td><?=$pr->mobile?></td>
                  <td><?=$pr->email?></td>
                  <td><?=$ser->title?></td>

                  <td><?=date('d M, Y',strtotime($pr->ser_date))?></td>
                  <td>
                    <?php 
                    if($pr->status==0){ ?>
                      <a href="<?=admin_url('orders/changeStatus/'.$pr->id)?>" class="btn btn-danger btn-xs">Pending</a>
                    <?php }else{ ?>
                      <a href="javascript:void(0)" class="btn btn-success btn-xs">Completed</a>
                      <?php
                    }
                    ?>
                  </td>
                  <td>
                    <div class="action-button">
                      <a href="<?=admin_url('orders/view/'.$pr->id)?>" class="btn btn-xs btn-info"><span class="fa fa-eye" title="view"></span></a>

                    </div>
                  </td>
                </tr>
                <?php
                $i++;
              }
            }
            ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <?=$paginate?>
              <!-- <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul> -->
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>