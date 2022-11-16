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


class CardPerson extends ActiveRecordEntity
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $card;

    /** @var string */
    protected $person;

    /** @var string */
    protected $createdAt;

    /*
     * @return string
     */
    public function getCard(): mixed
    {
        return $this->card;
    }

    /*
     * @return string
     */
    public function getPerson(): int
    {
        return $this->person;
    }

    /*
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    // /*
    //  * @return string
    //  */
    // public function getUpdatededAt(): string
    // {
    //     return $this->updatededAt;
    // }

    // /*
    //  * @return string
    //  */
    // public function getDeletedAt(): string
    // {
    //     return $this->deletedAt;
    // }

    // ************************************************

    protected static function getTableName(): string
    {
        return 'cards_persons';
    }

    /* ************************************************
        Сеттеры 
    */

    
    /*
     * @return string
    */
    public function setCard($card): string
    {
        return $this->card   = $card;
    }
    
    /*
     * @return string
    */
    public function setPerson($person): string
    {
        return $this->person   = $person;
    }


    /*
     * @return id CardPerson
    */
    public function setCardRecord($card, $person)//: CardPerson
    {

        // print_r($card);
        // echo"<br>";
        // print_r($person);
        $person_obj     = Person::findOneByColumn("name", $person);
        if ($person_obj ===null)
        {
            $person_obj = new Person();
            $person_obj->setName($person);
            $person_obj->save();
        }
        // echo $person_obj->getId();
        // $card_record    = CardPerson::findOneByColumnWhere(" WHERE (card='".$this->getCard()."') AND (person='".$person_obj->getId()."')");
        $card_record    = CardPerson::findOneByColumnWhere(" WHERE (card='".$card."') AND (person='".$person_obj->getId()."')");

        // var_dump($card_record);

        // Если есть такая запись у карточки персоналия, то возвращаем ид-р этой записи в таблице
        if ($card_record !== null)
        {
            return($card_record->getId());
        }

        // Если не было записи с такими данными, то создаем и возвращаем ее ид-р
        try {

            //code...
            $card_record = new CardPerson();
            $card_record->setCard($card);
            $card_record->setPerson($person_obj->getId());
            $card_record->save();

        } catch (\Throwable $th) {

            //throw $th;
            return(null);
        }

        // return($card_record);
        return($card_record->getId());
    }
}