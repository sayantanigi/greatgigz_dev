<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">State  List</h3>
              <a href="<?=admin_url('city/add')?>" class="pull-right btn btn-primary">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($pages) && count($pages)>0){
                    $i=1;
                    foreach ($pages as $pr) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?php 
                         
                                echo $pr->name;
                        ?></td>
                        <td>
                          <?php
                          if($pr->status == 1){
                            ?>
                            <a href="<?=admin_url('city/deactivate/'.$pr->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('city/activate/'.$pr->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>
                        </td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('city/add/'.$pr->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <a href="<?=admin_url('city/delete/'.$pr->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
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