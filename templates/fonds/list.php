<?php
include __DIR__ . '/../header.php';

// var_dump($fond);

// echo "Список фондов<hr>";
?>

Новый фонд
<form name="new_fond_form" action="/fonds" method="POST">
	<div class='flex-container3' style="display:flex;">
		<div>
			<textarea name="new_fond_name" id="new_fond_name" >Код</textarea>
		</div>
		<div>
			<textarea name="new_fond_title" id="new_fond_title" style="width:400px;"  name="" id="" >Название</textarea>
		</div>
		<div>
			<textarea name="new_fond_dates" id="new_fond_dates" >Даты</textarea>
		</div>
		<div>
			<textarea name="new_fond_path" id="new_fond_path" >Путь</textarea>
			<input type="submit" name="create_new_fond" value="Создать">
			<input type="reset" name="reset_new_fond" value="Сбросить">
		</div>
	</div>
</form>

<hr>

Список фондов<hr>

	<div class='flex-container3' style="display:flex;">
		<div>
			<textarea name="" id="" disabled>Код</textarea>
		</div>
		<div>
			<textarea style="width:400px;"  name="" id="" disabled>Название</textarea>
		</div>
		<div>
			<textarea name="" id="" disabled>Даты</textarea>
		</div>
		<div>
			<textarea name="" id="" disabled>Действия</textarea>
		</div>
	</div>

	<hr>

<?php
foreach($fond AS $i =>$f){
	
	
	// echo $f->getName();
	// echo $f->getTitle();
	// echo $f->getDates();
	// echo "<hr>";
	
	$view2->renderHtml('fonds/list_items.php', ['fond_i' => $f]);
}

// var_dump($view2);


?>