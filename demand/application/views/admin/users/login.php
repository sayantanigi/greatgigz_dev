<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>Login</title>
<link href="<?php echo base_url('assets/admin/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/admin/admin_style.css'); ?>" rel="stylesheet">
</head>
<style>
   
.box-header {
    background: #f54e19;
}
.box-title{
    color:#fff;
}
button.btn.btn-primary.btn-sm {
    background: #f54e19;
    border: 1px solid #f54e19;
}
.img-responsive{
    margin-bottom: 20px;
}

</style>
<body style="background: #000000c7;">
<div class="container" style="margin-top:80px;">
  <div class="col-sm-6 col-sm-offset-3">
    <center><img src="<?=theme_option('logo')?>" class="img-responsive"></center>
    <div class="box">
      <div class="box-header">
        <h4 class="box-title"><b>Secure Login</b></h4>
      </div>
      <div class="box-p">
        <?php $this->load->view('alert'); ?>
        <?php echo form_open(admin_url('users/login'), array('class' => 'form-horizontal')); ?>
        <div class="form-group">
          <label class="col-lg-3 control-label" for="username">Username:</label>
          <div class="col-lg-6">
            <input type="text" name="username" value="<?php echo set_value('username'); ?>"placeholder="Username" class="form-control input-sm"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label" for="password">Password:</label>
          <div class="col-lg-6">
            <input type="password" name="password" placeholder="Password" class="form-control input-sm" value="<?php echo set_value('password'); ?>"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-6 col-lg-offset-3">
            <input type="hidden" value="Login" name="submit"/>
            <button class="btn btn-primary btn-sm"><i class="fa fa-lock"></i> Login</button>
          </div>
        </div>
        <input type="hidden" value="" name="redirect"/>
        <input type="hidden" value="submitted" name="submitted"/>
        <?php echo form_close(); ?> </div>
      <div class="box-bt box-p"> <a >GreatGigz</a> <a href="<?= site_url(); ?>" class="pull-right">Back to Website</a> </div>
    </div>
  </div>
</div>
</div>
<div class="footer text-center" style="position: fixed; bottom: 0; width: 100%;"> Copyright &copy; <?php echo date('Y'); ?>. </div>
</body>
</html>