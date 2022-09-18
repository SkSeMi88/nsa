<?php

namespace MyProject\Models\Thems;



use MyProject\Services\Db;

use MyProject\Models\Users\User;

use MyProject\Models\Bplaces\Bplace;
use MyProject\Models\Finders\Finder;
use MyProject\Models\ActiveRecordEntity;


class Them extends ActiveRecordEntity
{
    // /** @var string */
    // protected $id;

    /** @var int */
    protected $themId;

    /** @var int */
    protected $typeId;

    /** @var int */
    protected $value;

	/**
     * @return int
     */
    public function getThemId(): int
    {
        return $this->themId;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->typeId;
    }

    /**
     * @return int
     * 
     */
    public function getValue(): int
    {
        return $this->value;
    }



    // /*
    //  * @return string
    //  */
    // public function getAuthor(): string
    // {
    //     return $this->author;
    // }

    /*
     * @return string
     */
    // public function getCreated(): string
    // {
    //     return $this->created;
    // }

    // /*
    //  * @return string
    //  */
    // public function getEditor(): string
    // {
    //     return $this->editor;
    // }

    // /*
    //  * @return string
    //  */
    // public function getEdited(): string
    // {
    //     return $this->edited;
    // }

    // /*
    //  * @return string
    //  */
    // public function getDeleted(): int
    // {
    //     return $this->deleted;
    // }


	
    protected static function getTableName(): string
    {
        return 'thems';
    }

	public function getLastTemId()
	{
		// var_dump(self);
		// $LastFinder	= $this->getById($this->getTableMaxId());
//		return($this->getTableMaxId());
		$LastTem	= $this->getTableMaxId();
		// $LastFinder	= $this->getTableLastId();
		var_dump($LastTem);
		return($LastTem);
	}

	//СЕТТЕРЫ

    public function setThemId($them_id): int
    {
        return $this->themId    = (int)$them_id;
    }

    public function setTypeId($type_id): int
    {
        return $this->typeId	= (int)$type_id;
    }

    public function setValue($value): int
    {
        return $this->value		= (int)$value;
    }



    public static function getRecordByFields($finder)
    {
//        echo "start:";
//        var_dump($finder);
        $db = Db::getInstance();
//        $SQL = "SELECT * FROM ". $this->getTableName();
        $SQL = "SELECT * FROM ". self::getTableName();
        $WHR = [];

        $fields_names = ["fond", "opis", "delo"];
        foreach($fields_names AS $field)
        {
            if (array_key_exists($field, $finder)){
                $WHR[] = "(".$field."='".$finder[$field]."')";
                continue;
            }
            $WHR[] = "(".$field." IS NULL)";
        }

        if (count($WHR)>0){
            $WHERE   = " WHERE ".implode((string)" AND ", $WHR);
            $SQL    .= $WHERE;
        }

        $SQL    .= ";";
//        echo "<hr>".$SQL;

        $result = $db->query(
            $SQL,
            []
        );
//        echo "<hr> result= ";
//        var_dump($result);
        if ($result === []) {
//            echo "СОздание новой записи поисковых данных";
            $new_finder  = self::createFromArray($finder);
//            echo"QAZ";
//            var_dump($new_finder);
            return($new_finder->getId());
        }
        return $result[0]->id;
    }

    public function createTemRecord(array $fields)
    {
        $SQL = 'INSERT INTO '. $this->getTableName(). "('tem_id', 'type_id', 'value') VALUES (:tem, :type, :value);";

        $db = Db::getInstance();
        $result = $db->query(
            $SQL,
            [":tem" => $fields["tem"],
             ":type" => $fields["type"],
             ":value" => $fields["value"],
            ]
//            ,            static::class
        );
//        echo "~~~";

//        foreach($fields AS $k=>$field){
//        }
//        echo $SQL;

        $result["id"]   = $db->getLastInsertId();
//        echo "<hr> result= ";
//        var_dump($result);
        if ($result === []) {
            return null;
        }
        return $result;//[0];
    }

//        public static function createFromArray(array $fields, User $author): Article
    public static function createFromArray(array $fields): Finder
    {
//            if (empty($fields['tem_id'])) {
//                throw new InvalidArgumentException('Не передано название статьи');
//            }
//
//            if (empty($fields['type_id'])) {
//                throw new InvalidArgumentException('Не передан текст статьи');
//            }

        $them = new Them();


        $them->setTemId($fields['tem_id']);
        $them->setTypeId($fields['type_id']);
        $them->setValue($fields['value']);
        // $finder->setState(1);
        $them->save();
        return $them;
    }



    public function updateFromArray(array $fields): Tem
    {
        if (empty($fields['tem_id'])) {
            throw new InvalidArgumentException('Не передана тема ');
        }

        if (empty($fields['type_id'])) {
            throw new InvalidArgumentException('Не передан тип уровня');
        }

        if (empty($fields['value'])) {
            throw new InvalidArgumentException('Не передан значение');
        }

        $this->setTemId($fields['tem_id']);
        $this->setTypeId($fields['type_id']);
        $this->setValue($fields['value']);

        $this->save();

        return $this;
    }

    public static function getAllCards()
    {
        $them_cards = [];
        $them_id    = $this->getId();

        $where      = 'WHERE(them_id="")AND(type_id="")';
        $cards      = Them::findOneByColumnWhere($where);
    }


//     public static function getCardsCount(){
        
//         // $SQL = "SELECT them_id, count(`them_id`) as count FROM `thems` WHERE type_id=6 GROUP BY them_id HAVING count(`them_id`)>1 ORDER BY `them_id` ASC;";

//         // // $them_cards = Them::query($SQL);

//         // return ($them_cards);

//         $SQL = 'INSERT INTO '. $this->getTableName(). "('fond', 'opis', 'delo.') VALUES (:fond, :opis, :delo);";

//         $db = Db::getInstance();
//         $result = $db->query(
//             $SQL,
//             [":fond" => $fields["fond"],
//              ":opis" => $fields["opis"],
//              ":delo" => $fields["delo"],
//             ]
// //            ,            static::class
//         );
// //        echo "~~~";

// //        foreach($fields AS $k=>$field){
// //        }
// //        echo $SQL;

//         $result["id"]   = $db->getLastInsertId();
// //        echo "<hr> result= ";
// //        var_dump($result);
//         if ($result === []) {
//             return Null;
//         }
//         return $result;//[0];


//     }
}
