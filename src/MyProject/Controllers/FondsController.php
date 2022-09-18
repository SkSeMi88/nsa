<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Models\Finders\Finder;
use MyProject\Models\Fonds\Fond;
use MyProject\View\View;

use MyProject\Models\Users\User;
use MyProject\Models\Shifrs\Shifr;

use MyProject\Models\Site\Site;

use MyProject\Services\UsersAuthService;

use MyProject\Exceptions\UnauthorizedException;

use MyProject\Exceptions\InvalidArgumentException;


class FondsController extends AbstractController
{
    /** @var View */
    // private $view;

  //  public function __construct()
  //  {
  //      // $this->view = new View(__DIR__ . '/../../../templates');
  //      $this->user = UsersAuthService::getUserByToken();
  //      $this->view = new View(__DIR__ . '/../../../templates');
  //      $this->view->setVar('user', $this->user);
        
		// $this->UserMenu	= Site::getUserMenu($this->user);
  //      $this->view->setVar('UserMenu', $this->UserMenu);
        
  //  }

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

//        var_dump($article);
        var_dump($this->user);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);
    }

    public function viewCard(int $fondId): void
    {
    	echo "Этл страница карточки";
    	$card_fond	= Fond::getById($fondId);
		$this->view->renderHtml('fonds/viewCard.php', [
            'card_fond' => $card_fond
        ]);
    }
    
  
    public function list(): void
    {
    	/*
    	// var_dump($_POST);
		$this->view2    = new View(__DIR__ . '/../../../templates');
		$this->view->setVar('view2', $this->view2);
		
		
		if (isset($_POST["create_new_fond"])){
			// var_dump($_POST);
			
			$new_fond = new Fond();
			$new_fond->setName($_POST['new_fond_name']);
			$new_fond->setTitle($_POST['new_fond_title']);
			$new_fond->setDates($_POST['new_fond_dates']);
			$new_fond->setPath($_POST['new_fond_path']);

			$result	= $new_fond->save();
			
			if (!$result){
				echo "<hr>Ошибка при создании нового фонда<hr>";
			}

			if ($result){
				echo "<hr>Новый фонд успешно создан. Заполните его параметры - перейдите в его карточку";
				// var_dump($new_fond);
				echo "<hr>";				
			}
			

		}
		
		
		if (isset($_POST["new_fond_form"])){
			var_dump($_POST);
		}
		

        $fond = Fond::findAll();

        // var_dump($fond);
        // var_dump($this->user);
        

        if ($fond === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('fonds/list.php', [
            'fond' => $fond
        ]);
    */

        // echo "<pre>";

        // $value = "ЙцукЙвае Qwert aSdfg zxCv Р 1480";
        // var_dump($value);

        // $value = mb_strtolower($value);
        // echo $value;

        $TREE	= Shifr::getShifrTree();
     //   echo "Пример вывода дерева архивного шифра<pre>";
        
     //   foreach($TREE["fonds"]["items"] AS $fond_id){
	    //     if (count($TREE["fonds"][$fond_id]["opisi"]["items"])==0){
	    //     	echo "<div>";
	    //     	echo "</div>";
	    //     	continue;
	    //     }
	    //     $i	= $TREE["fonds"][$fond_id]["name"];
     //   	// echo "&nbsp;>".$TREE["fonds"][$fond_id]["name"];
     //   	echo "<div style='margin-left:10px;'>" . $i. "</div>";
        	
	    //     foreach($TREE["fonds"][$fond_id]["opisi"]["items"] AS $opis_id){
	    //     	// echo "<div>";
	    //     	// echo "&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];
	    //     	// $i2	= $TREE["fonds"][$fond_id]["name"]." - ".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];
	    //     	$i2	= $TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];
	    //     	echo "<div style='margin-left:25px;'>" . $i2. "</div>";

    	//         foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"]["items"] AS $delo_id){
		   //     	// echo "<div>";
		   //     	// echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		   //     	// $i3		= $i2." . ".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		   //     	// $i3		= $TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		   //     	$i3		= $i." - ".$i2." - ".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
	    //     		echo "<div style='margin-left:50px;'>" . $i3. "</div>";
		        	
	    //     		echo "<div style='margin-left:75px;'>Открыть дело</div>";
					// foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"]["items"] AS $list_id){
		   //     		// $i	.=$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
			  //      	// echo "<div>";
			  //      	// echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			  //      	// echo $TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"][$list_id]["name"];
			        	
			        	
			        	
			  //      	// echo "</div>";
			  //      };
		        	
		   //     	echo "</div>";
		   //     };

	    //     	echo "</div>";
	    //     };
        	
     //   	// echo "</div>";
     //   };
       
       
       $this->view->renderHtml('fonds/shifrTree.php', ["TREE"=>$TREE]);
    
    }
    
    
    public function edit0(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        var_dump($this->user);

//        var_dump($this->user->getRole());

        if ($this->user->getRole()!="admin")
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article, 'user1'=>$this->user]);
    }



    // public function insert(): void
    // {

    //     $article = Article::getById(1);
    //     $article->id = null;

    //     if ($article === null) {
    //         $this->view->renderHtml('errors/404.php', [], 404);
    //         return;
    //     }

    //     $article->setName('Добавлени статья : название статьи');
    //     $article->setText('Новый текст добавленной  статьи');
    //     $article->setcreatedAt(date("Y-m-d H:i:s"));
    //     $article->setauthorId(1);


    //     $article->save();
    // }


    public function add1(): void
    {
        $author = User::getById(1);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole()!="admin")
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название новой статьи');
        $article->setText('Новый текст новой статьи');
        $article->setcreatedAt(date("Y-m-d H:i:s"));

        $article->save();

        var_dump($article);
    }

    public function delete(int $articleId): void
    {
        $finder = Finder::getById($articleId);

        var_dump($finder);

        if ($finder === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $finder
        ]);

        $finder->delete();
        // $article->save();
        var_dump($finder);
    }


    public function add(): void
    {

        var_dump($this->user);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole()!="user")
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        if (!empty($_POST)) {
            try {
                $finder = Finder::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $finder->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php',['user' => $this->user]);
    }
}