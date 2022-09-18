<?php

// namespace MyProject\Controllers;

// use MyProject\View\View;

// use MyProject\Models;


namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Services\Db;
use MyProject\View\View;


use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;

use MyProject\Services\UsersAuthService;

class UsersController extends AbstractController
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

    public function signUp()
    {
        // $errors = [];
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                // $errors[]   = $e->getMessage();
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                // $this->view->renderHtml('users/signUp.php', ["error"=> $errors]);
                return;
            }

            if ($user instanceof User) {

                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);

                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php');
    }

    public function activate(int $userId, string $activationCode)
    {
        // echo("<hr>");
        // print_r($userId);
        // echo("<hr>");
        // print_r($activationCode);
        // echo("<hr>");

        $errors = [];

        $user   = User::getById($userId);
        
        // var_dump($user);

        if (!($user instanceof User))
        {

            $errors   = 'Пользователь в системе не найден.';

            $this->view->renderHtml('users/activateFailed.php', ["errors"=>$errors]);
            return;

        }

        // echo("<hr>");
        // var_dump($user->getIsConfirmed());
        // var_dump($user->getAuthToken());
        // echo("<hr>");
        if (($user->getIsConfirmed()))
        {

            $errors   = 'Пользователь в системе уже активирован.';

            $this->view->renderHtml('users/activateFailed.php', ["errors"=>$errors]);
            return;

        }

        $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);
        if (!$isCodeValid)
        {
            echo("<hr>");
            $errors   = 'Ссылка активации не актуальная.';

            $this->view->renderHtml('users/activateFailed.php', ["errors"=>$errors]);
            return;
        }

        // var_dump($isCodeValid);

        $user->activate();

        // echo("QWERTY<hr>");
        // echo("<hr>");
        $isCodeDeleted = UserActivationService::deleteActivationCode($user, $activationCode);

        // var_dump($isCodeDeleted);
        // if (!$isCodeDeleted)
        // {
        //     $errors   = 'Завершение операции не возможно.';

        //     $this->view->renderHtml('users/activateFailed.php', ["errors"=>$errors]);
        //     return;
        // }
        // echo("QWERTY<hr>");
        // var_dump($user);

        $this->view->renderHtml('users/activateSuccessful.php');
        // UserActivationService::deleteActivationCode($user, $activationCode);
    
    }

    public function login()
    {
//        var_dump($this->user);

        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        if ($this->user!==null){
            header('Location: /');
            exit();
        }

        $this->view->renderHtml('users/login.php');
    }

    // public function logout($params)
    public function logout()
    {
        // var_dump($params);
        // var_dump($_SERVER);
        
        // $user   = User::getById($params);
        
        // var_dump(UsersAuthService::getUserByToken());
        // var_dump($user);

        /*
            1 проверка куки
                есть - метод выхода в сервисе
                нет - отображение шаблона, что вышли
        */
        $token = $_COOKIE['token'] ?? '';
        

        if (!empty($token)) {

            UsersAuthService::deleteToken();
            // print_r("<pre>");
            // print_r($_SERVER);
            // print_r("</pre>");
            header('Location: /');
            return;
        }

        header('Location: '.$_SERVER["HTTP_REFERER"]);
        return;

/*
        if (!empty($params)) {
            try {
                $user = User::logout($params);
                UsersAuthService::deleteToken(UsersAuthService::getUserByToken());
                UsersAuthService::deleteToken($user);
                header('Location: /'.$_SERVER[""]);
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('errors/500.php', ['error' => $e->getMessage()]);
                return;
            }
        }

                    try {
                $user = User::logout($params);
                UsersAuthService::deleteToken(UsersAuthService::getUserByToken());
                UsersAuthService::deleteToken($user);
                header('Location: /'.$_SERVER[""]);
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('errors/500.php', ['error' => $e->getMessage()]);
                return;
            }
*/
        // $this->view->renderHtml('users/login.php');
    }

    public function profile($params)
    {
        var_dump($params);
        var_dump($_SERVER);
    }
}