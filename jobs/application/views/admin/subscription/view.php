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
               <a  href="<?php echo admin_url('subscription'); ?>" class="btn btn-primary float-right">Back</a>
             </div>
              <div class="col-sm-6">
              <div class="form-group">
                <label>Subscription Name :</label>
                <label><?= $offersdata->subscription_name; ?></label>
              </div>
              </div>
               <div class="col-sm-6">
              <div class="form-group">
                <label>Subscription Amount :</label>
                <label><?= 'USD'.' '.$offersdata->subscription_amount; ?></label>
              </div>
              </div>
               <div class="col-sm-6">
              <div class="form-group">
                <label>Subscription Duration :</label>
                <label><?= $offersdata->subscription_amount; ?></label>
              </div>
							</div>
               <div class="col-sm-12">
							<div class="form-group">
								<label>Subscription Features </label>
								<div class="panel panel-default">
                  <div class="panel-body">

                 <ul>
                  <?php

                    $services=$this->Crud_model->GetData('subscription_service','',"subscription_id='".$offersdata->id."'");
                     foreach ($services as $key) {?>
                   <li><?= $key->service; ?></li>
                 <?php }?>
                 </ul>
                  </div>
                </div>
							</div>
              </div>
						</form>

					</div>
				</div>
          <!-- /.card-body -->
        </form>
        </div>
        <!-- /.card -->



      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
