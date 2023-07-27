        <!-- Banner Section -->
        <section id="banner1">
      <div class="blue-overlay"></div>
      <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
      <div class="banner-text" style="height: 100%; padding: 7px">
        <?php
        $ser = $this->session->userdata('service');
        $serv = $this->db->get_where('sub_service', array('id' =>$ser))->row();
         ?>
        <h1>Finding you a quality <?php echo $serv->name;?> in your community</h1>
      </div>
    </section>
        
        <!-- Content Start -->
        <div id="content">
          <!-- Service Detail -->
            <section class="service-detail-wrapper">
              <div class="container">
                  <div class="blah text-center">
                        <h3 style="color:blue"><br>Authenticate Your Number</h3>
                        <p class="help-block" style="color:green" >Congrats! We have found you a <?php echo $serv->name;?>. Please authenticate your number to see the results.</p>

                    </div>
                    <div class="row">
                      
                      <div class="col-md-8 col-md-offset-2">
                                    <div class="error text-center"></div>
                                    <div class="success text-center"></div>
                        <div  id="sh_mob_no">
                          <form method="post" >
                              <div class="row">
                                  <div class="col-sm-6 col-md-offset-3">
                                    <div class="form-group">
                                      <input type="text" class="form-control" id="fullname" placeholder="Enter Your Name" autocomplete="off" />
                                    </div>
                                      <div class="form-group"> 
                                        <input type="hidden" id="service" value="<?=$this->session->userdata('service')?>">
                                        <input type="hidden" id="city" value="<?=$this->session->userdata('city')?>">
                                        <input type="hidden" id="neighborhood" value="<?=$this->session->userdata('neighborhood')?>">
                      <label>Contact Number</label>
                                          <input type="tel" class="form-control" id="phoneNumber" placeholder="Mobile Number"  minlength="7" maxlength="17" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                  <div class="group-btn">
                                      <a href="javascript:void(0)" class="btn btn-info mt-20" onclick="sendOTP()">Continue</a>
                                      <!-- <button class="btn btn-info mt-20" type="submit">Continue</button> -->
                                    </div>
<!--                                    <p class="help-block">Verify your number, if you have not taken our service from last 24 hours then you will be able to process the booking</p>
-->
                                </div>
                              </form>
                              </div>

                            <div  id="sh_otp_no" style="display: none;">

                              <h4 class="text-center">Please Wait....</h4>
                             
                              </div>
                            
                              </form>
                        </div>
                    </div>
                </div>
            </section>
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
        <!----Mobile no verification----->
       
        