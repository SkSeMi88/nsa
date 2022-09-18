<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>КТК</title>
    <link rel="icon" type="image/ico" href="favicon.png" />
    <link rel="stylesheet" href="../../src/css/style.css" />
    <!-- <link rel="stylesheet" href="../style2.css"> -->
    <!--link rel="stylesheet" href="../../css/style.css" /-->
<!--    <link rel="stylesheet" type="text/css" href="/lib/jquery.fancybox.min.css" />-->

    <!-- <link rel="stylesheet" href="/ktk/css/style.css" /> -->
    <link rel="stylesheet" href="/ktk/css/mvckb.css" />
    <link rel="stylesheet" href="/ktk/css/create_man.css">
    <link rel="stylesheet" href="/ktk/css/create_man_id.css">

    <!-- Скрипт загатовка -->
    <script src="/ktk/js/mvckb.js"></script>
    <script src="/ktk/js/kb.js"></script>



    <script src="/js/ajax.js"></script>
    <script src="../src/js/card_list.js"></script>

    <!-- Стили общие -->
    <!-- <link rel="stylesheet" type="text/css" href="./views/man/css/create_man.css"> -->
    <link rel="stylesheet" type="text/css" href="../src/css/create_man.css">


    <link rel="stylesheet" href="../../src/css/list.css">
    <!-- <link rel="stylesheet" href="../../src/css/create_man.css"> -->
    <!-- <link rel="script" type="text/js" href="../views/man/js/kb.js"> -->
    <!-- <link rel="script" type="text/js" href="../src/js/card_list.js"> -->


    <!-- <link rel="stylesheet" href="../css/list.css"> -->
    <!-- <link rel="stylesheet" href="../src/css/sitePage.css"> -->
    <!-- <style type="text/css" href="../views/man/css/create_man.css"> -->
        
    <!-- </style> -->
</head>

<body>




        <div style="width:100%">
            <div class="show_new_line">

                <div class="show_new_line_element" id="new_fname_box">

                    <div>
                        <span>Фамилия</span>
                    </div>
                    <!-- <input type="text" id="new_fname" class="fio" placeholder="Фамилия"> -->
                    <textarea id="new_fname" class="fio new_fname" placeholder="Фамилия"></textarea>

                    <div>
                        <input type="button" value="Добавить" onclick="AdditionFIO('fname');">
                    </div>

                    <div id="fname_box" class="preview_box">

                    </div>
                    <!-- <input type="button" name="" value="Добавить" onclick="AddNewElement('fname')"> -->

                </div>

                <div class="show_new_line_element" id="new_name_box">

                    <div>
                        Имя
                    </div>

                    <textarea id="new_name" class="fio new_name" placeholder="Имя"></textarea>

                    <div>
                        <input type="button" value="Добавить" onclick="AdditionFIO('name');">
                    </div>

                    <div id="name_box" class="preview_box">

                    </div>

                </div>

                <div class="show_new_line_element" id="new_sname_box">
                    <div>
                        <span>Отчество</span>
                    </div>
                    <textarea id="new_sname" class="fio new_sname" placeholder="Отчество"></textarea>

                    <div>
                        <input type="button" value="Добавить" onclick="AdditionFIO('sname');">
                    </div>

                    <div id="sname_box" class="preview_box">

                    </div>

                </div>
                <div class="show_new_line_element" id="new_byear_box">

                    <div>
                        <span>Год рождения</span>
                    </div>

                    <textarea id="new_byear" class="fio new_byear" placeholder="Год рождения"></textarea>

                    <div>
                        <input type="button" value="Добавить" onclick="AdditionFIO('byear');">
                    </div>

                    <div id="byear_box" class="preview_box">

                    </div>
                </div>


                <div class="show_new_line_element" id="new_bplace_box">

                    <div>
                        <span>Место рождения</span>
                    </div>
                    <div>
                        <span>Пункт:</span>
                        <input type="text" name="t1" id="t1" list="tl1" autocomplete="on" onmouseleave="close_live_search_box(tl1)" onfocus="focus_search(0);" onkeyup="Live_Search2("1",this.value);" style="display: inline-block;">
                        <datalist id="tl1" onchange="alert('qwerty');">
                            <option value="1">Костомукша</option>
                            <option value="2">Петрозаводск</option>
                            <option value="2">Ригорека Волость: МАслозерская(Тивдийская) Уезд:Кемский</option>
                        </datalist>
                    </div>

                    <div>
                        <span>Волость:</span>
                        <input type="text" name="t2" id="t2" list="tl2" autocomplete="on" onfocus="focus_search(0);" onkeyup="Live_Search2("2",this.value);" style="display: inline-block;">
                        <datalist id="tl2" onchange="alert('qwerty');">
                            <option value="1">Тивдийская</option>
                            <option value="2">Кондопожская</option>
                        </datalist>
                    </div>

                    <div>
                        <span>Уезд:</span>
                        <input type="text" name="t3" id="t3" list="tl3" autocomplete="on" onfocus="focus_search(0);" onkeyup="Live_Search2("3",this.value);" style="display: inline-block;">
                        <datalist id="tl3" onchange="alert('qwerty');" style="width:1000px;">
                            <option value="1">Кемский</option>
                            <option value="2">Петрозаводский</option>
                            <option value="3">Олонецкий</option>
                            <option value="3">Ригорека; Волость: Маслозерская (Ребольская); Уезд: Кемский</option>
                        </datalist>
                    </div>

                    <div>
                        <input type="button" value="Добавить" onclick="Select_bplace();">
                    </div>
                    <button onclick="document.querySelector('#test1').style.display='None';">Hide</button>
                    <button onclick="document.querySelector('#test1').style.display='block';">Display</button>
                    <div style="position: relative; z-index:25;">
                        <div></div>
<!--                         <div id="test1" class="live_search_box " style="position:absolute; width: 100%;">
                            <ul>
                                <li>
                                    <a>
                                        Ригорека
                                    </a>
                                </li>

                                <li>
                                    <a>Ригорека; Волость: Маслозерская (Ребольская);</a>
                                </li>

                                <li>
                                    <a>
                                        Ригорека; Волость: Маслозерская (Ребольская); Уезд: Кемский
                                    </a>
                                </li>

                            </ul>
                        </div> -->
                    </div>

                    &nbsp;
                </div>


                <div class="show_new_line_element" id="new_photo_box">

                    <div>
                        <span>Наличие фотографии</span>
                    </div>
                    <select id="new_photo" class="fio">
                        <option value="0">Нет</option>
                        <option value="1" selected="selected">Да</option>
                    </select>

                    <input type="button" value="Выбрать" onclick="AdditionFIO('photo');">

                </div>
                <div class="show_new_line_element" id="new_prim_box">

                    <div>
                        <span>Примечание</span>
                    </div>

                    <textarea id="new_prim" class="fio prim" placeholder="Примечание"></textarea>

                    <div>
                        <input type="button" value="Добавить" onclick="AdditionFIO('prim');">
                    </div>

                </div>
            </div>
        </div>
        <div class="live_search">
            <div>
                <input type="search" id="search_t1" onkeyup="SendAjaxData3(1, this.value)">
            </div>
            <div class="live_search_box" id="t1_result">
                <ul id="live_search_r1" >
                    <!-- class="live_search_r1">
                        live_search_r1 -->
<!--                     <li><a href="#">д. Верхняя Седокса	?	Олонецкий</a></li>
                    <li><a href="#">д. Виданы	Шуйская	Петрозаводский</a></li>
                    <li><a href="#">д. Голодная варака	Летнеконецкая	Кемский</a></li>
                    <li><a href="#">д. Гора	???	Олонецкий</a></li>
                    <li><a href="#">д. Кибознаволок (Кибошнаволок)	Реболская	Повенецкий</a></li>
                    <li><a href="#">д. Кимасозеро	Ругозерская	Повенецкий</a></li>
                    <li><a href="#">д. Корташи (Корташева сельга)	Кондопожская (Тивдийская)	Петрозаводский</a></li>
                    <li><a href="#">д. Костомукша	Кондокская	Кемский</a></li>
                    <li><a href="#">д. Кузреко	Кестенгская	Кемский</a></li>
                    <li><a href="#">д. Логинова сельга (Инжунаволок)	Сямозерская	Петрозаводский</a></li>
                    <li><a href="#">д. Маркова Гора	Тунгулская	Кемский</a></li>
                    <li><a href="#">д. Марково (Маркова Гора)	Тунгудская	Кемский</a></li>
                    <li><a href="#">д. Мундусельга	Сямозерская	Петрозаводский</a></li>
                    <li><a href="#">д. Мунозеро	Великогубская	Петрозаводский</a></li> -->
<!--                    <li><a href="#">д. Мяндусельга	Мяндусельгская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Ояпса	Кондопожская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Петров-наволок	Богоявленская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Печная Сельга	Неккульская	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Пизьмагуба	Юшкозерская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Пограничные Кондуши	Видлицкая	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Рубчейла	Сямозерская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Сало-остров	Ведлозерская	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Таровская	Толвуйская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Торосозеро	Мяндусельская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Энонсуу	Ухтинская	Кемский</a></li>-->
<!--                    <li><a href="#">с. Шуезеро	Летнеконецкая	Кемский</a></li>-->
<!--                    <li><a href="#">Ухта	Ухтинская	Кемский</a></li>-->
                </ul>
            </div>
        </div>

        <div class="live_search">
            <div>
                <input type="search" id="search_t2"  onkeyup="SendAjaxData3(2, this.value)">
            </div>
            <div class="live_search_box" id="t2_result">
                <ul id="live_search_r2" class="live_search_r2">
<!--                <ul>-->
<!--                    <li><a href="#">д. Верхняя Седокса	?	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Виданы	Шуйская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Голодная варака	Летнеконецкая	Кемский</a></li>-->
<!--                    <li><a href="#">д. Гора	???	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Кибознаволок (Кибошнаволок)	Реболская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Кимасозеро	Ругозерская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Корташи (Корташева сельга)	Кондопожская (Тивдийская)	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Костомукша	Кондокская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Кузреко	Кестенгская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Логинова сельга (Инжунаволок)	Сямозерская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Маркова Гора	Тунгулская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Марково (Маркова Гора)	Тунгудская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Мундусельга	Сямозерская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Мунозеро	Великогубская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Мяндусельга	Мяндусельгская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Ояпса	Кондопожская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Петров-наволок	Богоявленская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Печная Сельга	Неккульская	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Пизьмагуба	Юшкозерская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Пограничные Кондуши	Видлицкая	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Рубчейла	Сямозерская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Сало-остров	Ведлозерская	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Таровская	Толвуйская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Торосозеро	Мяндусельская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Энонсуу	Ухтинская	Кемский</a></li>-->
<!--                    <li><a href="#">с. Шуезеро	Летнеконецкая	Кемский</a></li>-->
<!--                    <li><a href="#">Ухта	Ухтинская	Кемский</a></li>-->
                </ul>
<!--            </div>-->
        </div>

        <div class="live_search">
            <div>
                <input type="search" id="search_t3" onkeyup="SendAjaxData3(3, this.value)">
            </div>
            <div class="live_search_box" id="t3_result">
                <ul id="live_search_r3" class="live_search_r3">
<!--                <ul>-->
<!--                    <li><a href="#">д. Верхняя Седокса	?	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Виданы	Шуйская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Голодная варака	Летнеконецкая	Кемский</a></li>-->
<!--                    <li><a href="#">д. Гора	???	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Кибознаволок (Кибошнаволок)	Реболская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Кимасозеро	Ругозерская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Корташи (Корташева сельга)	Кондопожская (Тивдийская)	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Костомукша	Кондокская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Кузреко	Кестенгская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Логинова сельга (Инжунаволок)	Сямозерская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Маркова Гора	Тунгулская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Марково (Маркова Гора)	Тунгудская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Мундусельга	Сямозерская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Мунозеро	Великогубская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Мяндусельга	Мяндусельгская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Ояпса	Кондопожская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Петров-наволок	Богоявленская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Печная Сельга	Неккульская	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Пизьмагуба	Юшкозерская	Кемский</a></li>-->
<!--                    <li><a href="#">д. Пограничные Кондуши	Видлицкая	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Рубчейла	Сямозерская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Сало-остров	Ведлозерская	Олонецкий</a></li>-->
<!--                    <li><a href="#">д. Таровская	Толвуйская	Петрозаводский</a></li>-->
<!--                    <li><a href="#">д. Торосозеро	Мяндусельская	Повенецкий</a></li>-->
<!--                    <li><a href="#">д. Энонсуу	Ухтинская	Кемский</a></li>-->
<!--                    <li><a href="#">с. Шуезеро	Летнеконецкая	Кемский</a></li>-->
<!--                    <li><a href="#">Ухта	Ухтинская	Кемский</a></li>-->
                </ul>
<!--            </div>-->
        </div>

<!-- <ul id="live_search_r1" class="live_search_items">
</ul>

<ul id="live_search_r2" class="live_search_items">
</ul> -->

  <ul id="menu" class="menu">
    <li><a href="/html">HTML</a></li>
    <li><a href="/javascript">JavaScript</a></li>
    <li><a href="/css">CSS</a></li>
  </ul>


    <script src="/ktk/js/live_search.js"></script>
<!-- 
    <ul id="live_search_r2" class="live_search_items"><li class="live_search_items"><a href="#" oncliсk="console.log('д. Верхняя Седокса^?^Олонецкий');">д. Верхняя Седокса ? волость Олонецкий уезд</a></li><li class="live_search_items"><a href="#" oncliсk="console.log('д. Виданы^Шуйская^Петрозаводский');">д. Виданы Шуйская волость Петрозаводский уезд</a></li><li class="live_search_items"><a href="#" oncliсk="console.log('д. Голодная варака^Летнеконецкая^Кемский');">д. Голодная варака Летнеконецкая волость Кемский уезд</a></li><li class="live_search_items"><a href="#" oncliсk="console.log('д. Гора^???^Олонецкий');">д. Гора ??? волость Олонецкий уезд</a></li>
    </ul> -->

    <a href="/" onclick="return false">Нажми здесь</a>
или
<a href="/" onclick="event.preventDefault()">здесь</a>
</body>
</html>

