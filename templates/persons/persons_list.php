<?php
$title_page = "Список персоналий";

if (count($msg)!=0){
	foreach($msg AS $m){

		echo '<div>'.$m.'</div>';
	}
}
if ((isset($error))&&(strlen($error)!=0)){
	// foreach($msg AS $m){

		echo '<div>'.$error.'</div>';
	// }
}

include __DIR__ . '/../header2.php';

?>

Список персоналий(<?= count($persons);?>)
<hr>
<?// var_dump($thems[0])?>
<!-- <hr> -->
<input type="button" value="Создать карточку докумекта" onClick="document.location.href = '../cards/create';">

<hr>


	<div class='flex-container3' style="display:flex;">
		<!-- <div>
			<textarea name="" id="" disabled>№ п/п</textarea>
		</div> -->
		<!-- <div>
			<textarea style="width:400px;"  name="" id="" disabled>Название</textarea>
		</div> -->
		<div style="width:50px;">
			№ п/п
		</div>
		<div style="width:100px;">
			<!-- <textarea   name="" id="" disabled>Название</textarea> -->
			Кол-во карточек
		</div>
		<div style="width:400px;">
			<!-- <textarea   name="" id="" disabled>Название</textarea> -->
			Имя персоналии
		</div>
		<div style="width:400px;">
			<!-- <textarea   name="" id="" disabled>Название</textarea> -->
			Описание персоналии
		</div>
		
		<!-- <div>
			<textarea style="width:350px;"  name="" id="" disabled>Действия</textarea>
		</div> -->
		<!-- <div>
			<textarea name="" id="" disabled>Даты</textarea>
		</div>
		<div>
			<textarea name="" id="" disabled>Действия</textarea>
		</div> -->
	</div>

	<hr>

<?php
foreach($persons AS $i =>$person_i){

	// $view2->renderHtml('persons/list_items.php', ['i'=>$i,'person_i' => $p]);
	// echo "<br>";
	// print_r($t->getCount());

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

<?php
}

// var_dump($view2);
?>