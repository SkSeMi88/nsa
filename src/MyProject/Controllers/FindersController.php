<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Models\Finders\Finder;
use MyProject\View\View;

use MyProject\Models\Users\User;

use MyProject\Services\UsersAuthService;

use MyProject\Exceptions\UnauthorizedException;

use MyProject\Exceptions\InvalidArgumentException;

class ArticlesController extends AbstractController
{
    /** @var View */
    // private $view;

    public function __construct()
    {
        // $this->view = new View(__DIR__ . '/../../../templates');
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
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