<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">FAQ Lists</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 30%">Title</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th style="width: 80px">Action</th>
                </tr>
                <?php
                  if(is_array($faqs) && count($faqs)>0){
                    $i=1;
                    foreach ($faqs as $fa) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$fa->title?></td>
                        <td><?=$fa->description?></td>
                        <td>
                          <?php
                          if($fa->status == 1){
                            ?>
                            <a href="<?=admin_url('faqs/deactivate/'.$fa->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('faqs/activate/'.$fa->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?> 
                        </td>
                        <td>
                        
                          <a href="<?=admin_url('faqs/add/'.$fa->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <a href="<?=admin_url('faqs/delete/'.$fa->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
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