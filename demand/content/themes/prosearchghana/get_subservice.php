<select class="form-control" name="frm[service_type]" >
	<?php if(is_array($subservice) && count($subservice)>0){
		foreach ($subservice as $subservice_v) {
			?>
			
			<option value="<?=$subservice_v->id?>"  <?php echo set_select('frm[service_type]', $subservice_v->id, False); ?>  ><?=$subservice_v->name?></option>
			<?php
		}
	} ?>
</select>
