
<?php
if(!empty($_SESSION['phillyhire_admin']['id']))
{
  $get_admin=$this->Crud_model->get_single('admin',"userId='".$_SESSION['phillyhire_admin']['id']."'");
}
else{
  redirect(admin_url());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | <?php if(!empty($title)){ echo $title;} else{ echo "dashboard";}?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
   <link rel="icon" href="<?= base_url('assets/images/home/favicon.ico')?>" />
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
 <!--  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/jqvmap/jqvmap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/dist/css/adminlte.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/summernote/summernote-bs4.min.css')?>">
   <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/select2/css/select2.min.css')?>">
 <link rel="stylesheet" href="<?= base_url('dist/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('dist/assets/dist/img/loader.gif')?>" alt="Phillyhire" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0)" class="nav-link">Home</a>
      </li> -->

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->


      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>

      </li>
      <li class="nav-item dropdown user-menu">
       <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown">
         <?php if(!empty($get_admin->image)){
           if(!file_exists('uploads/logo/'.$get_admin->image)){
           ?>
           <img class="user-image img-circle elevation-2"
                src="<?= base_url('uploads/admin.png')?>"
                alt="Admin profile picture">
              <?php } else{?>
         <img class="user-image img-circle elevation-2"
              src="<?= base_url('uploads/logo/'.$get_admin->image)?>"
              alt="User profile picture">

            <?php } } else{?>
              <img class="user-image img-circle elevation-2"
                   src="<?= base_url('uploads/admin.png')?>"
                   alt="Admin profile picture">
            <?php } ?>
         <!-- <img src="<?= base_url('dist/assets/dist/img/user2-160x160.jpg')?>" class="user-image img-circle elevation-2" alt="User Image"> -->
         <!-- <span class="d-none d-md-inline">Admin</span> -->
       </a>
       <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         <!-- User image -->
         <li class="user-header bg-primary">
           <?php if(!empty($get_admin->image)){
             if(!file_exists('uploads/logo/'.$get_admin->image)){
             ?>
             <img class="img-circle elevation-2"
                  src="<?= base_url('uploads/admin.png')?>"
                  alt="Admin profile picture">
                <?php } else{?>
           <img class="img-circle elevation-2"
                src="<?= base_url('uploads/logo/'.$get_admin->image)?>"
                alt="User profile picture">

              <?php } } else{?>
                <img class="img-circle elevation-2"
                     src="<?= base_url('uploads/admin.png')?>"
                     alt="Admin profile picture">
              <?php } ?>

           <p> <?= $get_admin->name?> </p>
         </li>
         <!-- Menu Body -->

         <li class="user-footer">
           <a href="<?= admin_url('profile')?>" class="btn btn-default btn-flat">Profile</a>
           <a href="<?= admin_url('login/logOut')?>" class="btn btn-default btn-flat float-right">Sign out</a>
         </li>
       </ul>
     </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="javascript:void(0)" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->
