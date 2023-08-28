<div class="site-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="banner-content">
                        <h1>Philly Hire Job Portal</h1>
                        <p>Connecting Talent with Opportunity</p>
                    </div>
                    <div class="job-search">
                      <form method="post" action="<?= base_url('search-result')?>">
                       <div class="form-group col-md-6 padding-left b-r radius">
                           <input type="text" class="form-control" placeholder="Job title or keyword" name="search_title" id="search_title" />
                           <div class="search_icon"><span class="ti-briefcase"></span></div>
                       </div>
                       <div class="form-group col-md-6 padding-left radius2">
                           <input type="text" class="form-control" placeholder="Location" name="search_location" id="location" oninput="getsourceaddress();"/>
                           <div class="search_icon">
                               <span class="ti-location-pin"></span>
                               <!--<span class="ti-close" onclick="return reset_location()" ></span>-->
                           </div>
                       </div>
                       <div class="btn-search">
                           <button type="submit" class="btn btn-default"  onclick="return search_validate()" id="btn_search"><span class="ti-search"></span> Search Job</button>
                       </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="skill">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="page-heading">
                          <h2><?= ucwords(@$cms_findjob->title)?></h2>
                            <?= @$cms_findjob->description ?>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#Skills">Jobs By Category</a></li>
                            <li><a data-toggle="tab" href="#Industry">Jobs By Company Name</a></li>
                            <li><a data-toggle="tab" href="#Location">Jobs By Location</a></li>
                            <li class="pull-right"><a href="<?= base_url('search-result')?>" class="view">View all jobs</a></li>
                        </ul>
                        <div class="tab-content">
                           <div id="Skills" class="tab-pane fade in active"> 
								<div class="col-md-12 padding-left">
									<ul class="unstyled">
										<?php if(!empty($list_category)){ foreach($list_category as $key){?>
                                        <li><a href="<?= base_url('job-listing/category/'.$key->slug_url)?>"><i class="fa fa-angle-right"></i> <?= ucwords($key->category_name) ?></a></li>
										<?php } }?>
                                    </ul>                               
                                </div>
                            </div>
                            <?php //echo "<pre>"; print_r($list_company);?>
                            <div id="Industry" class="tab-pane fade">
                                <div class="col-md-12 padding-left">
                                    <ul class="unstyled">
										<?php if(!empty($list_company)){ foreach($list_company as $key){?>
                                        <li><a href="<?= base_url('job-listing/company/'.$key->post_slug_url)?>"><i class="fa fa-angle-right"></i> <?= ucwords($key->company_name) ?></a></li>
										<?php } }?>
                                    </ul>
                                </div>
                               
                            </div>
                            <div id="Location" class="tab-pane fade">
                                <div class="col-md-12 padding-left">
                                    <ul class="unstyled">
                                <?php if(!empty($list_location)){ foreach($list_location as $key){
                                   if(strlen($key->location)>30)
                                    {
                                        $location=substr($key->location, 0,30).'...';
                                    }
                                    else{
                                        $location=$key->location;
                                    }
                                  ?>
                                        <li><a href="<?= base_url('job-listing/location/'.$key->post_slug_url)?>"><i class="fa fa-angle-right"></i> <?= $location ?></a></li>
								<?php } }?>
                                       
                                    </ul>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="Resume">
                            <h1>Add your resume and Improve your resume with a free review.</h1>
                            <a href="javascript:void(0)" class="btn btn-cv btn-block" onclick="return get_uploadcv()">Upload Your CV</a>
                             <p> Max 3 MB, Type: doc, docx, pdf 
                              <?php if(empty($_SESSION['commonUser']['userId'])){?>
                              <strong>Already registered? </strong> <a href="javascript:void(0)">Login</a>
                            <?php } ?>
                            </p>
                            <div class="bottom">
                              <h1>Newsletter Subscription</h1>
                              <p> Get best Jobs on your Email.</p>
                              <div class="form-group">
                                  <span id="email_err"></span>
                                    <input type="text" class="form-control" placeholder="Email address..." name="subscribe" id="subscriber_email" />
                                </div>
                                <p class="text-right"><a href="javascript:void(0)" onclick="return subscriber();">Subscribe Now</a></p>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="featured">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-heading">
                            <h2>Featured Jobs</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-bg">
                            <table class="table">
                              <tbody>
                                   <?php if(!empty($list_featuredjob)){ foreach($list_featuredjob as $key){
                                   $get_category=$this->Crud_model->get_single('category',"id='".$key->category_id."'");
                                   if(strlen($key->location)>45)
                                   {
                                       $location=substr($key->location, 0,45).'...';
                                   }
                                   else{
                                       $location=$key->location;
                                   }

                                       ?>
                                   <tr>
                                       <td><div class="tab-image">
                                           <?php if(!empty($key->company_logo) && file_exists('uploads/company_logo/'.$key->company_logo)){?>
                                           <img src="<?= base_url('uploads/company_logo/'.$key->company_logo)?>" alt="" class="img-responsive" width="70" height="70"/>
                                       <?php } else{?>
                                            <img src="<?= base_url('uploads/no_image.png')?>" alt="" class="img-responsive" width="70" height="70"/>
                                       <?php } ?>
                                       </div><h1><?= ucfirst($key->job_title)?> <p><?= ucfirst($get_category->category_name) ?></p></h1></td>
                                       <?php if($key->job_type=='Full Time'){?>
                                       <td class="work-time"><?= ucfirst($key->job_type)?></td>
                                   <?php } if($key->job_type=='Part Time'){?>
                                       <td class="work-time part"><?= ucfirst($key->job_type)?></td>
                                   <?php } if($key->job_type=='Freelancer'){?>
                                       <td class="work-time Free"><?= ucfirst($key->job_type)?></td>
                                   <?php } ?>
                                       <td><span class="ti-location-pin"></span> <?= ucfirst($location)?></td>
                                       <td><a href="<?= base_url('job-detail/'.$key->post_slug_url)?>" class="table-btn-default">View Job</a></td>
                                   </tr>
                                  <?php }}?>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center mt-30">
                        <a href="<?= base_url('search-result')?>" class="btn btn-cv">View All Jobs</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="join-bdn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 padding-left">
                        <div class="left-col">
                            <div class="col-text">
                               <div class="page-heading heading4">
                                    <h2><?= ucwords(@$cms_join->title) ?></h2>
                                    <hr>
                                    <p><?= @$cms_join->description ?></p>
                                    <a href="javascript:void(0)" class="btn btn-cv mt-30">Plan Your Career</a>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 padding-left">
                        <?php if(!empty($cms_join->image) && file_exists('uploads/cms/'.@$cms_join->image)){?>

                        <div class="right-col" style="background: url('<?= base_url("uploads/cms/".@$cms_join->image)?>') no-repeat center top/cover;"></div>
                         <?php } else{?>
                           <div class="right-col" style="background: url('<?= base_url("assets/images/home/man.jpg")?>') no-repeat center top/cover;"></div>
                         <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="page-heading">
                            <h2><?= ucwords(@$cms_featuredservices->title)?></h2>
                           <?= @$cms_featuredservices->description ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <?php if(!empty($list_services)){ foreach($list_services as $key){?>
                   <div class="col-md-4">
                       <div class="block1">
                           <a href="javascript:void(0)">
                               <?php if(!empty($key->image)&& file_exists('uploads/featured_service/'.$key->image)){ ?>
                               <img src="<?= base_url('uploads/featured_service/'.$key->image)?>" alt="" class="img-responsive">
                           <?php } ?>
                           </a>
                           <div class="block1_desc">
                               <h4><?= ucfirst($key->title)?></h4>
                           </div>
                       </div>
                   </div>
                   <?php } }?>
                  
                </div>
            </div>
        </section>
    </main>
        <section class="call-to-action-two">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content">
                            <h2>Questions / Feedback<br> <span>If you need assistance or have feedback about this service</span></h2>
                            <?php $phone=preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($setting->phone)), 2);?>
                            <a href="tel:860-437-5700" class="btn btn-cv">Call us at <span class="btn-title"><i class="fa fa-phone"></i> <?= @$phone?></span></a>
                            <a href="mailto:" class="btn btn-cv"><span class="btn-title"><i class="fa fa-envelope"></i> <?= @$setting->email?></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
        $( window ).load(function() {
           if(navigator.geolocation){
               navigator.geolocation.getCurrentPosition(showLocation);
           }else{
               $('#location').html('Geolocation is not supported by this browser.');
           }
       });

       function showLocation(position){
           var latitude = position.coords.latitude;
           var longitude = position.coords.longitude;
          displayLocation(latitude,longitude);


       }

       function displayLocation(latitude,longitude){

           var geocoder;
           geocoder = new google.maps.Geocoder();
           var latlng = new google.maps.LatLng(latitude, longitude);

           geocoder.geocode(
               {'latLng': latlng},
               function(results, status) {
                   if (status == google.maps.GeocoderStatus.OK) {
                       if (results[0]) {
                           var add= results[0].formatted_address ;
                           var  value=add.split(",");

                           count=value.length;
                           country=value[count-1];
                           state=value[count-2];
                           city=value[count-3];
                           $("#location").val(city);
                       }

                   }

               }
           );
       }
           </script>
           
           <script type="text/javascript">
               function get_uploadcv(){
                var base_url=$('#base_url').val();
        <?php if(!empty($_SESSION['commonUser']['userId']) && $_SESSION['commonUser']['userType']==1)
         {
            $session_value=$_SESSION['commonUser']['userType'];
         }else{
            $session_value='';
         }?>
       var checkSession='<?= $session_value ?>';
       if(checkSession =='')
       {
        swal({   
            title: "Only for Jobseeker!",   
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#A5DC86',
            cancelButtonColor: '#0bc2f3',
            confirmButtonText: 'Yes, Login!',
            cancelButtonText: 'Ok, cancel', 
            closeOnConfirm: false,   
            closeOnCancel: true 
        }, function(isConfirm){
            if (isConfirm) {
                window.location.href =base_url+"login";
            }
        });

       }
       else{
        window.location.href =base_url+"jobseeker-profile";   
    }
}
           </script>
           <script type="text/javascript">
             function search_validate()
             {
              var searchtitle=$('#search_title').val();
              if(searchtitle=='')
              {
                $('#btn_search').css("cursor-pointer", "none");
                return false;
              }
              else{
                $("#btn_search").css("cursor-pointer", "");
              }
             }
           </script>
