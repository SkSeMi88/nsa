<?php

// namespace MyProject\Controllers;
namespace Admin\Controllers;

use Admin\Models\Roles\Role;


use MyProject\Exceptions\ForbiddenException;
use MyProject\Models\Admin\Admin;
use MyProject\Models\Articles\Article;


use MyProject\Services\Db;
use MyProject\View\View;

use Admin\Models\Users\User;

use MyProject\Models\Site\Site;

use MyProject\Services\UsersAuthService;

use MyProject\Exceptions\UnauthorizedException;

use MyProject\Exceptions\InvalidArgumentException;

class AdminController  extends AbstractController
{

        /** @var View */
    // private $view;

    /** @var Db */
    private $db;


    public function __construct()
    {
        // $this->view = new View(__DIR__ . '/../../../templates');
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
        
        
		$this->UserMenu	= Site::getUserMenu($this->user);
        $this->view->setVar('UserMenu', $this->UserMenu);

        $db = Db::getInstance();
    }

    public function index(): void
    {
    	// echo "qwerty";
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!in_array($this->user->getRoleTitle(),["root","admin"]))
        // if ($this->user->getRole()!="user")
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        // $roles  = new Role;//->findAll();
        // var_dump($roles->getById(1));
        // var_dump($roles);
        // print_r(Role::findAll());

        /*
        $article = Article::getById($articleId);

//       var_dump($article);
        var_dump($this->user);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
*/
        $this->view->renderHtml('admin/admin_index.php');
    }


    public function roleslist(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!in_array($this->user->getRoleTitle(),["root","admin"]))
        // if ($this->user->getRole()!="user")
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        if (isset($_POST["edit_role"])){

            var_dump($_POST);
            echo "<hr>";

            $role_id    = (int)$_POST["role_id"];
            var_dump($role_id);
            // $role       = (new Role)->getById($role_id);
            $role       = Role::getById($role_id);
            var_dump($role);

            // $role->update($_POST);

            if((isset($_POST["role_name"])) && (strlen($_POST["role_name"]) )>3){

                // echo "<hr>name";
                $role->setName($_POST["role_name"]);
            }

            if((isset($_POST["role_title"])) && (strlen($_POST["role_title"]) )>3){

                // echo "<hr>name";
                $role->setTitle($_POST["role_title"]);
            }

            if((isset($_POST["role_prim"]))  && (strlen($_POST["role_prim"]) )>3){

                // echo "<hr>prim";
                $role->setPrim($_POST["role_prim"]);
            }

            $state  = 1;
            if (!isset($_POST["role_state"])) {
                $state  = 0;
            }

            $role->setState($state);

            $role->save();
            // var_dump($role);

            echo "Изменения успешно созранены!";
        }

        if (isset($_POST["create_role"])){

            // var_dump($_POST);

 /*
            var_dump($this->user);
    
            if ($this->user === null) {
                throw new UnauthorizedException();
            }
    
            if ($this->user->getRole()!="user")
            {
                throw new ForbiddenException('Не достаточно прав доступа у Вас.');
            }
    */
            if (!empty($_POST)) {
                try {
                    $role = Role::createFromArray($_POST);
                } catch (InvalidArgumentException $e) {
                    $this->view->renderHtml('admin/admin_roles.php', ['error' => $e->getMessage()]);
                    return;
                }
    
                // header('Location: /admin_roles/' . $role->getId(), true, 302);
                // exit();
            }
    
            $roles  = Role::findAll();
            $this->view->renderHtml('admin/admin_roles.php',['roles' => $roles]);
            exit();

        }
        // }

        // if(isset($_POST['role_state_2']) && ($_POST['role_state_2'] == '1') )
        //     {
        //         echo "Need wheelchair access.";
        //     }

        /*
        $SQL    = "SELECT * FROM sys_roles;";
        // $roles  = $this->db->query($SQL);

        $db = Db::getInstance();
        $roles = $db->query(
            $SQL,
            [],
            static::class
        );
        */

        $roles  = (new Role)->findAll();
        // echo $roles[0]->getPrim();

        $this->view->renderHtml('admin/admin_roles.php',["roles"=>$roles]);
    }

    public function UsersList(): void
    {

        if ($this->user === null) {
            throw new UnauthorizedException();
        }
		// echo "<pre>";
  //      var_dump($this->user);
  //      var_dump($this->user->getRoleTitle());
  //      var_dump(!in_array($this->user->getRoleTitle(),["root","admin"]));
		// echo "</pre>";

        // if (!(in_array($this->user->getRoleTitle(),["root","admin"])))
        // // if ($this->user->getRole()!="user")
        // {
        //     throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        // }

        $new_user_role  = Role::getSelectRolesList();
        if (!empty($_POST)){
            // var_dump($_POST);
        }

        if (isset($_POST["edit_user"])){

            $changed   = 0;
            // var_dump($_POST);
            // echo "<hr>";

            $user_id    = (int)$_POST["user_id"];
            // var_dump($user_id);
            // $role       = (new Role)->getById($role_id);
            $user       = User::getById($user_id);
            // var_dump($user);

            // $role->update($_POST);

            if((isset($_POST["user_fio"])) && (strlen($_POST["user_fio"]) )>3){

                // echo "<hr>ФИО";
                if ($user->getFio()!==$_POST["user_fio"])
                {
                    $user->setFio($_POST["user_fio"]);
                    $changed   += 1;
                }

            }

            if((isset($_POST["user_nickname"])) && (strlen($_POST["user_nickname"]) )>3){

                // echo "<hr>name";
                if ($user->getNickname()!==$_POST["user_nickname"])
                {
                    $user->setNickname($_POST["user_nickname"]);
                    $changed   += 1;
                }
            }

            if((isset($_POST["user_email"])) && (strlen($_POST["user_email"]) )>3){

                // echo "<hr>name";
                if ($user->getNickname()!==$_POST["user_nickname"])
                {
                    $user->setEmail($_POST["user_email"]);
                    $changed   += 1;
                }
            }

            if((isset($_POST["user_passwordHash"])) &&(strlen($_POST["user_passwordHash"]) )>5){

                // echo "<hr>name";
                $user->setPasswordHash(password_hash($_POST["user_passwordHash"], PASSWORD_DEFAULT));
                $changed   += 1;
            }

            if((isset($_POST["user_role"]))  && (strlen($_POST["user_role"]) )!=0){

                // echo "<hr>role".$_POST["user_role"];
                if ($user->getRole()!==$_POST["user_role"])
                {
                    $user->setRole($_POST["user_role"]);
                    $changed   += 1;
                }
            }

            if((isset($_POST["user_prim"]))  && (strlen($_POST["user_prim"]) )>3){

                // echo "<hr>prim";
                if ($user->getPrim()!==$_POST["user_prim"])
                {
                    $user->setPrim($_POST["user_prim"]);
                    $changed   += 1;
                }
            }
            
            $state  = 1;
            if (!isset($_POST["user_state"])) {
                $state  = 0;
            }
            
            if ($state!=$user->getState())
            {
                $user->setState($state);
                $changed   += 1;
            }

            if ($changed>0){

                $user->save();
                echo "Изменения успешно сохранены!";
            }
            // var_dump($user);
        }

        if (isset($_POST["create_user"])){

            if ($this->user === null) {
                throw new UnauthorizedException();
            }
    
            // if ($this->user->getRole()!="user")
            if (!(in_array($this->user->getRoleTitle(),["root","admin"])))
            {
                throw new ForbiddenException('Не достаточно прав доступа у Вас.');
            }
            if (!empty($_POST)) {
                try {
                    $user = User::createFromArray($_POST);
                } catch (InvalidArgumentException $e) {
                    $users  = User::findAll();
                    $this->view->renderHtml('admin/admin_users.php', ["user" => $this->user, 'error' => $e->getMessage(), "users" => $users, "new_user_role" => $new_user_role]);
                    return;
                }
    
                echo "Новый пользователь создан успешно.";
                echo "<hr>";
                // header('Location: /admin_roles/' . $role->getId(), true, 302);
                // exit();
            }
        }
 
        $users  = User::findAll();
        // var_dump($users);
        $this->view->renderHtml('admin/admin_users.php', ["user" => $this->user, "users" => $users, "new_user_role" => $new_user_role]);
    }

    public function Urls(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        $this->view->renderHtml('admin/admin_urls.php');
    }
}