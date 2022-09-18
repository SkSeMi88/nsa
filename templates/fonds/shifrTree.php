
<!--$title		= "НСА 2021. Архивный шифр";-->
<!--include __DIR__ . '/../header2.php';-->

<!DOCTYPE HTML>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>НСА 2021. Архивный шифр</title>
	<!-- <script src="http://yandex.st/jquery/2.0.2/jquery.min.js"></script> -->
	<!-- CSS3 --> 
	<style>
	
	
		body {
			margin		: 0px;
			padding		: 0px;
			/*text-align	: left;*/
		}
		
		.user-line {
			/*margin		: 0px;*/
			padding			: 2px;
			padding-right	: 10px;
			width			: auto;/*100%;*/
			height			: 20px;
			font-size		: 18px;
			background		: silver;
			text-align		: right;
		}
		
		.logo-line {
			margin		: 0px;
			padding			: 0px;
			/*padding-right	: 10px;*/
			width			: 100%;
			height			: 32px;
			font-size		: 32px;
			/*background		: silver;*/
			text-align		: left;
		}
		
		.body-page {
			margin			: 5px;
			padding			: 0px;
			padding-left	: 5px;
		}
		
		.menu-line {
			display			: flex;
			margin			: 3px;
			border-top		: solid 1px;
			border-bottom	: solid 1px;
		}

		.menu-line > div {
			display			: flex;
			margin			: 3px;
		}

	
		*, html { font-family: Verdana, Arial, Helvetica, sans-serif; }
		body, form {
			margin: 0;
			padding: 0;
		}
		
		body { 
		  /*background-color: #616161; */
		  background-color: #ebebeb; 
		  /*color: #fff; */
		  margin: 0; 
		}
		
		img { 
		  border: none; 
		}
		
		p {
			font-size: 1em;
			margin: 0 0 1em 0;
		}
			
		/* Стили для дерево каталогов */
		ol.tree {
			padding: 0 0 0 30px;
			width: 300px;
			/*border-bottom	: solid 1px;*/
		}
		
		li { 
		  position: relative; 
			margin-left: -15px;
			list-style: none;
		}
		
		li.file {
			margin-left: -1px !important;
		}
		li.file a {
			background: url(../img/document.png) 0 2px no-repeat;
			/*color: #fff;*/
			padding-left: 21px;
			text-decoration: none;
			display: block;
		}
		
		li.file a:hover {
		  /*color: #aff;*/
		  color: #aaa;
		  text-decoration: underline;
		}
		
		li.toggle {
		  background	: url(img/folder-horizontal.png) 15px 1px no-repeat;
		  cursor		: pointer;
		  padding-left	: 37px;
		  border-left	: solid 1px;
		  width:25vw;
		  /*border-bottom	: solid 1px;*/
		}
		
		li.file [href*='.pdf']	{ 
		  background: url(img/document-pdf.png) 0 0 no-repeat; 
		}
		
		li.file [href*='.htm'], 
		li.file [href*='.html']	{ 
		/*  background: url(img/document-html.png) 0 3px no-repeat; */
		background: url(img/document-book-16x16.png) 0 3px no-repeat;
		}
		
		li.file [href*='.txt'] { 
		  background: url(img/document-txt.png) 0 3px no-repeat; 
		}
		
		li.file [href*='.zip'],
		li.file [href*='.gz'] { 
		  background: url(img/document-zip.png) 0 3px no-repeat; 
		}
		
		li.file [href$='.jpg'],
		li.file [href$='.gif'],
		li.file [href$='.ico']	{ 
		  background: url(img/document-jpg.png) 0 2px no-repeat; 
		}
		
		li.file [href$='.png']	{ 
		  background: url(img/document-png.png) 0 2px no-repeat; 
		}
		
		li.file [href$='.css']	{ 
		  background: url(img/document-css.png) 0 2px no-repeat; 
		}
		
		li.file [href$='.js']	{ 
		  background: url(img/document-js.png) 0 2px no-repeat; 
		}
		
		li.file [href$='.php']	{ 
		  background: url(img/document-php.png) 0 4px no-repeat; 
		}
		
		li input {
		  position: absolute;
		  left: 0;
		  margin-left: 0;
		  opacity: 0;
		  z-index: 2;
		  cursor: pointer;
		  height: 1em;
		  width: 1em;
		  top: 0;
		}
		
		li input + ol {
			background: url(img/toggle-small-expand.png) 5px -3px no-repeat;
			margin: -0.938em 0 0 -44px; /* 15px */
			height: 1em;
		}
		
		li input + ol > li { 
		  display: none; 
		  margin-left: -14px !important; 
		  padding-left: 1px; 
		}
		
		li input:checked + ol {
			background: url(img/toggle-small.png) 5px 2px no-repeat;
			margin: -1.25em 0 0 -44px; /* 20px */
			padding: 1.563em 0 0 80px;
			height: auto;
		}
		
		li input:checked + ol > li { display: block; margin: 0 0 0.125em;  /* 2px */}
		li input:checked + ol > li:last-child { margin: 0 0 0.063em; /* 1px */ } 
		
		/*li input:checked + ol:first-child { */
		/*		border-bottom	: solid 1px;*/
			
		/*} */
		
		/*ol.tree > li input:checked + ol > li:last-child{*/
		
		/*	border-bottom	: solid 1px;*/
		/*} */
		
	</style>
</head>
<body>
<body>
<div>
	<div class="user-line">
		<?php

	        if ($user!==null)
	        {

	            $user_profile_link_1  = "/users/profile/";//.$user->getId();
	            $user_profile_link_2  = "/users/logout/";//.$user->getId();
	            $logined = 'Привет, <a href="'.$user_profile_link_1.'">'. $user->getNickname().'</a> | <a href="'.$user_profile_link_2.'">Выйти</a>';
	            $logined = '<a href="'.$user_profile_link_1.'">'. $user->getFio().'('.$user->getRoleName().')</a> | <a href="'.$user_profile_link_2.'">Выйти</a>';
	            echo $logined;
	        }
	        else{
	
	            // не авторизованная загрузка страница
	            $not_logined     =  '<a href="/users/login">Войти</a>';
	            // $not_logined    .=  ' | <a href="/users/signup/">Зарегистрироваться</a>';
	            echo $not_logined;
	        }
		?>
	</div>
	
	<div class="logo-line">
		НСА 2021
		<!--&nbsp;-->
	</div>

	<div class="menu-line">
		<!--&nbsp;-->
		<?=$UserMenu;?>
	</div>
</div>
<div class="body-page">

        Пример вывода дерева архивного шифра
<ol class="tree">
<?php
        // echo "Пример вывода дерева архивного шифра<pre>";
        
        foreach($TREE["fonds"]["items"] AS $fond_id){
	        if (count($TREE["fonds"][$fond_id]["opisi"]["items"])==0){
	        	echo "<div>";
	        	echo "</div>";
	        	continue;
	        }
	        $i	= $TREE["fonds"][$fond_id]["name"];
        	// echo "&nbsp;>".$TREE["fonds"][$fond_id]["name"];
        	// echo "<div style='margin-left:10px;'>" . $i. "</div>";
			// echo '<ol class="tree">';
        	echo '<li class="toggle">';
        	echo $i;
        	echo '<input type="checkbox">';
        	echo '<ol class="tree">';
			// <ol class="tree">
        	
        	
	        foreach($TREE["fonds"][$fond_id]["opisi"]["items"] AS $opis_id){
	        	// echo "<div>";
	        	// echo "&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];
	        	// $i2	= $TREE["fonds"][$fond_id]["name"]." - ".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];
	        	$i2	= $TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];
	        	// echo "<div style='margin-left:25px;'>" . $i2. "</div>";
	        	echo '<li class="toggle">';
	        	echo $i." - ".$i2;
        		echo '<input type="checkbox">';
        		echo '<ol class="tree">';

    	        foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"]["items"] AS $delo_id){
		        	// echo "<div>";
		        	// echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		        	// $i3		= $i2." . ".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		        	// $i3		= $TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		        	$i3		= $i." - ".$i2." - ".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
	        		// echo "<div style='margin-left:50px;'>" . $i3. "</div>";
	        		// echo "<div style='margin-left:50px;'>" . $i3. "</div>";
					echo '<li class="toggle">';
		        		echo $i3;
        				echo '<input type="checkbox">';
						echo '<ol class="tree">';
							echo '<li class="file">';
								echo '<a href="http://www.rkna.ru/projects/metric/f.002/op.68/f.2-op.68-d.537/page.html " target="_blank" >Открыть дело</a>';
							echo '</li>';
						echo '</ol>';
					echo '</li>';
		        	
	    //     		echo "<div style='margin-left:75px;'><a href='#'>Открыть дело</a></div>";
					// foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"]["items"] AS $list_id){
		   //     		// $i	.=$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
			  //      	// echo "<div>";
			  //      	// echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			  //      	// echo $TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"][$list_id]["name"];
			        	
			        	
			        	
			  //      	// echo "</div>";
			  //      };
		        	
		        	// echo "</div>";
		        	// echo "</ol>";
		        };

	        	// echo "</div>";
		        	echo "</ol>";
		        	echo '</li>';
	        };
        	
        	// echo "</div>";
		        	echo "</ol>";
		        	echo '</li>';
        };
		        	echo "</ol>";
       

include __DIR__ . '/../footer2.php';
?>

