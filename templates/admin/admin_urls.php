
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Администрирование системы: роуты/разделы системы</title>

        <style>

            div.rline {
                display: flex;
                /* display: block; */
                
            }
            
            div.element {
                /* display: block; */
                /* display: flex; */
                
            }
            
            div.box {
                /* display: flex; */
                display: block;
                /* background-color: silver; */
            }
        </style>
    </head>
    <body>

<?php
echo "Раздел администрирования разделов системы (роуты/маршруты)";
?>
    <div class="box">

        <?php

            $checked_state  = [
                0       => "",
                1       => 'checked="checked"',
                "0"     => "",
                "1"     => 'checked="checked"'
            ];

            // echo "Раздел администрирования пользователей";

            // var_dump($error);

            /*
            // var_dump((get_object_vars($roles[0])));
            var_dump($roles[0]);
            $properties= array_keys(get_object_vars($roles[0]));
            // var_dump($roles[0]->name);
            
            echo '<div class="rline"   style="display:flex;">';
            foreach($properties AS $p){

                echo '<div class="element">';
                echo '<textarea >'.$p.'</textarea>';
                echo "</div>";
            }
            echo '</div>';
            
            */
            ?>
            <div class="rline"   style="display:flex;">
                <div class="element" >
                    <!-- style="width:25px;"> -->
                    <!-- <textarea>Вкл.</textarea> -->
                    Вкл.
                    <!-- Состояние -->
                    &nbsp;
                </div>
                <div class="element">
                    <textarea >Ид-р</textarea>
                    <!-- Ид-р -->
                </div>
                <div class="element">
                    <textarea>Ф.И.О.</textarea>
                    <!-- Алиас -->
                </div>

                <div class="element">
                    <textarea>Логин</textarea>
                    <!-- Алиас -->
                </div>
                <div class="element">
                    <textarea>Пароль</textarea>
                    <!-- Имя -->
                </div>
                <div class="element">
                    <textarea>Роль</textarea>
                    <!-- Примечание -->
                </div>
                <div class="element">
                    <textarea>Примечание</textarea>
                    <!-- Примечание -->
                </div>
                <div class="element">
                    <!-- <textarea>Действия</textarea> -->
                    Действия
                </div>

                <!-- protected 'fio' => string '2' (length=1)
      protected 'nickname' => string '2' (length=1)
      protected 'email' => string '2' (length=1)
      protected 'isConfirmed' => string '2' (length=1)
      protected 'passwordHash' => string '$2y$11$487e0d4e1036017417106uiUACDdHrOAZpXwmUa1W/U2R73fhdiha' (length=60)
      protected 'authToken' => string '2' (length=1)
      protected 'createdAt' => string '2021-10-11 21:15:33' (length=19)
      protected 'state' => string '1' (length=1)
      protected 'prim' => string 'тестирование' (length=24)
      protected 'id' => string '2' (length=1) -->
            </div>

            <?php
            foreach($users AS $r){

                if (($r->getId()==1)||($r->getNickname()=="root")) continue;

                echo '<form name="edit_user_form" action="" method="POST">';
                echo '<div class="rline"   style="display:flex;">';

                ?>

                <div class="element"  style="width:40px;">
                    <input type="checkbox" name="user_state" value="1" <?= $checked_state[$r->getState()];?>>
                </div>

                <div class="element">
                    <textarea name="user_id" id="user_id" ><?=$r->getId();?></textarea>
                </div>

                <div class="element">
                <!-- _   <-?//=$r->getId();?> -->
                    <textarea name="user_fio" id="user_fio"><?=$r->getFio();?></textarea>
                </div>
 
                <div class="element">
                    <textarea name="user_nickname" id="user_nickname"><?=$r->getNickname();?></textarea>
                </div>
 
                <div class="element">
                    <textarea name="user_email" id="user_email"><?=$r->getEmail();?></textarea>
                </div>

                <div class="element">
                    <!-- <textarea name="role" id="role">< -->
                        <?=$r->getRoleUserSelect();?>
                    <!-- </textarea> -->
                </div>

                <div class="element">
                    <textarea name="user_prim" id="user_prim"><?=$r->getPrim();?></textarea>
                </div>

                <div class="element">
                    <input type="submit" name="edit_user" value="Сохранить">
                    <input type="submit" name="delete_user" value="Удалить" disabled>
                </div>

                <?php
            
                // echo '<div class="element">';             
                // echo '<textarea name="user_'.$p.'_'.$r->id.'id="user_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // echo '<div class="element">';             
                // echo '<textarea name="user_'.$p.'_'.$r->id.'id="user_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // echo '<div class="element">';             
                // echo '<textarea name="user_'.$p.'_'.$r->id.'id="user_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // echo '<div class="element">';             
                // echo '<textarea name="user_'.$p.'_'.$r->id.'id="user_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // echo '<div class="element">';             
                // echo '<textarea name="user_'.$p.'_'.$r->id.'id="user_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // */
                echo "</div>";
                echo "</form>";
            }
            ?>
            <hr>
            Новый пользователь:
            <form name="create_user_form" action="" method="POST">
                <input type="text" name="user_fio" value="" placeholder="Ф.И.О. пользователя">
                <input type="text" name="user_nickname" value="" placeholder="Логин">
                <input type="text" name="user_email" value="" placeholder="E-mail">
                <input type="text" name="user_password" value="" placeholder="Пароль">
                <?= $new_user_role;?>
                <input type="text" name="user_prim" value="" placeholder="Примечание">
                <input type="submit" value="Создать" name="create_user">
            </form>
            <!-- <hr> -->
    </div>
    <hr>
    <a href="/admin">Администрирование системы</a>
    <a href="/admin/roles/">Роли системы</a>
    <a href="/admin/users/">Пользователи системы</a>
    </body>
</html>