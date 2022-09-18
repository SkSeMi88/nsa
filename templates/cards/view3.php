<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>КТК</title>

	<link rel="icon" type="image/ico" href="/ktk/img/favicon.png" />

	<!-- <link rel="stylesheet" href="../../src/css/style.css" /> -->

	<link rel="stylesheet" href="/ktk/css/mvckb.css" />
	<!-- <link rel="stylesheet" href="/ktk/css/create_man.css"> -->
	<!-- <link rel="stylesheet" href="/ktk/css/create_card_man.css"> -->
	<!-- <link rel="stylesheet" href="/ktk/css/create_man_id.css"> -->
	<link rel="stylesheet" href="/ktk/css/card_man_view.css">

	<link rel="stylesheet" href="/ktk/css/cards_list.css">

	<!-- Скрипт загатовка -->
	<script src="/ktk/js/mvckb.js"></script>
	<!-- <script src="/ktk/js/live_search.js"></script> -->
<!--    <script src="/ktk/js/kb.js"></script>-->
	<script src="/ktk/js/create_card_man.js"></script>


	<!--// редактор карточки кб -->
	<script src="/ktk/js/cards_editor.js"></script>


	<!-- Стили общие -->
	<!-- <link rel="stylesheet" type="text/css" href="./views/man/css/create_man.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="../src/css/create_man.css"> -->

	<!-- <link rel="stylesheet" href="../../src/css/list.css"> -->

	<style>
		.finders_textarea {
			/*background : green;*/
			width   : 75%;
            height  : 85px;
            text-align : left;
		}
		
		.txt-area1 {
			
			/*scroll:1;*/
			background : silver;
			overflow: auto;
			width   : 100%;
            height  : 25px;
            text-align : left;
            
            position: relative;
			
			
		}

	</style>
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
<!--<div class="result-list">-->

	<form id="form_edit"  name="form_edit"  method="post" action="<?php echo $_SERVER['REQUEST_URI']."edit";?>" >
	<input type="hidden" name="card_id" id="card_id"  value="<?= $card->getId();?>">
	 <!-- onsubmit="return check_form_edit();"> -->

	<div class='flex-container3'>

		<div>
			<a href="../<?= $card->getId();?>"><?= $card->getId();?></a>
		</div>

		<div>
			<div>
				<!--<input type="text" name="fname" id="fname"  value="<?= $card->getFnameTitle();?>">-->
				<textarea  name="fname" id="fname"  class="txt-area1" wrap="on" cols="300" rows="10" ><?= $card->getFnameTitle();?></textarea>
				
			</div>
			<div>
				<!--<input type="text" name="name" id="name"  value="<?//= $card->getNameTitle();?>">-->
				<textarea  name="name" id="name"  class="txt-area1" wrap="on" cols="300" rows="10" ><?= $card->getNameTitle();?></textarea>
			</div>
			<div>
				<!--<input type="text" name="sname" id="sname"  value="<?//= $card->getSnameTitle();?>">-->
				<textarea  name="sname" id="sname"  class="txt-area1" wrap="on" cols="300" rows="10" ><?= $card->getSnameTitle();?></textarea>
			</div>
		</div>

		<div>
			<input type="text" name="byear" id="byear"  value="<?= $card->getByearTitle();?>">
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
			<input type="hidden" name="bplace_id" id="bplace_id" value="<?= $card->bplace->getId();?>">
			<div>
				<textarea name="punkt" id="punkt" ><?= $card->bplace->getPunkt();?></textarea>
			</div>

			<div>
				<!-- <? //= $card->bplace->getVolost();?> -->
				<textarea name="volost" id="volost" ><?= $card->bplace->getVolost();?></textarea>
			</div>

			<div>
				<? //= $card->bplace->getUezd();?>
				<textarea name="uezd" id="uezd" ><?= $card->bplace->getUezd();?></textarea>
			</div>
		</div>

		<div>
			<?php 
				$s1	= "";
				$s2	= "";
				$select	= '<select name="photo" id="photo" >';
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
			<textarea class="prim_box" name="prim" id="prim" ><?= $card->getPrim();?></textarea>
		</div>
	</div>
	</div>
	 <hr> 
	<div style="position:absolute;">
		Поисковые данные
	</div>
	<!--<hr>-->
	<!--<div class="flex_container4" style="display:flex;">-->
	<!--	<div>-->

			<input type="hidden" name="finder_id" id="finder_id" value="<?= $card->finder->getId();?>">
	<!--	</div>-->
	<!--	<div>-->

	<!--		<div>-->
	<!--			Фонд-->
	<!--		</div>-->
	<!--		<div>-->
	<!--			<input type="text" name="fond"  id="fond" value="<?//= $card->finder->getFond();?>">-->
	<!--		</div>-->
	<!--	</div>-->
	<!--	<div>-->
	<!--		<div>-->
	<!--		Опись-->
	<!--		</div>-->
	<!--		<div>-->
	<!--			<input type="text" name="opis"  id="opis" value="<?//= $card->finder->getOpis();?>">-->
	<!--		</div>-->
	<!--	</div>-->
	<!--	<div>-->
	<!--		<div>-->
	<!--		Дело-->
	<!--		</div>-->
	<!--		<div>-->
	<!--			<input type="text" name="delo"  id="delo" value="<?//= $card->finder->getDelo();?>">-->
	<!--		</div>-->
	<!--	</div>-->
	<!--	<div>-->
	<!--		<div>-->
	<!--		Лист-->
	<!--		</div>-->
	<!--		<div>-->
	<!--			<input type="text" name="list"  id="list" value="<?//= $card->getList();?>">-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	
	
	<hr>
	
	<div style="margin-top:5px; width:100%; display:flex;">
		<textarea cols="10" rows="10"></textarea>
		<div  style="text-align:center; margin-top:5px; width:5%;">
			Фонд
			</div>
		<div style="margin-top:5px; width:100%; display:flex;">
			<textarea class="finders_textarea" name="fond"  id="fond" value="<?= $card->finder->getFond();?>"><?= $card->finder->getFond();?></textarea>
		</div>
	</div>
	
	<div style="margin-top:5px; width:100%; display:flex;">
		<div  style="text-align:center; margin-top:5px; width:5%;">
			Опись
			</div>
		<div style="margin-top:5px; width:100%; display:flex;">
			<textarea class="finders_textarea" name="opis"  id="opis" value="<?= $card->finder->getOpis();?>"><?= $card->finder->getOpis();?></textarea>
		</div>
	</div>
	
	<div style="margin-top:5px; width:100%; display:flex;">
		<div  style="text-align:center; margin-top:5px; width:5%;">
			Дело
			</div>
		<div style="margin-top:5px; width:100%; display:flex;">
			<textarea class="finders_textarea" name="delo"  id="delo" value="<?= $card->finder->getDelo();?>"><?= $card->finder->getDelo();?></textarea>
		</div>
	</div>
	
	<div style="margin-top:5px; width:100%; display:flex;">
		<div  style="text-align:center; margin-top:5px; width:5%;">
			Лист
			</div>
		<div style="width:100%; display:flex;">
			<textarea class="finders_textarea" name="list"  id="list" value="<?= $card->getList();?>"><?= $card->getList();?></textarea>
		</div>
	</div>
	
	<hr>
	<input type="submit" name="edit_card"  id="edit_card" value="Сохранить">
	<input type="reset" name="reset_card"  id="reset_card" value="Сбросить">
	<hr>
	<a href="../../">Список беженцев</a>
	<a href="../../cards/add/">Создать карточку беженца</a>
	<div id="log">
	</div>
	</form>
</div>
</body>
</html>