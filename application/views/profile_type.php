<?php 
 if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
     $banner_img=base_url("uploads/banner/".$get_banner->image);
            } else{
       $banner_img=base_url("assets/images/resource/mslider1.jpg");
        } ?>
 <section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url('<?= $banner_img ?>') repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
        <!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>Login</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="block remove-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-popup-area signin-popup-box static">
                        <div class="account-popup">
                            <h3>Choose Profile Type</h3>
                           <!--  <span>Lorem ipsum dolor sit amet consectetur adipiscing elit odio duis risus at lobortis ullamcorper</span> -->
                            <span class="text-success f-15"><?=$this->session->flashdata('success');  ?></span>
                            <span class="text-danger f-15"><?=$this->session->flashdata('error');  ?></span>
                            <form action="<?=base_url(); ?>validate" method="post">
                                
                                <div class="dropdown-field">
                                    <select name="service" class="chosen" id="service">
                                    <option value="">Employer</option>
                                    <option value="">Worker</option>
                                    <option value="">Jobs</option>
                                      
                                    </select>
                                </div> 
                               
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!-- LOGIN POPUP -->
                </div>
            </div>
        </div>
    </div>
</section>

            