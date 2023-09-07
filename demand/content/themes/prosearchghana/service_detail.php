<section id="banner1">
 <div class="blue-overlay"></div>
 <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
 <div class="banner-text">
  <h1>Finding you quality <?=$service_detail->title?> in your community</h1>
</div>
</section>

<!-- Content Start -->
<div id="content">
 <!-- Service Detail -->
 <section class="service-detail-wrapper">
   <div class="container">
     <div class="top-desc text-center">
      <h2>Service Detail</h2>
    </div>
    <div class="row">
     <div class="col-md-8 col-md-offset-2">
      <?php $this->load->view('alert'); ?>
       <form method="post" action="<?=site_url('welcome/process_enquiry')?>">
         <div class="row">
           <div class="col-sm-12">
             <div class="form-group">
               <input type="text" class="form-control" value="<?=@$detail->fname?>" name="frm[name]" placeholder="Name" required/>
             </div>
           </div>
           
         </div>
         <div class="row">
           <div class="col-sm-6">
             <div class="form-group">
               <input type="email" class="form-control" value="<?=@$detail->email?>" name="frm[email]" placeholder="Email Address" required/>
             </div>
           </div>
           <div class="col-sm-6">
             <div class="form-group">
               <input type="text" class="form-control" value="<?=@$detail->mobile?>" name="frm[mobile]" placeholder="Mobile Number" required/>
             </div>
           </div>
         </div>
         <div class="row">
           <div class="col-sm-12">
             <div class="form-group">
               <textarea class="form-control" placeholder="Address" name="frm[address]" required></textarea>
             </div>
           </div>
         </div>
         <div class="row">
           <div class="col-sm-6">
             <div class="form-group">
               <select class="form-control" readonly name="frm[service]">
                <option value="<?=$service_detail->id?>"><?=$service_detail->title?></option>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
           <div class="form-group">
             <select class="form-control" name="frm[subservice]" required>
              <?php if(is_array($subservice) && count($subservice)>0){
                foreach ($subservice as $sub) {
                  ?>
                  <option value="<?=$sub->id?>"><?=$sub->name?></option>
                  <?php
                }
              } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
       <div class="col-sm-6">
         <div class="form-group">
           <select class="form-control" onchange="getval(this);"  name="frm[city]" required>
            <option>Select City</option>
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
     <div class="col-sm-6">
       <div class="form-group" id="getcitylist">
         <select class="form-control">
          <option>Select Neighbourhood</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
   <div class="col-sm-6">
    <div class="form-group">
     <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
      <input class="form-control" size="16" type="date" placeholder="Pick a Date" name="frm[ser_date]" required>
      <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
    </div>
  </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
   <div class="input-group date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
    <input class="form-control" size="16" type="time" placeholder="Pick a Time" name="frm[ser_time]" required>
    <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
  </div>
</div>
</div>
</div>
<div class="form-group text-center">
 <div class="group-btn">
   <button  class="btn btn-info" type="submit">Next</button>
 </div>
 <p class="help-block">We will contact you within Two hours </p>
</div>
<div class="scedule-detail">
 <ul>
   <li>$ 199 will be charged for 1ST hour.</li>
   <li>$ 99 will be charged for next 30 minutes following to 1st hour.</li>
   <li>$ 99 will be charged in case of Inspection only.</li>
   <li>Material procurement time will be included in service time.</li>
   <li>Required Material cost is excluded from above cost.</li>
 </ul>
</div>
</form>
</div>
</div>
</div>
</section>
<!-- Plumbing Services -->
<?php if(!empty($service_detail->description)){ ?>
  <section id="plumbing-services" class="section-block">
   <div class="container">
     <div class="top-desc text-center">
      <h2>Our Plumbing Services</h2>
      <p class="sub-heading">---</p>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <?=$service_detail->description?>
      </div>
    </div>
  </div>
</section>
<?php } ?>
<!-- Our features section -->
<section id="our-features" class="section-block">
 <div class="container">
  <div class="row">
   <div class="col-sm-3">
     <span class="icon-box"><i class="icon icon-serviceguarantee" aria-hidden="true"></i></span>
     <div class="name">Service Guarantee</div> 
     <p>---</p>
   </div>
   <div class="col-sm-3">
     <span class="icon-box"><i class="icon icon-24x7support" aria-hidden="true"></i></span>
     <div class="name">24 x 7 Support</div> 
     <p>---</p>
   </div>
   <div class="col-sm-3">
     <span class="icon-box"><i class="icon icon-insuranceclaim" aria-hidden="true"></i></span>
     <div class="name">Insurance Claim</div> 
     <p>---</p>
   </div>
   <div class="col-sm-3">
     <span class="icon-box"><i class="icon icon-trainedcertified" aria-hidden="true"></i></span>
     <div class="name">Trained & Certified</div> 
     <p>---</p>
   </div>
 </div>
</div>
</section>  
<!-- Our services Section -->
<section id="services" class="section-block">
 <div class="container">
   <div class="top-desc text-center">
    <h2>Explore our Services</h2>
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
</div>
<style>
  select.bs-select-hidden, select.selectpicker {
   display: block !important; 
 }
</style>

<script>
  function getval(sel)
  {
    var id = sel.value;

    $.ajax({
      url: '<?=site_url('welcome/city_ajax')?>',
      type: 'POST',
      dataType: 'html',
      data: {id:id},
    })
    .done(function(e){
     $('#getcitylist').html(e);
   });

    
  }
</script>
