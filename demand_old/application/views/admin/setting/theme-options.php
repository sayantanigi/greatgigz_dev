<?php
$arr_default['logo'] = theme_url('img/logo.png');

$arr_default['meta_title'] = 'Welcome to our website';

$arr_default['twitter'] = '';
$arr_default['facebook'] = '';
$arr_default['pintrest'] = ''; 
$arr_default['skype'] = '';
$arr_default['lt'] = '';
$arr_default['lst'] = '';

$arr_default['l1'] = '';
$arr_default['l2'] = '';
$arr_default['l3'] = '';
$arr_default['l4'] = '';
$arr_default['l5'] = '';
$arr_default['l6'] = '';


$arr_default['address'] = '';
$arr_default['phone'] = '';
$arr_default['hth1'] = '';
$arr_default['hd1'] = '';
$arr_default['hth2'] = '';
$arr_default['hd2'] = '';
$arr_default['hth3'] = '';
$arr_default['hd3'] = '';
$arr_default['hth4'] = '';
$arr_default['hd4'] = '';
$arr_default['email'] = '';
$arr_default['youtube'] = '';
$arr_default['web'] = '';
$arr_default['course_price'] = ''; 
$arr_default['map'] = '';
$arr_default['tollfree  '] = '';

$_GET['options'] = $options;
$_GET['default'] = $arr_default;
function get_option($fname){
 $arr_options = $_GET['options'];
 $arr_default = $_GET['default'];
 if(isset($arr_options[$fname])){
  return $arr_options[$fname];
}else{
  if(isset($arr_default[$fname])){
   return $arr_default[$fname];
}else{
   return NULL;
}
}
}
?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Global Setting</h3>
       </div>
       <!-- /.box-header -->
       <?php echo form_open(admin_url('settings'), array('class' => 'form-horizontal')); ?>
       <div class="form-group">
         <label class="col-sm-2 control-label">Header Logo</label>
         <div class="col-sm-8">
            <input type="text" name="logo" value="<?= get_option('logo'); ?>" class="form-control input-sm" />
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-2 control-label">Banner text</label>
         <div class="col-sm-8">
            <input type="text" name="lt" value="<?= get_option('lt'); ?>" placeholder="Banner text" class="form-control input-sm" />
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-2 control-label">Banner sub-text</label>
         <div class="col-sm-8">
            <input type="text" name="lst" value="<?= get_option('lst'); ?>" placeholder="Banner sub-text" class="form-control input-sm" />
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-2 control-label">Title</label>
         <div class="col-sm-8">
            <input type="text" name="meta_title" value="<?= get_option('meta_title'); ?>" placeholder="Title" class="form-control input-sm" />
         </div>
      </div>

      <div class="form-group">
         <label class="col-sm-2 control-label">Address</label>
         <div class="col-sm-8">
            <input type="text" name="address" value="<?= get_option('address'); ?>" placeholder="Address" class="form-control input-sm" />
         </div>
      </div>

      <div class="form-group">
         <label class="col-sm-2 control-label">Phone</label>
         <div class="col-sm-8">
            <input type="text" name="phone" value="<?= get_option('phone'); ?>" placeholder="Enter Phone No" class="form-control input-sm" />
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-2 control-label">Toll Free</label>
         <div class="col-sm-8">
            <input type="text" name="tollfree" value="<?= get_option('tollfree'); ?>" placeholder="Enter Web" class="form-control input-sm" />
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-2 control-label">Email</label>
         <div class="col-sm-8">
            <input type="text" name="email" value="<?= get_option('email'); ?>" placeholder="Enter Email" class="form-control input-sm" />
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-2 control-label">Footer</label>
         <div class="col-sm-8">
            <input type="text" name="web" value="<?= get_option('web'); ?>" placeholder="Enter Web" class="form-control input-sm" />
         </div>
      </div>
      <div class="form-group">
         <label class="col-sm-2 control-label">Map</label>
         <div class="col-sm-8">
            <textarea class="form-control" name="map" rows="6"><?=get_option('map')?></textarea>
         </div>
      </div>
      
      
      <hr/>
      <div class="box-header with-border">
       <h3 class="box-title">Footer Setting</h3>
    </div>
    <br>
    <div class="form-group row">
      <label class="col-sm-2 control-label">Text 1</label>
      <div class="col-sm-3">
         <input type="text" name="l1" value="<?= get_option('l1'); ?>" placeholder="" class="form-control input-sm" />
      </div>

      <label class="col-sm-1 control-label">Excerpt 1</label>
      <div class="col-sm-5">
         <input type="text" name="l2" value="<?= get_option('l2'); ?>" placeholder="" class="form-control input-sm" />
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-2 control-label">Text 2</label>
      <div class="col-sm-3">
         <input type="text" name="l3" value="<?= get_option('l3'); ?>" placeholder="" class="form-control input-sm" />
      </div>

      <label class="col-sm-1 control-label">Excerpt 2</label>
      <div class="col-sm-5">
         <input type="text" name="l4" value="<?= get_option('l4'); ?>" placeholder="" class="form-control input-sm" />
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-2 control-label">Text 3</label>
      <div class="col-sm-3">
         <input type="text" name="l5" value="<?= get_option('l5'); ?>" placeholder="" class="form-control input-sm" />
      </div>

      <label class="col-sm-1 control-label">Excerpt 3</label>
      <div class="col-sm-5">
         <input type="text" name="l6" value="<?= get_option('l6'); ?>" placeholder="" class="form-control input-sm" />
      </div>
   </div>

   <hr/>
   <br>
   <div class="form-group">
      <label class="col-sm-2 control-label">Facebook Link</label>
      <div class="col-sm-8">
         <input type="text" name="facebook" value="<?= get_option('facebook'); ?>" placeholder="" class="form-control input-sm" />
      </div>
   </div>
   <div class="form-group">
      <label class="col-sm-2 control-label">Twitter Link</label>
      <div class="col-sm-8">
         <input type="text" name="twitter" value="<?= get_option('twitter'); ?>" placeholder="" class="form-control input-sm" />
      </div>
   </div>
   <div class="form-group">
      <label class="col-sm-2 control-label">Pintrest Link</label>
      <div class="col-sm-8">
         <input type="text" name="pintrest" value="<?= get_option('pintrest'); ?>" placeholder="" class="form-control input-sm" />
      </div>
   </div>
   <div class="form-group">
      <label class="col-sm-2 control-label">Youtube Link</label>
      <div class="col-sm-8">
         <input type="text" name="youtube" value="<?= get_option('youtube'); ?>" placeholder="" class="form-control input-sm" />
      </div>
   </div>
   <div class="form-group">
      <label class="col-sm-2 control-label">Linkedin Link</label>
      <div class="col-sm-8">
         <input type="text" name="skype" value="<?= get_option('skype'); ?>" placeholder="" class="form-control input-sm" />
      </div>
   </div>

   <div class="form-group">
      <label class="col-sm-2">&nbsp;</label>
      <div class="col-sm-5">
         <input type="submit" name="submit" value="Save Settings" class="btn btn-primary btn-sm" />
         <a href="<?= admin_url('settings/restore'); ?>" class="btn btn-sm btn-default reset">Restore Default</a>
      </div>
   </div>

   <div class="box-footer">
      <?php
      $str = '';
      if(is_array($arr_default) && count($arr_default) > 0){
         foreach($arr_default as $key => $val){
            $str .= $key . ',';
         }
      }
      $str = rtrim($str, ',');
      ?>
      <input type="hidden" name="fields" value="<?= $str; ?>" />
   </div>
</div>



</div>
<script>
   $(document).ready(function(){
    $('.reset').click(function(){
     if(!confirm('It will RESET all values. Are you sure to proceed?'))
      return false;
});
 });
</script>
<?= form_close(); ?>
</div>
<!-- /.nav-tabs-custom -->
</section>
</section>
<!-- /.content -->