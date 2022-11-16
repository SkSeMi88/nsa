<?php
// var_dump($card);
// var_dump($them_i);
// <textarea name="them_name_<?= $them_i->getId();?
// id="them_name_<?//= $them_i->getId();?"><?= $i+1;?</textarea>
?>
<form name="person_form" id="person_form_"<?= $person_i->getId();?> actio="<?= $person_i->getId();?> " method="POST">

	<div class='flex-container3' style="display:flex;">

			<div style="width:50px;">
				<?= $i+1;?>
			</div>

			<div style="width:100px;">
				<!-- <a href="../thems/card/<?//= $them_i->getId();?>"><?//= $them_i->getCount();?></a> -->
				<a href="../persons/card/<?= $person_i->getId();?>"><?//= $person_i->getCount();?></a>
			</div>

			<div>
				<a href="../persons/card/<?= $person_i->getId();?>"><?= $person_i->getName();?></a>
			</div>
	</div>
</form>
<hr>