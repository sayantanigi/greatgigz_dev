<?php 
$settings=$this->Crud_model->get_single('setting');
$total_users=$this->Crud_model->GetData('users','',"status='1'");
$total_jobs=$this->Crud_model->GetData('postjob','',"");
?>

<footer id="footer">
        <div class="container">
            <div class="row">
                <div class="footer-block">
                    <h5>For Employers</h5>
                    <hr>
                    <ul class="footer-link">
                        <li><a href="javascript:void(0)">Products</a></li>
                        <li><a href="javascript:void(0)">Post a Job</a></li>
                        <li><a href="javascript:void(0)">My Account</a></li>
                        <li><a href="javascript:void(0)">My Jobs</a></li>
                        <li><a href="javascript:void(0)">My Candidates</a></li>
                        <li><a href="javascript:void(0)">My Company</a></li>
                        <li><a href="javascript:void(0)">My Templates</a></li>
                        <li><a href="javascript:void(0)">Help</a></li>
                    </ul>
                </div>
                <div class="footer-block">
                    <h5>For Jobseekers</h5>
                    <hr>
                    <ul class="footer-link">
                        <li><a href="javascript:void(0)">My Account</a></li>
                        <li><a href="javascript:void(0)">Job Search</a></li>
                        <li><a href="javascript:void(0)">Career Planning</a></li>
                        <li><a href="javascript:void(0)">Resumes/Letters</a></li>
                        <li><a href="javascript:void(0)">Job Alerts</a></li>
                        <li><a href="javascript:void(0)">Resources</a></li>
                        <li><a href="javascript:void(0)">Help</a></li>
                    </ul>
                </div>
                <div class="footer-block">
                    <h5>Browse Jobs</h5>
                    <hr>
                    <ul class="footer-link">
                      <li><a href="<?= base_url('about-us')?>">About Us</a></li>
                       <li><a href="<?= base_url('contact')?>">Contact Us</a></li>
                       <li><a href="<?= base_url('candidate-listing')?>">Candidate List</a></li>
                       <li><a href="<?= base_url('pricing')?>">Pricing</a></li>
                       <li><a href="<?= base_url('employer-listing')?>">Employer List</a></li>
                        <li><a href="javascript:void(0)">Jobs by Location</a></li>
                        <li><a href="javascript:void(0)">Jobs by Skill</a></li>
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
                        <span>&#169; <?= date('Y')?>  GreatGigz. All Rights Reserved.<br/>  GreatGigz.com has no affiliation with any other job board or website.</span>
                    </div>
                    <div class="col-md-6 col-sm-6 text-right padding-left">
                        <ul class="bottom_link">
                            <li><a href="javascript:void(0)">Site Map</a></li>
                            <li><a href="javascript:void(0)">Terms of Use</a></li>
                            <li><a href="javascript:void(0)">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <input type="hidden" name="base_url" id="base_url" value="<?= base_url();?>">
    <!-- jQuery -->
    <script src="<?= base_url('assets/jobassets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/jobassets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/jobassets/plugins/flexslider/jquery.flexslider-min.js')?>"></script>
    <script src="<?= base_url('assets/jobassets/js/jquery.counterup.min.js')?>"></script>
    <script src="<?= base_url('assets/jobassets/plugins/wysihtml5/wysihtml5-0.3.0.js')?>" ></script>
    <script src="<?= base_url('assets/jobassets/js/wysihtml.js')?>"></script>
    <script src="<?= base_url('assets/jobassets/js/file.js')?>"></script>
    <script src="<?= base_url('assets/jobassets/js/waypoints.min.js')?>"></script>
    <script src="<?= base_url('assets/jobassets/js/counter.js')?>"></script>
    <script src="<?= base_url('assets/jobassets/js/flexslider.js')?>"></script>
    <script src="<?= base_url('assets/jobassets/js/common.js')?>"></script>

    <script src="<?= base_url('assets/jobassets/sweetalert/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/jobassets/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>
 <link href="<?= base_url('assets/jobassets/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css">
    <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

    </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap"
  async defer></script>

    <script src="<?= base_url('assets/jobassets/custom_js/validation.js')?>"></script>
<script src="<?= base_url();?>dist/assets/jobassets/notify/notify.min.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
      var sessionMessage = '<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>';

      if(sessionMessage==null || sessionMessage=="" ){ return false;}
      $.notify(sessionMessage,{ position:"top right",className: 'info' });//session msg
        });


    </script>

    <!------------------- post job message ---------------------->
    <script type="text/javascript">
       function postjob()
      {
          var base_url=$('#base_url').val();
           <?php if($_SESSION['commonUser']['userType']==2)
           {
            $session_value=$_SESSION['commonUser']['userType'];
           }else{
            $session_value='';
           }?>
         var checkSession='<?= $session_value ?>';
         if(checkSession =='')
         {
           swal({
              title: "Only for Employer!",
              type: "warning",
              confirmButtonColor: '#A5DC86',
              confirmButtonText: 'ok',
              closeOnConfirm: false,
          }, function(isConfirm){
              if (isConfirm) {
                  swal.close();
              }
          });

         }
         else{
        window.location.href=base_url+'post-job';
      }

      }
    </script>
    <!------------------- end post job message ---------------------->
</body>
</html>
