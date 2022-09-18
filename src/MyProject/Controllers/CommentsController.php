<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Models\Articles\Article;
use MyProject\View\View;

use MyProject\Models\Users\User;

use MyProject\Services\UsersAuthService;

use MyProject\Exceptions\UnauthorizedException;

use MyProject\Exceptions\InvalidArgumentException;

class CommentsController  extends AbstractController
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

    public function add(){

        var_dump($this);
    }
}