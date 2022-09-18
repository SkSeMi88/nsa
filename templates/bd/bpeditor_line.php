<form id="bp-form-<?=$Bplace->getId();?>"  name="bp-form-<?=$Bplace->getId();?>"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
	<div id="bp-line-<?= $Bplace->getId();?>" name="bp-line-<?= $Bplace->getId();?>" class="show_new_line" style="margin-top: 3px; display:flex;">

		<div class="" id="num_box"style="margin-top: 3px; display:flex;">
			<?php
				$idi = $Bplace->getId();
				// echo ($idi<10)?"0".$Bplace->getId():$Bplace->getId();
				echo ($i<10)?"0".$i:$i;
			?>
		</div>

		<div class="show_new_line_element" id="new_name_box" style="margin_top: 3px;">

			<textarea id="punkt"  name="punkt" class="fio new_name" ><?= $Bplace->getPunkt();?></textarea>

		</div>

		<div class="show_new_line_element" id="new_sname_box" style="margin_top: 3px;">

			<textarea id="volost" name="volost" class="fio new_sname" ><?= $Bplace->getVolost();?></textarea>

		</div>

		<div class="show_new_line_element" id="new_byear_box" style="margin_top: 3px;">

			<textarea id="uezd"  name="uezd" class="fio new_byear" ><?= $Bplace->getUezd();?></textarea>

		</div>

		<div class="show_new_line-element" id="new_prim_box" style="margin-top: 3px; display:flex;">

			<input type="hidden" name="save_bplace_id" value="<?=$Bplace->getId();?>" >
			<!-- </form> -->
			<!-- <input type="submit" name="save_bplace0" value="Сохранить"> -->
			<!-- <input type="button" name="save_bplace1" id="save_bplace1" value="Сохранить"> -->
			<input type="button" name="save_bplace" id="<?= $Bplace->getId();?>" value="Сохранить" onClick="sendAjaxData('save', this.id)">

			<!-- <form id="new_ref"  name="form_line"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>"> -->
			<input type="hidden" name="delete_bplace_id" value="<?=$Bplace->getId();?>">
			<!-- <input type="button" name="delete_bplace1" value="Удалить" onClick="">  -->
			<input type="button" id="<?= $Bplace->getId();?>" name="delete_bplace" value="Удалить" onClick="sendAjaxData('delete',this.id)">

		</div>
	</div>

</form>