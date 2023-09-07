 <!-- Banner Section -->
        <section id="banner1">
      <div class="blue-overlay"></div>
      <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
      <div class="banner-text">
        <h1>Forgot Password </h1>
      </div>
    </section>
        
        <!-- Content Start -->
        <div id="content">
      <section class="section-block">
              <div class="container">
          <div class="row">
            <!-- edit form column -->
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12 personal-info">
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
                 
                    ?>        
              <form class="form-horizontal" role="form" action="<?=site_url('forgot-password')?>" method="post">
              
             <div class="form-group">
                <label class="col-lg-12">Enter Your Phone Number:<span class="star">*</span></label>
                <div class="col-lg-12">
                  <input class="form-control" autocomplete="off" type="tel"  id="phoneNumber" minlength="7" maxlength="17" name="contact_prsn_mobile">
                </div>
              </div>
               
              <div class="form-group">
                <div class="col-md-12">
                <input class="btn btn-primary" value="Submit" type="submit">
                </div>
              </div>
              </form>
            </div>
            </div>
                </div>
            </section>
        </div>