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

		body {
			margin		: 0px;
			padding		: 0px;
			/*text-align	: left;*/
		}
		
		.user-line {
			/*margin		: 0px;*/
			padding			: 2px;
			padding-right	: 10px;
			width			: auto;/*100%;*/
			height			: 20px;
			font-size		: 18px;
			background		: silver;
			text-align		: right;
		}
		
		.logo-line {
			margin		: 0px;
			padding			: 0px;
			/*padding-right	: 10px;*/
			width			: 100%;
			height			: 32px;
			font-size		: 32px;
			/*background		: silver;*/
			text-align		: left;
		}
		
		.body_page {
			margin			: 250px;
			padding			: 0px;
		}

		
		.menu-line {
			display			: flex;
			margin			: 3px;
			border-top		: solid 1px;
			border-bottom	: solid 1px;
		}

		.menu-line > div {
			display			: flex;
			margin			: 3px;
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
        $msgs[] = "В нижерасположенной форме Вы можете создать следующую (новую) карточку на основе созданной.";
        $msgs[] = "Заполните поля и нажмите сохранить.";
        foreach($msgs AS $msg)
        {
            echo "<div>";
            echo $msg;
            echo "</div>";
        }
    }
    echo "</div>";
?>

<body>
<div>
	<div class="user-line">
		<?php

	        if ($user!==null)
	        {

	            $user_profile_link_1  = "/users/profile/";//.$user->getId();
	            $user_profile_link_2  = "/users/logout/";//.$user->getId();
	            $logined = 'Привет, <a href="'.$user_profile_link_1.'">'. $user->getNickname().'</a> | <a href="'.$user_profile_link_2.'">Выйти</a>';
	            $logined = '<a href="'.$user_profile_link_1.'">'. $user->getFio().'('.$user->getRoleName().')</a> | <a href="'.$user_profile_link_2.'">Выйти</a>';
	            echo $logined;
	        }
	        else{
	
	            // не авторизованная загрузка страница
	            $not_logined     =  '<a href="/users/login">Войти</a>';
	            $not_logined    .=  ' | <a href="/users/signup/">Зарегистрироваться</a>';
	            echo $not_logined;
	        }
		?>
	</div>
	
	<div class="logo-line">
		НСА 2021
		<!--&nbsp;-->
	</div>

	<div class="menu-line">
		<!--&nbsp;-->
		<?//=$user_menu;?>
		<?php
		// var_dump($UserMenu);
		print_r($UserMenu);
		?>
	</div>
</div>
<div class="body-page">


</div>


    <div class="header_page">
        <!-- <h2> -->
            Создание карточки "документа"
        <!-- </h2> -->
    </div>
<form id="new_ref"  name="new_ref"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" >
<!-- <div>
    <div>Тип документа</div>
    <div> -->
        <!-- <textarea name="doc_type"><?php //if (isset($_POST["doc_type"])){echo $_POST["doc_type"];}?></textarea> -->
    <!-- </div>
</div> -->

<div class="cardLine">
    <div class="cardFieldName">
        Тип документа
        </div>
     <div class="cardFieldValue"  style="width:25%;">
        <!-- <textarea name="doc_type"><?//=$card->getDocType(); ?></textarea> -->
        <input type="text" name="doc_type" value="<?php if (isset($_POST["doc_type"])){echo $_POST["doc_type"];}?>" width="250px;">
    </div>
</div>

<!-- <hr> -->

<div class="cardLine">
    <div class="cardFieldName">
        Дата события
        </div>
     <div class="cardFieldValue"   style="width:25%;">
		 <!-- <textarea name="event_date" required><?//=$card->getEventDate(); ?></textarea> -->
		 <input type="text" name="event_date" required value="<?php if (isset($_POST["event_date"])){echo $_POST["event_date"];}?>">
		</div>
</div>
<!-- <hr> -->
<div class="cardLine">
    <div class="cardFieldName"   style="width:25%;">
        Дата составления документа
    </div>
     <div class="cardFieldValue"   style="width:25%;">
		 <!-- <textarea name="card_date" required><?//=$card->getCardDate(); ?></textarea> -->
		 <input type="text" name="card_date" required value="<?php if (isset($_POST["card_date"])){echo $_POST["card_date"];}?>" >
	</div>
</div>
<!-- <hr> -->
<div class="cardLine">
    <div class="cardFieldName">
        Место события
    </div>
     <div class="cardFieldValue"   style="width:25%;">
		 <!-- <textarea name="event_place" required><?//=$card->getEventPlace(); ?></textarea> -->
		 <input type="text" name="event_place" required value="<?php if (isset($_POST["event_place"])){echo $_POST["event_place"];}?>">
	</div>
</div>
<!-- <hr> -->
<div class="cardLine">
    <div class="cardFieldName">
		 Место составления документа
    </div>
    <div class="cardFieldValue"   style="width:25%;">
		 <!-- <textarea name="card_place" required><?//=$card->getCardPlace(); ?></textarea> -->
		 <input type="text" name="card_place" required value="<?php if (isset($_POST["card_place"])){echo $_POST["card_place"];}?>">
		</div>
</div>

<!-- <hr> -->


<div class="cardLine">
    <div class="cardFieldName">
        Заголовок документа
    </div>
    <div class="cardFieldValue">
    <!-- <textarea name="doc_header" required><?//=$card->getDocHeader(); ?></textarea> -->
    <input type="text" name="doc_header" required value="<?php if (isset($_POST["doc_header"])){echo $_POST["doc_header"];}?>">
    </div>
</div>



<!-- <div>
    <div>Дата события</div>
    <textarea name="event_date" required><?php //if (isset($_POST["event_date"])){echo $_POST["event_date"];}?></textarea>
</div> -->
<!-- <hr> -->
<!-- <div>
    <div>Дата составления документа</div>
    <textarea name="card_date" required><?php //if (isset($_POST["card_date"])){echo $_POST["card_date"];}?></textarea>
</div> -->
<!-- <hr> -->
<!-- <div>
    <div>Место события</div>
    <textarea name="event_place" required><?php //if (isset($_POST["event_place"])){echo $_POST["event_place"];}?></textarea>
</div> -->
<!-- <hr> -->
<!-- <div> -->
    <!-- <div>Место составления документа</div> -->

    <!-- <textarea name="card_place" required><?php //if (isset($_POST["card_place"])){echo $_POST["card_place"];}?></textarea> -->
<!-- </div> -->

<!-- <div> -->
    <!-- <div>Заголовок документа</div> -->
    <!-- <div> -->
    <!-- <textarea name="doc_header" required><?php //if (isset($_POST["doc_header"])){echo $_POST["doc_header"];}?></textarea> -->
    <!-- </div> -->
<!-- </div> -->


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
                    <Input type="text" id="new_fond"  name="new_fond" placeholder="Фонд" value="<?php if (isset($_POST["new_fond"])){echo $_POST["new_fond"];}?>" required>
                </div>
            </div>
            <div class="finder">
                <div class="finder-name">
                    Опись
                </div>
                <div class="finder-value">
                    <Input type="text" id="new_opis"  name="new_opis" placeholder="Опись" value="<?php if (isset($_POST["new_opis"])){echo $_POST["new_opis"];}?>" required>
                </div>
            </div>
            <div class="finder">
                <div class="finder-name">
                    Дело
                </div>
                <div class="finder-value">
                    <Input type="text" id="new_delo"  name="new_delo" placeholder="Дело" value="<?php if (isset($_POST["new_delo"])){echo $_POST["new_delo"];}?>" required>
                </div>
            </div>
            <div class="finder">
                <div class="finder-name">
                    Лист
                </div>
                <div class="finder-value">
                    <Input type="text" id="new_list"  name="new_list" placeholder="Лист"  value="<?php if (isset($_POST["new_list"])){echo $_POST["new_list"];}?>" required>
                </div>
            </div>
        </div>
            <!-- <div class="finder"></div> -->
    </div>
<!-- <hr>
    <div class="finder_box">
        <div>
            <span>
                Поисковые данные НА РК,
            </span>
        </div>
        <div class="finder">
            <span>Фонд</span>
            <Input type="text" id="new_fond"  name="new_fond" placeholder="Фонд" value="<?php //if (isset($_POST["new_fond"])){echo $_POST["new_fond"];}?>" required></Input>
        </div>
        <div class="finder">
            <span>Опись</span>
            <Input type="text" id="new_opis"  name="new_opis" placeholder="Опись" value="<?php //if (isset($_POST["new_opis"])){echo $_POST["new_opis"];}?>" required></Input>
        </div>
        <div class="finder">
            <span>Дело</span>
            <Input type="text" id="new_delo"  name="new_delo" placeholder="Дело" value="<?php //if (isset($_POST["new_delo"])){echo $_POST["new_delo"];}?>" required></Input>
        </div>
        <div class="finder">
            <span>Лист</span>
            <Input type="text" id="new_list"  name="new_list" placeholder="Лист" value="<?php //if (isset($_POST["new_list"])){echo $_POST["new_list"];}?>" required></Input>
        </div>
        <div class="finder"></div>
        <div class="finder"></div>
    </div>
<hr> -->

<!-- <div>
    <div>Подлинник/Копия</div>
    <div>
        <textarea name="original" required><?php //if (isset($_POST["original"])){echo $_POST["original"];}?></textarea>
    </div>
</div> -->

<div class="cardLine">
    <div class="cardFieldName">
        Подлинник/Копия
    </div>
    <div class="cardFieldValue">
        <!-- <textarea name="original" required><?//=$card->getOriginal();?></textarea> -->
        <input type="text" name="original" required value="<?php if (isset($_POST["original"])){echo $_POST["original"];}?>">
    </div>
</div>

<!-- <hr> -->

<!-- <div>
    <div>Язык документа</div>
    <div>
        <textarea name="langs" required><?php //if (isset($_POST["langs"])){echo $_POST["langs"];}?></textarea>
    </div>
</div> -->

<div class="cardLine">
    <div class="cardFieldName">
        Язык документа
    </div>
    <div class="cardFieldValue">
        <!-- <textarea name="langs" required><?//=$card->getLangs();?></textarea> -->
        <input type="text" name="langs" required value="<?php if (isset($_POST["langs"])){echo $_POST["langs"];}?>">
    </div>
</div>


<!-- <hr>

<div>
   <div>Способ воспроизведения документа</div>
   <div>
      <textarea name="playback" required><?php //if (isset($_POST["playback"])){echo $_POST["playback"];}?></textarea>
   </div>
</div> -->

<div class="cardLine">
    <div class="cardFieldName">
        Способ воспроизведения документа
    </div>
    <div class="cardFieldValue">
        <input type="text" name="playback" required value="<?php if (isset($_POST["playback"])){echo $_POST["playback"];}?>" >
    </div>
</div>

<!-- <hr> -->

<!-- <div>
	<div>Физическое состояние документа</div>
	<div>
		<select name="state">
				<option value="1"> удовлетворительное</option>
				<option value="0"> неудовлетворительное</option>
		</select>
	</div>
</div> -->

<!-- fonds = [
	"items"	=>[],
	id	=> [
		items => [],
		opis_id => [
		
			"items"	=> [
				
			]

			delo_id 	=> [

				"items"	=> []
				list_id	=> [
				
				]
			]
		]

	]
] -->
<div class="cardLine">
	<div class="cardFieldName">
		Физическое состояние документа
	</div>
	<div class="cardFieldValue">
		<select name="state" style="width:25%; margin:0px;">
			<?php
				$selected = ["",""];

				if ((isset($_POST["state"]))&&($_POST["state"]==0)) {
					$selected[0]	= "selected";
				}

				if ((isset($_POST["state"]))&&($_POST["state"]==1)) {
					$selected[1]	= "selected";
				}
			?>
			<option value="1" <?=$selected[1];?>> удовлетворительное</option>
			<option value="0" <?=$selected[0];?>> неудовлетворительное</option>
		</select>
	</div>
</div>

<!-- <hr> -->

<!-- <div>
    
    <div>Составитель карточки</div>
    <div>
        <textarea name="compiler" required><?php //if (isset($_POST["compiler"])){echo $_POST["compiler"];}?></textarea>
    </div>
</div>

<hr>

<div>
    
    <div>Дата составления карточки</div>
    <div>
        <!-- <textarea name="compilation_date" required><?php //if (isset($_POST["compilation_date"])){echo $_POST["compilation_date"];}?></textarea> -->
        <!-- <textarea name="compilation_date" required><?//= date("Y-m-d H:i:s");?></textarea>
    </div>
</div> -->



<div class="cardLine">
	<div class="cardFieldName">
		Составитель карточки
	</div>
	<div class="cardFieldValue">
		<input type="text" name="compiler" required value="<?php if (isset($_POST["compiler"])){echo $_POST["compiler"];}?>"   style="width:25%;">
		<div class="cardFieldName" style="text-align:center;">
			<div style="margin-left:75px;">
			<!-- <div style="text-align:center;"> -->
				<b>
					<u>
						Дата составления карточки
					</u>
				</b>
			</div>
		</div>
		<div class="cardFieldName" style="width:25%">
			<input type="text" name="compilation_date" required value="<?= date("Y-m-d H:i:s");?>"   style="width:100%;">
		</div>
	</div>
</div>


<!-- <hr> -->

<!-- <div>
    
    <div>Аннотация</div>
    <div>
        <textarea name="summary" ><?php //if (isset($_POST["summary"])){echo $_POST["summary"];}?></textarea>
    </div>
</div> -->

<div class="cardLine">
    <div class="cardFieldName">
        Аннотация
    </div>
    <div class="cardFieldValue">
        <textarea name="summary" style="height:18px;width:inherit;"><?php if (isset($_POST["summary"])){echo $_POST["summary"];}?></textarea>
    </div>
</div>

<!-- <hr> -->



<div class="cardLine">
	<div class="cardFieldName">
		Тематика
	</div>
	<div style="width:70%;">

		<input list="myThem" id="myThems" name="thems" style="width:inherit;">
		<datalist id="myThem">
			<?php
					foreach($ThemList AS $thema)
					{
						echo '<option value="'.$thema->getName().'">';
					}
			?>

		</datalist>

		<!-- <input type="button" value="Добавить тему" onclick="addField(document.querySelector('#myThems').value);"> -->
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
                if ((isset($_POST["thems"]))&&(strlen($_POST["thems"])>3)){
                    echo '<div><input type="text" name="" value="'.$_POST["thems"].'">';
                    echo '<input type="button" name="" value="X"></div>';
                }
                
                if ((isset($_POST["new_thems"]))&&(count($_POST["new_thems"])>0)){
                    foreach($_POST["new_thems"] AS $k => $thema)
                    {
                        echo '<div><input type="text" id="new_thems'.$k.'" name="new_thems[]" value="'.$thema.'">';
                        echo '<input type="button" name="" value="X"></div>';

                    }
                }
            ?>
        </div>
    </div>
</div>

<hr>
<div class="cardLine">
	<div class="cardFieldName">
		Персоналии
	</div>
	<div class="cardFieldValue">
		<textarea name="persons" style="height:18px;width:inherit;"><?php if (isset($_POST["persons"])){echo $_POST["persons"];}?></textarea>
	</div>
</div>

<hr>
<input type="submit" value="Создать" >
<input type="reset" value="Сбросить">
<input type="button" value="Отемнить создание карточки" onClick="document.location.href = '../../';">
</form>
</body>
</html>

<!-- CREATE TABLE `ensa`.`cards` ( `id` INT NOT NULL AUTO_INCREMENT , `doc_type` INT NOT NULL , `event_date` TEXT NOT NULL , `card_date` TEXT NOT NULL , `event_place` TEXT NOT NULL , `card_place` TEXT NOT NULL , `doc_header` TEXT NOT NULL , `shifr_id` INT NOT NULL , `original` TEXT NOT NULL , `langs` TEXT NOT NULL , `playback` TEXT NOT NULL , `state` TEXT NOT NULL , `compiler` TEXT NOT NULL , `compilation_вфеу` TEXT NOT NULL , `summary` TEXT NOT NULL , `persons` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;  -->
<!-- ALTER TABLE `doc_types` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`); 
INSERT INTO `doc_types` (`id`, `name`) VALUES (NULL, 'Документ на бумажной основе'), (NULL, 'НТД'); 
INSERT INTO `doc_types` (`id`, `name`) VALUES (NULL, 'Фотодокумент'); 

ALTER TABLE `cards` CHANGE `state` `state` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0';

ALTER TABLE `cards` CHANGE `state` `state` TINYINT NULL DEFAULT '0';

-->
