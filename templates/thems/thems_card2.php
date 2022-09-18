<?php
    echo "<div>";
    if (!empty($errors))
    {
        foreach($errors AS $error)
        {
            echo "<div>";
            echo $error;
            echo "</div>";
        }
    }
    echo "</div>";

    echo "<div>";
    if (!empty($msgs))
    {
        foreach($msgs AS $msg)
        {
            echo "<div>";
            echo $msg;
            echo "</div>";
        }
    }
    echo "</div>";
?>



<?php
// var_dump($UserMenu);
?>

<?php include __DIR__ . '/../header2.php'; ?>

Карточка тематики.
<hr>
<form name="them_card" action="" method="POST">
	<div>
			Название
		<!-- <textarea name="them_name"  style="width:100%;"><?=$them->getName();?></textarea> -->
		<input type="text" name="them_name"  style="width:50%;" value="<?=$them->getName();?>">
		<input type="submit" name="save_them" value="Сохранить изменения">
		<input type="reset" value="Сбросить изменения">
	</div>
<hr>
	<div>
        <input type="button" value="Создать карточку докумекта" onClick="document.location.href = '../../cards/create';">
 
		  <!-- <input type="submit" value="Сохранить изменения">
        <input type="reset" value="Сбросить изменения">
        <input type="button" value="Создать карточку докумекта" onClick="document.location.href = '../../cards/create';"> -->
    </div>
</form>
<br>
Карточки документов (<?=count($them->cards);?>), в которых встречается данная тематика
<hr>
<!-- <div class="">
    <textarea style="width:5%; text-align:center;" disabled>№ </textarea>
    <textarea style="width:25%; text-align:center;" disabled>Шифр</textarea>
    <textarea style="width:60%; text-align:center;" disabled>Наименование карточки документа</textarea>
</div> -->

<div class="" style="display:flex;">
		<div style="width:5%; text-align:center;" disabled>№ п/п</div>
		<div style="width:25%; text-align:center;" disabled>Шифр</div>
		<div style="width:60%; text-align:left;" disabled>Наименование карточки документа</div>
</div>

<hr>

<?php

// var_dump($them->cards);
for($i=0; $i<count($them->cards); $i++)
{
    $shifr  = implode(" ", array_values($them->cards[$i]->shifrFullName));
    ?>
    <!-- <div class="">
        <textarea style="width:5%; text-align:center;margin:0px;"><?//=($i+1);?></textarea>
        <textarea style="width:25%; text-align:center;">&nbsp;<?//=$shifr;?></textarea>
        <textarea style="width:60%; text-align:center;"><?//=$them->cards[$i]->getDocHeader();?></textarea>
        <input type="button" value="K" onClick="document.location.href = '../../cards/<?//=$them->cards[$i]->getId();?>';">
    </div> -->



	 <div class="" style="display:flex;">
		<div style="width:5%; text-align:center;" disabled><a href="../../cards/<?=$them->cards[$i]->getId();?>"><?=($i+1);?></a></div>
		<div style="width:25%; text-align:center;" disabled><a href="../../cards/<?=$them->cards[$i]->getId();?>"><?=$shifr;?></a></div>
		<div style="width:60%; text-align:left;" disabled><a href="../../cards/<?=$them->cards[$i]->getId();?>"><?=$them->cards[$i]->getDocHeader();?></a></div>
	</div>

    <?php
}
?>
<?php //include __DIR__ . '/../footer.php'; ?>