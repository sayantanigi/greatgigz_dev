        <!-- Banner Section -->
        <section id="banner1">
      <div class="blue-overlay"></div>
      <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
      <div class="banner-text">
        <h1>Service Provider List</h1>
      </div>
    </section>
        
        <!-- Content Start -->
        <div id="content">
      <section class="section-block">
              <div class="container">
          <div class="row">
          <!-- Single Destination List -->
            <?php
                    if($this -> session -> flashdata('error')){
                        ?>
                       <h4 style="color:#ff8100;"><?php echo $this -> session -> flashdata('error'); ?></h4>
                        <?php
                    }
                   
                    ?> 

          <?php if(is_array($provider_detl) && count($provider_detl)>0)
          {
            foreach ($provider_detl as $provider_detlv) 
            {
              $own_t=$this->db->get_where('service',array('id'=>$provider_detlv->owner_type,'status'=>1))->row();
              $s_type=$this->db->get_where('sub_service',array('id'=>$provider_detlv->service_type,'status'=>1))->row();
              $ct =$this->db->get_where('city',array('id' =>$provider_detlv->city))->row();
              $ne =$this->db->get_where('city',array('id' =>$provider_detlv->neihborhood))->row();
              ?>
          <div class="col-lg-6 col-md-9">
            <article class="destination-box list-style">
              <div class="row">
                <div class="col-md-4 col-sm-4">
                  <div class="blah">
                    <a href="#">
                      <img src="<?=site_url('assets/images/profile/'.$provider_detlv->image)?>" width="90" height="90" class="blah destination-box-img"  onerror="this.src='<?=site_url()?>assets/images/no-image.png';" alt="">
                    </a>
                  </div>
                </div>
                <div class="col-md-7 col-sm-7"> 
                  <div class="inner-box">
                    <div class="box-inner-ellipsis">
                      <div style="margin: 0px; padding: 0px; border: 0px;">
                        <span class="service-head"></be><?=$s_type->name?></span>
                        
                        <h3 class="entry-title">
                          <a href="<?=site_url('auth-number')?>"><br><?=$provider_detlv->company_name?></a>
                        </h3>
                        <div class="entry-content">
                          <p><i class="fa fa-user"></i> <?=$provider_detlv->contact_prsn_fname.' '.$provider_detlv->contact_prsn_lname?>
                          &nbsp;&nbsp;<i class="fa fa-phone"></i> <?=$provider_detlv->contact_prsn_mobile?></p>
                          <p>Rating: <?php 
                          $cn=$provider_detlv->rating;
                          if($cn==0){ echo "<b>Not yet rated</b>";}else{
                          for ($i=0; $i<$cn; $i++) { 
                          ?>
                          <i class="fa fa-star"></i>
                          <?php } } ?></p>

                          <p><b>Address:</b> <?=$provider_detlv->company_addr.', '.$ne->name.', '.$ct->name ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
          <span> <?php $pid[]= $provider_detlv->id;
        $val= implode(",",$pid);
         $ids = explode(",", $val); ?></span>
        <?php

         } } ?>
          <!-- Single Destination List -->
        </div>
        <div class="row">
        </div>
        <div class="row">
        
          <?php
         
        $this->db->select("*");
        $this->db->from('provider_list');
        $this->db->where('status', 1);
        $this->db->where('admin_status', 1);
        $this->db->where('service_type', $this->input->get('ser'));
        $this->db->where('city', $this->input->get('city'));
        $this->db->where_not_in('id', $ids);
        $provider_detc = $this->db->get()->result();

           if(is_array($provider_detc) && count($provider_detc)>0){
            foreach ($provider_detc as $provider_detcv) {
              $own_t=$this->db->get_where('service',array('id'=>$provider_detcv->owner_type,'status'=>1))->row();
              $s_typec=$this->db->get_where('sub_service',array('id'=>$provider_detcv->service_type,'status'=>1))->row();
              $ct1 =$this->db->get_where('city',array('id' =>$provider_detcv->city))->row();
              $ne1 =$this->db->get_where('city',array('id' =>$provider_detcv->neihborhood))->row();
              ?>
               
              <h4 style="color:#ff8100;">Also there are same providers found in some near location</h4>
          <div class="col-lg-6 col-md-9">
            <article class="destination-box list-style">
              <div class="row">
                <div class="col-md-4 col-sm-4">
                  <div class="blah">
                    <a href="#">
                      <img src="<?=site_url('assets/images/profile/'.$provider_detcv->image)?>" width="90" height="90" class="blah destination-box-img"  onerror="this.src='<?=site_url()?>assets/images/no-image.png';" alt="">
                    </a>
                  </div>
                </div>
                <div class="col-md-7 col-sm-7"> 
                  <div class="inner-box">
                    <div class="box-inner-ellipsis">
                      <div style="margin: 0px; padding: 0px; border: 0px;">
                        <span class="service-head"><?=$s_typec->name?></span>
                        <h3 class="entry-title">
                          <a href="<?=site_url('auth-number')?>"><br><?=$provider_detcv->company_name?></a>
                        </h3>
                        <div class="entry-content">
                          <p><i class="fa fa-user"></i> <?=$provider_detcv->contact_prsn_fname.' '.$provider_detcv->contact_prsn_lname?>
                          &nbsp;&nbsp;<i class="fa fa-phone"></i> <?=$provider_detcv->contact_prsn_mobile?></p>
                          <p>Rating: <?php 
                          $cnc=$provider_detcv->rating;
                          if($cnc==0){ echo "<b>Not yet rated</b>";}else{
                          for ($i=0; $i<$cnc; $i++) { 
                          ?>
                          <i class="fa fa-star"></i>
                          <?php } } ?></p>

                          <p><b>Address:</b> <?=$provider_detcv->company_addr.', '.$ne1->name.', '.$ct1->name?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        <?php } }  ?>
          <!-- Single Destination List -->
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
        	.fa-star{
        		color:#e81e1e;
        	}
        </style>