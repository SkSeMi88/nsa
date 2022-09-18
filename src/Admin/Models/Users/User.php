<?php

namespace Admin\Models\Users;

use Admin\Models\Roles\Role;
use Admin\Models\Users\UsersRoles;

use MyProject\Models\ActiveRecordEntity;

use MyProject\Exceptions\InvalidArgumentException;



class User extends ActiveRecordEntity
{
    /** @var string */
    protected $fio;

    /** @var string */
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var int */
    protected $isConfirmed;
    // public $isConfirmed;

    // /** @var string */
    // protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;

    /** @var string */
    protected $createdAt;

    /** @var int */
    protected $state;
    
    // /** @var string
    protected $prim;
    
    /** @var int */
    protected $role;
    
    /** @var int */
    protected $ro_flag;

    // public $rolesList;


    /**
     * @return string
     */
    public function getFio(): string
    {
        return $this->fio;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getPrim()
    {
        return $this->prim;
    }

    protected static function getTableName(): string
    {
        return 'sys_users';
    }

    public static function signUp(array $userData)
    {

        // var_dump($userData);

        // echo("<br>signUp start");

        $errors = [];
        if (empty($userData['nickname'])) {
            // throw new InvalidArgumentException('Не передан nickname');
            $errors[]    = 'Не передан nickname';
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['nickname'])) {
            $errors[]    = 'Nickname может состоять только из символов латинского алфавита и цифр';
        }

        if (static::findOneByColumn('nickname', $userData['nickname']) !== null) {
            $errors[]    = 'Пользователь с таким nickname уже существует';
        }

        if (empty($userData['email'])) {
            // throw new InvalidArgumentException('Не передан email');
            $errors[]    = 'Не передан email';
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[]    = 'Email некорректен';
        }

        if (static::findOneByColumn('email', $userData['email']) !== null) {
            $errors[]    = 'Пользователь с таким email уже существует';
        }

        if (empty($userData['password'])) {
            // throw new InvalidArgumentException('Не передан password');
            $errors[]    = 'Не передан password';
        }

        if (mb_strlen($userData['password']) < 8) {
            $errors[]    = 'Пароль должен быть не менее 8 символов';
        }

        if (count($errors)>0)
        {
            // $error  = "<br>".implode("<br>", $errors);
            $error  = implode("<br>", $errors);
            // echo($error);
            throw new InvalidArgumentException($error);
        }

        // echo("Все проверки успешно пройдены!");

        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = false;
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        // echo("<br>signUp stop");
        return $user;
    }

    public function activate(): void
    {
        $this->isConfirmed = true;
        $this->save();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getIsConfirmed(): string
    {
        return $this->isConfirmed;
    }

    public function getAuthToken(): string
    {
        // var_dump($this);
        return $this->authToken;
    }

    public static function login(array $loginData): User
    {
        
        if (empty($loginData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (empty($loginData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        // if ($loginData['email']=="root"){
        //     $user   = new User();
        //     $user->setNickname("root");
        //     // var_dump($user);
        //     $user->refreshAuthToken();
        //     // $user->save();
            
        //     return $user;
            
        // }
        
        $user = User::findOneByColumn('email', $loginData['email']);
        
        if ($user === null) {
            $user = User::findOneByColumn('nickname', $loginData['email']);
            if ($user === null) {
                throw new InvalidArgumentException('Нет пользователя с таким email');
                throw new InvalidArgumentException('Нет пользователя с таким логином');
            }
            // var_dump($user);
        }
        
        if ($loginData['email']=="root"){
            
            $admin_settings		= require '../src/settings.php';
            // echo "<pre>";
            // var_dump($admin_settings["root"]);
            // echo "</pre>";
            if (!password_verify($loginData['password'], $admin_settings["root"])) {
                throw new InvalidArgumentException('Неправильный пароль');
            }
        }

        if ((!password_verify($loginData['password'], $user->getPasswordHash()))&&($loginData['email']!=="root")) {
            throw new InvalidArgumentException('Неправильный пароль');
        }

        if (!$user->isConfirmed) {
            throw new InvalidArgumentException('Пользователь не подтверждён');
        }

        // if (!$user->state) {
        //     throw new InvalidArgumentException('Пользователь выключен');
        // }

        // echo("Проверки пройдены");
        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getId(): int
    {
        return $this->id;
    }

    private function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    // public function logout(int $user_id)//:User
    public function logout()//:User
    {


        // $user = User::getById($user_id);
        // // $user->
        // $user->save();
        // return $user;
        
		$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
		setcookie('token', '', time()-60*60*24*365, '/', $domain, false);
    }

    // public function getUserRolesList()
    // {
    //     return $this->role;
    // }

    public static function getUserRolesList($user_id){

    }

    public function setEmail($email){
        return $this->email   = $email;
    }

    public function setState($state){
        return $this->state   = $state;
    }

    public function getRole(){
        return $this->role;
    }

    public function setPrim($prim){
        return $this->prim  = $prim;
    }

    public function getRoleName(){
        // $role   = Role::getById($this->role);
        $role   = Role::getById((int)$this->getRole());
        return $role->getTitle();
        // return $this->role;
    }

    public function getRoleTitle(){
        // $role   = Role::getById($this->role);
        $role   = Role::getById((int)$this->getRole());
        return $role->getName();
        // return $this->role;
    }

    public function setRole($role_id){
        return $this->role   = $role_id;
    }

    public function setFio($fio){
        return $this->fio   = $fio;
    }
    
    public function setNickname($Nickname){
        return $this->Nickname   = $Nickname;
    }

    public function getRoleUserSelect(){
        $roles  = Role::findAll();
        $role   = $this->getRole();

        $select = '<select name="user_role" class="user_select_role">';

        foreach($roles AS $r){

            // исключаем в списке ролей супер админа - рута. Он один может быть единственный.
            if (($r->getId()==1)||($r->getTitle()==="root"))
            {
                continue;
            }

            $selected   = "";

            if ($r->getId()==$role){
                $selected   = "selected";
            }

            $line   = '<option value="'.$r->getId().'" '.$selected.'>'.$r->getTitle().'</option>';

            $select .= $line;
        }

        $select .= '</select>';

        return($select);
    }

    /**
     * @return string
    */
    public function setCreatedAt($CreatedAt):string
    {
        return $this->CreatedAt = $CreatedAt;
    }


    public static function createFromArray(array $fields): User
    {
        // if (empty($fields['role_name'])) {
        //     throw new InvalidArgumentException('Не передано обозначение роли');
        // }
        
        // if (empty($fields['role_title'])) {
        //     throw new InvalidArgumentException('Не передан название роли');
        // }
        
        var_dump($fields);
        $user = new User();

        $user->setFio($fields['user_fio']);
        $user->setNickname($fields['user_nickname']);
        $user->setEmail($fields['user_email']);
        $user->isConfirmed = true;
        $user->authToken = "1";
        $user->ro_flag = "0";
        $user->setPasswordHash(password_hash($fields['user_password'], PASSWORD_DEFAULT));
        $user->setState(1);
        $user->setRole($fields['new_user_role']);
        $user->setCreatedAt(date("Y-m-d H:i:s"));
        $user->setPrim($fields['user_prim']);

        $user->save();

        return $user;
    }


    public function setPasswordHash($passwordHash): string
    {
        return $this->passwordHash  = $passwordHash;
    }

}
?>