<select class="form-control"  name="neihborhood">
	<?php if(is_array($neigh) && count($neigh)>0){
		foreach ($neigh as $neigh_v) {
			?>
			<option value="<?=$neigh_v->id?>"><?=$neigh_v->name?></option>
			<?php
		}
	} ?>
</select>
