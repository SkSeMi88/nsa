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


<?= "Общее количество карточек ".count($cards).'(<a href="/cards/add/">+</a>)';?>
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
<body>
</body>
</html>