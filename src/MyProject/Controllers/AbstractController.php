<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Services\UsersAuthService;
use MyProject\View\View;


use MyProject\Models\Site\Site;

abstract class AbstractController //extends AbstractController
{
    /** @var View */
    protected $view;

    /** @var User|null */
    protected $user;

    public function __construct()
    {
        // $this->os   = os.env();
        // $this->os   = $_SERVER;
        $this->user = UsersAuthService::getUserByToken();
        // var_dump($this->user);
        // var_dump($this->os);
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
        // $this->view->setVar('server', $_SERVER);
        
        $this->UserMenu	= Site::getUserMenu($this->user);
        $this->view->setVar('UserMenu', $this->UserMenu);
    }

    protected function getInputData()
	{
		return json_decode(
			file_get_contents('php://input'),
			true
		);
	}

    protected function getInputData1()
    {
        return json_decode(
            file_get_contents('php://input'),
            true
        );
    }


    protected function getMethodData()
    {
        return($_SERVER['REQUEST_METHOD']);
    }

    protected function sendMsg($msg_data, $code)
    {
        http_response_code($code);
        echo json_encode($msg_data, true);
        return;
    }
}