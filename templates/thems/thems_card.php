<?php include __DIR__ . '/../header.php'; ?>

Карточка тематики.
<hr>
<form name="them_card" action="" method="POST">
    <div>
        Название
    </div>
    <textarea name="them_name"  style="width:100%;"><?=$them->getName();?></textarea>
    <div>

        <input type="submit" value="Сохранить">
        <input type="reset" value="Сбросить">
        <input type="button" value="Создать карточку докумекта" onClick="document.location.href = '../../cards/create';">
    </div>
</form>
<br>
Карточки документов (<?=count($them->cards);?>)
<hr>
<div class="">
    <textarea style="width:5%; text-align:center;" disabled>№ </textarea>
    <textarea style="width:25%; text-align:center;" disabled>Шифр</textarea>
    <textarea style="width:60%; text-align:center;" disabled>Наименование карточки документа</textarea>
</div>

<?php

// var_dump($them->cards);
for($i=0; $i<count($them->cards); $i++)
{
    $shifr  = implode(" ", array_values($them->cards[$i]->shifrFullName));
    ?>
    <div class="">
        <textarea style="width:5%; text-align:center;margin:0px;"><?=($i+1);?></textarea>
        <textarea style="width:25%; text-align:center;">&nbsp;<?=$shifr;?></textarea>
        <textarea style="width:60%; text-align:center;"><?=$them->cards[$i]->getDocHeader();?></textarea>
        <input type="button" value="K" onClick="document.location.href = '../../cards/<?=$them->cards[$i]->getId();?>';">
    </div>
    <?php
}
?>
<?php //include __DIR__ . '/../footer.php'; ?>