<?php

namespace Admin\Models\Roles;

use MyProject\Models\ActiveRecordEntity;

use MyProject\Exceptions\InvalidArgumentException;



class Role extends ActiveRecordEntity
{

    /** @var string */
    protected $name;

    /** @var string */
    protected $title;

    /** @var int */
    protected $state;

    /** @var string */
    protected $prim;

    /** @var string */
    protected $createdAt;


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @return null|string
     */
    public function getPrim()
    {
        return $this->prim;
    }


    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->CreatedAt;
    }

    protected static function getTableName(): string
    {
        return 'sys_roles';
    }        


    // СЕТТЕРЫ

    
    /**
     * @return string
    */
    public function setName($name): string
    {
        return $this->name  = $name;
    }

    /**
     * @return string
    */
    public function setTitle($title): string
    {
        return $this->title = $title;
    }

    /**
     * @return int
    */
    public function setState($state): int
    {
        return $this->state = $state;
    }

    /**
     * @return null|string
    */
    public function setPrim($prim)
    {
        return $this->prim  = $prim;
    }


    /**
     * @return string
    */
    public function setCreatedAt($CreatedAt):string
    {
        return $this->CreatedAt = $CreatedAt;
    }

    
    public static function createFromArray(array $fields): Role
    {
        // var_dump($fields);
        if (empty($fields['role_name'])) {
            throw new InvalidArgumentException('Не передано обозначение роли');
        }

        if (empty($fields['role_title'])) {
            throw new InvalidArgumentException('Не передан название роли');
        }

        $role = new Role();

        $role->setName($fields['role_name']);
        $role->setTitle($fields['role_title']);
        $role->setPrim($fields['role_prim']);
        $role->setState(1);
        $role->setCreatedAt(date("Y-m-d H:i:s"));

        $role->save();

        return $role;
    }

    public static function getSelectRolesList(){
        
        $roles  = self::findAll();

        $select = '<select name="new_user_role" class="user_select_role">';

        foreach($roles AS $r){

            // исключаем в списке ролей супер админа - рута. Он один может быть единственный.
            if (($r->getId()==1)||($r->getTitle()==="root"))
            {
                continue;
            }

            $line   = '<option value="'.$r->getId().'" >'.$r->getTitle().'</option>';

            $select .= $line;
        }

        $select .= '</select>';

        return($select);
    }
   
}

?>