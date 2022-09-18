<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>НСА НА РК 2021. Главная страница</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            НСА 2021
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">

            <?php

            //var_dump($this);

                // Формирование ссылки на профиль, записи при авторизованной загрузке страницы
                if (($user!==null)||(isset($user)))
                {

                    // var_dump($user);
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
<!--            --><?//= //(!empty($user)||($user!==null)) ? $logined:$not_logined;?>
<!--            --><?//= //(!empty($user)) ? $logined:$not_logined;?>

            <?php //var_dump($this);?>
            <?php //var_dump($_SERVER);?>
        </td>
    </tr>
    <tr>
        <td>