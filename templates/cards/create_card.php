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
            
    <!-- Скрипт загатовка -->
    <script src="/ktk/js/mvckb.js"></script>
    <script src="/ktk/js/live_search.js"></script>
<!--    <script src="/ktk/js/kb.js"></script>-->
    <script src="/ktk/js/create_card_man.js"></script>

    <!-- Стили общие -->
    <!-- <link rel="stylesheet" type="text/css" href="./views/man/css/create_man.css"> -->
    <link rel="stylesheet" type="text/css" href="../src/css/create_man.css">

    <link rel="stylesheet" href="../../src/css/list.css">


</head>
<!--<form action="/cards/create_card.php" method="post">-->
<form id="new_ref"  name="new_ref"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" >
<!--    onsubmit="return check_form();">-->
<?php
print_r($_REQUEST);
print_r($_POST);
?>

<!--    onkeyup="EditFIO('fname', this.value);"-->
<div class="create_card_form">
    <div class="card_field_box">
        <!-- <input id="new_fname"   name="new_fname[]"  placeholder="Фамилия"> -->
        <textarea id="new_fname"   name="new_fname[]"  placeholder="Фамилия"></textarea>
        <input type="button" value="+" onclick="addField('fname');">
        <div id="new_fname_box"></div>
    </div>
    <div class="card_field_box">
        <textarea id="new_name" name="new_name[]" placeholder="Имя"></textarea>
        <input type="button" value="+" onclick="addField('name');">
        <div id="new_name_box"></div>
    </div>
    <div class="card_field_box">

            <textarea id="new_sname" name="new_sname[]" placeholder="Отчество"></textarea>
<!--            <textarea id="new_sname" onkeyup="EditFIO('sname', this.value);" placeholder="Отчество"></textarea>-->
            <input type="button" value="+" onclick="addField('sname');">

        <div id="new_sname_box"></div>
    </div>

    <div class="card_field_box">
        <textarea id="new_byear" name="new_byear[]" placeholder="Год рождения"></textarea>
<!--        <textarea id="new_byear" onkeyup="EditFIO('byear', this.value);" placeholder="Год рождения"></textarea>-->
        <input type="button" value="+" onclick="addField('byear');">
        <div id="new_byear_box"></div>
    </div>

    <div class="card_field_box">
        <input type="hidden" id="bplace_id" name="bplace_id" value="0">
        <div class="live_search1">
            <div class="bp_type">

                <div class="bp_type_name">
                    Пункт
                </div>

                <div class="bp_type_value">
                    <textarea id="search_t1" name="punkt" onkeyup="SendAjaxData3(1, this.value)"  placeholder="Населенный пункт"></textarea>
<!--                    onfocusout="hideLiveSearchBox('t1')"-->
                </div>
            </div>
            <div class="live_search_box" id="t1_result">
                <ul id="live_search_r1" >
                </ul>
            </div>
        </div>
        <div class="live_search1">
            <div class="bp_type">
                <div class="bp_type_name">
                    Волость
                </div>
                <div class="bp_type_value">
                    <textarea id="search_t2" name="volost" onkeyup="SendAjaxData3(2, this.value)"  onfocusout="hideLiveSearchBox('t2')"placeholder="Волость"></textarea>
                </div>
            </div>
            <div class="live_search_box" id="t2_result">
                <ul id="live_search_r2" >
                </ul>
            </div>
        </div>
    <div class="live_search1">
        <div class="bp_type">
            <div class="bp_type_name">
                Уезд
            </div>
            <div class="bp_type_value">
                <textarea id="search_t3" name="uezd" onkeyup="SendAjaxData3(3, this.value)"  onfocusout="hideLiveSearchBox('t3')"placeholder="Уезд"></textarea>
                </div>
        </div>
            <div class="live_search_box" id="t3_result">
                <ul id="live_search_r3">
                </ul>
            </div>
        </div>
    </div>

    <div class="card_field_box">
        <select class="photo" id="new_photo" name="new_photo">
            <option value="0" >Нет</option>
            <option value="1" selected="selected">Да</option>
        </select>
    </div>

    <div class="card_field_box">
        <textarea id="new_prim" name="new_prim" placeholder="Примечание"></textarea>
    </div>
</div>
<hr>
    <div class="finder_box">
        <span>
            Поисковые данные
        </span>
        <div class="finder">
            <span>Фонд</span>
            <Input type="text" id="new_fond"  name="new_fond" placeholder="Фонд"></Input>
        </div>
        <div class="finder">
            <span>Опись</span>
            <Input type="text" id="new_opis"  name="new_opis" placeholder="Опись"></Input>
        </div>
        <div class="finder">
            <span>Дело</span>
            <Input type="text" id="new_delo"  name="new_delo" placeholder="Дело"></Input>
        </div>
        <div class="finder">
            <span>Лист</span>
            <Input type="text" id="new_list"  name="new_list" placeholder="Лист"></Input>
        </div>
        <!-- <div class="finder"></div> -->
        <!-- <div class="finder"></div> -->
    </div>
    <hr>
<input type="submit" value="Создать" >
<!--    onclick="event.preventDefault();alert(25);">-->
<input type="reset" value="Сбросить">
</form>

<input type="button" value="MAN" onClick="console.log(MAN);">
<body>
</body>
</html>