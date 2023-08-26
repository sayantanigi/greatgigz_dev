<?php 
$settings=$this->Crud_model->get_single('settingss');
$total_users=$this->Crud_model->GetData('users','',"status='1'");
$total_jobs=$this->Crud_model->GetData('postjob','',"posted_from = 'Job Portal'");
?>

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap" async defer></script>
<script src="<?= base_url('assets/custom_js/validation.js')?>"></script>
<script src="<?= base_url();?>dist/assets/notify/notify.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //var sessionMessage = '<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>';
        var sessionMessage = '<?php if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); unset($_SESSION['message']); } ?>';
        if(sessionMessage==null || sessionMessage=="" ){ return false;}
        $.notify(sessionMessage,{ position:"top right",className: 'info' });//session msg
    });
</script>
<script type="text/javascript">
function employer_login() {
    var base_url=$('#base_url').val();
    <?php if(@$_SESSION['commonUser']['userType']==2) {
        $session_value=$_SESSION['commonUser']['userType'];
    } else {
        $session_value='';
    } ?>
    var checkSession='<?= $session_value ?>';
    if(checkSession =='') {
        swal({   
            title: "Only for Employer!",   
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#A5DC86',
            cancelButtonColor: '#0bc2f3',
            confirmButtonText: 'Yes, Login!',
            cancelButtonText: 'Ok, cancel', 
            closeOnConfirm: false,   
            closeOnCancel: true 
        }, function(isConfirm){
            if (isConfirm) {
                window.location.href =base_url+"login";
            }
        });
    }
}

function jobseeker_login() {
    var base_url=$('#base_url').val();
    <?php if(@$_SESSION['commonUser']['userType']==1) {
        $session_value=$_SESSION['commonUser']['userType'];
    } else {
        $session_value='';
    } ?>
    var checkSession='<?= $session_value ?>';
    if(checkSession =='') {
        swal({   
            title: "Only for Jobseeker!",   
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#A5DC86',
            cancelButtonColor: '#0bc2f3',
            confirmButtonText: 'Yes, Login!',
            cancelButtonText: 'Ok, cancel', 
            closeOnConfirm: false,   
            closeOnCancel: true 
        }, function(isConfirm){
            if (isConfirm) {
                window.location.href =base_url+"login";
            }
        });
    }
}
</script>
</body>
</html>
