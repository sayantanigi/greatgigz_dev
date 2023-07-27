<?php $settings=$this->Crud_model->get_single('setting');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GreatGigz - Job Portal</title>
    <link rel="icon" href="<?= base_url('assets/jobassets/images/home/favicon.ico')?>" />
    <link href="<?= base_url('assets/jobassets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/jobassets/plugins/flexslider/flexslider.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/jobassets/plugins/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/jobassets/plugins/themify/themify-icons.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/jobassets/plugins/wysihtml5/wysihtml5.css')?>" type="text/css">
    <link href="<?= base_url('assets/jobassets/css/style.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/jobassets/css/responsive.css')?>" rel="stylesheet">
     <script src="<?= base_url('assets/jobassets/js/jquery.min.js')?>"></script>
     <!-- social media tag -->

         <meta property="og:title" content="Join the best company in the world!" />
         <meta property="og:url" content="http://www.sharethis.com" />
         <meta property="og:image" content="http://sharethis.com/images/logo.jpg" />
         <meta property="og:description" content="ShareThis is its people. It's imperative that we hire smart,innovative people who can work intelligently as we continue to disrupt the very category we created. Come join us!" />
         <meta property="og:site_name" content="ShareThis" />
          <!--  end social media tag -->

       <!-- social media script -->
               <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=6163c52d38f8310012c86621&product=inline-share-buttons' async='async'></script>

               <!-- end social media script -->
</head>
<body>
    <div class="header-stricky">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3 col-3">
                    <div class="site-logo">
                       <a href="http://localhost/greatgigz_dev/">
                          <?php if(!empty($settings->logo) && file_exists('uploads/logo/'.@$settings->logo)){?>
                          <img src="<?= base_url('uploads/logo/'.@$settings->logo)?>" alt="logo" class="img-responsive" />
                        <?php } ?>
                        </a>
                    </div>
                </div>
                <div class="col-md-7 hidden-sm hidden-xs">
                    <nav class="navbar navbar-default navbar-static-top">
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav scrollto">
                                <li><a href="<?= base_url('')?>">Home</a></li>
                                 <?php if(!empty($_SESSION['commonUser']['userId']) && $_SESSION['commonUser']['userType']=='2' ){?>
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Employers <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= base_url('dashboard')?>">Profile Settings</a></li>
                                        <li><a href="<?= base_url('subscription')?>">Subscription Plans</a></li>
                                        <li><a href="<?= base_url('post-job')?>">Post a Job</a></li>
                                        <li><a href="<?= base_url('my-jobs')?>">My Jobs</a></li>
                                        <li><a href="javascript:void(0)">Notifications</a></li>
                                        <li><a href="<?= base_url('applicant-list')?>">Applicant List</a></li>
                                        <li><a href="<?= base_url('help')?>">Help</a></li>
                                    </ul>
                                </li>
                            <?php } if(!empty($_SESSION['commonUser']['userId']) && $_SESSION['commonUser']['userType']=='1' ){?>
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Job Seekers <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= base_url('dashboard')?>">Profile Settings</a></li>
                                      
                                        <li><a href="javascript:void(0)">Notification</a></li>
                                        <li><a href="<?= base_url('job-listing')?>">Job Search</a></li>
                                        <li><a href="<?= base_url('favorite-job')?>">Add Favorite Jobs</a></li>
                                        <li><a href="<?= base_url('applied-job')?>">Applied Jobs</a></li>
                                        <li><a href="<?= base_url('shortlist-job')?>">Shortlisted Jobs</a></li>
                                        <li><a href="<?= base_url('help')?>">Help</a></li>
                                    </ul>
                                </li>
                                <?php } if(empty($_SESSION['commonUser']['userId'])){?>
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Sign In or Create Account <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= base_url('login')?>">Employer</a></li>
                                        <li><a href="<?= base_url('login')?>">Job Seeker</a></li>
                                    </ul>
                                </li>
                            <?php } else{?>
                                <li><a href="<?= base_url('logout')?>"><i class="fa fa-sign-out"></i> Sign Out</a></li>
                            <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-md-2 col-sm-9 col-xs-9 col-9 text-right">
                    <div class="right-menu">
                          <?php if(!empty($_SESSION['commonUser']['userId'])){?>
                        <a href="javascript:void(0)" class="signup" onclick="return postjob()">Post a Job</a>
                    <?php } else{?>
                         <a href="<?= base_url('login')?>" class="signup">Post a Job</a>
                    <?php } ?>
                        <a href="javascript:void(0);" onclick="openNav()" class="signup mobile-menu">
                            &#9776;
                        </a>
                    </div>
                </div>
                <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                  <nav class="nav" role="navigation">
                  <ul class="nav__list">
                    <li><a href="<?= base_url()?>">Home</a></li>
                      <?php if(!empty($_SESSION['commonUser']['userId']) && $_SESSION['commonUser']['userType']=='2' ){?>
                    <li>
                      <input id="group-2" type="checkbox" hidden />
                      <label for="group-2"><span class="fa fa-angle-right"></span> Employers</label>
                      <ul class="group-list">
                        <li><a href="<?= base_url('dashboard')?>">Profile Settings</a></li>
                        <li><a href="<?= base_url('subscription')?>">Subscription Plans</a></li>
                        <li><a href="<?= base_url('post-job')?>">Post a Job</a></li>
                        <li><a href="<?= base_url('my-jobs')?>">My Jobs</a></li>
                        <li><a href="javascript:void(0)">Notifications</a></li>
                        <li><a href="<?= base_url('applicant-list')?>">Applicant List</a></li>
                        <li><a href="<?= base_url('help')?>">Help</a></li>
                      </ul>
                    </li>
                     <?php } if(!empty($_SESSION['commonUser']['userId']) && $_SESSION['commonUser']['userType']=='1' ){?>
                    <li>
                      <input id="group-3" type="checkbox" hidden />
                      <label for="group-3"><span class="fa fa-angle-right"></span> Job Seekers</label>
                      <ul class="group-list">
                         <li><a href="<?= base_url('dashboard')?>">Profile Settings</a></li>
                      
                        <li><a href="javascript:void(0)">Notification</a></li>
                        <li><a href="<?= base_url('job-listing')?>">Job Search</a></li>
                        <li><a href="<?= base_url('favorite-job')?>">Add Favorite Jobs</a></li>
                        <li><a href="<?= base_url('applied-job')?>">Applied Jobs</a></li>
                        <li><a href="<?= base_url('shortlist-job')?>">Shortlisted Jobs</a></li>
                        <li><a href="<?= base_url('help')?>">Help</a></li>
                      </ul>
                    </li>
                    <?php } if(empty($_SESSION['commonUser']['userId'])){?>
                    <li>
                      <input id="group-3" type="checkbox" hidden />
                      <label for="group-3"><span class="fa fa-angle-right"></span> Sign In or Create Account</label>
                      <ul class="group-list">
                        <li><a href="<?= base_url('login')?>">Employer</a></li>
                        <li><a href="<?= base_url('login')?>">Job Seeker</a></li>
                      </ul>
                    </li>
                <?php } else{?>
                      <li><a href="<?= base_url('logout')?>"><i class="fa fa-sign-out"></i> Sign Out</a></li>
                <?php } ?>
                  </ul>
                </nav>
                </div>
            </div>
        </div>
    </div>
