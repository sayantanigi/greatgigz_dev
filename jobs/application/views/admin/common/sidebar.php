<?php
if(!empty($_SESSION['phillyhire_admin']['id']))
{
  @$get_adminside=$this->Crud_model->get_single('admin',"userId='".$_SESSION['phillyhire_admin']['id']."'");
}
else{
  redirect(admin_url());
}

$seg2=$this->uri->segment(2);

?>


 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if(!empty(@$get_adminside->image)){
            if(!file_exists('uploads/logo/'.@$get_adminside->image)){
            ?>
            <img class="img-circle elevation-2"
                 src="<?= base_url('uploads/admin.png')?>"
                 alt="Admin profile picture">
               <?php } else{?>
          <img class="img-circle elevation-2"
               src="<?= base_url('uploads/logo/'.@$get_adminside->image)?>"
               alt="User profile picture">

             <?php } } else{?>
               <img class="img-circle elevation-2"
                    src="<?= base_url('uploads/admin.png')?>"
                    alt="Admin profile picture">
             <?php } ?>
          <!-- <img src="<?= base_url('dist/assets/dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block"><?= @$get_adminside->name?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= admin_url('dashboard')?>" <?php if($seg2=='dashboard'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>

          </li>

          <li class="nav-item">
           <a href="<?= admin_url('category') ?>"  <?php if($seg2=='category'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
             <i class="far fa-circle nav-icon"></i> <p>Category</p>
           </a>
         </li>
         <li class="nav-item">
          <a href="<?= admin_url('skill') ?>"  <?php if($seg2=='skill'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
            <i class="far fa-circle nav-icon"></i> <p>List of Skills</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= admin_url('service') ?>"  <?php if($seg2=='service'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
            <i class="far fa-circle nav-icon"></i> <p>Featured Services</p>
          </a>
        </li>
         <li class="nav-item">
            <a href="<?= admin_url('users') ?>"  <?php if($seg2=='users'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
              <i class="nav-icon fas fa-users"></i>
              <p>  Users</p>  </a>
              </li>
              <li class="nav-item">
           <a href="<?= admin_url('employers') ?>"  <?php if($seg2=='employers'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
             <i class="nav-icon fas fa-user"></i>
             <p>  List of Employers</p>  </a>
             </li>
             <li class="nav-item">
           <a href="<?= admin_url('jobs') ?>"  <?php if($seg2=='jobs'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
             <i class="far fa-circle nav-icon"></i>
             <p>  List of Jobs</p>  </a>
             </li>
             <li class="nav-item">
           <a href="<?= admin_url('jobseekers') ?>"  <?php if($seg2=='jobseekers'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
             <i class="nav-icon fas fa-user"></i>
             <p>  List of JobSeekers</p>  </a>
             </li>
             <li class="nav-item">
           <a href="<?= admin_url('subscribers') ?>"  <?php if($seg2=='subscribers'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
             <i class="nav-icon fas fa-envelope"></i>
             <p>  List of Subscribers</p>  </a>
             </li>
             <li class="nav-item">
           <a href="<?= admin_url('applied-jobs') ?>"  <?php if($seg2=='applied-jobs'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
             <i class="nav-icon fas fa-book"></i>
             <p>  List of Applied Jobs</p>  </a>
             </li>
             <li class="nav-item">
           <a href="<?= admin_url('orders') ?>"  <?php if($seg2=='orders'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
             <i class="nav-icon fas fa-book"></i>
             <p>  List of Payments</p>  </a>
             </li>
              <li class="nav-item">
                        <a href="<?= admin_url('subscription')?>"  <?php if($seg2=='subscription'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
                           <i class="nav-icon fas fa-book"></i>
                           <p>Subscription </p>  </a>
                       </li>

                     <li class="nav-item <?php if($seg2=='template' || $seg2=='mailer'|| $seg2=='email_template'){ echo "menu-open";} ?>">
            <a href="javascript:void(0)" class="nav-link <?php if($seg2=='template' || $seg2=='mailer' || $seg2=='email_template'){ echo "active";} ?>">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Email Management<i class="right fas fa-angle-left"></i> </p>
            </a>
             <ul class="nav nav-treeview">
               <li class="nav-item">
                 <a href="<?= admin_url('template') ?>" class="nav-link <?php if($seg2=='template'){ echo "active";}?>">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Template Creation</p></a>
               </li>

                <li class="nav-item">
                 <a href="<?= admin_url('mailer')?>" class="nav-link <?php if($seg2=='mailer'){ echo "active";}?>">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Mailer</p> </a>
               </li>

             </ul>
           </li>
           <li class="nav-item">
            <a href="<?= admin_url('cms')?>"  <?php if($seg2=='cms'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
              <i class="nav-icon fas fa-book"></i>
              <p> Manage Cms </p> </a>
          </li>
           <li class="nav-item">
            <a href="<?= admin_url('about-us')?>"  <?php if($seg2=='about-us'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
              <i class="far fa-circle nav-icon"></i>
              <p>About us</p> </a>
          </li>
            <li class="nav-item">
            <a href="<?= admin_url('our-service')?>"  <?php if($seg2=='our-service'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
              <i class="far fa-circle nav-icon"></i>
              <p>Our Services </p> </a>
          </li>
           <li class="nav-item">
            <a href="<?= admin_url('faq')?>"  <?php if($seg2=='faq'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
              <i class="nav-icon fas fa-book"></i>
              <p>FAQ </p> </a>
          </li>
           <li class="nav-item">
            <a href="<?= admin_url('testimonial')?>"  <?php if($seg2=='testimonial'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
              <i class="nav-icon fas fa-book"></i>
              <p>Testimonial </p> </a>
          </li>

                     <li class="nav-item">
                       <a href="<?= admin_url('setting')?>"  <?php if($seg2=='setting'){?>class="nav-link active" <?php } else{?> class="nav-link"<?php } ?>>
                         <i class="nav-icon fas fa-cog"></i>
                         <p>Setting </p> </a>
                     </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
