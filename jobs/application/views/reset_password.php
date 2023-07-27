<?php 
    $seg2= $this->uri->segment(2);
    $email=base64_decode($seg2);
    ?>

<div class="page_banner banner price-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="banner-heading">Reset Password</div>
				</div>
			</div>
		</div>
	</div>
	<main>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="page-tab">
						<div id="form">
							<div id="userform">
								<ul class="nav nav-tabs nav-justified" role="tablist">
									
								</ul>
								<div class="tab-content">
								<div class="tab-pane fade active in" id="login">
									<form id="login_form" method="post" action="#">
										<div class="form-group">
									
										 <span class="text-danger text-center f-30"><?=$this->session->flashdata('error');  ?></span>
                                      </div>
										 <input type="hidden" id="email" name="email" value="<?= $email?>">
										<div class="form-group">
											<label>Password<span style="color:red">*</span><span id="err_password"></span></label>
											<input type="password" class="form-control" name="password" id="new_password"  autocomplete="off" >
											<div class="search_icon"><span class="ti-user"></span></div>
										</div>
										<div class="form-group">
											<label>Reset Password<span style="color:red">*</span><span id="err_confirmpassword"></span></label>
											<input type="password" class="form-control" name="cpassword" id="confirm_password"  autocomplete="off" >
											<div class="search_icon"><span class="ti-user"></span></div>
										</div>
											<div  class="form-group">
												<label id="matchPass2"></label>
											</div>
										<div class="mrgn-30-top">
											<button type="button" class="btn btn-larger btn-block" onclick="newpassword()"/>Submit</button>
										</div>
									</form>
								</div>
								
							</div>
						</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</main>

	

            <script>
                function newpassword()
                {
                  
        var base_url=$('#base_url').val();
        var password=$("#new_password").val();
        var cpass=$("#confirm_password").val();
        var email=$("#email").val();

         if(password=="")
         {
                 $("#err_password").fadeIn().html("Please enter password").css('color','red');
                 setTimeout(function(){$("#err_password").html("&nbsp;");},3000);
                 $("#new_password").focus();
                 return false;
         }
          if(password.length<6)
{
  $('#err_password').fadeIn().html('please enter at least 6 character').css('color','red');
    setTimeout(function(){$("#err_password").html("&nbsp;");},3000);
    $("#new_password").focus();
    return false;
}
        
            if(cpass=="")
         {
                 $("#err_confirmpassword").fadeIn().html("Please enter Confirm password").css('color','red');
                 setTimeout(function(){$("#err_confirmpassword").html("&nbsp;");},3000);
                 $("#confirm_password").focus();
                 return false;
         }
             if(password!=cpass){
             $('#matchPass2').html('Password does not match').css('color','red');
             return null
         }
         $.ajax({
             type:'post',
             cache:false,
             url:base_url+'user/login/resetpassword_action',
             data:{
                 email:email,
                 password:password,
                 cpass:cpass,
             },
             success:function(result)
             {
                 //alert(result); return false;
                     if(result==1)
                     {
                        
                         window.location.href=base_url+'login';
                     }
                     else{
                         location.reload();
                     }
                    
             }

         }); 
                }
            </script>