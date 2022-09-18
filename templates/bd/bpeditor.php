<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>КТК</title>
    <link rel="icon" type="image/ico" href="favicon.png" />
    <!-- <link rel="stylesheet" href="../../src/css/style.css" /> -->

    <link rel="stylesheet" href="/ktk/css/mvckb.css" />
    <link rel="stylesheet" href="/ktk/css/create_man.css">
    <!-- <link rel="stylesheet" href="/ktk/css/create_man_id.css"> -->

    <!-- Скрипт загатовка -->
    <script src="/ktk/js/mvckb.js"></script>
    <script src="/ktk/js/kb.js"></script>

    
    

    <!-- <script src="/js/ajax.js"></script>
    <script src="../src/js/card_list.js"></script> -->

    <!-- Стили общие -->

    <!-- <link rel="stylesheet" type="text/css" href="../src/css/create_man.css"> -->


    <!-- <link rel="stylesheet" href="../../src/css/list.css"> -->

    <style>
            body {
            padding     : 1,1px;
            margin      : 0px;
        }

        .headerbox {
            width       : inherit;
            color       : rgb(255, 217, 0);
            background  : #741b00;
            padding     : 5px;
            margin      : 0px;
            font-size   : 24px;
            margin-bottom   : 5px;
        }

        .container_line {
            display : flex;
            /* background : blue; */
        }

        .container_line > div {
            background : orange;
        }

        .container-line {
            display : flex;
            /* background : blue; */
        }

        .container-line > div {
            /* background : orange; */
        }
    </style>
</head>
<!-- onLoad="sendData();" -->
<body >
<div class="headerbox">
База "Карельские беженцы"
</div>
<div>
    Редактор мест рождений (<?php echo $cnt;?>)
</div>
    <hr>
    Фильтр (<?= count($bplaces);?>)
    <form id="filtr"  name="filtr"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
    <div style="width:100%">
        <div class="container-line">

            <div class="" id="new_fname_box">
                <div>
                    <span>Nп/п</span>
                </div>
            </div>

            <div class="show_new_line_element" id="new_name_box">
                <div>
                    Населенный пункт
                </div>
                <textarea id="find_punkt"  name="find_punkt" class="filtr-form-bplace" ><?=$bp_editor["filtr"]["find_punkt"]?></textarea>
            </div>

            <div class="show_new_line_element" id="new_sname_box">
                <div>
                    <span>Волость</span>
                </div>
                <textarea id="find_volost"  name="find_volost" class="filtr-form-bplace" ><?=$bp_editor["filtr"]["find_volost"]?></textarea>
            </div>

            <div class="show_new_line_element" id="new_byear_box">
                <div>
                    <span>Уезд</span>
                </div>
                <textarea id="find_uezd"  name="find_uezd" class="filtr-form-bplace" ><?=$bp_editor["filtr"]["find_uezd"]?></textarea>
            </div>
        </div>

        <div>
            <input type="submit" name="filtr_send"  id="filtr_send" value="Найти">
            <input type="reset" name="filtr_reset"  id="filtr_reset" value="Сбросить" onclick="resetFormFiltrBPeditor();">
        </div>
    </div>
    </form>
    <hr>

    <div id="content" style="width:100%; height:70%; overflow-y: scroll;">

        <?php  

        // $fname          = __DIR__ . '/../../../templates';
        // $this->view2    = new View($fname);

        $i = 0;
        foreach ($Bplaces as $Bplace)
        {
            $i++;
            // echo $i;
            $line   = $view2->getRenderHtml('bd/bpeditor_line.php', ["Bplace" => $Bplace, "i"=>$i]);
            echo $line."<hr>";
        }

        ?>

    </div>

<!-- <script src="/ktk/js/live_search.js"></script> -->
<script src="/ktk/js/bp_editor.js"></script>

<!-- qwerty -->
</body>
</html>

