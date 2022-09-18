<?php


namespace Admin\Models\Users;

use Admin\Models\Users\User;

use Admin\Models\Roles\Role;

use MyProject\Services\Db;

use MyProject\Models\ActiveRecordEntity;

use MyProject\Exceptions\InvalidArgumentException;



class UsersRoles extends ActiveRecordEntity
{
    /** @var int */
    protected $userId;

    /** @var int */
    protected $roleId;

    
    /** @var int */
    protected $state;

    // Геттеры

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    protected static function getTableName(): string
    {
        return 'sys_users_roles';
    }

    public static function getUserRolesList(User $user, $state=null)
    {
        // $user   = User::getById($user_id);
        // $user->roleId = null;
        $db = Db::getInstance();


        $SQL    = 'SELECT sys_roles.title,sys_roles.name, sys_users_roles.role_id, sys_users_roles.state 
        FROM sys_users_roles, sys_roles WHERE (sys_users_roles.user_id=:user_id) AND (sys_roles.id=sys_users_roles.role_id)';

        // echo $SQL;
        // $SQL     = 'SELECT * FROM ' . self::getTableName() . ' WHERE user_id = :user_id';

        $SQL    .= (($state==null)?"":" AND (state = :state)").";";

        $params     = [
            
            'user_id' => $user->getId(),
        ];

        if ($state!==null){
            $SQL    .= " AND (state = :state);";
            $params['state'] = $state;
        }

        $result  = $db->query(
            // 'SELECT * FROM ' . self::getTableName() . ' WHERE user_id = :user_id AND state = :state',
            $SQL,
            $params,
            // array
            // [
            //     'user_id' => $user->getId(),
            // ]
        );

        // var_dump($result);

        $user->roles   = [];

        foreach($result AS $r){
            // var_dump($r);
            $user->roles[$r->name]    = [
                // $r->name  => [
                    "id"    => $r->role_id, 
                    "state" => $r->state,
                    "title" => $r->title,
                // ]
            ];
        }
        return($user);
    }

    public static function createUserRolesList(User $user, $roles){


        $SQL    = 'Insert INTO sys_users_roles (user_id, role_id, state) VALUES ';
        $lines  = [];
        foreach($roles AS $role){
            $lines[]   = '('.$user->getId().','.$role->getId().',1)';
        }
        $SQL   .= implode(",", $lines);

        return $SQL;

    }
}
?>