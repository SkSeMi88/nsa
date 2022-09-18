<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>КТК</title>

    <link rel="icon" type="image/ico" href="favicon.png" />

    <link rel="stylesheet" href="../../src/css/style.css" />

    <link rel="stylesheet" href="/ktk/css/mvckb.css" />
    <!-- <link rel="stylesheet" href="/ktk/css/create_man.css"> -->
    <!-- <link rel="stylesheet" href="/ktk/css/create_card_man.css"> -->
    <!-- <link rel="stylesheet" href="/ktk/css/create_man_id.css"> -->
	 <link rel="stylesheet" href="/ktk/css/card_man_view.css">

    <!-- Скрипт загатовка -->
    <script src="/ktk/js/mvckb.js"></script>
    <script src="/ktk/js/live_search.js"></script>
<!--    <script src="/ktk/js/kb.js"></script>-->
    <script src="/ktk/js/create_card_man.js"></script>

    <!-- Стили общие -->
    <!-- <link rel="stylesheet" type="text/css" href="./views/man/css/create_man.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../src/css/create_man.css"> -->

    <link rel="stylesheet" href="../../src/css/list.css">

    <style>

        body {
            padding     : 1,1px;
            margin      : 0px;
        }

        .headerbox {
            width       : inherit;
            color       : rgb(255, 217, 0);
            background  : #741b00;
            padding     : 5px;
            margin      : 0px;
            font-size   : 24px;
            margin-bottom   : 5px;
        }

        .finder{
            margin      : 5px;
        }
        .finder span {

            margin  : 5px;

        }


        /* .bp_type, textarea {

            width : 20%;
            height : 25%;

        } */

        #new_prim {
            width   : 300px;
            height  : 100px;
        }

		  .create_card_form{
			  min-width	: 150px;
				width		:250px;
				background	: white;
				border: 1px solid; 
		  }

		  textarea {
			  position	: none;
			  width		: 200px;
		  }

   * {box-sizing: border-box; }

	.flex-container {
		/* background: rgb(0, 150, 208);  */
		display: flex;
		height: 100px; 
		flex-direction: column; 
		flex-wrap: wrap; 
	}

	.flex-container > div {
		/* background: rgb(241, 101, 41);  */
		/* border: 1px solid;  */
		width: 95%;
		margin: 0px; 
		padding: 5px; 
	}

//.flex-container > div:nth-of-type(1) {width: 10%; flex-grow: 0; }
//.flex-container > div:nth-of-type(2) {width: 10%; text-align: right;}

.flex-container > div:nth-of-type(6) {width: 10%; }



* {box-sizing: border-box; }
#flex-container1 {
	/* background: rgb(0, 150, 208);  */
	display: flex; 
	height: 200px; 
	flex-wrap: wrap; 
	align-content: flex-start; 
}
#flex-container1 > div {
	/* background: rgb(241, 101, 41);  */
	/* border: 1px solid;  */
	width: 20%; 
	margin: 0px; 
	padding: 0px; 
}
#flex-container1 > div:nth-of-type(1) {width: 20%; flex-grow: 0; }
#flex-container1 > div:nth-of-type(2) {width: 10%;  }
#flex-container1 > div:nth-of-type(3) {width: 10%;  }
#flex-container1 > div:nth-of-type(5) {width: 20%; }


	.card_field_box_bp_names > div {
		width		: 200px;
		margin		: 0px;
		padding		: 0px;
		text-align	: right;
		padding-right	: 3px;
	}
	
	.card_field_box_prim > div {
		width	: 300px;
		width: 25%;
		height	: 100px;
		
	}
	

	* {
		box-sizing: border-box; 
	}

	.flex-container3 {
		/* background: rgb(0, 150, 208);  */
		/* width			: 100%; */
		display: flex; 
		height: 60px; 
		/* flex-wrap: wrap; */
		/* align-content: space-between;  */
		/* justify-content: space-evenly; //stretch; */
		/* align-items: baseline;  */
	}

	.flex-container3 > div {
		/* background: rgb(241, 101, 41);  */
		/* border: 1px solid;  */
		width: 20%; 
		margin: 0px; 
		padding: 0px; 
		text-align		: center;
	}
	
	.flex-container3 > div:hover {
		background: rgb(241, 101, 41); 
		/* border: 1px solid; 
		width: 20%; 
		margin: 0px; 
		padding: 0px; 
		text-align		: center; */
	}
	
	/*.flex-container3 > */
	input[type="text"], textarea {

		width: 80%;
		margin: 0px; 
		padding: 0px; 
		text-align		: center;
		height			: 18px;
	}

	.prim_box {
		width				: 90%;
		/* height			: 60px; */
		height			: 50px;
	}

	.flex-container3 > div:nth-of-type(1) {width: 2%; padding: 1px; order: 0; }
	.flex-container3 > div:nth-of-type(2) {width: 25%; padding: 1px; order: 0; }
	.flex-container3 > div:nth-of-type(3) {width: 10%; }
	.flex-container3 > div:nth-of-type(4) {width: 8%; text-align:right; padding-right: 5px;}
	.flex-container3 > div:nth-of-type(5) {padding: 1px; }
	.flex-container3 > div:nth-of-type(6) {width: 5%; padding: 1px; }
	.flex-container3 > div:nth-of-type(7) {width: 30%; padding: 1px; }


	.result-list {

		width			: 99vw;
		height		: 50vw;
		overflow		: y-scroll;

	}

   </style>

</head>
<body>
<div class="headerbox">
	База "Карельские беженцы"
</div>


<div class='flex-container3'>
	<div>№п/п</div>
	<div>Фамилия / Имя / Отчетсво</div>
	<div>Год рождения</div>
	<div></div>
	<div>Место рождения</div>
	<div>Фотографии</div>
	<div>Примечание</div>
</div>

<div class="result-list">

	<form id="new_ref"  name="new_ref"  method="post" action="<?php echo $_SERVER['REQUEST_URI']."/edit/";?>" onsubmit="return check_form_create();">

	<div class='flex-container3'>

		<div>
			<a href="../cards/1/"><?= "000"?></a>
		</div>

		<div>
			<div>
				<input type="text" value="<?= $card->getFnameTitle();?>">
			</div>
			<div>
				<input type="text" value="<?= $card->getNameTitle();?>">
			</div>
			<div>
				<input type="text" value="<?= $card->getSnameTitle();?>">
			</div>
		</div>

		<div>
			<input type="text" value="<?= $card->getByear();?>">
		</div>

		<div>
			<div>
				Населенный пункт
			</div>

			<div>
				Волость
			</div>

			<div>
				Уезд
			</div>
		</div>

		<div>
			<div>
				<textarea name="" id="" ><?= $card->bplace->getPunkt();?></textarea>
			</div>

			<div>
				<!-- <? //= $card->bplace->getVolost();?> -->
				<textarea name="" id="" ><?= $card->bplace->getVolost();?></textarea>
			</div>

			<div>
				<? //= $card->bplace->getUezd();?>
				<textarea name="" id="" ><?= $card->bplace->getUezd();?></textarea>
			</div>
		</div>

		<div>
			<?php 
				$s1	= "";
				$s2	= "";
				$select	= '<select name="" id="" >';
			// echo ($card->getPhoto())?"Есть":"Нет";
				$s1	= ($card->getPhoto())?"selected":"";
				$s2	= (!$card->getPhoto())?"selected":"";
				
				$select	.= '<option value="0" '.$s2.'>Нет</option>';
				$select	.= '<option value="1" '.$s1.'>Есть</option>';
			$select		.= '</select>';
			echo $select;
			?>
		</div>

		<div>
			<?php //echo $card->getPrim();?>
			<textarea class="prim_box" name="" id="" ><?= $card->getPrim();?></textarea>
		</div>
	</div>
	<!-- <hr> -->
	<div>
		Поисковые данные
	</div>
	<hr>
	<div class="flex_container4" style="display:flex;">
		<div>

			
		</div>
		<div>
			<div>
				Фонд
			</div>
			<div>
				<input type="text" name="fond" value="<?= $card->finder->getFond();?>">
			</div>
		</div>
		<div>
			<div>
			Опись
			</div>
			<div>
				<input type="text" name="fond" value="<?= $card->finder->getOpis();?>">
			</div>
		</div>
		<div>
			<div>
			Дело
			</div>
			<div>
				<input type="text" name="fond" value="<?= $card->finder->getDelo();?>">
			</div>
		</div>
		<div>
			<div>
			Лист
			</div>
			<div>
				<input type="text" name="fond" value="<?= $card->getList();?>">
			</div>
		</div>
	</div>
	<hr>
	<input type="submit" name="edit_card" value="Сохранить">
	<input type="reset" name="edit_card" value="Сбросить">
	<div id="log">
	</div>
</div>
<body>
</body>
</html>