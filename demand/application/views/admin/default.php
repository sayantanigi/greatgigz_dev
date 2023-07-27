<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Greatgigz | <?=$title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" href="http://localhost/greatgigz_dev/jobs/assets/images/home/favicon.ico">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/css/AdminLTE.min.css')?>">
  <link rel="stylesheet" href="<?=site_url('assets/admin/style.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?=site_url('assets/admin/css/skins/_all-skins.min.css')?>">
   <!-- Morris chart -->
   <link rel="stylesheet" href="<?=site_url('assets/admin/morris.js/morris.css')?>">
   <!-- jvectormap -->
   <link rel="stylesheet" href="<?=site_url('assets/admin/jvectormap/jquery-jvectormap.css')?>">
   <!-- Date Picker -->
   <link rel="stylesheet" href="<?=site_url('assets/admin/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?=site_url('assets/admin/bootstrap-daterangepicker/daterangepicker.css')?>">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="<?=site_url('assets/admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">

   <!-- Google Font -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- jQuery 3 -->
   <script src="<?=site_url('assets/admin/jquery/dist/jquery.min.js')?>"></script>
   <!-- jQuery UI 1.11.4 -->
   <script src="<?=site_url('assets/admin/jquery-ui/jquery-ui.min.js')?>"></script>
   <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?=site_url('assets/admin/bootstrap/dist/js/bootstrap.min.js')?>"></script>
  <!-- Morris.js charts -->
  <script src="<?=site_url('assets/admin/raphael/raphael.min.js')?>"></script>
  <script src="<?=site_url('assets/admin/morris.js/morris.min.js')?>"></script>
  <!-- Sparkline -->
  <script src="<?=site_url('assets/admin/jquery-sparkline1/dist/jquery.sparkline.min.js')?>"></script>
  <!-- jvectormap -->
  <script src="<?=site_url('assets/admin/jvectormap1/jquery-jvectormap-1.2.2.min.js')?>"></script>
  <script src="<?=site_url('assets/admin/jvectormap1/jquery-jvectormap-world-mill-en.js')?>"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?=site_url('assets/admin/jquery-knob/dist/jquery.knob.min.js')?>"></script>
  <!-- daterangepicker -->
  <script src="<?=site_url('assets/admin/moment/min/moment.min.js')?>"></script>
  <script src="<?=site_url('assets/admin/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
  <!-- datepicker -->
  <script src="<?=site_url('assets/admin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?=site_url('assets/admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
  <!-- Slimscroll -->
  <script src="<?=site_url('assets/admin/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
  <!-- FastClick -->
  <script src="<?=site_url('assets/admin/fastclick/lib/fastclick.js')?>"></script>
  <!-- AdminLTE App -->
  <script src="<?=site_url('assets/admin/js/adminlte.min.js')?>"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?=site_url('assets/admin/js/pages/dashboard.js')?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?=site_url('assets/admin/js/demo.js')?>"></script>
  <!------------- CKEDITOR----------->
  <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?=admin_url('dashboard')?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b><img src="<?=theme_option('logo')?>" alt="" style="width: 200px;"></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><img src="<?=theme_option('logo')?>" alt="" style="width: 200px;"></b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?=site_url('assets/admin/img/user2-160x160.jpg')?>" class="user-image" alt="User Image">
                <span class="hidden-xs">Admin</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header" style="height: 135px;!important">
                  <img src="<?=site_url('assets/admin/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">

                  <p>
                    Admin
                    <!-- <small>Member since Nov. 2012</small> -->
                  </p>
                </li>
                <li class="user-footer" >
                  <div class="pull-left">
                    <a href="<?=admin_url('profile')?>" class="btn btn-default btn-flat">Change Password</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?=admin_url('users/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="<?=admin_url('settings')?>" ><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?=site_url('assets/admin/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Admin</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li class="<?=($tab=='dashboard')?'active':'' ;?>">
            <a href="<?=site_url('dashboard')?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview <?=($tab=='srch_msg' || $tab=='members' || $tab=='add_srchmsg')?'active':'' ;?>">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Providers Management</span>
              <span class="pull-right-container">
                <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
              </span>
            </a>
            <ul class="treeview-menu">
              <!--li class="<?=($tab=='add_member')?'active':'' ;?>"><a href="<?=admin_url('members/add')?>"><i class="fa fa-circle"></i> Add Member</a></li-->
              <li class="<?=($tab=='members')?'active':'' ;?>"><a href="<?=admin_url('members')?>"><i class="fa fa-circle"></i> Provider Lists</a></li>
               <li class="<?=($tab=='srch_msg' || $tab=='add_srchmsg')?'active':'' ;?>"><a href="<?=admin_url('searchmsg')?>"><i class="fa fa-circle"></i>Set Search Message & Time</a></li>
            </ul>
          </li> 

            <li class="treeview <?=($tab=='add_city' || $tab=='city' || $tab=='add_ngh'|| $tab=='neigh')?'active':'' ;?>">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>State & City </span>
                <span class="pull-right-container">
                  <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?=($tab=='add_city')?'active':'' ;?>"><a href="<?=admin_url('city/add')?>"><i class="fa fa-circle"></i> Add State</a></li> 
                <li class="<?=($tab=='city')?'active':'' ;?>"><a href="<?=admin_url('city')?>"><i class="fa fa-circle"></i> State List</a></li>
                <li class="<?=($tab=='add_ngh')?'active':'' ;?>"><a href="<?=admin_url('city/add_neigh')?>"><i class="fa fa-circle"></i>Add City</a></li> 
                <li class="<?=($tab=='neigh')?'active':'' ;?>"><a href="<?=admin_url('city/view_neighbour')?>"><i class="fa fa-circle"></i> City List</a></li>
              </ul>
            </li> 
         <li class="treeview <?=($tab=='add_service' || $tab=='service'|| $tab=='add_sub_service'|| $tab=='sub_service')?'active':'' ;?>">
                  <a href="#">
                    <i class="fa fa-list"></i>
                    <span>Service Management</span> 
                    <span class="pull-right-container">
                      <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  
                   <li class="<?=($tab=='sub_service')?'active':'' ;?>"><a href="<?=admin_url('subservice')?>"><i class="fa fa-circle"></i> Sub-Service List</a></li>
                   <li class="<?=($tab=='service')?'active':'' ;?>"><a href="<?=admin_url('service')?>"><i class="fa fa-circle"></i> Service List</a></li>
                 </ul>
               </li>
                  <li class="treeview <?=($tab=='add_teams' || $tab=='teams')?'active':'' ;?>">
                   <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Banner Management</span>
                    <span class="pull-right-container">
                      <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                    </span>
                  </a>
                  <ul class="treeview-menu">
             <!-- <li class="<?=($tab=='add_teams')?'active':'' ;?>"><a href="<?=admin_url('teams/add')?>"><i class="fa fa-circle"></i> Add Team Member</a></li>
             -->
             <li class="<?=($tab=='teams')?'active':'' ;?>"><a href="<?=admin_url('teams')?>"><i class="fa fa-circle"></i>Banner List</a></li>
           </ul>
         </li>
         <!--<li class="treeview <?=($tab=='add_blog' || $tab=='blog')?'active':'' ;?>">-->
          <!--  <a href="#">-->
            <!--    <i class="fa fa-users"></i>-->
            <!--    <span>Blog & News Management</span> -->
            <!--    <span class="pull-right-container">-->
              <!--      <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>-->
              <!--    </span>-->
              <!--  </a>-->
              <!--  <ul class="treeview-menu">-->
                <!--    <li class="<?=($tab=='add_blog')?'active':'' ;?>"><a href="<?=admin_url('blog/add')?>"><i class="fa fa-circle"></i> Add Blog & News</a></li>-->
                <!--    <li class="<?=($tab=='blog')?'active':'' ;?>"><a href="<?=admin_url('blog')?>"><i class="fa fa-circle"></i> Blog & News Lists</a></li>-->
                <!--  </ul>-->
                <!--</li>-->
                <li class="treeview <?=($tab=='add_cms' || $tab=='cms')?'active':'' ;?>">
                  <a href="#">
                    <i class="fa fa-list"></i>
                    <span>CMS Management</span> 
                    <span class="pull-right-container">
                      <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                   <!-- <li class="<?=($tab=='add_cms')?'active':'' ;?>"><a href="<?=admin_url('cms/add')?>"><i class="fa fa-circle"></i> Add CMS</a></li> -->
                   <li class="<?=($tab=='cms')?'active':'' ;?>"><a href="<?=admin_url('cms')?>"><i class="fa fa-circle"></i> CMS Lists</a></li>
                 </ul>
               </li>

               
               <!--li class="treeview <?=($tab=='view_orders' || $tab=='orders'|| $tab=='completed_orders')?'active':'' ;?>">
                  <a href="#">
                    <i class="fa fa-list"></i>
                    <span>Orders Management</span> 
                    <span class="pull-right-container">
                      <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                   <li class="<?=($tab=='orders')?'active':'' ;?>"><a href="<?=admin_url('orders')?>"><i class="fa fa-circle"></i> Pending List</a></li>
                   <li class="<?=($tab=='completed_orders')?'active':'' ;?>"><a href="<?=admin_url('orders/completed_orders')?>"><i class="fa fa-circle"></i> Completed List</a></li>
                   
                 </ul>
               </li>
               <li class="treeview <?=($tab=='add_faqs' || $tab=='faqs')?'active':'' ;?>">
                <a href="#">
                  <i class="fa fa-cog"></i>
                  <span>FAQ Management</span> 
                  <span class="pull-right-container">
                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                 <li class="<?=($tab=='add_faqs')?'active':'' ;?>"><a href="<?=admin_url('faqs/add')?>"><i class="fa fa-circle"></i> Add FAQ</a></li>
                 <li class="<?=($tab=='faqs')?'active':'' ;?>"><a href="<?=admin_url('faqs')?>"><i class="fa fa-circle"></i> FAQ Lists</a></li>
               </ul>
             </li-->
             <li class="treeview <?=($tab=='add_testimonials' || $tab=='testimonials')?'active':'' ;?>">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Testimonial Management</span>
                <span class="pull-right-container">
                  <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?=($tab=='add_testimonials')?'active':'' ;?>"><a href="<?=admin_url('testimonials/add')?>"><i class="fa fa-circle"></i> Add Testimonial</a></li>
                <li class="<?=($tab=='testimonials')?'active':'' ;?>"><a href="<?=admin_url('testimonials')?>"><i class="fa fa-circle"></i> Testimonial Lists</a></li>
              </ul>
            </li>
          <!-- <li class="<?=($tab=='faqs')?'active':'' ;?> ">
            <a href="<?=admin_url('faqs/add/1')?>">
              <i class="fa fa-question"></i> <span>Faqs Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
          </li> -->
          <!--<li class="treeview <?=($tab=='gallery' || $tab=='gallery')?'active':'' ;?>">-->
            <!--  <a href="#">-->
              <!--    <i class="fa fa-image"></i>-->
              <!--    <span>Project Gallery Management</span>-->
              <!--    <span class="pull-right-container">-->
                <!--      <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>-->
                <!--    </span>-->
                <!--  </a>-->
                <!--  <ul class="treeview-menu">-->
                  <!--    <li class="<?=($tab=='gallery')?'active':'' ;?>"><a href="<?=admin_url('gallery/add')?>"><i class="fa fa-circle"></i> Add Gallery</a></li>-->
                  <!--    <li class="<?=($tab=='gallery')?'active':'' ;?>"><a href="<?=admin_url('gallery')?>"><i class="fa fa-circle"></i> Gallery Lists</a></li>-->
                  <!--  </ul>-->
                  <!--</li> -->

                  <!--<li class="<?=($tab=='contacts')?'active':'' ;?> ">-->
                    <!--  <a href="<?=admin_url('contacts')?>">-->
                      <!--    <i class="fa fa-envelope"></i> <span>Contact Management</span>-->
                      <!--    <span class="pull-right-container">-->
                        <!--      <i class="fa fa-angle-right pull-right"></i>-->
                        <!--    </span>-->
                        <!--  </a>-->
                        <!--</li>-->

                        <li class="<?=($tab=='enquiry')?'active':'' ;?> ">
                         <a href="<?=admin_url('contacts')?>">
                           <i class="fa fa-question-circle"></i> <span>Enquiry Management</span>

                         </a>
                       </li>
                        <li class="<?=($tab=='contacts')?'active':'' ;?> ">
                         <a href="<?=admin_url('contacts/number_list')?>">
                           <i class="fa fa-question-circle"></i> <span>Authenticated Number</span>

                         </a>
                       </li>
                       <li class="<?=($tab=='settings')?'active':'' ;?>">
                        <a href="<?=admin_url('settings')?>"><i class="fa fa-wrench"></i> Settings</a>
                      </li>
                      <li class="<?=($tab=='option')?'active':'' ;?>">
                        <a href="<?=admin_url('option')?>"><i class="fa fa-bolt"></i> How It Works</a>
                      </li>
                    </ul>
                  </section>
                  <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <h1>
                      <?=$title?>
                    </h1>
                    <ol class="breadcrumb">
                      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                      <li class="active"><?=$title?></li>
                    </ol>
                  </section>
                  <section class="content-header">
                    <?php $this->load->view('alert');?>
                  </section>
                  <?php
                  $this->load->view($main);
                  ?>
                </div>
                <!-- /.content-wrapper -->
                <footer class="main-footer">
      <!-- <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div> -->
      <strong>Copyright &copy; <?=date('Y')?> <a href="https://adminlte.io"></a>.</strong> All rights
      reserved.
    </footer>
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->
 <script>
  $(document).ready(function(){
    $(".delete").click(function(){
      if (!confirm("Do you want to delete")){
        return false;
      }
    });
  });
</script>
<script>
  CKEDITOR.replace( 'editor1' );
  CKEDITOR.replace( 'editor2');
</script>
</body>
</html>