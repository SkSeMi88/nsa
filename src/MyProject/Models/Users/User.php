<?php

namespace MyProject\Models\Users;

use MyProject\Models\ActiveRecordEntity;

use MyProject\Exceptions\InvalidArgumentException;



class User extends ActiveRecordEntity
{
    /** @var string */
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var int */
    protected $isConfirmed;
    // public $isConfirmed;

    /** @var string */
    protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;

    /** @var string */
    protected $createdAt;

    /** @var string
    protected $role;*/


    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    protected static function getTableName(): string
    {
        return 'users';
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

        $user = User::findOneByColumn('email', $loginData['email']);
        if ($user === null) {
            throw new InvalidArgumentException('Нет пользователя с таким email');
        }

        if (!password_verify($loginData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Неправильный пароль');
        }

        if (!$user->isConfirmed) {
            throw new InvalidArgumentException('Пользователь не подтверждён');
        }

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
    }

    public function getRole()
    {
        return $this->role;
    }

}
