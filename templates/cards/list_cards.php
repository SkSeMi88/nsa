<?php
$title_page = "Список персоналий";


include __DIR__ . '/../header2.php';

?>

Список карточек (<?= count($cards);?>)
<hr>
<?// var_dump($thems[0])?>
<!-- <hr> -->
<!-- <input type="button" value="Создать карточку докумекта" onClick="document.location.href = '../cards/create';"> -->

<!-- <hr> -->


<div class="" style="display:flex;">
		<div style="width:5%; text-align:center;" disabled>№ п/п</div>
		<div style="width:25%; text-align:center;" disabled>Шифр</div>
		<div style="width:60%; text-align:left;" disabled>Наименование карточки документа</div>
</div>

<hr>

<?php

// var_dump($cards);
// for($i=0; $i<count($cards); $i++)
$i  = count($cards)>0?1:0;
foreach($cards AS $card)
{
    // $shifr  = implode(" ", array_values($them->cards[$i]->shifrFullName));
    //var_dump($card);
    //echo $i;
    $shifr  = implode(" ", array_values($card->shifrFullName));
    ?>
    <?//=$card->getId();?>
    <?//=$shifr;?>
    <?//=$card->getDocHeader();?>

    <!-- <div class="">
        <textarea style="width:5%; text-align:center;margin:0px;"><?//=($i+1);?></textarea>
        <textarea style="width:25%; text-align:center;">&nbsp;<?//=$shifr;?></textarea>
        <textarea style="width:60%; text-align:center;"><?//=$them->cards[$i]->getDocHeader();?></textarea>
        <input type="button" value="K" onClick="document.location.href = '../../cards/<?//=$them->cards[$i]->getId();?>';">
    </div> -->

    


	 <div class="" style="display:flex;">
		<div style="width:5%; text-align:center;" disabled><a href="../../cards/<?=$card->getId();?>"><?=($i);?></a></div>
		<div style="width:25%; text-align:center;" disabled><a href="../../cards/<?=$card->getId();?>"><?=$shifr;?></a></div>
		<div style="width:60%; text-align:left;" disabled><a href="../../cards/<?=$card->getId();?>"><?=$card->getDocHeader();?></a></div>
	</div>

    <?php
    $i++;
}
?>
<?php //include __DIR__ . '/../footer.php'; ?>


<!-- 
    Первый вариант на память:
<table>
<caption></caption>
<th></th>
<tbody> -->

    <?php

// var_dump($cards);
// for ($i=0; $i < count($cards); $i++) { 
//     # code...
    
//     echo '<tr>';
//     echo '<td align="center">'.($i+1).'</td>';
//     echo '<td>'.($cards[$i])->getDocHeader().'</td>';
//     echo '</tr>';
    
// }

?>
<!-- </tbody>
</table> -->