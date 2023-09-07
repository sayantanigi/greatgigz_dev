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
