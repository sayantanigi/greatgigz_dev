<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Phillyhire | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="icon" href="<?= base_url('assets/images/home/favicon.ico')?>" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/dist/css/adminlte.min.css')?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>phillyhire.com</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in </p>
      <span class="msghide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></span>
      <form  method="post" action="<?=admin_url(); ?>Login/actionLogin" onsubmit="return validation()">

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="email_id" id="email_id">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>

        </div>
         <span class="error" id="error_email"><?php echo form_error('email_id'); ?></span>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>

        </div>
         <span class="error" id="error_password"><?php echo form_error('password'); ?></span>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

     <!--  <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('dist/assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('dist/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('dist/assets/dist/js/adminlte.min.js')?>"></script>

 <script type="text/javascript">
    function validation(){


        var email = $("#email_id").val().trim();
        var password = $("#password").val().trim();
        if(email =='')
        {
          $("#error_email").fadeIn().html("Please enter email or usernamme").css("color","red");
          setTimeout(function(){$("#error_email").fadeOut("&nbsp;");},2000)
          $("#email_id").focus();
          return false;
        }


        if(password =='')
        {
          $("#error_password").fadeIn().html("Please enter password").css("color","red");
          setTimeout(function(){$("#error_password").fadeOut("&nbsp;");},2000)
          $("#password").focus();
          return false;
        }

}
  </script>
</body>
</html>
