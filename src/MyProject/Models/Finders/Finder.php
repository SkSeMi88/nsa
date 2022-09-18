<?php

namespace MyProject\Models\Finders;
use MyProject\Models\Users\User;


use MyProject\Services\Db;
use MyProject\Models\ActiveRecordEntity;



class Finder extends ActiveRecordEntity
{
    // /** @var string */
    // protected $id;

    /** @var string */
    protected $fond;

    /** @var string */
    protected $opis;

    /** @var string */
    protected $delo;

    /** @var string */
    protected $state;

    // /** @var string */
    // protected $author;

    // /** @var string */
    // protected $created;

    // /** @var string */
    // protected $editor;

    // /** @var string */
    // protected $edited;

    // /** @var string */
    // protected $deleted;

    public function getFond(): string
    {
        return $this->fond;
    }

    /**
     * @return string
     */
    public function getOpis(): string
    {
        return $this->opis;
    }

    /**
     * @return string
     */
    public function getDelo(): string
    {
        return $this->delo;
    }

    // /**
    //  * @return string
    //  */
    // public function getList(): string
    // {
    //     return $this->list;
    // }

    /**
     * @return string
     */
    public function getState(): int
    {
        return $this->state;
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
    public function getCreated(): string
    {
        return $this->created;
    }

    /*
     * @return string
     */
    public function getEditor(): string
    {
        return $this->editor;
    }

    /*
     * @return string
     */
    public function getEdited(): string
    {
        return $this->edited;
    }

    /*
     * @return string
     */
    public function getDeleted(): int
    {
        return $this->deleted;
    }


	
    protected static function getTableName(): string
    {
        return 'finders';
    }

	public function getLastFinderId()
	{
		// var_dump(self);
		// $LastFinder	= $this->getById($this->getTableMaxId());
//		return($this->getTableMaxId());
		$LastFinder	= $this->getTableMaxId();
		// $LastFinder	= $this->getTableLastId();
		var_dump($LastFinder);
		return($LastFinder);
	}

	//СЕТТЕРЫ

    public function setFond($fond): string
    {
        return $this->fond=$fond;
    }

    public function setOpis($opis): string
    {
        return $this->opis=$opis;
    }

    public function setDelo($delo): string
    {
        return $this->delo=$delo;
    }

    // public function setList($list): string
    // {
    //     return $this->list=$list;
    // }

    public function setState($state): string
    {
        return $this->state=$state;
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

    public function createFinderRecord(array $fields)
    {
        $SQL = 'INSERT INTO '. $this->getTableName(). "('fond', 'opis', 'delo.') VALUES (:fond, :opis, :delo);";

        $db = Db::getInstance();
        $result = $db->query(
            $SQL,
            [":fond" => $fields["fond"],
             ":opis" => $fields["opis"],
             ":delo" => $fields["delo"],
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
            return Null;
        }
        return $result;//[0];
    }

//        public static function createFromArray(array $fields, User $author): Article
        public static function createFromArray(array $fields): Finder
        {
//            if (empty($fields['name'])) {
//                throw new InvalidArgumentException('Не передано название статьи');
//            }
//
//            if (empty($fields['text'])) {
//                throw new InvalidArgumentException('Не передан текст статьи');
//            }

            // echo "!>>>>>>>>>>>";
            $finder = new Finder();

            $finder->setFond($fields['fond']);
            $finder->setOpis($fields['opis']);
            $finder->setDelo($fields['delo']);
            $finder->setState(1);
            $finder->save();

            // echo "!!!<hr>";
            // var_dump($fields);

            return $finder;
        }
    /*
        public function updateFromArray(array $fields): Article
        {
            if (empty($fields['name'])) {
                throw new InvalidArgumentException('Не передано название статьи');
            }

            if (empty($fields['text'])) {
                throw new InvalidArgumentException('Не передан текст статьи');
            }

            $this->setName($fields['name']);
            $this->setText($fields['text']);

            $this->save();

            return $this;
        }
    */
}