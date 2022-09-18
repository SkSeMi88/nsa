<?php //include __DIR__ . '/../header2.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>НСА НА РК 2021. <?=isset($title_page)?$title_page:"НСА НА РК 2021";?></title>
	<link rel="stylesheet" href="/styles.css">
	<link rel="stylesheet" href="/mvcnsa21.css">

	<style>
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
			/*margin			: 0px;*/
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
			text-align		: left;
		}

	</style>
</head>

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
		&nbsp;
		<?//=$user_menu;?>
	</div>
</div>

<div class="body-page">
	
	<pre>
<!---->

	10-19 декабря 2021 года
	РЕализован тестовая версия раздела системы "Архивный шифр".
	Использовался за основу проект метрические книги.
	Небольшие отличия: цвет фона и цвет текста, вертикальные линии для визуального разграничения уровней шифра при просмотре.
	Перенаправление наглавную странцу при открытии папок в корне проекта - безопасность.
	Тестирование сайта полностью.
	Система абсолютно готова для ввода данных.
	Запрос так и не поступил на создание пользователей специалистам для начала рабоыт в системе.
	Очень печально.
	
	
	9 и 10 декабря 2021 года
	Последние штрихи и полное тестирование.
	Выявлены проблемы с авторизацией и решены.
	Создание строки меню согласно правам доступа.
	
	07-12-2021
	Внесены практически все изменения согласно плану по результатам встречи 26-11-2021
	
	
	27 и 28 11-2021
	Удалось соглсовать план, чтобы снова нне переделывать.
	Приступил к работе 28 ноября.
	
	26-11-2021
	Система была готова уже для ввода первых данных, первого тестирования спациалистами.
	Но был полный разнос, что всё не так и надо практически все переделать.
	
	
	25-11-2021:
	Система готова к первоначальному заполнению специалистами НА РК.
	Выполнен план по результатам встречи от 12-11-2021.
	Реализовано.
	Тематики (список, карточка тематики)
	Карточка документа создание, просомтр, редактирование.
	
	Протетсировано и выявлены некоторые недостаткт
	
	</pre>
</div>

<?php include __DIR__ . '/../footer2.php'; ?>