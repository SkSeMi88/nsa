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

        /* #thems_list_box {
            padding     : 0px;
        } */

        .header_page{
            font-size: 20px;
            font-style:bold;
            border-bottom: solid 1px;
            color: red;
        }

        /* #myThems {
            width   : 50%;
        } */

        .cardThem {
            width		: 50%;
            margin	: 3px;
        }

        .cardLine {
            display     : flex;
            margin      : 3px;
            justify-content:flex-start;
        }

        .cardFieldName {
            
            display     : flex;
            width       : 25%;
            /* text-align  : center; */
            text-align  : right;
            align       : right;
            font-style   : italic;
            font-weight: bold;
        }
        

        .cardFieldName > div {
            
            /* display     : flex; */
            /* width       : 15%; */
            /* text-align  : center; */
            text-align  : right;
            align       : right;
        }
        
        .cardFieldValue{
            
            align       : right;
            display     : flex;
            width       : 75%;
        }
        
        .cardFieldValue input, select, textarea{
            
            /* display     : flex; */
            width       : 75%;
        }
        
        /* input > 
        #myThems {
            
            width       : 75%;

        } */

        .finder_box{
            display:    flex;
            /* justify-content: start; */
        }

        .finder-box-value {
            display     : flex;
            width       : 60%;
        }     

        .finder {
            /* display:    flex; */
            width   : 20%;
        }

        /* .finder > div {

            width   : inherit;
            width   : 50%;
            width   : 50%;
        }  */
        
        .finder-name {
            width           : auto;
            margin-right    : 3px;
        }
        
        .finder-value{
            /* display : inline; */
            /* width           : inherit;  */
            /* width           : auto; */
            width           : 80%;
        }

        .finder-value > input {
            width           : inherit; 
            /* width           : 100%;  */
            /* width           : auto; */
            

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



<div class="cardLine">
    <div class="cardFieldName">
        Тип документа
        </div>
     <div class="cardFieldValue"  style="width:25%;">
        <!-- <textarea name="doc_type"><?//=$card->getDocType(); ?></textarea> -->
        <input type="text" name="doc_type" value="<?=$card->getDocType();?>" width="250px;">
    </div>
</div>
<!-- <hr> -->
<div class="cardLine">
    <div class="cardFieldName">
        Дата события
        </div>
     <div class="cardFieldValue"   style="width:25%;">
		 <!-- <textarea name="event_date" required><?//=$card->getEventDate(); ?></textarea> -->
		 <input type="text" name="event_date" required value="<?=$card->getEventDate(); ?>">
		</div>
</div>
<!-- <hr> -->
<div class="cardLine">
    <div class="cardFieldName"   style="width:25%;">
        Дата составления документа
    </div>
     <div class="cardFieldValue"   style="width:25%;">
		 <!-- <textarea name="card_date" required><?//=$card->getCardDate(); ?></textarea> -->
		 <input type="text" name="card_date" required value="<?=$card->getCardDate(); ?>" >
	</div>
</div>
<!-- <hr> -->
<div class="cardLine">
    <div class="cardFieldName">
        Место события
    </div>
     <div class="cardFieldValue"   style="width:25%;">
		 <!-- <textarea name="event_place" required><?//=$card->getEventPlace(); ?></textarea> -->
		 <input type="text" name="event_place" required value="<?=$card->getEventPlace(); ?>">
	</div>
</div>
<!-- <hr> -->
<div class="cardLine">
    <div class="cardFieldName">
		 Место составления документа
    </div>
    <div class="cardFieldValue"   style="width:25%;">
		 <!-- <textarea name="card_place" required><?//=$card->getCardPlace(); ?></textarea> -->
		 <input type="text" name="card_place" required value="<?=$card->getCardPlace(); ?>">
		</div>
</div>

<div class="cardLine">
    <div class="cardFieldName">
        Заголовок документа
    </div>
    <div class="cardFieldValue">
    <!-- <textarea name="doc_header" required><?//=$card->getDocHeader(); ?></textarea> -->
    <input type="text" name="doc_header" required value="<?=$card->getDocHeader(); ?>">
    </div>
</div>

<!-- <hr> -->
    <div class="finder_box">
        <div class="cardFieldName">
            <span>
                Поисковые данные НА РК,
            </span>
        </div>
        <!-- <div style="display:flex;width:75%"> -->
        <div class="finder-box-value">
            <div class="finder">
                <div class="finder-name">
                    Фонд
                </div>
                <div class="finder-value">
                    <Input type="text" id="new_fond"  name="new_fond" placeholder="Фонд" value="<?=$card->shifrFullName["fond"];?>" required>
                </div>
            </div>
            <div class="finder">
                <div class="finder-name">
                    Опись
                </div>
                <div class="finder-value">
                    <Input type="text" id="new_opis"  name="new_opis" placeholder="Опись" value="<?=$card->shifrFullName["opis"];?>" required>
                </div>
            </div>
            <div class="finder">
                <div class="finder-name">
                    Дело
                </div>
                <div class="finder-value">
                    <Input type="text" id="new_delo"  name="new_delo" placeholder="Дело" value="<?=$card->shifrFullName["delo"];?>" required>
                </div>
            </div>
            <div class="finder">
                <div class="finder-name">
                    Лист
                </div>
                <div class="finder-value">
                    <Input type="text" id="new_list"  name="new_list" placeholder="Лист"  value="<?=$card->shifrFullName["list"];?>" required>
                </div>
            </div>
        </div>
            <!-- <div class="finder"></div> -->
    </div>
<!-- <hr> -->

<div class="cardLine">
    <div class="cardFieldName">
        Подлинник/Копия
    </div>
    <div class="cardFieldValue">
        <!-- <textarea name="original" required><?//=$card->getOriginal();?></textarea> -->
        <input type="text" name="original" required value="<?=$card->getOriginal();?>">
    </div>
</div>

<!-- <hr> -->

<div class="cardLine">
    <div class="cardFieldName">
        Язык документа
    </div>
    <div class="cardFieldValue">
        <!-- <textarea name="langs" required><?//=$card->getLangs();?></textarea> -->
        <input type="text" name="langs" required value="<?=$card->getLangs();?>">
    </div>
</div>

<!-- <hr> -->

<div class="cardLine">
    <div class="cardFieldName">
        Способ воспроизведения документа
    </div>
    <div class="cardFieldValue">
        <!-- <textarea name="playback" required><?//=$card->getPlayBack();?></textarea> -->
        <input type="text" name="playback" required value="<?=$card->getPlayBack();?>" >
    </div>
</div>

<!-- <hr> -->

<div class="cardLine">
    <div class="cardFieldName">
        Физическое состояние документа
    </div>
    <div class="cardFieldValue">
        <select name="state" style="width:25%; margin:0px;">
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

<!-- <hr> -->

<div class="cardLine">
    <div class="cardFieldName">
        Составитель карточки
    </div>
    <div class="cardFieldValue">
        <!-- <textarea name="compiler" required><?//=$card->getCompiler();?></textarea> -->
        <input type="text" name="compiler" required value="<?=$card->getCompiler();?>"   style="width:25%;">
        <div class="cardFieldName" style="margin-left:5px;">
            <b>
                <u>
                Дата составления карточки
                </u>
            </b>
        </div>
        <div class="cardFieldName" style="width:25%">
        <!-- <textarea name="compilation_date" required><?php //if (isset($card["compilation_date"])){echo $card["compilation_date"];}?></textarea> -->
        <!-- <textarea name="compilation_date" required><?//=$card->getCompilationDate();?></textarea> -->
        <input type="text" name="compilation_date" required value="<?=$card->getCompilationDate();?>"   style="width:100%;">
    </div>
    </div>
</div>
<!-- <div class="cardLine">
    <div class="cardFieldName">
        Дата составления карточки
    </div>
    <div class="cardFieldValue"> -->
        <!-- <textarea name="compilation_date" required><?php //if (isset($card["compilation_date"])){echo $card["compilation_date"];}?></textarea> -->
        <!-- <textarea name="compilation_date" required><?//=$card->getCompilationDate();?></textarea> -->
        <!-- <input type="text" name="compilation_date" required value="<?//=$card->getCompilationDate();?>"   style="width:25%;"> -->
    <!-- </div>
</div> -->

<!-- <hr> -->


<!-- <hr> -->

<div class="cardLine">
    <div class="cardFieldName">
        Аннотация
    </div>
    <div class="cardFieldValue">
        <textarea name="summary" style="height:18px;width:inherit;"><?= $card->getSummary();?></textarea>
    </div>
</div>

<!-- <hr> -->

<div class="cardLine">
<div style="width:25%;">
    <!-- <div class="cardFieldName"> -->
        Тематика
    </div>
    <!-- <div class="cardFieldValue"> -->
        <div style="width:75%;">

		<input list="myThem" id="myThems" name="thems" style="width:inherit;">
		<datalist id="myThem" >
        <!-- style="width:100%;"> -->

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

		<input type="button" value="Добавить в карточку" onclick="addField(document.querySelector('#myThems').value);">
    </div>
</div>

<div class="cardLine">
    <div class="cardFieldName">
        &nbsp;
    </div>
    <div style="width:75%;">

    <span>
        Добавленые тематики в эту карточку:
    </span>

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
		<!-- <br> -->
	</div>
	</div>
</div>
<!-- <hr> -->
<div class="cardLine">
    <div class="cardFieldName">
        Персоналии
    </div>
    <div class="cardFieldValue">
		<textarea name="persons" style="height:18px;width:inherit;"><?= $card->getPersons();?></textarea>
		<!-- <textarea name="persons"><?//= $card->getPersons();?></textarea> -->

	</div>
</div>
<!-- <hr> -->
<input type="submit" value="Сохранить имзменения" name="edit_card">
<!--    onclick="event.preventDefault();alert(25);">-->
<input type="reset" value="Сбросить изменения">
<input type="button" value="Просмотр изображений карточки" onClick="document.location.href = '../cards/<?=$card->getId();?>/files';">
<input type="button" value="Перейти на главную страницу" onClick="document.location.href = '../';">
</form>

</body>
<!-- <div>Физическое состояние документа</div> -->
<!-- <div>Составитель карточки</div> -->
<!-- <div>Дата составления карточки</div> -->
<!-- <div>Дата составления карточки</div> -->
<!-- <div>Аннотация</div> -->
<!-- <div>Тематика</div> -->
</html>