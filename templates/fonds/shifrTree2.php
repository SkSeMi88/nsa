<?php

$title		= "НСА 2021. Архивный шифр";
include __DIR__ . '/../header2.php';

        echo "Пример вывода дерева архивного шифра<pre>";
        
        foreach($TREE["fonds"]["items"] AS $fond_id){
	        if (count($TREE["fonds"][$fond_id]["opisi"]["items"])==0){
	        	echo "<div>";
	        	echo "</div>";
	        	continue;
	        }
	        $i	= $TREE["fonds"][$fond_id]["name"];
        	// echo "&nbsp;>".$TREE["fonds"][$fond_id]["name"];
        	echo "<div style='margin-left:10px;'>" . $i. "</div>";
        	
	        foreach($TREE["fonds"][$fond_id]["opisi"]["items"] AS $opis_id){
	        	// echo "<div>";
	        	// echo "&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];
	        	// $i2	= $TREE["fonds"][$fond_id]["name"]." - ".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];
	        	$i2	= $TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];
	        	echo "<div style='margin-left:25px;'>" . $i2. "</div>";

    	        foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"]["items"] AS $delo_id){
		        	// echo "<div>";
		        	// echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		        	// $i3		= $i2." . ".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		        	// $i3		= $TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		        	$i3		= $i." - ".$i2." - ".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
	        		echo "<div style='margin-left:50px;'>" . $i3. "</div>";
		        	
	        		echo "<div style='margin-left:75px;'><a href='#'>Открыть дело</a></div>";
					foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"]["items"] AS $list_id){
		        		// $i	.=$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
			        	// echo "<div>";
			        	// echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			        	// echo $TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"][$list_id]["name"];
			        	
			        	
			        	
			        	// echo "</div>";
			        };
		        	
		        	echo "</div>";
		        };

	        	echo "</div>";
	        };
        	
        	// echo "</div>";
        };
       

include __DIR__ . '/../footer2.php';
?>