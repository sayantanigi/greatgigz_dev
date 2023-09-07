<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  
  <meta name="keywords" content="search in businesses">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" >
  <meta name="format-detection" content = "telephone=no">
  <meta name="description" content="">
  <meta name="author" content=""> 
  <!-- Title -->
  <title><?=theme_option('meta_title')?></title> 
  <!-- favicon icon -->
 <link rel="icon" href="https://igiapp.com/greatgigz/jobs/assets/images/home/favicon.ico">
  <!-- Icons -->
  <link href="<?=site_url()?>fassets/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?=site_url()?>fassets/css/custom-icons.css" rel="stylesheet">

  <!-- CSS Stylesheet -->
  <link href="<?=site_url()?>fassets/css/bootstrap.css" rel="stylesheet">
  <link href="<?=site_url()?>fassets/css/slick.css" rel="stylesheet">
  <link href="<?=site_url()?>fassets/css/slick-theme.css" rel="stylesheet">
  <link href="<?=site_url()?>fassets/css/bootstrap-select.css" rel="stylesheet">
  <link href="<?=site_url()?>fassets/css/style.css" rel="stylesheet">
  <link href="<?=site_url()?>fassets/css/css3.css" rel="stylesheet">
  <link href="<?=site_url()?>fassets/css/intlTelInput.css" rel="stylesheet">
  <link href="<?=site_url()?>fassets/css/theme/theme-1.css" rel="stylesheet" id="switch_style">
</head> 
<style>
  .register-link em {
    margin-left: -30px;
    font-size: 20px;
    margin-top: 1px;
    position: absolute;
  }
</style>
<body>
  <div id="wrapper" class="homePage">
    <!-- Header Start -->
    <header id="header">
      <div class="container"> 
       <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-4">
           <div class="navbar-header">
            <a class="navbar-brand" href="https://igiapp.com/greatgigz/">
              <img src="<?=theme_option('logo')?>" alt="Logo" class="img-responsive" />
            </a>
            <button type="button" class="navbar-toggle">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

          </div> 
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
         <div class="clearfix">
             <?php 
                      //  print_r($_SESSION);
            if(!isprologin()){
              ?>
              <div class="register-link right-header">
    
                <a href="#" data-toggle="modal" data-target="#myModal" id="myModalLabel"><em class="fa fa-sign-in" aria-hidden="true"></em>Member Log In</a>
                <a href="<?=site_url('create-profile')?>" data-toggle="modal"><em class="fa fa-user" aria-hidden="true"></em>Join Our Business/Provider Network </a>
              </div>  
              <?php
            }else{
              ?>
              <div class="register-link">
                <a href="<?=site_url('edit-profile')?>" data-toggle="modal" id="myModalLabel"><em class="fa fa-user" aria-hidden="true"></em>My Account</a>
                <a href="<?=site_url('logout')?>" data-toggle="modal" id="myModalLabel"><em class="fa fa-sign-out" aria-hidden="true"></em>Logout</a>
              </div>
              <?php
            } ?>
          <nav class="navigation">
           <div class="close-menu"><i class="fa fa-close" aria-hidden="true"></i></div>
           <div class="navbar-collapse">
            <ul class="nav navbar-nav">
                <?php $url = $this->uri->segment(1);
                if($url != 'create-profile'){
                    ?>
                  
                <li <?php if($load=='home'){echo 'class="active"';} ?>><a href="<?= site_url('') ?>">Home</a></li>
                <li <?php if($load=='about'){echo 'class="active"';} ?>><a href="<?= site_url('about') ?>">About Us</a></li>
                <li <?php if($load=='service' || $load=='service_detail'){echo 'class="active"';} ?>><a href="<?= site_url('service') ?>">Our Services</a></li>
                <li <?php if($load=='contact'){echo 'class="active"';} ?>><a href="<?= site_url('contact') ?>">Contact Us</a></li> 
                <?php } ?>
              <?php
              if(!isprologin()){
                ?>
                <li class="visible-xs"><a href="#" data-toggle="modal" data-target="#myModal" id="myModalLabel"><em class="fa fa-user" aria-hidden="true"></em>Sign In/Register <br/></a></li> 
              <?php } else { ?>
                <li class="visible-xs"><a href="<?=site_url('logout')?>" data-toggle="modal"  id="myModalLabel"><em class="fa fa-sign-out" aria-hidden="true"></em>Sign Out <br/></a></li> 
              <?php } ?>


            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>
</header>
<!-- Register Section -->
<section class="register-user">
  <div class="modal reg fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><em class="fa fa-close" aria-hidden="true"></em></span></button>
        <div class="row-height">
          <div class="right-part">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="login">
                <div id="msg"></div>
                <form>
                  <div class="form-group">
                   <p style="color:black; text-align: center; font-size: 20px;"><b>Business Owners and Registered Users Login</b></p>
                  </div>

                  <div class="form-group">
                    <input type="tel" class="form-control" placeholder="Enter your Mobile"  id="login_username" autocomplete="off" />
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" autocomplete="off" id="login_password"/>
                    <p class="help-block text-right"><a href="<?=site_url('forgot-password')?>">Forgot Password?</a></p>
                  </div>

                  <div class="form-group">
                    <a href="javascript:void(0)" onclick="getLogin();" class="btn btn-info btn-block">Secure Login</a>
                    <p class="help-block text-center">By Logging in you agree to our <a href="<?=site_url('terms-and-conditions') ?>">T&C </a> and <a href="<?=site_url('privacy-policy') ?>">Privacy Policy</a>. </p>
                    <p class="text-center"><b>Don't have an Account? <a href="<?=site_url('create-profile')?>">Register Now</a></b></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php $this->load->front_view($load); ?>

<footer id="footer">
  <div class="top-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6">
          <h3>Quick Links</h3>
          <div class="row">
            <div class="col-xs-6">
              <ul class="links">
                <li><a href="<?=site_url() ?>">Home</a></li>
                <li><a href="<?=site_url('about') ?>">About Us</a></li>

                <li><a href="<?=site_url('contact') ?>">Contact Us</a></li>
              </ul>
            </div>
            <div class="col-xs-6">
              <ul class="links">
                <li><a href="<?=site_url('career') ?>">Careers</a></li>
                <li><a href="<?=site_url('terms-and-conditions') ?>">Terms of Service</a></li>
                <li><a href="<?=site_url('privacy-policy') ?>">Privacy Policy</a></li>

              </div>
            </div>
          </div> 
          <div class="col-md-4 col-sm-6">
            <h3>Our Services</h3>
            <div class="row">
                <div>Helping you find quality professional businesses and service providers in your community.</div>
              <div class="col-xs-6">
                <?php
                $ser1 = $this->db->limit(4)->order_by('id','asc')->get('service')->result();
                $ser2 = $this->db->limit(4)->order_by('id','desc')->get('service')->result();
                ?>
                <ul class="links">
                  <?php 
                  if(is_array($ser1) && count($ser1)>0){
                    foreach ($ser1 as $s) {
                      ?>
                      <li><a href="<?=site_url('service-detail/'.$s->slug)?>"><?= $s->title ?></a></li>
                      <?php
                    }
                  } ?>
                </ul>
              </div>
              <div class="col-xs-6">
                <ul class="links">
                  <?php 
                  if(is_array($ser2) && count($ser2)>0){
                    foreach ($ser2 as $sr1) {
                      ?>
                      <li><a href="<?=site_url('service-detail/'.$sr1->slug)?>"><?= $sr1->title ?></a></li>
                      <?php
                    }
                  } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <h3>Follow us</h3>
            <p><?= theme_option('web') ?></p>
                    <!--div class="contact-us">
                        <input type="email" placeholder="Enter email address" />
                        <input type="submit" class="btn btn-primary" value="Submit" />
                      </div-->
                      <ul class="list-inline social-links">
                        <li><a href="<?= theme_option('facebook') ?>"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
                        <li><a href="<?= theme_option('twitter') ?>"><i aria-hidden="true" class="fa fa-twitter"></i></a></li>
                        <li><a href="<?= theme_option('skype') ?>"><i aria-hidden="true" class="fa fa-linkedin"></i></a></li>
                        <li><a href="<?= theme_option('pintrest') ?>"><i aria-hidden="true" class="fa fa-pinterest"></i></a></li>
                        <li><a href="<?= theme_option('youtube') ?>"><i aria-hidden="true" class="fa fa-youtube"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="copyright">
                <div class="container">Copyright © <?=date('Y')?>. All Rights Reserved.</div>
              </div>
            </footer> 
          </div>
          <!-- JavaScript files -->
          <script src="<?=site_url()?>fassets/js/jquery-1.12.4.min.js"></script>
          <script src="<?=site_url()?>fassets/js/bootstrap.min.js"></script><!-- bootstrap.min js-->
          <script src="<?=site_url()?>fassets/js/slick.min.js"></script><!-- slick js-->
          <script src="<?=site_url()?>fassets/js/bootstrap-select.min.js"></script><!-- Bootstrap selectbox js-->
          <script src="<?=site_url()?>fassets/js/custom.js"></script><!-- custom js-->
          <script src="<?=site_url()?>fassets/js/jquery.dd.js"></script>
          <script src="<?=site_url()?>fassets/js/intlTelInput.js"></script>
          <script src="<?=site_url()?>fassets/js/utils.js"></script>
          <script>
            $("input[type=tel]").intlTelInput();
          </script>
          <!-- selectbox js-->
          <script language="javascript" type="text/javascript">
            function showvalue(arg) {
        //alert(arg);
      }
      $(document).ready(function() {
        try {
          oHandler = $(".mydds").msDropDown().data("dd");
          $("#ver").html($.msDropDown.version);
        } catch(e) {
            //alert("Error: "+e.message);
          }
           $("#phoneNumber").keypress(function (e) {
          if (e.which != 8 && e.which != 0 && ((e.which < 48 && e.which !=32) || e.which > 57)) {
             return false;
          }
          
         })
        })
      </script>

      <script>
        function getLogin(){
          var uname = $('#login_username').val();
          var pass = $('#login_password').val();
          var redirect_url = '<?=site_url("edit-profile")?>';

          $.ajax({
            url: '<?=site_url('welcome/login_ajax')?>',
            type: 'POST',
            dataType: 'html',
            data: {uname:uname,password:pass},
          })
          .done(function(e) {
            if(e==1){
              window.location.href = redirect_url;
              $('#msg').html('<div class="alert alert-success"><b>User Authenticated..Please Wait..!!</b></div>');
            }else{
                //alert('Invalid mobile no or password');
                $('#msg').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Enter Valid Number and Password ..!!</b></div>');
                //$('#login_password').val('');
              }
            });

        }
      </script>

      <script>
        $(document).ready(function () {
          $("#type1").change(function () {
            var val = $(this).val();
            $.ajax({
              url: '<?=site_url('welcome/subservice_ajax')?>',
              type: 'POST',
              dataType: 'html',
              data: {subservice:val},
            })
            .done(function(e){
             $('#service_type').html(e);
           });

          });
        });
      </script>
      <script>
        $(document).ready(function () {
          $("#type2").change(function () {
            var val = $(this).val();
            $.ajax({
              url: '<?=site_url('welcome/subservice_ajax')?>',
              type: 'POST',
              dataType: 'html',
              data: {subservice:val},
            })
            .done(function(e){
             $('#service_type').html(e);
           });

          });
        });
      </script>
      <script>
        function getval(sel)
        {
          var id = sel.value;

          $.ajax({
            url: '<?=site_url('welcome/city_ajax')?>',
            type: 'POST',
            dataType: 'html',
            data: {id:id},
          })
          .done(function(e){
           $('#getcitylist').html(e);
         });


        }
      </script>
      <script>
        function sendOTP() {
          document.getElementById("sh_otp_no").style.display="block";
          document.getElementById("sh_mob_no").style.display="none";   
          $(".error").html("").hide();
          var number = $("#phoneNumber").val();
          var fullname = $("#fullname").val();
          var service = $("#service").val();
          var city = $("#city").val();
          var neighbor = $("#neighborhood").val();

          if(number.length < 7){
          alert('Please Enter Valid No');
          document.getElementById("sh_mob_no").style.display="block";  
          document.getElementById("sh_otp_no").style.display="none"; 
            return false;
          }
          if (number.length > 7 && number.length < 17) {
            var input = {
            "fullname":fullname,
            "mobile_number" : number,
            "service" : service,
            "city" : city,
            "neighborhood" : neighbor,
              "action" : "send_otp"
            };
            $.ajax({
              url : '<?=site_url('twilio/sendSms')?>',
              type : 'POST',
              data : input,
              dataType:'json',
              success : function(response) {
                if (response.type == 'success') {
                $(".success").html('<h4>One OTP Has been sent to your mobile number</h4>');
                $("#sh_otp_no").html("<div class='row'><div class='col-sm-6 col-md-offset-3'><div class='form-group'><label>Enter OTP</label><input type='text' class='form-control' id='mobileOtp'  placeholder='XXXX'/></div></div></div><div class='form-group text-center'><div class='group-btn'><button class='btn btn-info mt-20' onclick='verifyOTP()'>Verify OTP</button></div><p class='help-block'>Verify your number, if you have not taken our service from last 24 hours then you will be able to process the booking</p></div>");
              }
                else{
                document.getElementById("sh_otp_no").style.display="none"; 
                $("." + response.type).html(response.message)
                $("." + response.type).show(); 
                }
               },
                error : function() {
                 window.location.href = "<?=site_url('provider-list')?>?ser=" + service + "&city=" + city + "&neighbor=" + neighbor;
                 return false;
              }
            });
          } else {
            $(".error").html('Please enter a valid number!')
            $(".error").show();
          }
        }
      </script>
      <script>
        function verifyOTP() {
          $(".error").html("").hide();
          $(".success").html("").hide();
          var otp = $("#mobileOtp").val();
          var service = $("#service").val();
          var city = $("#city").val();
          var neighbor = $("#neighborhood").val();
          var input = {
            "otp" : otp,
            "service" : service,
            "city" : city,
            "neighborhood" : neighbor,
            "action" : "verify_otp"
          };
          if (otp.length == 6 && otp != null) {
            $.ajax({
              url : '<?=site_url('twilio/verify_OTP')?>',
              type : 'POST',
              dataType : "json",
              data : input,
              success : function(response) {
                if (response.type == 'success') {
                    window.location.href = "<?=site_url('provider-list')?>?ser=" + service + "&city=" + city + "&neighbor=" + neighbor;
                }
                else{
                $("." + response.type).html(response.message)
                $("." + response.type).show(); 
                }
              },
              error : function() {
                $("." + response.type).html(response.message)
                $("." + response.type).show(); 
              }
            });
          } else {
            $(".error").html('You have entered wrong OTP.')
            $(".error").show();
          }
        }
      </script>

   <script>
     jQuery(document).ready(function($) {
      var id = document.getElementById('citySelect').value;
       $.ajax({
        url: '<?=site_url('welcome/city_ajax')?>',
        type: 'POST',
        dataType: 'html',
        data: {id:id},
      })
       .done(function(e){
         $('#getcitylist').html(e);
       });
     });
   </script>
   <script>
     jQuery(document).ready(function($) {
      var id = document.getElementById('type1').value;
       $.ajax({
        url: '<?=site_url('welcome/subservice_ajax')?>',
        type: 'POST',
        dataType: 'html',
        data: {subservice:id},
      })
       .done(function(e){
         $('#service_type').html(e);
       });
     });
   </script>   <script>
     jQuery(document).ready(function($) {
      var id = document.getElementById('type2').value;
       $.ajax({
        url: '<?=site_url('welcome/subservice_ajax')?>',
        type: 'POST',
        dataType: 'html',
        data: {subservice:id},
      })
       .done(function(e){
         $('#service_type').html(e);
       });
     });
   </script>
   <script>
    $(document).ready(function(){
   document.getElementById("myBtn").disabled = true;
 
    $('#fname').keyup(function(){
        if($(this).val().length !=0){
        }
        else
        {
            document.getElementById("myBtn").disabled = true;      
        }
    })
      $('#lname').keyup(function(){
        if($(this).val().length !=0){
        }
        else
        {
            document.getElementById("myBtn").disabled = true;      
        }
    })
      $('#cname').keyup(function(){
        if($(this).val().length !=0){
        }
        else
        {
            document.getElementById("myBtn").disabled = true;      
        }
    })
         $("#phoneNumber").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && ((e.which < 48 && e.which !=32) || e.which > 57)) {
       return false;
    }
    
   })
        $('#cadr').keyup(function(){
        if($(this).val().length !=0){
        }
        else
        {
            document.getElementById("myBtn").disabled = true;      
        }
    })
        $('#psd').keyup(function(){
        if($(this).val().length !=0){
        }
        else
        {
            document.getElementById("myBtn").disabled = true;      
        }
    })
        $('#cpsd').keyup(function(){
        if($(this).val().length !=0){
        }
        else
        {
            document.getElementById("myBtn").disabled = true;      
        }
    })
/*image upload is not obligatory
        $('#img').keyup(function(){
        if($(this).val().length !=0){
        }
        else
        {
            document.getElementById("myBtn").disabled = true;      
        }
    })
*/
         $('#agreecheckbox').keyup(function(){
        if($(this).val().length !=0){
             document.getElementById("myBtn").disabled = false;      
        }
        else
        {
            document.getElementById("myBtn").disabled = true;      
        }
    })
 

});
   </script>
 <script>
          $("#phoneNumber").bind("keyup keydown", function() { 
    var mynum = $(this).val().replace(/ /g, "");
    var amount = parseFloat(mynum);
    //alert(mynum.length);
    if (amount) {
        if (amount.toString().length < 9 || amount.toString().length > 15) {
             document.getElementById("myBtn").disabled = true;
            $("span.phonealert").html("Your phone number length must be between 9 and 15");
        } else
    if(amount.toString().length < 16) {
             document.getElementById("myBtn").disabled = false;
            $("span.phonealert").html(" ");
            //$("span.phonealert").html("valid phone number");
        }
    } else {
        $("span.phonealert").html("Enter phone number in international format: +233 506433742");
    }
});
        </script>
        
<script>
    $(function(){
        $('#myBtn').click(function(){
          document.getElementById("otp_sub").disabled = true;
          
          var fnam = $('#fname').val();
          var lnam = $('#lname').val();
          //var cnam = $('#cname').val();
          var cadr = $('#cadr').val();
          var psd = $('#psd').val();
          var cpsd = $('#cpsd').val();
          var agreecheckbox = $('#agreecheckbox').val();
          
          var checked1 = document.getElementById('type1').checked;
          var checked2 = document.getElementById('type2').checked;
          var agreecheckbox = document.getElementById('agreecheckbox').checked;

          if (checked1 == false  &&  checked2 == false ) {
                alert('select business owner or service provider');
                 return;
          } 


          if (fnam.length < 1 ) {
                alert('first name is invalid');
                 return;
          } 

          if (lnam.length < 1 ) {
                alert('last name is invalid');
                 return;
          } 

          if (cadr.length < 1 ) {
                alert('company address is invalid');
                 return;
          } 

          if (psd.length <  1) {
                alert('fill in password');
                 return;
          } 

          if (agreecheckbox == false) {
                alert('please agree with terms');
                 return;
          } 

          if (psd != cpsd) {
                alert('passwords don\'t match');
                 return;
          } 
          
          var phonep = $('#phoneNumber').val();
          var phonep = phonep.replace(/ /g, "");
          if (phonep.length < 9 || phonep.length > 15) {
                alert('the phone nyumber is invalid');
                return;
          } 
          
          $.ajax({
            url: '<?=site_url('welcome/profile_otp_send')?>',
            type: 'POST',
            dataType: 'html',
            data: {phonep:phonep},
          })
           .done(function(e) {
            if(e==1){
              //window.location.href = redirect_url;
              $('#otp_msg').html('One OTP sent to your Phone Number');
              $('#otp_form').css('display','block');
              document.getElementById("myBtn").disabled = true;
            }else{
                $('#otm_msg').html('Phone number already exists!! Enter a new phone number');
              }
            });
        });
    })
    
</script>
   
    <script>
      $(function(){
          $('#otp_ver').click(function(){  
            document.getElementById("otp_sub").disabled = true;
          var otpp = $('#profile_otp').val();
          $.ajax({
            url: '<?=site_url('welcome/otpverify')?>',
            type: 'POST',
            dataType: 'html',
            data: {otpp:otpp},
          })
           .done(function(f) {
            if(f==1){
              //window.location.href = redirect_url;
              $('#otp_msg').html('OTP Verified..');
              $('#otp_form').css('display','block');
              $('#otp_ver').css('display','none');
            document.getElementById("otp_sub").disabled = false;
            }else{
                $('#otm_msg').html('You have entered wrong OTP');
              }
            });
           
        });
      })
     
      </script>
 </body>
 </html> 