        <!-- Banner Section -->
        <section id="banner1">
      <div class="blue-overlay"></div>
      <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
      <div class="banner-text">
        <?php
        $ser = $this->input->post('service');
        $serv = $this->db->get_where('sub_service', array('id' =>$ser))->row();
         ?>
        <h1 style="font-size:25px;">Finding you quality <?php echo $serv->name; ?> in your community</h1>
      </div>
    </section>
        
        <!-- Content Start -->
        <div id="content">
          <!-- Our services Section -->
            <section id="services" class="section-block">
              <div class="container">
                  <div class="top-desc text-center">
                     <?php if($this -> session -> flashdata('error')){
                        ?>
                        <h4 style="color:red;"><?php echo $this -> session -> flashdata('error'); ?></h4>
                          <?php
                    } ?>
                    </div>
               
                </div>
            </section> 
        </div>
        <!----Mobile no verification----->
       
        