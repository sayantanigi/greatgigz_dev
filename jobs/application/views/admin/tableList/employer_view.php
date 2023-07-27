<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $heading?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $heading?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->

				<div class="card">
					<div class="card-body">

							<div class="row">
                 <div class="col-sm-12 ">
               <a  href="<?php echo admin_url('employers'); ?>" class="btn btn-primary float-right">Back</a>
             </div>
              <div class="col-sm-4">
              <div class="form-group">
                <label>Full Name :</label>
                <p><?= ucwords(@$get_data->firstname.' '.@$get_data->lastname); ?></p>
              </div>
              </div>
              
               <div class="col-sm-4">
              <div class="form-group">
                <label>Email ID :</label>
                <p><?= @$get_data->email; ?></p>
              </div>
							</div>
              <div class="col-sm-4">
             <div class="form-group">
               <label>Phone Number :</label>
               <p><?= @$get_data->mobile; ?></p>
             </div>
             </div>
            <?php if(!empty($get_data->country_name)){?>
             <div class="col-sm-4">
            <div class="form-group">
              <label>Country :</label>
              <p><?= @$get_data->country_name; ?></p>
            </div>
           </div>
         <?php } if(!empty($get_data->state_name)){?>
           <div class="col-sm-4">
          <div class="form-group">
            <label>State :</label>
            <p><?= @$get_data->state_name; ?></p>
          </div>
          </div>
        <?php } if(!empty($get_data->city)){?>
          <div class="col-sm-4">
         <div class="form-group">
           <label>City :</label>
           <p><?= @$get_data->city; ?></p>
         </div>
         </div>
       <?php } if(!empty($get_data->zipcode)){?>
         <div class="col-sm-4">
        <div class="form-group">
          <label>ZipCode :</label>
          <p><?= @$get_data->zipcode; ?></p>
        </div>
        </div>
      <?php } if(!empty($get_data->organization_type)){?>
         <div class="col-sm-4">
        <div class="form-group">
          <label>Organization Type :</label>
          <p><?= @$get_data->organization_type; ?></p>
        </div>
        </div>
      <?php } if(!empty($get_data->company)){?>
             <div class="col-sm-4">
             <div class="form-group">
               <label>Company :</label>
               <p><?= @$get_data->company; ?></p>
             </div>
             </div>
           <?php } if(!empty($get_data->job_title)){ ?> 
       <div class="col-sm-4">
              <div class="form-group">
                <label>Job Title :</label>
                <p><?= ucwords(@$get_data->job_title); ?></p>
              </div>
              </div>
            <?php } if(!empty($get_data->ext)){?>
               <div class="col-sm-4">
              <div class="form-group">
                <label>EXT :</label>
                <p><?= @$get_data->ext; ?></p>
              </div>
              </div>
            <?php } ?>
             <?php if(!empty($get_data->fax)){?>
               <div class="col-sm-4">
              <div class="form-group">
                <label>Fax Number :</label>
                <p><?= @$get_data->fax; ?></p>
              </div>
              </div>
            <?php } ?>
             <?php if(!empty($get_data->other)){?>
               <div class="col-sm-4">
              <div class="form-group">
                <label>Other :</label>
                <p><?= @$get_data->other; ?></p>
              </div>
              </div>
            <?php } ?>
             <?php if(!empty($get_data->address1)){?>
             <div class="col-sm-12">
             <div class="form-group">
               <label>Address :</label>
               <p><?= @$get_data->address1; ?></p>
             </div>
             </div>
           <?php } ?>
            <?php if(!empty($get_data->short_bio)){?>
               <div class="col-sm-12">
              <div class="form-group">
                <label>Company Overview :</label>
                <p><?= @$get_data->short_bio; ?></p>
              </div>
              </div>
            <?php } ?>
            
             <div class="col-sm-12">
               
              <div class="form-group">
                  
                 <label>Active Subscription Plan :</label>
                  <div class="row">
                <?php if(!empty($list_subscription)){ foreach($list_subscription as $key){
            $get_service=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$key->subscription_id."'");
            $total_postjobs=$this->Crud_model->GetData('postjob','',"user_id='".$_SESSION['commonUser']['userId']."' and employer_subscription_id='".$key->id."'");

           if(date('Y-m-d',strtotime($key->end_date)) > date('Y-m-d') && $key->no_of_post > count($total_postjobs)){
            ?>
                <div class="col-sm-3">
                <div class="card">
 
  <div class="card-body" style="background-color: #f2f2f2;">
    <h3 class="text-center"><b><?= ucwords($key->subscription_name)?></b></h3>
    <p class="text-center"><b><?= $key->start_date.' '.'Month'?></b></p>
    <p class="text-center"><b><?= $key->no_of_post.' '.'Job Posting'?></b></p>
  </div>
  <ul class="list-group list-group-flush">
    <?php if(!empty($get_service)){ foreach($get_service as $row){?>
    <li class="list-group-item text-center"><?= ucwords($row->service)?></li>
    <?php } }?>
  </ul>
  <div class="card-body text-center">
    <a href="javascriopt:void(0)" class="card-link">$ <?= $key->amount ?>/Member</a>
   
  </div>
  <div class="card-body text-center">
    <a href="javascriopt:void(0)" class="card-link">Date Of Expiry :</a>
    <span ><?= date('d-M-Y',strtotime($key->end_date)) ?></span>
   
  </div>
</div>
</div>  <!-- col-sm-4 -->
<?php }} } ?>
</div>
              </div>
            </div>  <!-- col-sm-12 -->

					</div>
				</div>
          <!-- /.card-body -->
      
        </div>
        <!-- /.card -->



      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
