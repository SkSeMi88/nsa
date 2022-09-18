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
	
	<!--<link rel="stylesheet" href="/ktk/css/card_man_view.css">-->
<!---->
	<!--<link rel="stylesheet" href="/ktk/css/cards_list.css">-->

	<!-- Скрипт загатовка -->
	<script src="/ktk/js/mvckb.js"></script>
	<!-- <script src="/ktk/js/live_search.js"></script> -->
<!--    <script src="/ktk/js/kb.js"></script>-->
	<script src="/ktk/js/create_card_man.js"></script>


	<!--// редактор карточки кб -->
	<script src="/ktk/js/cards_editor.js"></script>

	<style>
	
		body {
			margin			: 0px;
			padding			: 0px;
			/*padding-left	: 5px;*/
		}
		
		.headerbox {
		    width: inherit;
		    color: rgb(255, 217, 0);
		    background: #741b00;
		    padding: 5px;
		    margin: 0px;
		    font-size: 24px;
		    margin-bottom: 5px;
		}


		.finders_textarea {
			/*background : green;*/
			width   : 75%;
            height  : 50px;
            text-align : left;
		}
		
		.txt-area1 {
			
			/*scroll:1;*/
			background : silver;
			overflow: auto;
			width   : 90%;
            height  : 30px;
            text-align : left;
            
            position: relative;
			
			
		}
		
		.element-box {
			display : block;
			margin	: 3px;
		}
		
		.element-prim {
			/*display : block;*/
			margin	: 3px;
			width	: 100%;
			height	: 100px;
		}
		
		.txt-area2 {
			width	: 100%;
			height	: 100px;
		}
		

		.element-box1 {
			width : 25%;
			padding-left	: 3px;
		}

		.element-box2 {
			width : 10%;
		}

		.element-box3 {
			width : 3%;
			text-align	: right;
		}

		.element-box4 {
			width : 25%;
		}

		.element-box5 {
			
			width : 10%;
		}
		
		.element-box5 > select,textarea {
			margin : 5px ;
			width : 75%;
		}

		.element-box6 {
			width : 25%;
		}

		
	</style>
</head>
<body>
	
<div class="headerbox">
	База "Карельские беженцы"
</div>

<hr>

<!--<div class='flex-container3'>-->
<div style="display:flex;">
	<div class="element-box1">
		Фамилия / Имя / Отчество
	</div>
	
	<div class="element-box2">
		Год рождения
	</div>

	<div class="element-box3">
	</div>

	<div class="element-box4">
		Место рождения
	</div>

	<div class="element-box5">
		Фотографии
	</div>

	<div class="element-box6">
		Примечание
	</div>
</div>

<form id="form_edit"  name="form_edit"  method="post" action="<?php echo $_SERVER['REQUEST_URI']."edit";?>" >
<input type="hidden" name="card_id" id="card_id"  value="<?= $card->getId();?>">

<div style="display:flex;">
	
<!--cols="100" rows="50"-->
	<div class="element-box1">
		<textarea class="txt-area1" name="fname" id="fname" placeholder="Фамилия"><?= $card->getFnameTitle();?></textarea>
		<textarea class="txt-area1" name="name" id="name" placeholder="Имя"><?= $card->getNameTitle();?></textarea>
		<textarea class="txt-area1" name="sname" id="sname" placeholder="Отчество"><?= $card->getSnameTitle();?></textarea>	
	</div>
	
	<div class="element-box2">
		<textarea   name="byear" id="byear"  placeholder="Год рождения"><?= $card->getByearTitle();?></textarea>
	</div>
	
	
	
	<div class="element-box3">
		<div>Пункт</div>
		<div>Волость</div>
		<div>Уезд</div>
	</div>
	
	<div class="element-box4">
		<input type="hidden" name="bplace_id" id="bplace_id" value="<?= $card->bplace->getId();?>">
		<textarea class="txt-area1"  name="punkt" id="punkt" placeholder="Пункт"><?= $card->bplace->getPunkt();?></textarea>
		<textarea class="txt-area1"  name="volost" id="volost" placeholder="Волость"><?= $card->bplace->getVolost();?></textarea>
		<textarea class="txt-area1"  name="uezd" id="uezd" placeholder="Уезд"><?= $card->bplace->getUezd();?></textarea>	
	</div>
	
	<div class="element-box5">
		<!--<select>-->
		<!--	<option value="LF">Да</option>-->
		<!--	<option value="LF" selected="selected">НЕТ</option>-->
		<!--</select>-->
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
	
	<div class="element-box6">
		<textarea class="txt-area2" name="prim" id="prim" placeholder="Примечание"><?= $card->getPrim();?></textarea>
	</div>

</div>

<hr> 
<div>
	Поисковые данные
</div>

	<div style="margin-top:5px; width:100%; display:flex;">

		<input type="hidden" name="finder_id" id="finder_id" value="<?= $card->finder->getId();?>">

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
	
	<?php
	
		if (($user!==null)&&(in_array($user->getRole(),["user","admin"])))
		// if (in_array($user->getRole(),["user","admin"]))
		{
            // throw new UnauthorizedException();
            echo "<hr>";
            echo '<input type="submit" name="edit_card"  id="edit_card" value="Сохранить">';
            echo '<input type="reset" name="reset_card"  id="reset_card" value="Сбросить">';

        }
		// var_dump($user->getRole());
	?>
	<!--<hr>-->
	<!--<input type="submit" name="edit_card"  id="edit_card" value="Сохранить">-->
	<!--<input type="reset" name="reset_card"  id="reset_card" value="Сбросить">-->
	
	<hr>
	<a href="../../">Список беженцев</a>
	<!--<pre>-->
	<?php
	
		// if (($this->user !== null)||(in_array($this->user->getRole(),["user","admin"])))
		// if (($user !== null)||(in_array($user->getRole(),["user","admin"])))
		// {
            // throw new UnauthorizedException();
            
        // }
		// var_dump($user->getRole());
	?>
	
		<?php
	
		if (($user!==null)&&(in_array($user->getRole(),["user","admin"])))
		{
            
			echo '<a href="../../cards/add/">Создать карточку беженца</a>';

        }
		// var_dump($user->getRole());
	?>
	
	
	
	
	<!--<a href="../../cards/add/">Создать карточку беженца</a>-->
	<div id="log">
	</div>
	</form>
	
<hr>

</body>
</html>