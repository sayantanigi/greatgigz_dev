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
         
             <form  action="#" method="post" enctype="multipart/form-data" id="userform">
           
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
               <div class="form-group">
          <label>First Name <span style="color:red;">*</span></label>
      <input type="text" class="form-control"  name="firstname" value="<?= @$firstname?>" required onkeypress="only_alphabets(event)">
        </div>

              </div>
               <div class="col-md-6">

               <div class="form-group">
                        <label>Last Name <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="lastname" value="<?= @$lastname?>" required onkeypress="only_alphabets(event)">
                      </div>
              </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Job Title<span style="color:red;">*</span></label>
                        <input type="text" class="form-control"  name="job_title" value="<?= @$job_title?>">
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label>Email <span style="color:red">*</span><span id="err_email"></span></label>
                        <input type="email" class="form-control"  name="email" id="email_address" value="<?= @$email?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone<span style="color:red;">*</span><span id="err_phone"></span></label>
                        <input type="text" class="form-control"  name="mobile" id="phone_number" value="<?= @$mobile?>" onkeypress="only_number(event)">
                      </div>
                    </div>
                     <div class="col-md-6">
                     <div class="form-group">
                      <label>&nbsp;</label>
                 <div class="form-group clearfix">
                        <label for="radioPrimary3">
                         User Type : 
                        </label>
                   
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary1" name="userType" value="1" <?php if(@$userType==1){ echo "checked";} ?> >
                        <label for="radioPrimary1">
                          Job Seekar
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" name="userType" value="2" <?php if(@$userType==2){ echo "checked";} ?>>
                        <label for="radioPrimary2">
                          Employer
                        </label>
                      </div>
                     
                    </div>
              </div>
            </div>
                      <input type="hidden" name="id" value="<?= @$id?>">
                      <input type="hidden" name="button" value="<?= $button?>">

              <div class="col-md-12">
                    <button type="submit" class="btn btn-info" style="float: right">Submit</button>
          <a href="<?php echo admin_url('users') ?>" class="btn btn-link">Cancel</a>
          </div>
              <!-- /.col -->

            </div>
            <!-- /.row -->



          </div>
          <!-- /.card-body -->
        </form>
        </div>
        <!-- /.card -->



      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
<script type="text/javascript">
$(document).ready(function() {
$("#userform").submit(function(e) {
e.preventDefault();


var formData = new FormData(this);
$.ajax({
        type: "POST",
        url: "<?php echo admin_url('Users/update_action'); ?>",
        data: formData,
         cache: false,
          contentType: false,
         processData: false,
         dataType:'json',
        success:function(returndata)
            {
                if(returndata.result==1)
                    {
                     window.location.href='<?= admin_url('users')?>';
                    }
                   if(returndata.result=='0')
         {
            if(returndata.data=='email'){ 
                    $('#err_email').fadeIn().html('This email already exists').css('color','red');
                     setTimeout(function(){$("#err_email").html("&nbsp;");},3000);
                     $("#email_address").focus();
                     return false;
                    }
            if(returndata.data=='phone')
               {
                 $("#err_phone").fadeIn().html("This phone already exists").css('color','red');
                 setTimeout(function(){$("#err_phone").html("&nbsp;");},3000);
                 $("#phone_number").focus();
                 return false;
                }
                 
                 }
            }
        });
});
});

</script>