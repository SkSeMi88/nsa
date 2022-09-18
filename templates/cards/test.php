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
    <script src="/ktk/js/create_card_man.js"></script>
<!--    <script src="/ktk/js/kb.js"></script>-->

    <!-- Стили общие -->
    <!-- <link rel="stylesheet" type="text/css" href="./views/man/css/create_man.css"> -->
    <link rel="stylesheet" type="text/css" href="../src/css/create_man.css">

    <link rel="stylesheet" href="../../src/css/list.css">


</head>
<!--<form action="/cards/create_card.php" method="post">-->
<form id="new_ref"  name="new_ref"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" >

    <div class="card_field_box">
        <textarea id="new_fname"  name="new_fname"  placeholder="Фамилия"></textarea>
        <input type="button" value="+" onclick="addFIO('fname');">
        <div id="fname_box"></div>
    </div>
    <div class="card_field_box">
        <textarea id="new_name" placeholder="Имя"></textarea>
        <input type="button" value="+" onclick="addFIO('name');">
        <div id="name_box"></div>
    </div>
    <div class="card_field_box">

        <textarea id="new_sname" placeholder="Отчество"></textarea>
        <!--            <textarea id="new_sname" onkeyup="EditFIO('sname', this.value);" placeholder="Отчество"></textarea>-->
        <input type="button" value="+" onclick="addFIO('sname');">

        <div id="sname_box"></div>
    </div>
    <input type="submit" value="Создать" >

    <input type="reset" value="Сбросить">
</form>

<input type="button" value="MAN" onClick="console.log(MAN);">
<body>
</body>
</html>