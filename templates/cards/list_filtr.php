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


<!--<?= "Общее количество карточек ".count($cards).'(<a href="/cards/add/">+</a>)';?>-->
<?= "Общее количество карточек ".$count_all.'(<a href="/cards/add/">+</a>)';?>
<?= '';//'<br><a href="../cards/add/">Создать новую карточку</a>';?>
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

<form name="filtr_form" id="filtr_form"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" > 
<!--</form>onsubmit="return check_form_create();">-->
	<!--<form id="new_ref"  name="new_ref"  method="post" action="<?php //echo $_SERVER['REQUEST_URI']."/edit/";?>" onsubmit="return check_form_create();">-->

	<div class='flex-container3'>

		<div>
			<!--<a href="../cards/<?//= $card->getId();?>/"><?//= $i+1;?></a>-->
		</div>

		<div>
			<div>
				<input name="filtr-fname" id="filtr-fname" type="text" value="<?php if (isset($_REQUEST["filtr-fname"])) {echo $_REQUEST["filtr-fname"];}?>">
			</div>
			<div>
				<input name="filtr-name" id="filtr-name" type="text" value="<?php if (isset($_REQUEST["filtr-name"])) {echo $_REQUEST["filtr-name"];}?>">
			</div>
			<div>
				<input name="filtr-sname" id="filtr-sname" type="text" value="<?php if (isset($_REQUEST["filtr-sname"])) {echo $_REQUEST["filtr-sname"];}?>">
			</div>
		</div>

		<div>
			<input name="filtr-byear" id="filtr-byear" type="text" value="<?php if (isset($_REQUEST["filtr-byear"])) {echo $_REQUEST["filtr-byear"];}?>">
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
				<textarea name="filtr-punkt" id="filtr-punkt" ><?php if (isset($_REQUEST["filtr-punkt"])) {echo $_REQUEST["filtr-punkt"];}?></textarea>
			</div>

			<div>
				<!-- <? //= $card->bplace->getVolost();?> -->
				<textarea name="filtr-volost" id="filtr-volost" ><?php if (isset($_REQUEST["filtr-volost"])) {echo $_REQUEST["filtr-volost"];}?></textarea>
			</div>

			<div> 
				<? //= $card->bplace->getUezd();?>
				<textarea name="filtr-uezd" id="filtr-uezd" ><?php if (isset($_REQUEST["filtr-uezd"])) {echo $_REQUEST["filtr-uezd"];}?></textarea>
			</div>
		</div>

		<div>
			<?php
			
				$select  = '<select name="filtr-photo" id="filtr-photo">';
			
				$s0	=  (!empty($_REQUEST["filtr-photo"])&&($_REQUEST["filtr-photo"]==-1))?"selected":"";
				$s2	=  (!empty($_REQUEST["filtr-photo"])&&($_REQUEST["filtr-photo"]==0))?"selected":"";
				$s1	=  (!empty($_REQUEST["filtr-photo"])&&($_REQUEST["filtr-photo"]==1))?"selected":"";
			
				

				$select	.= '<option value="-1" '.$s0.'>Все</option>';
				$select	.= '<option value="0" '.$s2.'>Нет</option>';
				$select	.= '<option value="1" '.$s1.'>Есть</option>';
			
				$select		.= '</select>';
			
				echo $select;
			?>
		</div>

		<div>
			<?php //echo $card->getPrim();?>
			<textarea class="prim-box" name="filtr-prim" id="filtr-prim" ><?php if (isset($_REQUEST["filtr-prim"])) {echo $_REQUEST["filtr-prim"];}?></textarea>
		</div>
	</div>
<hr>
	<input type="submit" value="Найти">
	<input type="reset" value="Сбросить">
	<input type="button" value="Очистить" onClick="clearFiltrFields();">
</form>
Reзультат(<?= count($cards);?>)
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

	<?php
	
		// echo count($cards)."<pre>";
		foreach ($cards as $i => $card) {

			$view2->renderHtml('cards/list_items.php', ["i"=>$i,'card' => $card]);
			// echo "<hr>";
		}
	
	?>
	
</div>
<script>
	function clearFiltrFields(){
		console.log(document.forms.filtr_form);
		var Forma	= document.forms.filtr_form;
		var fields = {
			"fname": "Фамилия",
	        "name": "Имя",
	        "sname": "Отчество",
	        "byear": "Год рождения",
	
	        "prim": "Примечание",
	        "photo": "Фотография",
	        
	        "punkt"	: "Населенный пункт",
	        "volost"	: "Волость",
	        "uezd"	: "Уезд",
		}
		
		
			
	    for (var field in fields) {
	    	
	        console.log(">", field, Forma["filtr-"+field].value.length, Forma["filtr-"+field].value);
	        Forma["filtr-"+field].value="";
	        console.log(">", field, Forma["filtr-"+field].value.length, Forma["filtr-"+field].value);
	        
	    }

	}
</script>
</body>
</html>