<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;
use MyProject\Models\Shifrs\Shifr;

use MyProject\Models\Fonds\Fond;
use MyProject\Models\Opisi\Opis;
use MyProject\Models\Dela\Delo;



use MyProject\Exceptions;//\DbException;

use MyProject\Services\UsersAuthService;

class MainController extends AbstractController
{
    /** @var View */
    // private $view;

    /** @var Db */
    private $db;

    public function __construct()
    {

        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);

        // $this->view = new View(__DIR__ . '/../../../templates');
        // $this->db = new Db();
        $db = Db::getInstance();
    }

    public function main01()
    {
        $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        // var_dump($articles);
        return;
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function main()
    {
        // $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        // $this->view->renderHtml('main/main.php', ['articles' => $articles]);

        $title      = "Мой блог. Главная страница";
        // echo "Мой блог. Главная страница";
        $articles   = [];

        // var_dump($this->user);

        // $articles = Article::findAll();
        // $this->view->renderHtml('main/main.php', ['articles' => $articles,'title' => $title]);
        // $this->view->renderHtml('main/index.php', ['articles' => $articles,'title' => $title, 'user'=>$this->user]);
        $this->view->renderHtml('main/index.php', ['articles' => $articles,'title' => $title]);
        /*
        // echo "<pre>";
        $TREE	= Shifr::getShifrTree();
        echo "Пример вывода дерева архивного шифра";
        
        foreach($TREE["fonds"]["items"] AS $fond_id){
        	echo "<div>";
	        if (count($TREE["fonds"][$fond_id]["opisi"]["items"])==0){
	        	echo "</div>";
	        	continue;
	        }
        	echo "&nbsp;".$TREE["fonds"][$fond_id]["name"];
        	
	        foreach($TREE["fonds"][$fond_id]["opisi"]["items"] AS $opis_id){
	        	echo "<div>";
	        	echo "&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];

    	        foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"]["items"] AS $delo_id){
		        	echo "<div>";
		        	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		        	
					foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"]["items"] AS $list_id){
			        	echo "<div>";
			        	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			        	echo $TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"][$list_id]["name"];
			        	
			        	
			        	
			        	echo "</div>";
			        };
		        	
		        	echo "</div>";
		        };

	        	echo "</div>";
	        };
        	
        	echo "</div>";
        };
        */
        
    }

    public function m404()
    {
        // $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        // $this->view->renderHtml('main/main.php', ['articles' => $articles]);

        $title      = "Мой блог. Главная страница";
        // echo "Мой блог. Главная страница";
        $articles   = [];

        // var_dump($this->user);

        // $articles = Article::findAll();
        // $this->view->renderHtml('main/main.php', ['articles' => $articles,'title' => $title]);
        $this->view->renderHtml('404.php', ['articles' => $articles,'title' => $title, 'user'=>$this->user]);
    }
    
    public function release()
    {
        $this->view->renderHtml('main/release.php');

    }

    public function test()
    {

        $SQL    = "ORDER BY name;";
    	$fonds	= Fond::findAllByColumnWhere($SQL);

        echo "<pre>";

        // var_dump($fonds);

        $k = 0;
        foreach($fonds AS $fond)
        {
           echo "<hr> # ".$k++;
           echo "<br>".$fond->getName();
           echo "<br>";
           echo Shifr::transliter($fond->getName());
           echo "<br>";
           echo Fond::convertFondById(Shifr::transliter($fond->getName()));
           $fond->setPath(Fond::convertFondById(Shifr::transliter($fond->getName())));
           $fond->save();

            // находим все описи отсортированные по имени
            $SQL2	= 'WHERE (fond_id="'.$fond->getId().'") ORDER BY name';

            // Получение всех описей по ид-ру фонда
            $opisi_items	= Opis::findAllByColumnWhere($SQL2);

            // переходим к следующему фонду если нет описей у текущего
            if ($opisi_items===null){
                continue;
            };

            if (count($opisi_items)==0){
                continue;
            };

            // для каждой описи $opis из списка всех описей $opisi_items  в конкретном фонде $fond
            foreach($opisi_items AS $opis)
            {
                $SQL3	= 'WHERE (fond_id="'.$fond->getId().'") AND(opis_id="'.$opis->getId().'") ORDER BY name';
                $dela	= Delo::findAllByColumnWhere($SQL3);

	    		if ($dela===null){
					continue;
				};

	    		if ((count($dela)==0)||($dela===null)){
	    			continue;
	    		};

    			// $Tree["fonds"][$fond->getId()]["opisi"]["items"][]	= $opis->getId();
    			// $Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]	= [
    			// 	"name"	=> $opis->getName(),
    			// 	"dela"	=> [],
    			// ];

                $opis_name  = Opis::convertOpisName(Opis::transliter($opis->getName()));
                echo "<br>      ".$opis_name;
                $opis->setPath(Opis::convertOpisName(Opis::transliter($opis->getName())));
                $opis->save();

                foreach($dela AS $delo){

                    $delo_name  = Delo::convertDeloName(Delo::transliter($delo->getName()));
                    echo "<br>                  ".$delo_name;
                    $delo->setPath($delo_name);
                    $delo->save();
    

    				// $SQL4	= 'WHERE (fond_id="'.$fond->getId().'") AND(opis_id="'.$opis->getId().'") AND(delo_id="'.$delo->getId().'")  ORDER BY list';
    				// $lists	= Shifr::findAllByColumnWhere($SQL4);


					// if ($lists===null){
					// 	continue;
					// };

    				// if(count($lists)==0){
    				// 	continue;
    				// };
    		
    				// $Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"]["items"][]		= $delo->getId();
    				// $Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"][$delo->getId()]	= [
    				// 	// "name"	=> $fond->getName()." ". $opis->getName()." ".$delo->getName(),
    				// 	"name"	=> $delo->getName(),
    				// 	"html"	=> $fond->getName()." ". $opis->getName()." ".$delo->getName(),
    				// 	"lists"	=> [],
    				// ];
    				

    				// foreach($lists AS $list){
    					
					// 	$Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"][$delo->getId()]["lists"]["items"][] 		= $list->getId();
					// 	$Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"][$delo->getId()]["lists"][$list->getId()]	= [
					// 		"name"	=> $list->getList()
					// 	];
    				// 	// "name"	=> $delo->getName(),
    				// 	// "lists"	=> [],
    				
    				// }
    				
    			};
            }


        }
        echo "</pre>";

    }
}