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

							<?php if($button=='Update'){?>
                 <form  action="<?php echo admin_url('subscription/update_action'); ?>" method="post" enctype="multipart/form-data">
                <?php }else{ ?>
                   <form class="forms-sample" action="<?php echo admin_url('Subscription/create_action'); ?>" method="post" enctype="multipart/form-data">
                <?php }?>
                 <div class="row">
              <div class="col-md-6">
							<div class="form-group">
								<!-- <label>Subscription Type <span class="text-danger">*</span></label>
								<input class="form-control" type="text" placeholder="Basic" name="subscription_name" value="<?= $subscription_name;  ?>" required> -->
                <label>Subscription Type <span class="text-danger"></span></label>
                 <div class="form-group clearfix">

                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary1" name="subscription_name" value="free" <?= (@$subscription_name=='free')?'checked':'checked'; ?> >
                         <label for="radioPrimary1" style="display:<?php if(@$subscription_name=='paid'){ echo "none"; } else if(@$subscription_name=='free'){ echo ""; } ?>"> Free</label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" name="subscription_name" value="paid" <?= (@$subscription_name=='paid')?'checked':''; ?>>
                         <label for="radioPrimary2" style="display:<?php if(@$subscription_name=='free'){ echo "none"; } else if(@$subscription_name=='paid'){ echo ""; } ?>"> Paid </label> 
                      </div>

                    </div>
							</div>
            </div>
               <div class="col-md-6">
              <div class="form-group">
                <label>Number of Duration<span class="text-danger">*</span></label>
                <!--<input class="form-control" type="text" name="subscription_duration" value="<?= @$subscription_duration; ?>" required>-->
                 <select class="form-control" name="subscription_duration" required>
                   <option value="">--Select Duration--</option>
                  <option value="1" <?= (@$subscription_duration=='1')?'selected':'';?>>1 Month</option>
                  <option value="2" <?= (@$subscription_duration=='2')?'selected':'';?>>2 Month</option>
                  <option value="3" <?= (@$subscription_duration=='3')?'selected':'';?>>3 Month</option>
                  <option value="4" <?= (@$subscription_duration=='4')?'selected':'';?>>4 Month</option>
                  <option value="5" <?= (@$subscription_duration=='5')?'selected':'';?>>5 Month</option>
                  <option value="6" <?= (@$subscription_duration=='6')?'selected':'';?>>6 Month</option>
                  <option value="7" <?= (@$subscription_duration=='7')?'selected':'';?>>7 Month</option>
                  <option value="8" <?= (@$subscription_duration=='8')?'selected':'';?>>8 Month</option>
                  <option value="9" <?= (@$subscription_duration=='9')?'selected':'';?>>9 Month</option>
                  <option value="10" <?= (@$subscription_duration=='10')?'selected':'';?>>10 Month</option>
                  <option value="11" <?= (@$subscription_duration=='11')?'selected':'';?>>11 Month</option>
                  <option value="12" <?= (@$subscription_duration=='12')?'selected':'';?>>12 Month</option>
                </select>
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label>Number of Post<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="no_of_post" value="<?= @$no_of_post?>" required>
              </div>
            </div>
             <div class="col-md-6" style="display:<?= (@$subscription_name=='paid')?'':'none'; ?>;" id="cost">
							<div class="form-group">
								<label>Amount($)<span class="text-danger">*</span><span id="err_cost"></span></label>
								<input class="form-control" type="text" name="subscription_amount" id="subscription_amount" value="<?= @$subscription_amount;  ?>">
							</div>
							 </div>
                <div class="col-md-12">
							<div class="form-group">

								<div class="panel panel-default">
                  <div class="panel-body">
                  <table class="table jobsites" id="purchaseTableclone1">
             <tr class="color">
                 <th>Services <span style="color:red;">*</span></th>
                 <th><button type="button" class="btn btn-info" onclick="add_row()" >Add service</button> </th>
             </tr>
             <tbody id="clonetable_feedback1">
             	  <?php if($button == 'Create') { ?>
                 <tr>

                <td><input type="text" name="service[]" id="service1" class="form-control" required></td>


                <td><a href="#" title="Delete" class="text-danger" onclick="return remove(this)"><i class="fa fa-trash mr-1"></i></a></td>
                 </tr>
             <?php } else{ ?>

             	<?php
             	if(!empty($sub_offer)){
             	$rows=1;

             		foreach ($sub_offer as $key) {?>

             			 <tr>

                <td><input type="text" name="service[]" id="service<?= $rows; ?>" class="form-control" value="<?= $key->service; ?>" ></td>


                <td><a href="#" title="Delete" class="text-danger" onclick="return remove(this)"><i class="fa fa-trash mr-1"></i></a></td>
                 </tr>

             <?php }} }?>
             </tbody>
           </table>
                  </div>
                </div>
							</div>
            </div>

							<input type="hidden" name="id" value="<?php echo $id; ?>">

							<div class="mt-4">
								<button class="btn btn-primary" type="submit">Submit</button>
								<a href="<?= admin_url('subscription')?>" class="btn btn-link">Cancel</a>
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

  <script >
  function add_row()
  {
    //alert('hii'); return false;
     var y=document.getElementById('clonetable_feedback1');
      var new_row = y.rows[0].cloneNode(true);
      var len = y.rows.length;
      new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;

      var inp3 = new_row.cells[0].getElementsByTagName('input')[0];
      inp3.value = '';
      inp3.id = 'service'+(len+1);

      var submit_btn =$('#submit').val();
      y.appendChild(new_row);

  }

   function remove(row)
    {
      var y=document.getElementById('purchaseTableclone1');
      var len = y.rows.length;
      if(len>2)
      {
        var i= (len-1);
        document.getElementById('purchaseTableclone1').deleteRow(i);
      }
    }

     $('#radioPrimary1').click(function(){
   $('#cost').hide();

});

$('#radioPrimary2').click(function(){

  $('#cost').show();
   // var subscription_amount=$('#subscription_amount').val();
   // if(subscription_amount==''){
   // $("#err_cost").fadeIn().html("Required").css('color','red');
   //       setTimeout(function(){$("#err_cost").html("&nbsp;");},3000);
   //       $("#subscription_amount").focus();
   //       return false;
   //     }
});
</script>
