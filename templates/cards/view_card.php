<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>КТК.Карточка документа.</title>

    <link rel="icon" type="image/ico" href="favicon.png" />

    <link rel="stylesheet" href="../../src/css/style.css" />

    <link rel="stylesheet" href="/ktk/css/mvckb.css" />
    <link rel="stylesheet" href="/ktk/css/create_man.css">
    <link rel="stylesheet" href="/ktk/css/create_card_man.css">
    <link rel="stylesheet" href="/ktk/css/create_man_id.css">
            
    <script src="/ensa/js/ensa.js"></script>

    <style>
        .header_page{
            font-size: 20px;
            font-style:bold;
            border-bottom: solid 1px;
            color: red;
        }

        #myThems {
            width   : 50%;
        }

        .cardThem {
            width		: 50%;
				margin	: 3px;
        }

    </style>


</head>
<body>

<?php
    echo "<div>";
    if (!empty($errors))
    {
        foreach($errors AS $error)
        {
            echo "<div>";
            echo $error;
            echo "</div>";
        }
    }
    echo "</div>";

    echo "<div>";
    if (!empty($msgs))
    {
        foreach($msgs AS $msg)
        {
            echo "<div>";
            echo $msg;
            echo "</div>";
        }
    }
    echo "</div>";
?>

    <div class="header_page">
        <!-- <h2> -->
            Карточка ("документа") № <?=$card->getId();?>
        <!-- </h2> -->
    </div>
<form id="new_ref"  name="new_ref"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" >
<div>
    <div>Тип документа</div>
    <div>
        <textarea name="doc_type"><?=$card->getDocType(); ?></textarea>
    </div>
</div>
<hr>
<div>
    <div>Дата события</div>
    <textarea name="event_date" required><?=$card->getEventDate(); ?></textarea>
</div>
<hr>
<div>
    <div>Дата составления документа</div>
    <textarea name="card_date" required><?=$card->getCardDate(); ?></textarea>
</div>
<hr>
<div>
    <div>Место события</div>
    <textarea name="event_place" required><?=$card->getEventPlace(); ?></textarea>
</div>
<hr>
<div>
    <div>Место составления документа</div>
    <textarea name="card_place" required><?=$card->getCardPlace(); ?></textarea>
</div>

<div>
    <div>Заголовок документа</div>
    <div>
    <textarea name="doc_header" required><?=$card->getDocHeader(); ?></textarea>
    </div>
</div>

<hr>
    <div class="finder_box">
        <div>
            <span>
                Поисковые данные НА РК,
            </span>
        </div>
        <div class="finder">
            <span>Фонд</span>
            <Input type="text" id="new_fond"  name="new_fond" placeholder="Фонд" value="<?=$card->shifrFullName["fond"];?>" required>
        </div>
        <div class="finder">
            <span>Опись</span>
            <Input type="text" id="new_opis"  name="new_opis" placeholder="Опись" value="<?=$card->shifrFullName["opis"];?>" required>
        </div>
        <div class="finder">
            <span>Дело</span>
            <Input type="text" id="new_delo"  name="new_delo" placeholder="Дело" value="<?=$card->shifrFullName["delo"];?>" required>
        </div>
        <div class="finder">
            <span>Лист</span>
            <Input type="text" id="new_list"  name="new_list" placeholder="Лист"  value="<?=$card->shifrFullName["list"];?>" required>
        </div>
        <!-- <div class="finder"></div> -->
    </div>
<hr>

<div>
    <div>Подлинник/Копия</div>
    <div>
        <textarea name="original" required><?=$card->getOriginal();?></textarea>
    </div>
</div>

<hr>

<div>
    <div>Язык документа</div>
    <div>
        <textarea name="langs" required><?=$card->getLangs();?></textarea>
    </div>
</div>

<hr>

<div>
    
    <div>Способ воспроизведения документа</div>
    <div>
        <textarea name="playback" required><?=$card->getPlayBack();?></textarea>
    </div>
</div>

<hr>

<div>
    <div>Физическое состояние документа</div>
    <div>
         <select name="state">
				<?php
					$selected = ["",""];
					// $selected[$card->getState()] = $card->getState()?"selected":"";
					if ($card->getState()==0) {
						$selected[0]	= "selected";
					}
					if ($card->getState()==1) {
						$selected[1]	= "selected";
					}
				?>
             <option value="1" <?=$selected[1];?>> удовлетворительное</option>
             <option value="0" <?=$selected[0];?>> неудовлетворительное</option>
             
         </select>
    </div>
</div>

<hr>

<div>
    
    <div>Составитель карточки</div>
    <div>
        <textarea name="compiler" required><?=$card->getCompiler();?></textarea>
    </div>
</div>

<hr>

<div>
    
    <div>Дата составления карточки</div>
    <div>
        <!-- <textarea name="compilation_date" required><?php //if (isset($card["compilation_date"])){echo $card["compilation_date"];}?></textarea> -->
        <textarea name="compilation_date" required><?=$card->getCompilationDate();?></textarea>
    </div>
</div>

<hr>

<div>
    
    <div>Аннотация</div>
    <div>
        <textarea name="summary" ><?= $card->getSummary();?></textarea>
    </div>
</div>

<hr>

<div>
	<div>Тематика</div>
	<div>

		<input list="myThem" id="myThems" name="thems">
		<datalist id="myThem">
            <?php
					foreach($ThemList AS $thema)
					{
						echo '<option value="'.$thema->getName().'">';
					}
            ?>
            <!-- <option value="Chrome">
            <option value="Firefox">
            <option value="Internet Explorer">
            <option value="Opera">
            <option value="Safari">
            <option value="Microsoft Edge"> -->
		</datalist>

		<input type="button" value="Добавить тему" onclick="addField(document.querySelector('#myThems').value);">
		<div>
			<br>
			Добавлено:
		</div>
		<div id="thems_list_box" name="thems_list_box">
			<?php
				// echo "<pre>";
				// var_dump($card->thems);
				// echo "</pre>";
					// if ((isset($card["thems"]))&&(strlen($card["thems"])>3)){
					// echo '<div><input type="text" name="" value="'.$card["thems"].'">';
					// echo '<input type="button" name="" value="X"></div>';
					// }
					
					// if ((isset($card["new_thems"]))&&(count($card["new_thems"])>0)){
						foreach($card->thems AS $k => $thema)
						{
							echo '<div id="line_them_id_'.$k.'">';
							echo '<input type="text" id="thems_'.$k.'" name="thems['.$k.']" value="'.$thema.'"  class="cardThem">';
							echo '<input type="button" name="" value="X" onClick="deleteCardThem('.$k.')">';
							// echo '<input type="button" name="" value="X" onClick="deleteCardThem();">';
							echo '</div>';

						}
					// }
            ?>
		</div>
		<br>
	</div>
</div>
<hr>
<div>
	<!-- <div>Физическое состояние документа</div> -->
	<!-- <div>Составитель карточки</div> -->
	<!-- <div>Дата составления карточки</div> -->
	<!-- <div>Дата составления карточки</div> -->
	<!-- <div>Аннотация</div> -->
	<!-- <div>Тематика</div> -->
	<div>Персоналии</div>
	<div>
		<textarea name="persons"  ><?= $card->getPersons();?></textarea>
	</div>
</div>
<hr>
<input type="submit" value="Сохранить имзменения" name="edit_card">
<!--    onclick="event.preventDefault();alert(25);">-->
<input type="reset" value="Сбросить изменения">
<input type="button" value="Просмотр изображений карточки" onClick="document.location.href = '../cards/<?=$card->getId();?>/files';">
<input type="button" value="Перейти на главную страницу" onClick="document.location.href = '../';">
</form>

</body>
</html>