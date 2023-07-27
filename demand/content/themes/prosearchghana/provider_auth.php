 <!-- Banner Section -->
        <section id="banner1">
      <div class="blue-overlay"></div>
      <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
      <div class="banner-text">
        <h1>Authenticate Provider </h1>
      </div>
    </section>
        
        <!-- Content Start -->
        <div id="content">
      <section class="section-block">
              <div class="container">
          <div class="row">
            <!-- edit form column -->
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 personal-info">
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
              <form class="form-horizontal" role="form" action="<?=site_url('welcome/otpverify')?>" method="post">
              
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
              </form>
            </div>
            </div>
                </div>
            </section>
        </div>