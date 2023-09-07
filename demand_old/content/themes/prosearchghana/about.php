 <!-- Banner Section -->
 <section id="banner1">
     <div class="blue-overlay"></div>
     <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
     <div class="banner-text">
        <h1><?=$abt->title?></h1>
    </div>
</section>

<!-- Content Start -->
<div id="content">
   <!-- Our Story -->
   <section id="our-story" class="section-block">
       <div class="container">
           <div class="top-desc text-center">
            <h2><?=$abt->meta_title?></h2>
            <p class="sub-heading">---</p>
        </div>
        <?=$abt->description?>
    </div>
</section>
<!-- Our info section -->
<section id="our-info" class="section-block">
   <div class="blue-overlay"></div>
   <div class="container">
       <div class="row">
           <div class="col-sm-4">
               <i class="icon icon-empowered" aria-hidden="true"></i>
               <h3><span class="counter">150,000</span>+</h3>
               <p>Empowered</p>
           </div>
           <div class="col-sm-4">
               <i class="icon icon-borrowed" aria-hidden="true"></i>
               <h3>over<span class="counter"> 1</span> million+</h3>
               <p>lives improved</p>
           </div>
           <div class="col-sm-4">
               <i class="icon icon-rating" aria-hidden="true"></i>
               <h3>Customer</h3>
               <p>Rating</p>
           </div>
       </div>
   </div>
</section>
<!-- Our services Section -->
<section id="services" class="section-block">
   <div class="container">
       <div class="top-desc text-center">
        <h2>our Services</h2>
        <p class="sub-heading">---</p>
    </div>
    <div class="service-slider">
        <?php if(is_array($service) && count($service)>0){
            foreach($service as $sr){
                ?>
                <div class="col-md-3 col-sm-6">
                 <a href="<?=site_url('service')?>">
                    <div class="img"><img src="<?=site_url('assets/images/service/'.$sr->image)?>" alt="" /></div>
                    <span class="name"><?=$sr->title?></span>
                </a>
            </div>
            <?php
        }
    } ?>
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