<?php
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

Список тематик(<?= count($thems);?>)
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
			Название
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
foreach($thems AS $i =>$t){

	$view2->renderHtml('thems/list_items3.php', ['i'=>$i,'them_i' => $t]);
}

// var_dump($view2);


?>