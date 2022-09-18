<?php
// Пока не удалять. вместо этого файла используется thems_list2.php
// include __DIR__ . '/../header.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>НСА. Спсиок тематик</title>

    <link rel="icon" type="image/ico" href="favicon.png" />

    <link rel="stylesheet" href="../../src/css/style.css" />

    <link rel="stylesheet" href="/ktk/css/mvckb.css" />
    <link rel="stylesheet" href="/ktk/css/create_man.css">
    <link rel="stylesheet" href="/ktk/css/create_card_man.css">
    <link rel="stylesheet" href="/ktk/css/create_man_id.css">
            
 
    <style>
        .header_page{
            font-size: 20px;
            font-style:bold;
            border-bottom: solid 1px;
            color: red;
        }

    </style>

</head>
<body>
<div>

    Список тематик.
</div>


<?php
echo $count_all;

for($i=0; $i<count($thems); $i++){
    ?>
    <div>

        <div><?=$i+1?></div>
        <div><?=$thems[$i]->getName();?></div>
    </div>
    <?php
}
?>

<?php include __DIR__ . '/../footer.php'; ?>

