<section id="banner1">
 <div class="blue-overlay"></div>
 <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
 <div class="banner-text">
    <h1>Our Services</h1>
</div>
</section>

<!-- Content Start -->
<div id="content">
   <!-- Our team section -->
   <section id="our-team" class="section-block our-team2">
       <div class="container">
        <div class="row">
            <?php if(is_array($service) && count($service)>0){
                foreach($service as $sr){
                    ?>
                    <div class="col">
                       <div class="img"><a href="<?=site_url('auth-number')?>"><img src="<?=site_url('assets/images/service/'.$sr->image)?>" alt="" /></a></div>
                       <div class="name"><a href="<?=site_url('auth-number')?>"><?=$sr->title?></a></div> 
                       <p><?=$sr->meta_description?></p>
                   </div>
                   <?php
               }
           } ?>

       </div>
   </div>
</section> 
</div>    