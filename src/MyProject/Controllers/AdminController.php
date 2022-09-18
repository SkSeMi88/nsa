<?php

namespace MyProject\Controllers;

use Admin\Models\Roles\Role;


use MyProject\Exceptions\ForbiddenException;
use MyProject\Models\Admin\Admin;
use MyProject\Models\Articles\Article;


use MyProject\Services\Db;
use MyProject\View\View;

use MyProject\Models\Users\User;

use MyProject\Services\UsersAuthService;

use MyProject\Exceptions\UnauthorizedException;

use MyProject\Exceptions\InvalidArgumentException;

use MyProject\Models\Site\Site;

class AdminController extends AbstractController
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
    	echo "QWERTY";
        var_dump($this->UserMenu); 
        $roles  = new Role;//->findAll();
        var_dump($roles->getById(1)); 
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
        $this->view->renderHtml('admin/admin_index.php',["UserMenu"=>""]);
    }


    public function roleslist(): void
    {

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
        $this->view->renderHtml('admin/admin_users.php');
    }


    public function Urls(): void
    {
        $this->view->renderHtml('admin/admin_users.php');
    }

 

}