<?php

namespace MyProject\Models\Fonds;
use MyProject\Models\Users\User;


use MyProject\Services\Db;
use MyProject\Models\ActiveRecordEntity;


class Fond extends ActiveRecordEntity
{
    // /** @var string */
    // protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $title;

    /** @var string */
    protected $dates;

    /** @var string */
    protected $path;

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
     * @return string
     */
    public function getDates(): string
    {
        if ($this->dates === null) return ("");
        return $this->dates;
    }

    /**
     * @return string
     */
    public function getPath(): mixed
    {
        return $this->path;
    }


    protected static function getTableName(): string
    {
        return 'fonds';
    }

	public function getLastFondId()
	{

		$LastFond	= $this->getTableMaxId();
		var_dump($LastFond);
		return($LastFond);
	}

	//СЕТТЕРЫ

    public function setName($name): string
    {
        return $this->name  = $name;
    }

    public function setTitle($title): string
    {
        return $this->title		= $title;
    }

    public function setDates($dates): string
    {
        return $this->dates		= $dates;
    }

    public function setPath($path): string
    {
        return $this->path		= $path;
    }

    public static function getRecordByFields($fond)
    {
//        echo "start:";
//        var_dump($fond);
        $db = Db::getInstance();

        $SQL = "SELECT * FROM ". self::getTableName();
        $WHR = [];

        $fields_names = ["name", "title", "dates", "path"];
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
        $SQL = 'INSERT INTO '. $this->getTableName(). "('name', 'title', 'dates','path') VALUES (:name, :title, :dates, :path);";

        $db = Db::getInstance();
        $result = $db->query(
            $SQL,
            [
            	":name"		=> $fields["name"],
				":title"	=> $fields["title"],
				":dates"	=> $fields["dates"],
				":path"		=> $fields["path"],
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
        return $result;
    }

//        public static function createFromArray(array $fields, User $author): Article
        public static function createFromArray(array $fields): Fond
        {
//            if (empty($fields['name'])) {
//                throw new InvalidArgumentException('Не передано название статьи');
//            }
//
//            if (empty($fields['text'])) {
//                throw new InvalidArgumentException('Не передан текст статьи');
//            }

            // echo "!>>>>>>>>>>>";
            $fond = new Fond();

            $fond->setName($fields['name']);
            $fond->setTitle($fields['title']);
            $fond->setDates($fields['dates']);
            $fond->setPath($fields['path']);

            $fond->save();

            return $fond;
        }

        public function updateFromArray(array $fields): Fond
        {
            if (empty($fields['name'])) {
                throw new InvalidArgumentException('Не передан код фонда');
            }

            if (empty($fields['title'])) {
                throw new InvalidArgumentException('Не передано название фонда');
            }

            $this->setName($fields['name']);
            $this->setTitle($fields['text']);
            $this->setDates($fields['dates']);
            $this->setPath($fields['path']);

            $this->save();

            return $this;
        }

        public static function createFromСard($fond_name)
        {

            $fond   = new Fond;
            $fond->setName($fond_name);
            $fond->setTitle('Название фонда');
            $fond->setDates('');
            $fond->setPath('');
    
            $fond->save();

            return($fond);
        }

        public static function convertFondById($fond_name)
        {
            // $fond           = Fond::getById($fond_id);
            // $fond_name      = $fond->getName();

            // максимальное число разрядов в имени фонда
            $maxNum         = 6;

            $rests    = [
                1   => "0",
                2   => "00",
                3   => "000",
                4   => "0000",
                5   => "00000",
            ];

            // раздляем подготовленную строку имени фонда на буквенную и числовую части
            $tmp            = explode(".", $fond_name);

            // 


            // Отделяем последнюю (ЧИСЛОВУЮ) часть шифра у фонда
            $fond_Number    = $tmp[count($tmp)-1];


            // дополняем при необходимости разряды нулей слева у числа в нужном количестве, чтобы было максимаум 16000 , т.е всего д.б. 6 цифр.
            
            // получаем сначала массив цифр числовой части в имени фонда
            $digits         = str_split($fond_Number);
            // print_r($digits);
            
            // Получаем число нулевых разрядов, которое нужно добавить слева к числовой части в имени фонда
            $rest_digits    = ($maxNum - (count($digits)));
            // print_r($rest_digits);

            // $fond_Number    = str_pad($fond_Number, $rest_digits, "_", STR_PAD_LEFT);

            // array_pad($digits, $maxNum, "9");
            // print_r($digits);

            $fond_Number    = $rests[$rest_digits].implode($digits);

            if (count($tmp)==1){

                $fond_name    = "f.".$fond_Number;
                // print_r($fond_name);
                return($fond_name);

            }

            $fond_name    = $tmp[0].".".$fond_Number;
            // print_r($fond_name);



            





            // $fond->setTitle('Название фонда');
            // $fond->setDates('');
            // $fond->setPath('');
    
            // $fond->save();

            return($fond_name);

        }
}