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
				width		:200px;
		  }

		  textarea {
			  position	: none;
			  width		: 200px;
		  }

          * {box-sizing: border-box; }
    #flex-container {
        background: rgb(0, 150, 208); 
        display: flex;
        height: 300px; 
        flex-direction: column; 
        flex-wrap: wrap; 
    }
        
    #flex-container > div {
        background: rgb(241, 101, 41); 
        border: 1px solid; 
        width: 20%;
        margin: 0px; 
        padding: 0px; 
    }

//#flex-container > div:nth-of-type(1) {width: 25%; flex-grow: 0; }
//#flex-container > div:nth-of-type(5) {width: 25%; }



* {box-sizing: border-box; }
#flex-container1 {background: rgb(0, 150, 208); display: flex; height: 300px; flex-wrap: wrap; align-content: flex-start; }
#flex-container1 > div {background: rgb(241, 101, 41); border: 1px solid; width: 20%; margin: 0px; padding: 0px; }
#flex-container1 > div:nth-of-type(1) {width: 20%; flex-grow: 0; }
#flex-container1 > div:nth-of-type(5) {width: 20%; }

    </style>

</head>
<body>
<div class="headerbox">
База "Карельские беженцыsss"
</div>
QWERTYU
<hr>
<pre>
<?php 
// var_dump($card);
?>
</pre>
QWERTYU
<hr>
<form id="new_ref"  name="new_ref"  method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" onsubmit="return check_form_create();">

<div id='flex-container'>
  <div>
    <?= "card->getFnameTitle();"?>
  </div>
    <div>
        <?= "card->getNameTitle();"?>
    </div>
    <div>
        <?= "card->getSnameTitle();"?>
    </div>

</div>


<hr>
<div id='flex-container1'>
  <!--<div>1</div><div>2</div><div>3</div><div>4</div><div>5</div>-->
</div>
<hr>



<hr>
<div id="log">
  
</div>
<body>
</body>
</html>