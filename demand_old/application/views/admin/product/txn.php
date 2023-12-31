<style type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css"></style>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Transaction Lists</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered" id="example1">
            <tr>
              <th style="width: 10px">#</th>
              <th>Subject</th>
              <th>Username</th>
              <th>Price</th>
              <th>Transaction Id</th>
              <th>Date</th>
              <th>Payment Status</th>

            </tr>
            <?php
            if(is_array($orders) && count($orders)>0){
              $i=1;
              foreach ($orders as $ord) {
                $user = $this->db->get_where('users',array('id'=>$ord->userid))->row();
                $txn = $this->db->get_where('payments',array('order_id'=>$ord->id))->row();
                ?>
                <tr>
                  <td><?=$i?></td>
                  <td><?=$ord->title?></td>
                  <td><?=$user->firstname?></td>
                  <td>$ <?=$ord->amount?></td>
                  <td><?=$txn->txn_id?></td>
                  <td><?= date('d-m-Y',strtotime($ord->c_date));?></td>
                  <td><?php 
                  if($ord->payment_status == 1){
                    echo '<div class="btn btn-success"> Completed</div>';
                  }else{
                    echo '<div class="btn btn-danger"> Completed</div>';
                  }

                  ?></td>

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

    </div>
    <!-- /.box -->
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#example1').DataTable();
  } );
</script>