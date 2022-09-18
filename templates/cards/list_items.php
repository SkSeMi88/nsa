<?php
// var_dump($card);
?>

	<div class='flex-container3'>

		<div>
			<a href="../cards/<?= $card->getId();?>/"><?= $i+1;?></a>
		</div>

		<div>
			<div>
				<input type="text" value="<?= $card->getFnameTitle();?>">
			</div>
			<div>
				<input type="text" value="<?= $card->getNameTitle();?>">
			</div>
			<div>
				<input type="text" value="<?= $card->getSnameTitle();?>">
			</div>
		</div>

		<div>
			<input type="text" value="<?= $card->getByearTitle();?>">
		</div>

		<div>
			<div>
				Населенный пункт
			</div>

			<div>
				Волость
			</div>

			<div>
				Уезд
			</div>
		</div>

		<div>
			<div>
				<textarea name="" id="" ><?= $card->bplace->getPunkt();?></textarea>
			</div>

			<div>
				<!-- <? //= $card->bplace->getVolost();?> -->
				<textarea name="" id="" ><?= $card->bplace->getVolost();?></textarea>
			</div>

			<div> 
				<? //= $card->bplace->getUezd();?>
				<textarea name="" id="" ><?= $card->bplace->getUezd();?></textarea>
			</div>
		</div>

		<div>
			<?php 
				$s1	= "";
				$s2	= "";
				$select	= '<select name="" id="" >';
			// echo ($card->getPhoto())?"Есть":"Нет";
				$s1	= ($card->getPhoto())?"selected":"";
				$s2	= (!$card->getPhoto())?"selected":"";
				
				$select	.= '<option value="0" '.$s2.'>Нет</option>';
				$select	.= '<option value="1" '.$s1.'>Есть</option>';
			$select		.= '</select>';
			echo $select;
			?>
		</div>

		<div>
			<?php //echo $card->getPrim();?>
			<textarea class="prim_box" name="" id="" ><?= $card->getPrim();?></textarea>
		</div>
	</div>
	<hr>