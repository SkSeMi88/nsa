<?php

namespace MyProject\Models\Persons;



use MyProject\Services\Db;

use MyProject\Models\Users\User;

use MyProject\Models\Fonds\Fond;
use MyProject\Models\Opisi\Opis;
use MyProject\Models\Dela\Delo;
use MyProject\Models\Shifrs\Shifr;

use MyProject\Models\Thems\ThemList;
use MyProject\Models\Thems\Them;

// use MyProject\Models\Shifrs\Shifr;
use MyProject\Models\Bplaces\Bplace;
use MyProject\Models\Finders\Finder;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;


class PersonTest extends ActiveRecordEntity
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $old;

    /** @var string */
    protected $new;


    /*
     * @return string
     */
    public function getOld(): string
    {
        return $this->old;
    }

    /*
     * @return string
     */
    public function getNew(): string
    {
        return $this->new;
    }

    // ************************************************

    protected static function getTableName(): string
    {
        return 'persons_test';
    }

    /* ************************************************
        Сеттеры 
    */

    
    /*
     * @return string
    */
    public function setOld($old): string
    {
        return $this->old   = $old;
    }
    
    /*
     * @return string
    */
    public function setNew($new): string
    {
        return $this->new   = $new;
    }
    

}