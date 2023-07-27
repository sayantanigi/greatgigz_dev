<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Enquiry User Lists</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Subject</th>
                  <th>Address</th>
                  <th style="width: 25%">Message</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($enquiry) && count($enquiry)>0){
                    $i=1;
                    foreach ($enquiry as $enquiry_v) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$enquiry_v->name?></td>
                        <td><?=$enquiry_v->email?></td>
                        <td><?=$enquiry_v->phone?></td>
                        <td><?=$enquiry_v->subject?></td>
                        <td><?=$enquiry_v->address?></td>
                        <td><?=$enquiry_v->message?></td>
                        <td>
                          <!-- <a href="javascript:void(0);" class="text-info" title="Reply"><span class="fa fa-eye"></span></a> -->
                          <a href="<?=admin_url('contacts/enq_delete/'.$enquiry_v->id)?>" class="text-danger delete"><span class="fa fa-trash"></span></a>
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