<footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y')?> <a href="javascript:void(0)">phillyhire.com</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <!-- <b>Version</b> 3.2.0-rc -->
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('dist/assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('dist/assets/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('dist/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('dist/assets/plugins/chart.js/Chart.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('dist/assets/plugins/sparklines/sparkline.js')?>"></script>
<!-- JQVMap -->
<script src="<?= base_url('dist/assets/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('dist/assets/plugins/jquery-knob/jquery.knob.min.js')?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('dist/assets/plugins/moment/moment.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('dist/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<!-- Summernote -->
<script src="<?= base_url('dist/assets/plugins/summernote/summernote-bs4.min.js')?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('dist/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('dist/assets/dist/js/adminlte.js')?>"></script>
<!-- AdminLTE for demo purposes -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('dist/assets/dist/js/pages/dashboard.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/select2/js/select2.full.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')?>"></script>

<!-- server side table script -->
<script src="<?= base_url('dist/assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/jszip/jszip.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/pdfmake/pdfmake.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/pdfmake/vfs_fonts.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
<script src="<?= base_url('dist/assets/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>
<!-- end server side table script -->

 <script src="<?= base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>
 <link href="<?= base_url('assets/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css">

<script src="<?= base_url('assets/custom_js/validation.js')?>"></script>


<input type="hidden" name="admin_url" id="admin_url" value="<?= admin_url();?>">




<script src="<?= base_url();?>dist/assets/notify/notify.min.js"></script>
<script type="text/javascript">
  // alert();
        $(document).ready(function(){
      var sessionMessage = '<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>';
      //alert(notifi);
      if(sessionMessage==null || sessionMessage=="" ){ return false;}
      $.notify(sessionMessage,{ position:"top right",className: 'info' });//session msg
        });


    </script>
    <?php if (!empty($this->session->flashdata('msg'))): ?>
    <?php if ($this->session->flashdata('msg') == 'error') { 
       $this->session->unset_userdata ('msg');
      ?>
      <script>
        alert_func(["Some error occured, Please try again!", "error", "#DD6B55"]);  
      </script>
    <?php } else { ?>
      <script>
        alert_func(<?= $this->session->flashdata('msg') ?>);
      </script>
        <?php  $this->session->unset_userdata('msg');  ?>
    <?php } ?>
  <?php endif ?>

<script type="text/javascript">
     function alert_func(data) {

    swal({title: data[0], type: data[1], confirmButtonColor: data[2]});

    }
 </script>

<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {

  $(".msghide").fadeOut(8000);

    table = $('.example_datatable').DataTable({
         "oLanguage": {
         "sProcessing": "<img src='<?= base_url()?>dist/assets/dist/img/loader.gif' width='100px' height='100px'>"
    },

        //"scrollX":true,
         //"scrollX":false,
        "stateSave": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "lengthMenu" : [[10,25, 100,200,500,1000,2000], [10,25, 100,200,500,1000,2000 ]],"pageLength" : 10,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": url,
            "type": "POST",
       "data": function(d) {
                    d.Foo = 'gmm';
                     d.select_all = $(".select_all").is(":checked");
                    d.SearchData = $(".filter_search_data").val();
                    d.SearchData1 = $(".filter_search_data1").val();
                    d.SearchData2 = $(".filter_search_data2").val();
                    d.SearchData3 = $(".filter_search_data3").val();
                    d.SearchData4 = $(".filter_search_data4").val();
                    d.SearchData5 = $(".filter_search_data5").val();
                    d.SearchData6 = $(".filter_search_data6").val();
                    d.SearchData7 = $(".filter_search_data7").val();
                    d.SearchData8 = $(".filter_search_data8").val();
                    d.SearchData9 = $(".filter_search_data9").val();
                    d.SearchData10 = $(".filter_search_data10").val();
                    d.FormData = $(".filter_data_form").serializeArray();
                }

        },

        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ actioncolumn ], //first column / numbering column
            "orderable": false, //set not orderable

        },
        ],
         <?php if(!empty($show)){ ?>
                    "fnDrawCallback": function() {
                    var api = this.api()
                    var json = api.ajax.json();
                    $(".append_ids").val(json.ids);
                    // uni_array();
                 },
          <?php } ?>
    });

    $(".filter_search_data4").change(function(){
                     table
                    .draw();

    });
    $(".filter_search_data5").change(function(){
                     table
                    .draw();

    });
    $(".filter_search_data6").change(function(){
                     table
                    .draw();

    });
    $(".filter_search_data7").change(function(){
                     table
                    .draw();

    });
    $(".filter_search_data8").change(function(){
                     table
                    .draw();

    });
    $(".filter_search_data9").change(function(){
                     table
                    .draw();

    });
    $(".filter_search_data10").change(function(){
                     table
                    .draw();

    });

 });

 $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

</script>

<script>
  $(function () {
    $('.summernote').summernote();
      bsCustomFileInput.init();
  })
</script>

</body>
</html>
