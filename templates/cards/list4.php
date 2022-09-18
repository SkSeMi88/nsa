<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>КТК</title>

    <link rel="icon" type="image/ico" href="favicon.png" />

    <link rel="stylesheet" href="../../src/css/style.css" />

    <link rel="stylesheet" href="/ktk/css/mvckb.css" />
    <!-- <link rel="stylesheet" href="/ktk/css/create_man.css"> -->
    <!-- <link rel="stylesheet" href="/ktk/css/create_card_man.css"> -->
    <!-- <link rel="stylesheet" href="/ktk/css/create_man_id.css"> -->
	 <link rel="stylesheet" href="/ktk/css/card_man_view.css">

	 <link rel="stylesheet" href="/ktk/css/cards_list.css">

    <!-- Скрипт загатовка -->
    <script src="/ktk/js/mvckb.js"></script>
    <script src="/ktk/js/live_search.js"></script>
<!--    <script src="/ktk/js/kb.js"></script>-->
    <script src="/ktk/js/create_card_man.js"></script>

    <!-- Стили общие -->
    <!-- <link rel="stylesheet" type="text/css" href="./views/man/css/create_man.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../src/css/create_man.css"> -->

    <link rel="stylesheet" href="../../src/css/list.css">


</head>
<body>
<div class="headerbox">
	База "Карельские беженцы"
</div>
<!-- 
<div>
Фильтр
</div>
<div class='flex-container5'>
	<div>1</div>
	<div>
		<div>Фамилия / Имя / Отчество</div>
		<input type="text">
		<input type="text">
		<input type="text">
	</div>
	<div>
		3
		Год рождения
		<input type="text">
	</div>
	<div></div>
	<div>
		Место рождения
		<input type="text">
	</div>
	<div>
		Фотографии
		<input type="text">
	</div>
	<div>
		<div>
			Примечание
		</div>
		<input type="text">
	</div>
</div>
<hr>
<div>
<input type="submit" value="Найти">
<input type="reset" value="Сбросить">
</div> -->



<hr>
<div class='flex-container3'>
	<div>№ п/п</div>
	<div>
		Фамилия / Имя / Отчество
		<!-- <input type="text">
		<input type="text"> -->
		<!-- <input type="text"> -->
	</div>
	<div>
		Год рождения
		<!-- <input type="text"> -->

	</div>
	<div></div>
	<div>
		Место рождения
		<!-- <input type="text">
		<input type="text">
		<input type="text"> -->
	</div>
	<div>Фотографии
	<!-- <input type="text"> -->
	</div>
	<div>
		Примечание
		<!-- <input type="text"> -->
	</div>
</div>
</div>

<hr>
<div class="result-list">

	<form id="new_ref"  name="new_ref"  method="post" action="<?php echo $_SERVER['REQUEST_URI']."/edit/";?>" onsubmit="return check_form_create();">

	<div class='flex-container3'>

		<div>
			<a href="../cards/1/"><?= "000"?></a>
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
			<input type="text" value="<?= $card->getByear();?>">
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
	<!-- <hr> -->
	<div>
		Поисковые данные
	</div>
	<hr>
	<div class="flex_container4" style="display:flex;">
		<div>

			
		</div>
		<div>
			<div>
				Фонд
			</div>
			<div>
				<input type="text" name="fond" value="<?= $card->finder->getFond();?>">
			</div>
		</div>
		<div>
			<div>
			Опись
			</div>
			<div>
				<input type="text" name="fond" value="<?= $card->finder->getOpis();?>">
			</div>
		</div>
		<div>
			<div>
			Дело
			</div>
			<div>
				<input type="text" name="fond" value="<?= $card->finder->getDelo();?>">
			</div>
		</div>
		<div>
			<div>
			Лист
			</div>
			<div>
				<input type="text" name="fond" value="<?= $card->getList();?>">
			</div>
		</div>
	</div>
	<hr>
	<input type="submit" name="edit_card" value="Сохранить">
	<input type="reset" name="edit_card" value="Сбросить">
	<div id="log">
	</div>
</div>
<body>
</body>
</html>