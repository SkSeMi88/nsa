<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Администрирование системы: роли</title>

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

    <div class="box">

        <?php

            $checked_state  = [
                0       => "",
                1       => 'checked="checked"',
                "0"     => "",
                "1"     => 'checked="checked"'
            ];

            echo "Раздел администрирования ролей";

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
                    <textarea>Алиас</textarea>
                    <!-- Алиас -->
                </div>
                <div class="element">
                    <textarea>Имя</textarea>
                    <!-- Имя -->
                </div>
                <div class="element">
                    <textarea>Примечание</textarea>
                    <!-- Примечание -->
                </div>
                <div class="element">
                    <!-- <textarea>Действия</textarea> -->
                    Действия
                </div>
            </div>

            <?php
            foreach($roles AS $r){
                if ($r->getId()==1) continue;

                echo '<form name="edit_role_form" action="" method="POST">';
                echo '<div class="rline"   style="display:flex;">';
                // foreach($properties AS $p){

                //     echo '<div class="element">';
                //     // echo $r->$p;
                    
                //     echo '<textarea name="role_'.$p.'_'.$r->id.'id="role_'.$p.'_'.$r->name.'">'.$r->$p.'</textarea>';
                    
                //     echo "</div>";
                
                // }
                ?>

                <div class="element"  style="width:40px;">
                    <!-- <textarea name="role_state_<?//=$r->getId();?>" id="role_state_<?//=$r->getId();?>"><?//=$r->getState();?></textarea> -->
                    <!-- <input type="checkbox" name="role_state_<?//=$r->getId();?>" value="<?//=$r->getState();?>" <?//= $checked_state[$r->getState()];?>>
                    <input type="checkbox" name="role_state_<?//=$r->getId();?>" value="<?//=$r->getState();?>"> -->
                    <input type="checkbox" name="role_state" value="1" <?= $checked_state[$r->getState()];?>>
                </div>
                <div class="element">
                    <textarea name="role_id" id="role_id" ><?=$r->getId();?></textarea>
                </div>

                <div class="element">
                <!-- _   <-?//=$r->getId();?> -->
                    <textarea name="role_name" id="role_name"><?=$r->getName();?></textarea>
                </div>
 
                <div class="element">
                    <textarea name="role_title" id="role_title"><?=$r->getTitle();?></textarea>
                </div>

                <div class="element">
                    <textarea name="role_prim" id="role_prim"><?=$r->getPrim();?></textarea>
                </div>

                <div class="element">
                    <input type="submit" name="edit_role" value="Сохранить">
                    <input type="submit" name="delete_role" value="Удалить" disabled>
                </div>

                <?php
            
                // echo '<div class="element">';             
                // echo '<textarea name="role_'.$p.'_'.$r->id.'id="role_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // echo '<div class="element">';             
                // echo '<textarea name="role_'.$p.'_'.$r->id.'id="role_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // echo '<div class="element">';             
                // echo '<textarea name="role_'.$p.'_'.$r->id.'id="role_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // echo '<div class="element">';             
                // echo '<textarea name="role_'.$p.'_'.$r->id.'id="role_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // echo '<div class="element">';             
                // echo '<textarea name="role_'.$p.'_'.$r->id.'id="role_p_'.$r->name.'">'.$r->$p.'</textarea>';
                // echo "</div>";
            
                // */
                echo "</div>";
                echo "</form>";
            }
            ?>
            <hr>
            Новая роль:
            <form name="create_role_form" action="" method="POST">
                <input type="text" name="role_name" value="" placeholder="Имя роли">
                <input type="text" name="role_title" value="" placeholder="Обозначние роли">
                <input type="text" name="role_prim" value="" placeholder="Примечание">
                <input type="submit" value="Создать" name="create_role">
            </form>
            <hr>
    </div>
    <hr>
    <a href="/admin">Администрирование системы</a>
    <a href="/admin/users/">Пользователи системы</a>
    </body>
</html>