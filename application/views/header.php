<?php
$get_setting=$this->Crud_model->get_single('setting');
$get_category=$this->Crud_model->GetData('category','',"status='Active'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>GreatGigz - Project Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="<?=base_url(); ?>uploads/logo/<?= $get_setting->favicon?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap-grid.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>assets/css/icons.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>assets/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/chosen.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/colors/colors.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="<?=base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/rating_css.css" />
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
    <meta property="og:title" content="Join the best company in the world!" />
    <meta property="og:url" content="http://www.sharethis.com" />
    <meta property="og:image" content="http://sharethis.com/images/logo.jpg" />
    <meta property="og:description" content="ShareThis is its people. It's imperative that we hire smart,innovative people who can work intelligently as we continue to disrupt the very category we created. Come join us!" />
    <meta property="og:site_name" content="ShareThis" />
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=6163c52d38f8310012c86621&product=inline-share-buttons' async='async'></script>
    <style>
    .completeSub {display: none; text-align: center; margin-top: 20px; color: #fa5a1f; font-size: 20px;}
    #completeSub {
  position: relative;
  display: inline-block;
}

#completeSub #completeSubtext {
  visibility: hidden;
      width: max-content;
    background-color: white;
    color: #000;
    text-align: center;
    border-radius: 6px;
    padding: 5px 10px;
    position: absolute;
    z-index: 1;
    top: 50px;
    font-size: 13px;
    right: 0;
}

#completeSub:hover #completeSubtext {
  visibility: visible;
}
</style>
<script>
function completeSub() {
    $('.completeSub').show();
    setTimeout(function(){
        $('.completeSub').fadeOut('slow');
    },4000);
}
$(function () {
    $('#completeSub').mouseover(function(){
        $("#completeSub").css("background-color", "yellow");
    });
})
</script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" defer></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "b5807d3e-0518-4cdc-bd66-c21dcd8d37ce",
      safari_web_id: "web.onesignal.auto.560021c2-877c-448b-9811-f001e7b5ec58",
      notifyButton: {
        enable: true,
      },
    });
  });
</script>
</head>
<body>
    <div class="page-loading">
        <img src="<?=base_url(); ?>assets/images/loader.gif" alt="" />
    </div>
    <div class="theme-layout" id="scrollup">
        <div class="responsive-header">
            <div class="responsive-menubar">
                <div class="res-logo">
                    <a href="<?=base_url('projects'); ?>" title=""><img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" /></a>
                </div>
                <div class="menu-resaction">
                    <div class="res-openmenu">Menu</div>
                    <div class="res-closemenu">Close</div>
                </div>
            </div>
            <div class="responsive-opensec">
                <div class="btn-extars">
                <?php if(!empty($_SESSION['commonUser']['userId'])){?>
                    <a href="<?= base_url('projects/postjob')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
                <?php } else{?>
                    <a href="<?= base_url('projects/login')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
                <?php } ?>
                    <ul class="account-btns">
                        <?php if(!empty($_SESSION['commonUser']['userId'])){?>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>'projects/dashboard"><i class="la la-key"></i> My Account</a>
                            </li>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>'projects/logout"><i class="la la-external-link-square"></i> Logout</a>
                            </li>
                        <?php } else {?>
                            <li class="signup-popup">
                                <a href="<?=base_url(); ?>'projects/register" title=""><i class="la la-key"></i> Sign Up</a>
                            </li>
                            <li class="signin-popup">
                                <a href="<?= base_url('projects/login')?>" title=""><i class="la la-external-link-square"></i> Login</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <form class="res-search">
                    <input type="text" placeholder="Job title, keywords or company name" />
                    <button type="submit"><i class="la la-search"></i></button>
                </form>
                <div class="responsivemenu">
                    <ul>
                        <li class="menu-item-has-children">
                            <a href="#" title="">Our Services</a>
                            <ul>
                            <?php if(!empty($get_category)){
                            foreach ($get_category as $row ) {
                            $get_subcategory=$this->Crud_model->GetData('sub_category','',"category_id='".$row->id."'"); ?>
                                <li class="menu-item-has-children">
                                    <a href="#" title=""><?= ucfirst($row->category_name)?></a>
                                    <ul>
                                    <?php if(!empty($get_subcategory)){
                                    foreach ($get_subcategory as $key) { ?>
                                        <li><a href="<?= base_url('projects/employees_list/'.base64_encode($key->id))?>"><?= ucfirst($key->sub_category_name)?></a></li>
                                    <?php } } ?>
                                    </ul>
                                </li>
                            <?php } } ?>
                            </ul>
                        </li>
                        <li class="account-btns">
                            <a href="<?= base_url('projects/ourjobs')?>" title="">Our Jobs</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="<?= base_url('projects/employer-list')?>" title="">Become a AfreBay Partner</a>
                            <ul>
                                <li><a href="#" title="">For Employer</a></li>
                                <li><a href="<?= base_url('projects/workers-list')?>" title="">For AfreBay Freelancer</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <header class="stick-top forsticky ">
            <div class="menu-sec">
                <div class="container Header_Menu_Nav">
                    <div class="logo">
                        <a href="<?=base_url('projects'); ?>" title="">
                            <img class="hidesticky" src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" style="width: 135px;"/>
                            <img class="showsticky" src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" style="width: 135px;"/>
                            <input type="hidden" class="hidden-logo" value="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>">
                        </a>
                    </div>
                    <nav>
                        <ul>
                            <!-- <li class="menu-item-has-children">
                                <a href="#" title="">Our Services</a>
                                <ul>
                                <?php if(!empty($get_category)){
                                foreach ($get_category as $row ) {
                                $get_subcategory=$this->Crud_model->GetData('sub_category','',"category_id='".$row->id."'"); ?>
                                    <li class="menu-item-has-children">
                                        <a href="#" title=""><?= ucfirst($row->category_name)?></a>
                                        <ul>
                                            <?php if(!empty($get_subcategory)) {
                                            foreach ($get_subcategory as $key) { ?>
                                                <li><a href="<?= base_url('projects/employees_list/'.base64_encode($key->id))?>"><?= ucfirst($key->sub_category_name)?></a></li>
                                            <?php } } ?>
                                            </ul>
                                        </li>
                                <?php } } ?>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#" title="">Become a AfreBay Partner</a>
                                <ul>
                                    <li><a href="<?= base_url('projects/employer-list')?>" title="">Vendors</a></li>
                                    <li><a href="<?= base_url('projects/workers-list')?>" title="">Freelancers</a></li>
                                </ul>
                            </li> -->
                            <li class="">
                                <a href="<?= base_url('projects/employer-list')?>" title="">Vendors</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url('projects/workers-list')?>" title="">Freelancers</a>
                            </li>
                            <li class="">
                                <a href="<?= base_url('projects/ourjobs')?>" title="">Our Jobs</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="btn-extars">
                        <?php
                        if(!empty($_SESSION['commonUser']['userId'])) {
                            if($_SESSION['commonUser']['userType'] == '2') {
                                $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['commonUser']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                                if(empty($get_sub_data)) { ?>
                                    <a href="javascript:void(0)" title="" class="post-job-btn" id="completeSub"><i class="la la-plus"></i>Post Jobs<span id="completeSubtext">Please activate a subscription package and complete your profile to proceed with the post job activities.</span></a>
                                <?php } else if(!empty($get_sub_data)) {
                                    $profile_check = $this->db->query("SELECT `profilePic`, `companyname`, `email`, `mobile`,`address`, `foundedyear`, `teamsize`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['commonUser']['userId']."'")->result_array();
                                    if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) { ?>
                                        <a href="javascript:void(0)" title="" class="post-job-btn" id="completeSub"><i class="la la-plus"></i>Post Jobs<span id="completeSubtext">Please activate a subscription package and complete your profile to proceed with the post job activities.</span></a>
                                    <?php } else { ?>
                                        <a href="<?= base_url('projects/postjob')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <a href="<?= base_url('projects/login')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
                                }
                            <?php } }
                        } else { ?>
                            <a href="<?= base_url('projects/login')?>" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a>
                        <?php } ?>
                        <ul class="account-btns">
                            <?php if(!empty($_SESSION['commonUser']['userId'])) { ?>
                                <li class="menu-item-has-children User_Dashboard_Menu">
                                    <a class="Profile_dashboard_btn" href="javascript:void(0)" title="">Hi,
                                        <?php if(!empty($_SESSION['commonUser']['firstname'])) {
                                            $fullname = $_SESSION['commonUser']['firstname']." ".$_SESSION['commonUser']['lastname'];
                                        } else {
                                            $fullname = $_SESSION['commonUser']['companyname'];
                                        }
                                        echo ucwords($fullname); ?>
                                    </a>
                                    <ul>
                                        <li>
                                            <?php $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['commonUser']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                                            if(empty($get_sub_data)) {
                                                if(@$_SESSION['commonUser']['userType']=='1') { ?>
                                                    <a href="<?=base_url('projects/subscription'); ?>" title="">Subscribe</a>
                                                <?php } else { ?>
                                                    <a href="<?=base_url('projects/subscription'); ?>" title="">Subscribe</a>
                                            <?php } } else {
                                                $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['commonUser']['userId']."'")->result_array();
                                                if(empty($profile_check[0]['companyname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['teamsize'])  || empty($profile_check[0]['short_bio'])) { ?>
                                                <a href="<?=base_url('projects/profile'); ?>" title="">Profile</a>
                                                <?php } else { ?>
                                                <a href="<?=base_url('projects/dashboard'); ?>" title="">Dashboard</a>
                                                <?php } ?>
                                            <?php } ?>
                                        </li>
                                        <li>
                                            <?php
                                            $uid = $_SESSION['commonUser']['userType'];
                                            if(@$_SESSION['commonUser']['userType']=='1') { ?>
                                            <a href="<?php echo base_url("projects/worker-detail/".base64_encode($_SESSION['commonUser']['userId']))?>" title="">View Profile</a>
                                            <?php } else if(@$_SESSION['commonUser']['userType']=='2') { ?>
                                            <a href="<?php echo base_url("projects/employerdetail/".base64_encode($_SESSION['commonUser']['userId']))?>" title="">View Profile</a>
                                            <?php } ?>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('projects/password-reset')?>" title="">Change Password</a>
                                        </li>
                                        <li><a href="<?=base_url('projects/logout'); ?>">Logout</a></li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="">
                                    <a href="<?=base_url('projects/register'); ?>"><i class="la la-key"></i> Sign Up</a>
                                </li>
                                <li class="">
                                    <a href="<?=base_url('projects/login'); ?>"><i class="la la-external-link-square"></i> Login</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
