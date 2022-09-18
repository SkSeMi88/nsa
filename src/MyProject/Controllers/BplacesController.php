<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Models\Articles\Article;
use MyProject\View\View;

use MyProject\Models\Users\User;

use MyProject\Services\UsersAuthService;

use MyProject\Exceptions\UnauthorizedException;

use MyProject\Exceptions\InvalidArgumentException;

use MyProject\Models\BP_lists\BP_list;
use MyProject\Models\Bplaces\Bplace;


class BplacesController  extends AbstractController
{
    /** @var View */
    // private $view;

    public function __construct()
    {
        // $this->view = new View(__DIR__ . '/../../../templates');
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view2 = new View(__DIR__ . '/../../../templates');
//        $this->bplaces = Blace::findAll();
        $this->view->setVar('user', $this->user);
        $this->view->setVar('view2', $this->view2);
        //$this->view->setVar('Bplaces', Bplace::findAll());
    }

    public function edit(int $bplace_Id):void
    {
        $bplace = Bplace::getById($bplace_Id);

        // if ($this->user->getRole()!="admin")
        // {
        //     throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        // }

        // if ($this->user === null) {
        //     throw new UnauthorizedException();
        // }

        // // if ($this->user->getRole()!="user")
        // if (!in_array($this->user->getRole(),["admin"]))
        // {
        //     throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        // }


        if ($bplace === null) {
            throw new NotFoundException();
        }

        // if ($this->user === null) {
        //     throw new UnauthorizedException();
        // }

        if (!empty($_POST)) {
            try {
                $bplace->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('bp/bpeditor.php', []);//'error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /bplaces/', true, 302);
            exit();
        }

        $this->view->renderHtml('bp/bpeditor.php', ['bplace' => $bplace]);
    }

    public function list(): void
    {
        // echo "Редактор мест рождений..";

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        // if ($this->user->getRole()!="user")
        if (!in_array($this->user->getRole(),["admin"]))
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        $bp_editor = [

            "filtr" => [
                "find_punkt"    => "",
                "find_volost"   => "",
                "find_uezd"     => ""
            ],

            "find_uezd"     => Bplace::getAllUezd("uezd")["datalist"],
            "find_volost"   => Bplace::getAllVolost("volost")["datalist"]
        ];

        $bplaces = Bplace::findALL();

        $cnt    = count($bplaces);

        if(isset($_POST["filtr"])) {

            // echo "пришла форма поиска";

            $SQL_filtr  = Bplace::getSQLFromFiltrForm();
            // echo "$SQL_filtr";
            $bplaces    = Bplace::getAllByFiltrFormSQL($SQL_filtr);

            $bp_editor["filtr"]["find_punkt"]       = $_REQUEST["find_punkt"];
            $bp_editor["filtr"]["find_volost"]      = $_REQUEST["find_volost"];
            $bp_editor["filtr"]["find_uezd"]        = $_REQUEST["find_uezd"];
        }

        // echo "<pre>";
        // var_dump($bplaces);
        // echo "</pre>";

        if(isset($_POST["save_bplace"]))
        {
        
            // echo "<pre>";
            // var_dump($_REQUEST);
            // echo "пришла форма сохранения";
            $check = Bplace::getSQLFromSaveForm();
            if ($check===null){
                echo "Ошибка ввода";
            }
            else {
                $bplace    = Bplace::getById((int)$_REQUEST["save_bplace_id"]);
                // var_dump($bplace);
                // echo "<hr></pre>".$bplace->getId();
                $bplace->setPunkt($_REQUEST["punkt"]);
                $bplace->setVolost($_REQUEST["volost"]);
                $bplace->setUezd($_REQUEST["uezd"]);
                $bplace->save();

                // header('Location: /bplaces/', true, 302);
                header("Refresh: 0");
                exit();
            }

        }

        if(isset($_POST["delete_bplace"])) {
            // echo "<pre>";
            // var_dump($_REQUEST);
            // echo "пришла форма удаления";
            $tmp    = Bplace::getById((int)$_REQUEST["delete_bplace_id"]);
            // var_dump($tmp);
            // echo "<hr></pre>".$tmp->getId()."```````````".(int)$_REQUEST["id"];
            // echo "<hr>";
            // print_r($_GET["id"]);
            header("Refresh: 0");
            exit();
        }

////        var_dump($article);
//        var_dump($Bplaces);

        if ($bplaces === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->setVar('Bplaces',$bplaces);

        $this->view->renderHtml('bd/bpeditor.php', ['bplaces' => $bplaces, "bp_editor"=> $bp_editor, "cnt" =>$cnt]);
    }

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
/*
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

*/

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
        $article = Article::getById($articleId);

        var_dump($article);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);

        $article->delete();
        // $article->save();
        var_dump($article);
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
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php',['user' => $this->user]);
    }
}