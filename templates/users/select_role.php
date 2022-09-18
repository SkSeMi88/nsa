<!-- Страница выбора роли при авторизации пользователя. -->
<?php

// var_dump($user);

// echo "Выберите роль:";
?>
<div>
    Выберите роль
</div>

<!-- <form name="select_role_form" action="/users/login/select_role/" method="POST"> -->
<form name="select_role_form" action="" method="POST">

    <input type="hidden" name="user_id" value="<?=$user->getId();?>">
<?php
// $roles1 = $user->roles;
// var_dump(count($roles1));
// print_r($roles1[0]);
// print_r(array_keys($roles1));
// print_r(array_keys($roles1)[0]);

// var_dump($roles1["root"]);
foreach(array_keys($user->roles) AS $role_name){
    // echo "<hr>";
    // var_dump($role_name);
    $role   = $user->roles[$role_name];
    if ($role["state"]==1) {
        // echo '<div><input type="radio" name="role" value="'.$role["id"].'" >'.$role["title"].'</input></div>';
        echo '<div><input type="radio" name="role" value="'.$role_name.'" >'.$role["title"].'</input></div>';
    }
}

?>

<input type="submit" name="select_role" value="Войти">

</form>