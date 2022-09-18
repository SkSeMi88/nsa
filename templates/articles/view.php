<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p>Автор: <?= $article->getAuthor()->getnickname()?></p>
    <?php

    var_dump($user);
     if (($user!==null)&&($user->getRole()=="user")) {

//         var_dump($article);
         $link   = '"/articles/'.$article->getId().'/edit"';
         echo '<a href='.$link.'>Редактировать</a>';
     }

        $link   = '"/articles/'.$article->getId();
        $forma  = '<div>';
        $forma .= '<form id="addComment" action="'.$link.'/comments" method="POST">';
        $forma .= '<p><b>Ваш новый комментарий</b></p>';
        $forma .= '<textarea class="comment_add"></textarea>';
        $forma .= '<div><input type="submit" name="comment_add_btn" value="Отправить"></div>';

        $forma .= '</form>';
        $forma .= '</div>';

//        echo $forma;

        $unlogined  = '<p>Чтобы добавить комментарий неообходимо <a href="/users/login">авторизоваться на сайте</a>.</p>';


        var_dump($user);
//        if (($user!==null))

    ?>

    <h3>Комментарии</h3>
    <hr>
    <?= ($user1!==null)?$forma:$unlogined;?>



    <div>
        Область вывода последних 10 комментариев
    </div>

<?php include __DIR__ . '/../footer.php'; ?>