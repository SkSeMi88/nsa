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
            Создание карточки "документа"
        <!-- </h2> -->
    </div>
<form id="new_ref"  name="new_ref"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" >
<div>
    <div>Тип документа</div>
    <div>
        <textarea name="doc_type"><?php if (isset($_POST["doc_type"])){echo $_POST["doc_type"];}?></textarea>
    </div>
</div>
<hr>
<div>
    <div>Дата события</div>
    <textarea name="event_date" required><?php if (isset($_POST["event_date"])){echo $_POST["event_date"];}?></textarea>
</div>
<hr>
<div>
    <div>Дата составления документа</div>
    <textarea name="card_date" required><?php if (isset($_POST["card_date"])){echo $_POST["card_date"];}?></textarea>
</div>
<hr>
<div>
    <div>Место события</div>
    <textarea name="event_place" required><?php if (isset($_POST["event_place"])){echo $_POST["event_place"];}?></textarea>
</div>
<hr>
<div>
    <div>Место составления документа</div>
    <textarea name="card_place" required><?php if (isset($_POST["card_place"])){echo $_POST["card_place"];}?></textarea>
</div>

<div>
    <div>Заголовок документа</div>
    <div>
    <textarea name="doc_header" required><?php if (isset($_POST["doc_header"])){echo $_POST["doc_header"];}?></textarea>
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
            <Input type="text" id="new_fond"  name="new_fond" placeholder="Фонд" value="<?php if (isset($_POST["new_fond"])){echo $_POST["new_fond"];}?>" required></Input>
        </div>
        <div class="finder">
            <span>Опись</span>
            <Input type="text" id="new_opis"  name="new_opis" placeholder="Опись" value="<?php if (isset($_POST["new_opis"])){echo $_POST["new_opis"];}?>" required></Input>
        </div>
        <div class="finder">
            <span>Дело</span>
            <Input type="text" id="new_delo"  name="new_delo" placeholder="Дело" value="<?php if (isset($_POST["new_delo"])){echo $_POST["new_delo"];}?>" required></Input>
        </div>
        <div class="finder">
            <span>Лист</span>
            <Input type="text" id="new_list"  name="new_list" placeholder="Лист" value="<?php if (isset($_POST["new_list"])){echo $_POST["new_list"];}?>" required></Input>
        </div>
        <!-- <div class="finder"></div> -->
        <!-- <div class="finder"></div> -->
    </div>
<hr>

<div>
    <div>Подлинник/Копия</div>
    <div>
        <textarea name="original" required><?php if (isset($_POST["original"])){echo $_POST["original"];}?></textarea>
    </div>
</div>

<hr>

<div>
    <div>Язык документа</div>
    <div>
        <textarea name="langs" required><?php if (isset($_POST["langs"])){echo $_POST["langs"];}?></textarea>
    </div>
</div>

<hr>

<div>
    
    <div>Способ воспроизведения документа</div>
    <div>
        <textarea name="playback" required><?php if (isset($_POST["playback"])){echo $_POST["playback"];}?></textarea>
    </div>
</div>

<hr>

<div>
    <div>Физическое состояние документа</div>
    <div>
         <select name="state">
             <option value="1"> удовлетворительное</option>
             <option value="0"> неудовлетворительное</option>
             
         </select>
    </div>
</div>

<hr>

<div>
    
    <div>Составитель карточки</div>
    <div>
        <textarea name="compiler" required><?php if (isset($_POST["compiler"])){echo $_POST["compiler"];}?></textarea>
    </div>
</div>

<hr>

<div>
    
    <div>Дата составления карточки</div>
    <div>
        <!-- <textarea name="compilation_date" required><?php //if (isset($_POST["compilation_date"])){echo $_POST["compilation_date"];}?></textarea> -->
        <textarea name="compilation_date" required><?= date("Y-m-d H:i:s");?></textarea>
    </div>
</div>

<hr>

<div>
    
    <div>Аннотация</div>
    <div>
        <textarea name="summary" ><?php if (isset($_POST["summary"])){echo $_POST["summary"];}?></textarea>
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
            <option value="Chrome">
            <option value="Firefox">
            <option value="Internet Explorer">
            <option value="Opera">
            <option value="Safari">
            <option value="Microsoft Edge">
        </datalist>

        <input type="button" value="Добавить тему" onclick="addField(document.querySelector('#myThems').value);">
        
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
<div>
    <!-- <div>Физическое состояние документа</div> -->
    <!-- <div>Составитель карточки</div> -->
    <!-- <div>Дата составления карточки</div> -->
    <!-- <div>Дата составления карточки</div> -->
    <!-- <div>Аннотация</div> -->
    <!-- <div>Тематика</div> -->
    <div>Персоналии</div>
    <div>
        <textarea name="persons" required><?php if (isset($_POST["persons"])){echo $_POST["persons"];}?></textarea>
    </div>
</div>

<input type="submit" value="Создать" >
<!--    onclick="event.preventDefault();alert(25);">-->
<input type="reset" value="Сбросить">
</form>

<!-- <input type="button" value="MAN" onClick="console.log(MAN);"> -->

</body>
</html>

<!-- CREATE TABLE `ensa`.`cards` ( `id` INT NOT NULL AUTO_INCREMENT , `doc_type` INT NOT NULL , `event_date` TEXT NOT NULL , `card_date` TEXT NOT NULL , `event_place` TEXT NOT NULL , `card_place` TEXT NOT NULL , `doc_header` TEXT NOT NULL , `shifr_id` INT NOT NULL , `original` TEXT NOT NULL , `langs` TEXT NOT NULL , `playback` TEXT NOT NULL , `state` TEXT NOT NULL , `compiler` TEXT NOT NULL , `compilation_вфеу` TEXT NOT NULL , `summary` TEXT NOT NULL , `persons` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;  -->
<!-- ALTER TABLE `doc_types` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`); 
INSERT INTO `doc_types` (`id`, `name`) VALUES (NULL, 'Документ на бумажной основе'), (NULL, 'НТД'); 
INSERT INTO `doc_types` (`id`, `name`) VALUES (NULL, 'Фотодокумент'); 
-->
