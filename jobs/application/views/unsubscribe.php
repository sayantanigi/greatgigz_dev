<?php 
$settings=$this->Crud_model->get_single('settingss');
$total_users=$this->Crud_model->GetData('users','',"status='1'");
$total_jobs=$this->Crud_model->GetData('postjob','',"");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>phillyhire - Job Portal</title>
    <link rel="icon" href="<?= base_url('assets/images/home/favicon.ico')?>" />
    <link href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/flexslider/flexslider.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/themify/themify-icons.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/wysihtml5/wysihtml5.css')?>" type="text/css">
    <link href="<?= base_url('assets/css/style.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/responsive.css')?>" rel="stylesheet">
     <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
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
                       <a href="<?= base_url('')?>">
                          <?php if(!empty($settings->logo) && file_exists('uploads/logo/'.@$settings->logo)){?>
                          <img src="<?= base_url('uploads/logo/'.@$settings->logo)?>" alt="logo" class="img-responsive" />
                        <?php } ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <main id="maincontent">
        <section class="contact_us">
            <div class="container">
       
           <div class="row">
                    <div class="col-md-12">
                        <form action="<?= base_url('home/save_unsubscribe')?>" method="post">
                     <label>Reason <span style="color:red">*</span></label>
                     <textarea name="reason" class="form-control" required></textarea>
                      <input type="hidden" name="email" id="email" value="<?= @$get_subscribe->email?>" class="form-control">
                    <br/>
                       <?php if(!empty($get_subscribe->email)){?>
              <button type="submit" class="btn btn-default pull-right">Unsubscribe</button>
              <?php } else{?>
                <h4 style="color:red">You are not Subscriber!</h4>
              <?php } ?>
                 </form>
                    </div>
                </div>
                
            </div>
       
    </section>
</main>
    

	<footer id="footer">
        <div class="container">
            <div class="row">
                <div class="footer-block">
                    <h5>For Employers</h5>
                    <hr>
                   <?php if(@$_SESSION['commonUser']['userType']==2){?>
                    <ul class="footer-link">
                        <li><a href="<?= base_url('post-job')?>">Post a Job</a></li>
                        <li><a href="<?= base_url('dashboard')?>">My Account</a></li>
                        <li><a href="<?= base_url('my-jobs')?>">My Jobs</a></li>
                        <li><a href="<?= base_url('jobseeker-list')?>">My Candidates</a></li>
                       
                        <li><a href="<?= base_url('help')?>">Help</a></li>
                    </ul>
                  <?php } else{?>
                      <ul class="footer-link">
                        <li><a href="javascript:void(0)" onclick="return employer_login()">Post a Job</a></li>
                        <li><a href="javascript:void(0)" onclick="return employer_login()">My Account</a></li>
                        <li><a href="javascript:void(0)" onclick="return employer_login()">My Jobs</a></li>
                        <li><a href="javascript:void(0)" onclick="return employer_login()">My Candidates</a></li>
                       
                        <li><a href="javascript:void(0)" onclick="return employer_login()">Help</a></li>
                    </ul>
                  <?php } ?>
                </div>
                <div class="footer-block">
                    <h5>For Jobseekers</h5>
                    <hr>
                    <?php if(@$_SESSION['commonUser']['userType']==1){?>
                    <ul class="footer-link">
                        <li><a href="<?= base_url('dashboard')?>">My Account</a></li>
                        <li><a href="<?= base_url('search-result')?>">Job Search</a></li>
                       
                        <li><a href="<?= base_url('help')?>">Help</a></li>
                    </ul>
                     <?php } else{?>
                      <ul class="footer-link">
                        <li><a href="javascript:void(0)" onclick="return jobseeker_login()">My Account</a></li>
                        <li><a href="<?= base_url('search-result')?>">Job Search</a></li>
                        <li><a href="javascript:void(0)" onclick="return jobseeker_login()">Help</a></li>
                    </ul>
                  <?php } ?>
                </div>
                <div class="footer-block">
                    <h5>Browse Jobs</h5>
                    <hr>
                    <ul class="footer-link">
                      <li><a href="<?= base_url('about-us')?>">About Us</a></li>
                       <!--<li><a href="<?= base_url('contact')?>">Contact Us</a></li>-->
                       <?php if(@$_SESSION['commonUser']['userType']==2){?>
                        <li><a href="<?= base_url('candidate-listing')?>">Candidate List</a></li>
                      <?php }else{?>
                        <li><a href="javascript:void(0)" onclick="return employer_login()">Candidate List</a></li>
                      <?php }?>
                       <li><a href="<?= base_url('pricing')?>">Pricing</a></li>
                       <li><a href="<?= base_url('employer-listing')?>">Employer List</a></li>
                       <li><a href="<?= base_url('faq')?>">FAQ</a></li>
                        <!--<li><a href="javascript:void(0)">Jobs by Skill</a></li>-->
                    </ul>
                </div>
                <div class="footer-block footer-block2">
                    <h5>Follow Us</h5>
                    <hr>
                    <ul class="follow">
                        <li><a href="<?= @$settings->facebook ?>" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="<?= @$settings->twitter ?>" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="<?= @$settings->linkedin ?>" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="<?= @$settings->instagram ?>" title="Instagram"><span class="ti-instagram"></span></a></li>
                        <li><a href="<?= @$settings->youtube ?>" title="RSS"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                    <div class="border"></div>
                    <div class="register">
                        <a href="javascript:void(0)"><?= count($total_users)?> <span>Registerd Members</span></a>
                    </div>
                    <div class="register job">
                        <a href="javascript:void(0)"><?= count($total_jobs)?> <span>Latest Jobs</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 padding-left">
                        <span>&#169; <?= date('Y')?> Philly Hire. All Rights Reserved.<br/> phillyhire.com has no affiliation with any other job board or website.</span>
                    </div>
                    <div class="col-md-6 col-sm-6 text-right padding-left">
                        <ul class="bottom_link">
                            <!--<li><a href="javascript:void(0)">Site Map</a></li>-->
                            <li><a href="<?= base_url('term-and-conditions')?>">Terms of Use</a></li>
                            <li><a href="<?= base_url('privacy-policy')?>">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <input type="hidden" name="base_url" id="base_url" value="<?= base_url();?>">
     <input type="hidden" name="admin_url" id="admin_url" value="<?= admin_url();?>">
    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/plugins/flexslider/jquery.flexslider-min.js')?>"></script>
    <script src="<?= base_url('assets/js/jquery.counterup.min.js')?>"></script>
    <script src="<?= base_url('assets/plugins/wysihtml5/wysihtml5-0.3.0.js')?>" ></script>
    <script src="<?= base_url('assets/js/wysihtml.js')?>"></script>
    <script src="<?= base_url('assets/js/file.js')?>"></script>
    <script src="<?= base_url('assets/js/waypoints.min.js')?>"></script>
    <script src="<?= base_url('assets/js/counter.js')?>"></script>
    <script src="<?= base_url('assets/js/flexslider.js')?>"></script>
    <script src="<?= base_url('assets/js/common.js')?>"></script>

    <script src="<?= base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>
 <link href="<?= base_url('assets/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css">
    <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

    </script>
      
    <script src="<?= base_url('assets/custom_js/validation.js')?>"></script>
<script src="<?= base_url();?>dist/assets/notify/notify.min.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
      var sessionMessage = '<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>';

      if(sessionMessage==null || sessionMessage=="" ){ return false;}
      $.notify(sessionMessage,{ position:"top right",className: 'info' });//session msg
        });


    </script>
    
    
</body>
</html>
