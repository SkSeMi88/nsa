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


class Person extends ActiveRecordEntity
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $title;

    /** @var int */
    protected $author;

    /** @var string */
    protected $createdAt;

    /** @var string */
    protected $updatedAt;

    /** @var string */
    protected $deletedAt;




    /*
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /*
     * @return string
     */
    public function getTitle(): mixed
    {
        return $this->title;
    }

    /*
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /*
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /*
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatededAt;
    }

    /*
     * @return string
     */
    public function getDeletedAt(): string
    {
        return $this->deletedAt;
    }

    // ************************************************

    protected static function getTableName(): string
    {
        return 'persons';
    }

    /* ************************************************
        Сеттеры 
    */

    
    /*
     * @return string
    */
    public function setName($name): string
    {
        return $this->name   = $name;
    }
    
    /*
     * @return string
    */
    public function setTitle($title): string
    {
        return $this->title   = $title;
    }
    
    /*
     * @return string
    */
    public function setAuthor($author): int
    {
        return $this->author   = $author;
    }

    public function setUpdatedAt($updatedAt): string
    {
        return $this->updatedAt   = $updatedAt;
    }

    public static function checkPersonExist($personName)
    {

        $person = Person::findOneByColumn("name", $personName);

        // Если нет персонаилии в таблице списке  создаем ее новую
        if ($person === null)
        {
            $person = new Person();
            $person->setName($personName);
            $person->save();

            // и возвращаем ее ид-р для записив таблицу персоналии в карточках
            return $person->getId();
        }

        // возвращаем ее ид-р для записив таблицу персоналии в карточках
        return $person->getId();
    }

    public static function getByName($personName)
    {

        $person = Person::findOneByColumn("name", $personName);

        // Если нет персонаилии в таблице списке  создаем ее новую
        if ($person === null)
        {
            $person = new Person();
            $person->setName($personName);
            $person->save();

            // и возвращаем ее ид-р для записив таблицу персоналии в карточках
            return($person);
        }

        // возвращаем ее ид-р для записив таблицу персоналии в карточках
        return($person);
    }

}