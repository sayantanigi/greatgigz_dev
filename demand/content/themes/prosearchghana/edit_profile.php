 <!-- Banner Section -->
        <section id="banner1">
      <div class="blue-overlay"></div>
      <img src="<?=site_url()?>fassets/images/banner-img/abt-us-banner.jpg" alt=""/>
      <div class="banner-text">
        <h1>Update Provider Profile</h1>
      </div>
    </section>
        
        <!-- Content Start -->
        <div id="content">
      <section class="section-block">
              <div class="container">
          <div class="row">
            <!-- edit form column -->
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 personal-info">
            <p class="pro-head">Welcome To Your Dashboard! <br/></p>
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
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $err; ?>
                        </div>
                        <?php
                    }
                    ?>          
              <form class="form-horizontal" role="form" action="<?=site_url('edit-profile')?>" method="post" enctype="multipart/form-data">
<!--                  
              <div class="form-group">
                <label class="col-lg-4 control-label">Business/Service Provider:</label>
                <div class="col-lg-8">
                <select class="form-control" id="type" name="frm[owner_type_old]">
                  <option value="1" <?php if($pdetail->owner_type == '1'){ echo "selected"; }?>>Business Owner</option>
                  <option value="2" <?php if($pdetail->owner_type == '2'){ echo "selected"; }?>>Service Provider</option>
                     </select>
                </div>
              </div>
-->             
             
              <div class="form-group">
                  <label class="col-lg-4 control-label">Do you own a business or are you a service provider?:</label>
                <div class="col-lg-8">
                  <input type="radio" <?php if($pdetail->owner_type == '1'){ echo 'checked="checked"'; }?> id="type1" name="frm[owner_type]" value="1">
                  <label>I own a business</label>  &nbsp;&nbsp;
                
                  <input type="radio"  <?php if($pdetail->owner_type == '2'){ echo 'checked="checked"'; }?> id="type2" name="frm[owner_type]" value="2">
                  <label>I am a Service Provider</label>
                
                </div>  
            </div>
              
              <div class="form-group">
                <label class="col-lg-4 control-label">Business/Service Type:</label>
                <div class="col-lg-8" id="service_type">
                <select class="form-control"  name="frm[service_type]" >
                  <?php
                  $ownt=$pdetail->service_type;
                 $subservice = $this->db->get_where('sub_service',array('id'=>$ownt))->result();
                
                        foreach ($subservice as $cl){
                 ?>
                   <option value="<?php echo $cl->id; ?>"><?=$cl->name?></option>
               
                <?php } ?>
                </select>
                </div>
              </div>
                        <div class="form-group">
                <label class="col-lg-4 control-label">Contact Person Name:</label>
                <div class="col-lg-4">
                <input class="form-control" autocomplete="off" type="text" name="frm[contact_prsn_fname]" placeholder="First Name"  value="<?=$pdetail->contact_prsn_fname?>">
                </div>
                <div class="col-lg-4">
                <input class="form-control" autocomplete="off" type="text" name="frm[contact_prsn_lname]" placeholder="Last Name"  value="<?=$pdetail->contact_prsn_lname?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Company Name:</label>
                <div class="col-lg-8">
                <input class="form-control" autocomplete="off" value="<?=$pdetail->company_name?>" type="text" name="frm[company_name]">
                </div>
              </div>
              

              <div class="form-group">
                  <label class="col-lg-4 control-label">Government Issued ID/Photo ID  /Other:</label>
                  <div class="col-lg-8">
                      <img src="<?=site_url('assets/images/profile/'.$pdetail->image)?>" onerror="this.src='<?=site_url()?>assets/images/no-image.png';" class="img-responsive" style="width:150px">
                      
<!--                      <input type="file" name="image" id="img" value="<?=$pdetail->image?>" class="form-control">
-->
                    </div>
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label">Contact Person Number:</label>
                <div class="col-lg-8">
                <input class="form-control" autocomplete="off" type="tel" value="<?=$pdetail->contact_prsn_mobile?>"  readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Company Address:</label>
                <div class="col-lg-8">
                <input class="form-control" autocomplete="off"  value="<?=$pdetail->company_addr?>" type="text" name="frm[company_addr]">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Select City:</label>
                <div class="col-lg-8">
                <div class="ui-select">
                   <select class="form-control" onchange="getval(this);"  name="frm[city]" required>
                    <option>Select City</option>
                    <?php if(is_array($city) && count($city)>0){
                      foreach ($city as $ct) {
                       ?>
                       <option value="<?=$ct->id?>" <?php if($pdetail->city == $ct->id){ echo "selected"; } ?>><?=$ct->name?></option>
                       <?php  
                     }
                   } ?>       
                 </select>
                </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Select Neighborhood:</label>
                <div class="col-lg-8">
                <div class="ui-select" id="getcitylist">
                   <select class="form-control" name="neihborhood">
                    <?php if(is_array($neigh) && count($neigh)>0){
                      foreach ($neigh as $neigh_v) {
                       ?>
                       <option value="<?=$neigh_v->id?>" <?php if($pdetail->neihborhood == $neigh_v->id){ echo "selected"; } ?>><?=$neigh_v->name?></option>
                       <?php  
                     }
                   } ?>
                  </select>
                </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">New Password:</label>
                <div class="col-lg-8">
                <input class="form-control" value="<?=base64_decode($pdetail->password)?>"  type="password" name="password">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 control-label">Confirm Password:</label>
                <div class="col-lg-8">
                <input class="form-control" value="<?=base64_decode($pdetail->password)?>"  type="password" name="con_pass">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-8">
                <input class="btn btn-primary" value="Update" type="submit">
                </div>
              </div>
              </form>
            </div>
            </div>
                </div>
            </section>
        </div>
