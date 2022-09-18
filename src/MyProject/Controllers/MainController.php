<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;
use MyProject\Models\Shifrs\Shifr;


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
}