 <!-- Banner Section -->
        <section id="banner1">
      <div class="blue-overlay"></div>
      <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
      <div class="banner-text">
        <h1>Provider Registration</h1>
      </div>
    </section>
        
        <!-- Content Start -->
        <div id="content">
      <section class="section-block">
              <div class="container">
          <div class="row">
            <!-- edit form column -->
            <div class="col-lg-8 col-lg-offset-1 col-md-8 col-md-offset-1 col-sm-12 col-xs-12 personal-info">
            <p class="pro-head">Please provide your Business/Service information below to create your account.</p>
             <?php
                    if($this -> session -> flashdata('success')){
                        ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this -> session -> flashdata('success'); ?>
                        </div>
                        <?php
                    }
                    if($this -> session -> flashdata('error')){
                        ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this -> session -> flashdata('error'); ?>
                        </div>
                        <?php
                    }
                    $err = validation_errors();
                    if($err){
                        ?>
                        <div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $err; ?>
                        </div>
                        <?php
                    }
                    ?> 
                    <div id="profile_form">         
              <form class="form-horizontal" role="form" action="<?=site_url('create-profile')?>" method="post" enctype="multipart/form-data">
<!--              
              <div class="form-group">
                <label class="col-lg-4 control-label">Business/Service Provider:<span class="star">*</span></label>
                <div class="col-lg-8">
                <select class="form-control" id="type" name="frm[owner_type]">
                          <option value="1" <?php echo set_select('frm[owner_type]', 1, False); ?> >Business Owner</option>
                          <option value="2" <?php echo set_select('frm[owner_type]', 2, False); ?> >Service Provider</option>
                        </select>
                </div>
              </div>
-->
              <div class="form-group">
                  <label class="col-lg-4 control-label">Business Owner/Service Provider/Artisan:<span class="star">*</span></label>
                <div class="col-lg-8">
                  <input type="radio" id="type1" name="frm[owner_type]" value="1">
                  <label>I own a business</label> &nbsp;&nbsp;
                
                  <input type="radio" id="type2" name="frm[owner_type]" value="2">
                  <label>I am a Service Provider/Artisan</label>
                
                </div>  
            </div>
              
              
              <div class="form-group">
                <label class="col-lg-4 control-label">Business/Service Type:<span class="star">*</span></label>
                <div class="col-lg-8" id="service_type">
                <select class="form-control" name="frm[service_type]">
                  <option value="">-- select one -- </option>
                </select>
                </div>
              </div>
                <div class="form-group">
                <label class="col-lg-4 control-label">Contact Person Name:<span class="star">*</span></label>
                <div class="col-lg-4">
                <input class="form-control " autocomplete="off" type="text" name="frm[contact_prsn_fname]" placeholder="First Name" id="fname" value="<?php echo set_value('frm[contact_prsn_fname]'); ?>">
                </div>
                <div class="col-lg-4">
                <input class="form-control"  id="lname" autocomplete="off" type="text" name="frm[contact_prsn_lname]" placeholder="Last Name" value="<?php echo set_value('frm[contact_prsn_lname]'); ?>">
                </div>
              </div>      
              <div class="form-group">
                <label class="col-lg-4 control-label">Company Name:</label>
                <div class="col-lg-8">
                <input class="form-control"  id="cname" autocomplete="off" type="text" name="frm[company_name]" value="<?php echo set_value('frm[company_name]'); ?>">
                </div>
              </div>
              
              
              <div class="form-group">
                <label class="col-lg-4 control-label">Contact Person Number:<span class="star">*</span></label>
                <div class="col-lg-8">
                <input class="form-control" autocomplete="off" type="tel"  id="phoneNumber" minlength="9" name="frm[contact_prsn_mobile]" value="<?php echo set_value('frm[contact_prsn_mobile]'); ?>">
                <span class="phonealert"></span>

                </div>
              </div>
            
              <div class="form-group">
                  <label class="col-lg-4 control-label">Government Issued ID/Photo ID  /Other:</label>
                  <div class="col-lg-8">
                      <img src="<?=site_url('assets/images/profile/'.$pdetail->image)?>" onerror="this.src='<?=site_url()?>assets/images/no-image.png';" class="img-responsive" style="width:150px">
                      
                      <input type="file" name="image" id="img" value="<?=$pdetail->image?>" class="form-control">
                    </div>
             </div>
             
              <div class="form-group">
                <label class="col-lg-4 control-label">Company Address/Your Location:<span class="star">*</span></label>
                <div class="col-lg-8">
                <input class="form-control" id="cadr" autocomplete="off" type="text" name="frm[company_addr]" value="<?php echo set_value('frm[company_addr]'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Select State:<span class="star">*</span></label>
                <div class="col-lg-8">
                <div class="ui-select">
                   <select class="form-control" onchange="getval(this);"  name="frm[city]" id="citySelect">
                      <?php if(is_array($city) && count($city)>0){
                        foreach ($city as $ct) {
                         ?>
                         <option value="<?=$ct->id?>"><?=$ct->name?></option>
                         <?php  
                       }
                     } ?>       
                  </select>
                 
                </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Select City:</label>
                <div class="col-lg-8">
                <div class="ui-select" id="getcitylist">
                  <select class="form-control" name="neihborhood">
                    <option value="">Select City</option>
                  </select>
                </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Password:<span class="star">*</span></label>
                <div class="col-lg-8">
                <input class="form-control" id="psd"  type="password" name="password" value="<?php echo set_value('password'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Confirm Password:<span class="star">*</span></label>
                <div class="col-lg-8">
                <input class="form-control" id="cpsd"  type="password" name="con_pass" value="<?php echo set_value('con_pass'); ?>">
                </div>
              </div>

              <div class="form-group">
                <?php
                
                        $useragent=$_SERVER['HTTP_USER_AGENT'];
                        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                
                        { 
                            //echo "mobile";
                            echo '<div style = "position:relative; left:1px;" class="col-md-10">';
                        }
                        else{
                            //echo "desktop";
                            echo '<div style = "position:relative; left:260px;" class="col-md-10">';
                        }
                ?>                  
                  
<!--
                <input class="checkbox1" type="checkbox" id="agreecheckbox" name="agreecheckbox" value="1" required>
-->
                <input type="checkbox" id="agreecheckbox" name="agreecheckbox" value="1" required>
                <label for="agreecheckbox" class="checkbox1">By registering you agree to our <a href="<?=base_url('terms-and-conditions')?>">T&C </a> and <a href="<?=base_url('privacy-policy')?>">Privacy Policy</a>.<span class="star">*</span></label>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-8">
                    <button class="btn btn-primary" id="myBtn">Continue</button>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                <label id="otm_msg" style="color:red"></label>
                <label id="otp_msg" style="color:green"></label>
                </div>
              </div>

            <div id="otp_form" style="display: none;">
               <div class="form-group">
                <label class="col-lg-4 control-label">Mobile OTP:<span class="star">*</span></label>
                <div class="col-lg-4">
                <input class="form-control" autocomplete="off"  type="text" id="profile_otp" name="profile_otp" required placeholder="Enter OTP">
                </div>
                <div class="col-md-4">
                <a href="javascript:void(0);" class="btn btn-warning" id="otp_ver">Verify</a>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-8">
                <input class="btn btn-primary" value="Register" id="otp_sub" type="submit" >
                </div>
              </div>
            </div>
            </div>
              </form>
            </div>
            </div>
                </div>
            </section>
        </div>
        <style>
          .star{
            color:red;
          }
          .phonealert{
            color:red;
          }
          .chkbox {
           padding-left: 20px;
           font-weight: bold;
          }
          .checkbox1 {
              display: inline-block;
              vertical-align: center;
              padding-left: 1px;
              position: relative;
          }
        
          .checkbox1 input {
              position: absolute;
              left: 0;
              top: 0;
          }       
          .input[type=checkbox] + label {
            display: inline-block;
            margin-left: 0.5em;
            margin-right: 2em;
            line-height: 1em;
          }          
        </style>
 