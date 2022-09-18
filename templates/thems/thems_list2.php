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
include __DIR__ . '/../header.php';

// var_dump($_SERVER);
// HTTP_HOST
// getenv("REMOTE_ADDR"); //fetch the current user's IP address

?>
Новая тематика
<form name="new_them_form" action="" method="POST">
	<div class='flex-container3' style="display:flex;">
		<div>
			<textarea style="width:570px;" name="new_them_name" id="new_them_name" placeholder="Название"></textarea>
		</div>
		<!-- <div>
			<textarea name="new_them_title" id="new_them_title" style="width:400px;"  name="" id="" >Название</textarea>
		</div>
		<div>
			<textarea name="new_them_dates" id="new_them_dates" >Даты</textarea>
		</div> -->
		<div>
			<!-- <textarea name="new_them_path" id="new_them_path" >Путь</textarea> -->
			<input type="submit" name="create_new_them" value="Создать">
			<input type="reset" name="reset_new_them" value="Сбросить">
		</div>
	</div>
</form>

<hr>
<!-- <input type="button" onclick="document."> -->
<input type="button" value="Создать карточку докумекта" onClick="document.location.href = '../cards/create';">
<!-- <a href="../cards/create">Создать карточку докумекта</a> -->
<hr>

Список тематик<hr>

	<div class='flex-container3' style="display:flex;">
		<div>
			<textarea name="" id="" disabled>Код</textarea>
		</div>
		<div>
			<textarea style="width:400px;"  name="" id="" disabled>Название</textarea>
		</div>
		
		<div>
			<textarea style="width:350px;"  name="" id="" disabled>Действия</textarea>
		</div>
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

	$view2->renderHtml('thems/list_items.php', ['i'=>$i,'them_i' => $t]);
}

// var_dump($view2);


?>