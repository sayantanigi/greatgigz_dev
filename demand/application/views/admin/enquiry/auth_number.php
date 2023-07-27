<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Authenticated User Lists</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Number</th>
                  <th>Status</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($enquiry) && count($enquiry)>0){
                    $i=1;
                    foreach ($enquiry as $enquiry_v) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$enquiry_v->contact_name?></td>
                        <td><?=$enquiry_v->mobile_number?></td>
                        <td> <?php
                          if($enquiry_v->verified == 1){
                            ?>
                           <span class="badge bg-green">Verified</span>
                            <?php
                          }
                          else{
                            ?>
                            <span class="badge bg-red">Not Verified</span>
                            <?php
                          }
                          ?>        </td>
                        <td>
                          <!-- <a href="javascript:void(0);" class="text-info" title="Reply"><span class="fa fa-eye"></span></a> -->
                          <a href="<?=admin_url('contacts/number_delete/'.$enquiry_v->id)?>" class="text-danger delete"><span class="fa fa-trash"></span></a>
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