<section id="banner" class="banner-slider">
    <div class="banner-img-slider">
    <?php if(is_array($banner) && count($banner)>0){
        foreach ($banner as $bn) {
        ?>
        <div>
            <div class="banner-thumb"><img src="<?=site_url('assets/images/teams/'.$bn->img)?>" alt="" class="hide" /></div>
        </div>
        <?php
        }
    } ?>
    </div>
    <div class="blue-overlay"></div>
    <div class="banner-text-wrapper">
        <div class="container">
            <div class="banner-text">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <h1><?=theme_option('lt')?></h1>
                        <p><?=theme_option('lst')?></p>
                        <div class="search-wrapper">
                            <div class="row">
                                <form method="post" action="<?=site_url('provider-not-found')?>">
                                    <div class="col-12">
                                        <div class="service-list">
                                            <select class="form-control" name="service">
                                                <option value="" selected="selected">I am looking for:</option>
                                                <?php if(is_array($sub_service) && count($sub_service)>0) {
                                                usort($sub_service, function ($a, $b) {
                                                    return strcmp($a->name, $b->name);
                                                });
                                                foreach ($sub_service as $sub_service_v) { ?>
                                                <option value="<?=$sub_service_v->id?>"><?=$sub_service_v->name?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-control" onchange="getval(this);" name="city" required>
                                        <option value="" selected="selected">Select State</option>
                                        <?php if(is_array($city) && count($city)>0){
                                        foreach ($city as $ct) { ?>
                                            <option value="<?= $ct->id ?>"><?=$ct->name?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="col-12"  id="getcitylist">
                                        <select class="form-control" name="neihborhood" required>
                                            <option value="" selected="selected">Select City</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <?php if(!isprologin()) { ?>
                                        <button class="btn search-btn" type="submit">Find</button>
                                        <?php } else { ?>
                                        <button class="btn search-btn" disabled="" type="submit">Find</button>
                                        <?php } ?>
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

<!-- Content Start -->
<!-- Our services Section -->
<div id="content">
    <section id="services" class="section-block">
        <div class="container">
            <div class="top-desc text-center">
                <h2>Most commonly used services</h2>
                <h3 class="blahblah"  style="font-size:20px; color:black"> </h3> 
            </div>
            <p></p>
            <br>
            <div class="row" >
                <div class="col-md-2 col-sm-6" style="text-align:center;">
                    <img src="assets/images/service/car.png"  alt="car mechanic" class="imgcenter" title="Car Mechanic" width="150" height="150"/>
                    <h4 style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Car Mechanic</h4>
                </div>    

                <div class="col-md-2 col-sm-6" style="text-align:center;">
                    <img src="assets/images/service/carpenter.png"  alt="carpenter" class="imgcenter" title="Carpenter" width="150" height="150"/>
                    <h4 style="text-align:center">Carpenter</h4>
                </div>    

                <div class="col-md-2 col-sm-6" style="text-align:center;">
                    <img src="assets/images/service/plumber.png"  alt="plumber" class="imgcenter" title="Plumber" width="150" height="150"/>
                    <h4 style="text-align:center">Plumber</h4> 
                </div>    

                <div class="col-md-2 col-sm-6" style="text-align:center;">
                    <img src="assets/images/service/outlet.png"  alt="electrician" class="imgcenter" title="Electrician" width="150" height="150"/>
                    <h4 style="text-align:center">Electrician</h4> 
                </div>    

                <div class="col-md-2 col-sm-6" style="text-align:center;">
                    <img src="assets/images/service/paint-roller.png"  alt="painter" class="imgcenter" title="Painter" width="150" height="150"/>
                    <h4 style="text-align:center">Painter</h4> 
                </div>    

                <div class="col-md-2 col-sm-6" style="text-align:center;">
                    <img src="assets/images/service/cleaning.png" alt="cleaning" class="imgcenter" title="Cleaning" width="150" height="150"/>
                    <h4 style="text-align:center">Cleaner</h4>
                </div>
            </div>
        </div>
    </section>
    <hr style="height:2px;border-width:0;color:red;background-color:red">
    <!-- How it works Section -->
    <section id="how-works" class="section-block">
        <div class="container">
            <div class="top-desc">
                <h2>How it works</h2>
                <p class="sub-heading"> </p>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                    <div class="name"><?=theme_option1('hth1')?></div>
                    <p><?=theme_option1('hd1')?></p> 
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="icon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div>
                    <div class="name"><?=theme_option1('hth2')?></div>
                    <p><?=theme_option1('hd2')?></p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="icon"><i class="fa fa-list-alt" aria-hidden="true"></i></div>
                    <div class="name"><?=theme_option1('hth3')?></div>
                    <p><?=theme_option1('hd3')?></p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="icon"><i class="fa fa-gear" aria-hidden="true"></i></div>
                    <div class="name"><?=theme_option1('hth4')?></div>
                    <p><?=theme_option1('hd4')?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Provider Section --> 
    <section id="service-provider">
        <div class="row-height">
            <div class="col-lg-4 col-sm-height">
                <div class="inside-full-height left-part">
                    <h2>largest home Service Provider</h2>
                </div>
            </div>
            <div class="col-lg-8 col-sm-height right-part">
                <div class="inside-full-height">
                    <div class="row">
                        <div class="col-lg-5 col-sm-6">
                            <div class="row-height">
                                <div class="col-sm-height icon"><span><i class="fa fa-support" aria-hidden="true"></i></span></div>
                                <div class="col-sm-height support">
                                    <span class="time">24/7</span>
                                    <span class="text">online<br>support</span>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-5 col-sm-6">
                        <div class="row-height">
                            <div class="col-sm-height icon"><span><i class="fa fa-phone" aria-hidden="true"></i></span></div>
                                <div class="col-sm-height call-us">
                                    <span class="text">Call us toll free:</span>
                                    <span class="num"><?=theme_option('tollfree')?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Exceptional Quality Section -->
    <section id="exceptional-quality" class="section-block">
        <div class="blue-overlay"></div>
        <div class="container">
            <div class="h1">Exceptional quality</div>
            <div class="h1">Make Life Easy</div>
            <a href="<?=site_url('about')?>" class="btn btn-info">Read More</a> 
        </div>
    </section>

    <!-- Our Customers Section -->
    <section id="our-customers" class="section-block">
        <div class="container">
            <div class="top-desc">
                <h2>Our Happy Customers</h2>
                <p class="sub-heading">and what they are saying</p>
            </div>
            <div class="row">
                <?php if(is_array($testimonial) && count($testimonial)>0) {
                foreach ($testimonial as $t) { ?>
                <div class="col-md-3 col-sm-6">
                    <div class="img"><img src="<?=site_url('assets/images/testimonial/'.$t->image)?>" alt="" /></div>
                    <div class="name"><?=$t->name?></div>
                    <?=$t->description?>
                </div>
                <?php } } ?>
            </div>
        </div>
    </section>

    <!-- Our services Section -->
    <section id="our-services" class="section-block">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="icon-box"><i class="icon icon-verifiedprofessionals" aria-hidden="true"></i></div>
                    <div class="name"><?=theme_option('l1');?></div>
                    <p><?=theme_option('l2');?></p>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="icon-box"><i class="icon icon-insuredwork" aria-hidden="true"></i></div>
                    <div class="name"><?=theme_option('l3');?></div>
                    <p><?=theme_option('l4');?></p>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="icon-box"><i class="icon icon-satisfactionguaranteed" aria-hidden="true"></i></div>
                    <div class="name"><?=theme_option('l5');?></div>
                    <p><?=theme_option('l6');?></p>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    .city-select{border: none; font-size: 18px; font-weight: 500; display: block; }
</style>

<style>
    .imgcenterxx {padding-left: 10px; padding-right: 10px; padding-bottom: 10px; padding-top: 10px}    
</style>
<script type="text/javascript" src="<?=site_url()?>fassets/js/jquery-1.6.1.min.js"></script>