<?php
// var_dump($card);
// var_dump($them_i);
// <textarea name="them_name_<?= $them_i->getId();?
// id="them_name_<?//= $them_i->getId();?"><?= $i+1;?</textarea>
?>
<form name="them_form" id="them_form_"<?= $them_i->getId();?> actio="<?= $them_i->getId();?> " method="POST">
	<div class='flex-container3' style="display:flex;">


			<div>
				<input type="hidden" name="them_id" id="them_id" value="<?= $them_i->getId();?>">
				<!-- <textarea name="them_name_<?= $them_i->getId();?>" id="them_name_<?= $them_i->getId();?>"><?= $i+1;?></textarea> -->
				<textarea><?= $i+1;?></textarea>
			</div>

			<div>
				<textarea style="width:400px;" name="them_name" id="them_name"><?= $them_i->getName();?></textarea>
			</div>
            
			<div>
				<!--<textarea name="" id="" ><?php //$them_i->getPath();?></textarea>-->
				<input type="submit" name="save_them" value="Сохранить">
				<input type="reset" value="Сбросить">
				<input type="button" value="Карточка" onClick="document.location.href = './card/<?= $them_i->getId();?>';">
				<input type="submit" value="Удалить" disabled>
			</div>

	</div>
</form>
	<hr>