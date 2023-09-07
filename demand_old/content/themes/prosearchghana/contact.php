<section id="banner1">
   <div class="blue-overlay"></div>
   <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
   <div class="banner-text">
    <h1>Contact Us</h1>
</div>
</section>
<!-- Content Start -->
<div id="content">
 <!-- Contact Us Section -->
 <section id="contact-us" class="section-block"> 
     <div class="container">
        <div class="row">
         <div class="col-sm-8">
             <h3>Write Us</h3>
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
             <form id="contact_form" action="<?=site_url('contact')?>" method="post">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group">
                             <label>First Name<span class="star">*</span></label>
                             <input type="text" name="frm[firstname]" class="form-control" />
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group">
                             <label>Last Name<span class="star">*</span></label>
                             <input type="text" name="frm[lastname]" class="form-control" />
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group">
                             <label>Email</label>
                             <input type="text" name="frm[email]" class="form-control"/>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group">
                             <label>Phone Number<span class="star">*</span></label>
                             <input type="tel" name="frm[phone]" minlength="7" maxlength="17" class="form-control"  id="phoneNumber"/>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                    <label>Message<span class="star">*</span></label>
                    <textarea class="form-control" name="frm[message]"></textarea>
                </div>
                <div class="form-group">
                 <input type="submit" class="btn btn-info" value="SEND" id="attending_btn"/>
             </div>
         </form>
     </div>
     <div class="col-sm-4">
         <h3>Our Office Address</h3>
         <address>
             <p><i class="fa fa-map-marker" aria-hidden="true"></i><?=theme_option('address')?></p>
             <p><i class="fa fa-phone" aria-hidden="true"></i><?=theme_option('phone')?></p>
             <p><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:<?=theme_option('email')?>"><?=theme_option('email')?></a></p>
         </address>
     </div>
 </div>
</div>
</section>
<!-- Contact Map -->
<div class="contact-map">
    <div id="map" class="map inside-full-height">
        <?=theme_option('map')?>
    </div>
</div>
</div>  
<style>
  .star{
    color:red;
  }
</style>