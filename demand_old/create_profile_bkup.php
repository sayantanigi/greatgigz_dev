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
              <form class="form-horizontal" role="form" action="<?=site_url('create-profile')?>" method="post">
              
              <div class="form-group">
                <label class="col-lg-4 control-label">Business/Service Provider:<span class="star">*</span></label>
                <div class="col-lg-8">
                <select class="form-control" id="type" name="frm[owner_type]">
                  <option value="">-- select one -- </option>
                          <option value="1" <?php echo set_select('frm[owner_type]', 1, False); ?> >Business Owner</option>
                          <option value="2" <?php echo set_select('frm[owner_type]', 2, False); ?> >Service Provider</option>
                        </select>
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
                <label class="col-lg-4 control-label">Company Name:<span class="star">*</span></label>
                <div class="col-lg-8">
                <input class="form-control"  id="cname" autocomplete="off" type="text" name="frm[company_name]" value="<?php echo set_value('frm[company_name]'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Contact Person Number:<span class="star">*</span></label>
                <div class="col-lg-8">
                <input class="form-control" autocomplete="off" type="tel"  id="phoneNumber" minlength="7" maxlength="17" name="frm[contact_prsn_mobile]" value="<?php echo set_value('frm[contact_prsn_mobile]'); ?>">
                <span class="phonealert"></span>

                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Company Address:<span class="star">*</span></label>
                <div class="col-lg-8">
                <input class="form-control" id="cadr" autocomplete="off" type="text" name="frm[company_addr]" value="<?php echo set_value('frm[company_addr]'); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Select City:<span class="star">*</span></label>
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
                <label class="col-lg-4 control-label">Select Neighborhood:</label>
                <div class="col-lg-8">
                <div class="ui-select" id="getcitylist">
                  <select class="form-control" name="neihborhood">
                    <option value="">Select Neighbourhood</option>
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
                <label class="col-md-4 control-label"></label>
                <div class="col-md-8">
                <input class="btn btn-primary" value="Register" id="myBtn" type="submit" >
                </div>
              </div>
            </div>
            <div id="otp_form" style="display: none;">
               <div class="form-group">
                <label class="col-lg-3 control-label">Mobile OTP:<span class="star">*</span></label>
                <div class="col-lg-8">
                <input class="form-control" autocomplete="off"  type="text" name="profile_otp" required>
                </div>
              </div>
               
              <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-8">
                <input class="btn btn-primary" value="Verify" type="submit">
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
        </style>

