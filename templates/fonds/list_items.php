<?php
// var_dump($card);
// var_dump($fond_i);
?>
<form name="fond_form" id="fond_form_"<?= $fond_i->getId();?> actio="<?= $fond_i->getId();?> " method="POST">
	<div class='flex-container3' style="display:flex;">


			<div>
				<textarea name="fond_name_<?= $fond_i->getId();?>" id="fond_name_<?= $fond_i->getId();?>"> <?= $fond_i->getName();?> </textarea>
			</div>
			<div>
				<textarea name="fond_title_<?= $fond_i->getId();?>" id="fond_title_<?= $fond_i->getId();?>" style="width:400px;" ><?= $fond_i->getTitle();?></textarea>
			</div>
			<div>
				<textarea name="fond_dates_<?= $fond_i->getId();?>" id="fond_dates_<?= $fond_i->getId();?>" ><?= $fond_i->getDates();?></textarea>
			</div>
			<div>
				<!--<textarea name="" id="" ><?php //$fond_i->getPath();?></textarea>-->
				<input type="submit" name="save_fond" value="Сохранить">
				<input type="reset" value="Сбросить">
				<input type="button" value="Карточка" onClick="document.location.href = './fond/<?= $fond_i->getId();?>';">
				<input type="submit" value="Удалить" disabled>
			</div>

	</div>
</form>
	<hr>