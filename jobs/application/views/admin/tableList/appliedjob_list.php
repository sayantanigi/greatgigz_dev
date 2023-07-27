<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $heading?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $heading?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">

          <!-- /.card-header -->
          <div class="card-body">
             
             <div class="table-responsive"><br/>
              <table id="table" class="table table-hover table-center mb-0 example_datatable" >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Category</th>
                    <th>Job Title</th>
                    <th>Job Type</th>
                    <th>Resume</th>
                    <th>Job Status</th>
                  <!--   <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>

                                  </tbody>
                                </table>
                              </div>

          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->



      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  


    <script>
    var url = '<?= admin_url('tableList/Applied_jobs/ajax_manage_page')?>';
    var actioncolumn=6;
</script>

<script type="text/javascript">
  function Delete(obj,cid)
{
  var admin_url=$('#admin_url').val();
  var ask = confirm("Do you want to delete this record?");
  if(ask==true)
  {
    $(".id"+cid).fadeOut();
    var datastring="cid="+cid;
    $.ajax({
        type:"POST",
        url:admin_url+"tableList/jobs/delete",
        data:datastring,
        cache:false,
        success:function(returndata)
        {
          table.draw();
        }
      });
  }
}
</script>
