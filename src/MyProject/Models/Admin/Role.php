<?php

namespace MyProject\Models\Admin;

use MyProject\Models\ActiveRecordEntity;

use MyProject\Exceptions\InvalidArgumentException;

class Role extends ActiveRecordEntity
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
   
       /**
        * @return string
        */
       public function getNickname(): string
       {
           return $this->nickname;
       }
   
       protected static function getTableName(): string
       {
           return 'sys_roles';
       }
   
}

?>