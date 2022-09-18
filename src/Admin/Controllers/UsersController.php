<?php

// namespace MyProject\Controllers;

// use MyProject\View\View;

// use MyProject\Models;


namespace Admin\Controllers;

// use MyProject\Models\Users\User;
use Admin\Models\Users\User;
use Admin\Models\Users\UsersRoles;
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

        // $prev_page      = $_SERVER["HTTP_REFERER"];

        // if (!empty($_POST)) {
            // var_dump($_POST);
            // if (isset($_POST["select_role"])){

            //     $user           = User::getById((int)$_POST["user_id"]);
            //     $user->setRole($_POST["role"]);
            //     var_dump($user);
            //     UsersAuthService::createToken2($user);
                
            // // }
            // if ($this->user!==null){
            //     header('Location: /');
            //     // header('Location: '.$_SERVER["HTTP_REFERER"]);
            //     exit();
            // }
            

        //     try {
        //         $user           = User::login($_POST);
        //         // var_dump($user);
        //         UsersAuthService::createToken($user);
        //         // $user           = UsersRoles::getUserRolesList($user);

        //         // $this->view->renderHtml('users/select_role.php',["user" => $user]);
        //         header('Location: /');
        //         exit();
        //     } catch (InvalidArgumentException $e) {
        //         $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
        //         return;
        //     }

        //     //если павильно ввели форму входа, то отображаем странгицу выбора роли с передачей ей
        // }

        // if ($this->user!==null){
        //     header('Location: /');
        //     // header('Location: '.$_SERVER["HTTP_REFERER"]);
        //     exit();
        // }

        // $this->view->renderHtml('users/login.php');
        
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

    $this->view->renderHtml('users/login.php');
    }

    // public function logout($params)
    public function logout()
    {
    	
  //      setcookie('token', null, -1, '/','', false, true);
  //      // header('Location: /users/login');
        
		// // setcookie('token');
		// header('Location: /');
        
    	
		if ((!empty($this->user))||($this->user!==null)) {
            setcookie('token', '', -1, '/', '/', false, true);
			setcookie('token');
            // echo "QWERTY";
            
			
			// unset cookies
			if (isset($_SERVER['HTTP_COOKIE'])) {
				$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
				foreach($cookies as $cookie) {
					$parts = explode('=', $cookie);
					$name = trim($parts[0]);
					setcookie($name, '', time()-1000);
					setcookie($name, '', time()-1000, '/');
				}
			}
	
			$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
			setcookie('token', '', time()-60*60*24*365, '/', $domain, false);
			
	        header('Location: /');
	        exit();
        }
        $this->view->renderHtml('users/login.php');
        
        
        
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
        // $token = $_COOKIE['token'] ?? '';
        

        // if (!empty($token)) {

        //     UsersAuthService::deleteToken();
        //     // print_r("<pre>");
        //     // print_r($_SERVER);
        //     // print_r("</pre>");
        //     header('Location: /');
        //     return;
        // }

        // // header('Location: '.$_SERVER["HTTP_REFERER"]);
        // header('Location: /');
        // return;



        // $token = $_COOKIE['token'] ?? '';
        
        // if (!empty($token)) {

        //     UsersAuthService::deleteToken();
        //     header('Location: /');
        //     return;
        // }

        // header('Location: '.$_SERVER["HTTP_REFERER"]);
        
        
		// setcookie('token', '', -1, '/', '', false, true);
		// $this->view->renderHtml('users/login.php');
		// // header('Location: ../../../');
  //      exit;
        // return;

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

    // public function profile($params)
    public function profile()
    {
        // var_dump($params);
        // var_dump($_SERVER);
        $user   = UsersAuthService::getUserByToken();

        if ($user===null){
            print_r("Страница доступна только авторизованным пользователям.");
            return(0);
        }
        // var_dump($user);
        
        echo "<br>";
        echo "Ф.И.О.";
        echo "<br>";
        echo '<input type="text" class="user_profile_text" value="'.$user->getFio().'">';
        
        echo "<br>";
        echo "<br>";
        echo "Логин";
        echo "<br>";
        echo '<input type="text"  class="user_profile_text" value="'.$user->getNickname().'">';
        
        echo "<br>";
        echo "<br>";
        echo "Электронная почта";
        echo "<br>";
        echo '<input type="text"  class="user_profile_text" value="'.$user->getEmail().'">';
        
        echo "<br>";
        echo "<br>";
        echo "Роль";
        echo "<br>";
        echo '<input type="text"  class="user_profile_text" value="'.$user->getRoleName().'">';
        
        echo "<br>";
        echo "<br>";
        $back_link  = $_SERVER['HTTP_REFERER'];
        echo '<a href="'.$back_link.'">Назад</a>';

        if ($user->getRoleName()==="admin"){

            echo "<hr>";
        }


    
    }
}