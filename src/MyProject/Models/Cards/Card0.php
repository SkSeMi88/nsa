<?php

namespace MyProject\Models\Cards;



use MyProject\Services\Db;

use MyProject\Models\Users\User;

use MyProject\Models\Bplaces\Bplace;
use MyProject\Models\Finders\Finder;
use MyProject\Models\ActiveRecordEntity;

class Card extends ActiveRecordEntity
{

    /** @var string */
    protected $id;

    /** @var int */
    protected $finderId;

    /** @var string */
    protected $list;

    /** @var int */
    protected $state;

    // /** @var string */
    protected $fullname;

    /** @var string */
    protected $fname;

    /** @var string */
    protected $fnameTitle;

    /** @var int */
    protected $fnameLen;

    /** @var int */
    protected $fnameState;


   /** @var string */
   protected $name;

   /** @var string */
   protected $nameTitle;

   /** @var int */
   protected $nameLen;

   /** @var int */
   protected $nameState;

   /** @var string */
   protected $sname;

   /** @var string */
   protected $snameTitle;

   /** @var int */
   protected $snameLen;

   /** @var int */
   protected $snameState;

// //    /** @var string */
   protected $byear;
// //
// //    /** @var string */
   protected $byearTitle;
// //
// //    /** @var int */
   protected $byearLen;

   /** @var int */
    protected $byearState;

    /** @var int */
    protected $photo;

    /** @var int */
    protected $bplaceId;

    /** @var string */
    protected $prim;

    /*
     * @return string
     */
    public function getFinderId(): string
    {
        return $this->finderId;
    }

    /*
     * @return string
     */
    public function getList(): string
    {
        return $this->list;
    }

    /*
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /*
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullname;
    }

    /*
     * @return string
     */
    public function getFname(): string
    {
        return $this->fname;
    }

    /*
     * @return string
     */
    public function getFnameTitle(): string
    {
        return $this->fnameTitle;
    }

    /**
     * @return int
     */
    public function getFnameLen(): int
    {
        return $this->fnameLen;
    }

    /**
     * @return int
     */
    public function getFnameState(): int
    {
        return $this->fnameState;
    }

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
    public function getNameTitle(): string
    {
        return $this->nameTitle;
    }

    /*
    * @return int
    */
    public function getNameLen(): int
    {
        return $this->nameLen;
    }

    /*
    * @return int
    */
    public function getNameState(): int
    {
        return $this->nameState;
    }

    /*
    * @return string
    */
    public function getSname(): string
    {
        return $this->sname;
    }

    /*
    * @return string
    */
    public function getSnameTitle(): string
    {
        return $this->snameTitle;
    }

    /*
    * @return int
    */
    public function getSnameLen(): int
    {
        return $this->snameLen;
    }

    /*
    * @return int
    */
    public function getSnameState(): int
    {
        return $this->snameState;
    }



    /*
    * @return string
    */
    public function getByear(): string
    {
        return $this->byear;
    }

    /*
    * @return string
    */
    public function getByearTitle(): string
    {
        return $this->byearTitle;
    }

    /**
    * @return int
    */
    public function getByearLen(): int
    {
        return $this->byearLen;
    }

    /**
    * @return int
    */
    public function getByearState(): int
    {
        return $this->byearState;
    }

    /**
    * @return int
    */
    public function getBplaceId(): int
    {
        return $this->bplaceId;
    }

    /**
     * @return int
     */
    public function getPhoto(): int
    {
        return $this->photo;
    }

    /*
     * @return string
     */
    public function getPrim(): string
    {
        return ($this->prim)?$this->prim:"";
    }

    protected static function getTableName(): string
    {
        return 'cards';
    }

    /**
     * @return int
     */
    public function setFinderId($finderId): int
    {
        // echo "!@#";
        return $this->finderId = (int)$finderId;
    }

    public function setList($list): string
    {
        return $this->list=$list;
    }

    public function setState($state): int
    {
        return $this->state=$state;
    }

    public function setFullname($fullname): string
    {
        return $this->fullname=$fullname;
    }

    public function setFname($fnames): string
    {
//        return $this->fname=implode(",", $fnames);
        return $this->fname = $fnames;
    }

    public function setFnameTitle($fnames): string
    {
//         return $this->fnameTitle=implode(",", $fnames);
        return $this->fnameTitle = $fnames;
    }

    public function setFnameLen($len): int
    {
        return $this->fnameLen = $len;
    }

    public function setFnameState($state): int
    {
        return $this->fnameState = $state;
    }

    /*
        Сеттеры для имени
    */

    public function setName($names): string
    {
//        return $this->name = implode(",", $names);
        return $this->name = $names;
    }

    public function setNameTitle($names): string
    {
//        return $this->nameTitle=implode(",", $names);
        return $this->nameTitle = $names;
    }

    public function setNameLen($len): int
    {
        return $this->nameLen = $len;
    }

    public function setNameState($state): int
    {
        return $this->nameState = $state;
    }

    /*
        Сеттеры для ОТЧЕСТВА
    */


    public function setSname($snames): string
    {
//        return $this->sname = implode(",", $snames);
        return $this->sname = $snames;
    }

    public function setSnameTitle($snames): string
    {
//        return $this->snameTitle=implode(",", $snames);
        return $this->snameTitle = $snames;
    }

    public function setSnameLen($len): int
    {
        return $this->snameLen = $len;
    }

    public function setSnameState($state): int
    {
        return $this->snameState = $state;
    }

    /*
        Сеттеры для года рождения
    */


    public function setByear($byears): string
    {
//        return $this->byear = implode(",", $byears);
        return $this->byear =  $byears;
    }

    public function setByearTitle($byears): string
    {
//        return $this->byearTitle=implode(",", $byears);
        return $this->byearTitle = $byears;
    }

    public function setByearLen($len): int
    {
        return $this->byearLen = $len;
    }

    public function setByearState($state): int
    {
        return $this->byearState = $state;
    }

    /*
    Сеттеры для места рождения
    */
    public function setBplaceId($bplaceId): int
    {
        return $this->bplaceId = $bplaceId;
    }

    public function setPhoto($photo): int
    {
        return $this->photo = $photo;
    }

    /*
    Сеттеры для примечания
    */
    public function setPrim($prim): string
    {
        return $this->prim = $prim;
    }

    public static function checkFormCreateCard(array $fields): array
    {
        $errors = [];
        $fields_names = [

            "new_fname" =>"Фамилия",
            "new_name" =>"Имя",
            "new_sname" =>"Отчество",
            "new_byear" =>"Год рождения",

            "new_prim" =>"Примечание",
            "new_photo" =>"Фотография",
    
            // "fond": "Фонд",
            // "opis": "Опись",
            // "delo": "Дело",
            // "list": "Лист"
        ];

        $new_form = [
            "new_fname" =>[],
            "new_name" =>[],
            "new_sname" =>[],
            "new_byear" =>[],
            // "new_prim": []
        ];

        // echo "<hr>Функция проверки формы";
        // echo "<br>Поля карточки со значекниями массива:";

        foreach(array_keys($new_form) AS $field) {

            $arr    = $fields[$field];
            // var_dump($arr);

            if ($field=="new_byear"){

                if (count($arr)==0) 
                {
                    $errors[]   = "Поле год рождения обязательно для заполнения.";
                    continue;
                }

                foreach($arr AS $val1){
                    if (strlen($val1)==0)
                    {
                        // errors.push("Поле " + fields["new_byear"] + " имеет не корректное значение " + Forma[field].value);
                        $errors[]   = "Поле $fields_names[$field] имеет некорректное значение ~> $val1";
                        continue;
                    }

                }
            }

            
            if ((count($arr)==1)&&(strlen($arr[0])==0)&&($field!="new_sname")){
                $errors[]   = "Поле $fields_names[$field] имеет некорректное значение > $arr[0]";
                continue;
            }

            foreach($arr AS $val){
                if ((strlen($val)<2)&&(($field!="new_sname")&&($field!="new_byear"))){
                    $errors[]   = "Поле $fields_names[$field] имеет некорректное значение: $val";
                    continue;
                }
            }


        }

        // if ((strlen($fields["new_byear"][count($fields["new_byear"])-1]) < 1)||(count($fields["new_byear"])==0)) {
        //     // errors.push("Поле " + fields["new_byear"] + " имеет не корректное значение " + Forma[field].value);
        //     $errors[]   = "Поле $fields_names[$field] имеет некорректное значение $val";
        // }

        $bplace_fields = [
            "punkt" =>"Населенный пункт",
            "volost" =>"Волость",
            "uezd" =>"Уезд"
        ];

        $bplace_flag = 0;

        foreach(array_keys($bplace_fields) AS $field) {

            if ((array_key_exists($field, $fields))&&(strlen($fields[$field]) > 4))
            {
                $bplace_flag = +1;
            }
//            // console.log(field, Forma[field], Forma[field].value);
//            if (strlen($fields[$field]) > 4) {
//                $bplace_flag = +1;
//                // new_form[field] = Forma[field].value;
//            }
        }
        // echo "bplace_flag   $bplace_flag";

        if ($bplace_flag == 0) {
            $errors[]   = "Место рождения должно иметь минимум одно значение от 4х символов.";
        }

/*

        if ((!isset($fields["new_fname"]))||(strlen($fields["new_fname"][0])==0)||(count($fields["new_fname"])==0)) {
            echo "Нeт фамилии.";
        }

        $fnames = array_reverse($fields["new_fname"]);
        print_r($fnames);

        $names = array_reverse($_REQUEST["new_name"]);
        print_r($names);

        $snames = array_reverse($_REQUEST["new_sname"]);
        print_r($snames);

        $byear = array_reverse($_REQUEST["new_byear"]);
        print_r($byear);

        $photo = $_REQUEST["new_photo"];
        print_r($photo);

        $prim = $_REQUEST["new_prim"];
        print_r($prim);

        $fond = $_REQUEST["new_fond"];
        print_r($fond);

        $opis = $_REQUEST["new_opis"];
        print_r($opis);

        $delo = $_REQUEST["new_delo"];
        print_r($delo);

        $list = $_REQUEST["new_list"];
        print_r($list);

        $bplace_flag    = 0;
        $BPLACES = [
                "punkt"  => [null],
                "volost"  => [null],
                "uezd"  => [null]
        ];
*/
        $response = [
            "status" => true,
            "errors"    => $errors,
        ];
        if (count($errors)!=0){
            $response["status"]=false;
        }
        // var_dump($response);
        return($response);

    }

    public static function prepareArrayForm(array $fields): array
    {
        // echo "<hr>Функция подготовки формы перед записью в БД";
        $card_array = [
            "state" => 1,
            
        ];
        $fields_names = [
            "fname",
            "name",
            "sname",
            "byear"
        ];

        $spec_chars = ["*", "!", "?", "(", ")", "{", "}", "[", "]"];

        $fullname   = "";
        foreach($fields_names AS $field){
            // echo"<br>$field";
            // массив значений поля карточки как было записано специалистом
            $field_arr_title    = array_reverse($fields["new_".$field]);

            //Создаем для заполнения массивом значения поля карточки после удаления из них спец символов неопределенности
            $field_arr          = [];//$field_arr_title;

            // вычиcление кол-ва значений в поле карточки по самым исходным данным записанным специалистом
            $field_arr_len      = count($field_arr_title);

            // по умолчанию все хорошо  соответствие между введенными значениями и истинными
            $field_arr_state    = 1;
            
            // Для каждого поля карточки перебор каждого значения поля карточки с добавлением их в отд. массив без спец символов
            for ($i=0; $i < count($field_arr_title) ; $i++) { 
                $field_arr[]    = str_ireplace($spec_chars, "", $field_arr_title[$i]);
            }

            // Конкатенация полного ФИО для карточки из первых значений этих полей без спец символов
            $fullname   .=($field!="byear")?$field_arr[0]." ":"";
            // $fullname   .= $field_arr[0]." ";

//            $field_str_title    = array_shift($field_arr_title)."(".implode(", ", $field_arr_title).")";
//            $field_str          = array_shift($field_arr)."(".implode(", ", $field_arr).")";

            $field_str_title    = implode(", ", $field_arr_title);
            $field_str          = implode(", ", $field_arr);

            // Формирование строк занчения и отображения для поля карточки соответственно.
            // $first              = $field_arr[0];
            // $field_str          = array_shift($field_arr)."(".implode(", ", $field_arr).")";
            // $field_str_title    = array_shift($field_arr_title[0])."(".implode(", ", $field_arr_title).")";

            // $field_str_1        = str_ireplace([$spec_chars, "", $field_str]);

            $field_arr_state    = ($field_str!==$field_str_title)?0:1;

            $card_array[$field]             = $field_str;
            $card_array[$field."_title"]    = $field_str_title;
            $card_array[$field."_len"]      = $field_arr_len;
            $card_array[$field."_state"]    = $field_arr_state;

            /*
                Если год только равен ? то надо оставить этот ?, чтобы записать в бд
            */
            if (($field=="byear")&&($card_array[$field."_title"]=="?")){
                $card_array[$field]             = $field_str_title;
                $card_array[$field."_title"]    = $field_str_title;
                $card_array[$field."_len"]      = $field_arr_len;
                $card_array[$field."_state"]    = $field_arr_state;
            }
        }

        // var_dump($card_array);
        $card_array["fullname"] = str_replace("  "," ",rtrim($fullname));

        $card_array["photo"]    = $fields['new_photo'];
        $card_array["prim"]     = $fields['new_prim'];

//            "punkt"             => $fields["punkt"],
//            "volost"            => $fields["volost"],
//            "uezd"              => $fields["uezd"]
        $bplace_arr = [
        ];

        $bplace_fields  =  ["punkt", "volost", "uezd"];
        foreach($bplace_fields AS $field){
            $bplace_arr[$field] = $fields[$field];
        }


//        $bplace_object  = Bplace::getRecordByFields($bplace_arr);
//        $card_array["bplace_id"]    = $bplace_object->getId();

        $card_array["bplace_id"]  = Bplace::getRecordByFields($bplace_arr);
        $finder_arr = [
            "fond" => $fields["new_fond"],
            "opis" => $fields["new_opis"],
            "delo" => $fields["new_delo"],
        ];
        $card_array["finder_id"]  = Finder::getRecordByFields($finder_arr);
        $card_array["list"]  = $fields["new_list"];
        $card_array["photo"]  = $fields["new_photo"];
        $card_array["prim"]  = $fields["new_prim"];

//        print_r($card_array["finder_id"]);

        // var_dump($card_array);
        // echo"Подготовка завершена успешно<hr>";
        return($card_array);
    }

    public static function createFromArrayForm(array $fields): Card
    {

        $check     = self::checkFormCreateCard($fields);

        if ($check["status"]==false){
            $errors = implode("<br>", $check["errors"]);
            throw new InvalidArgumentException($errors);
        }
        // echo "Подготовка формы";
        $fields = self::prepareArrayForm($fields);

        $card = new Card();

        // echo "<pre><hr>Поступила форма";

        // var_dump($fields);

        // $bplace->setAuthor($author);

        $card->setFinderId($fields['finder_id']);
        $card->setList($fields['list']);
        $card->setState($fields['state']);
        $card->setFullName($fields['fullname']);

        $card->setFname($fields['fname']);
        $card->setFnameTitle($fields['fname_title']);
        $card->setFnameLen($fields['fname_len']);
        $card->setFnameState($fields['fname_state']);

        $card->setName($fields['name']);
        $card->setNameTitle($fields['name_title']);
        $card->setNameLen($fields['name_len']);
        $card->setNameState($fields['name_state']);

        $card->setSname($fields['sname']);
        $card->setSnameTitle($fields['sname_title']);
        $card->setSnameLen($fields['sname_len']);
        $card->setSnameState($fields['sname_state']);

        $card->setByear($fields['byear']);
        $card->setByearTitle($fields['byear_title']);
        $card->setByearLen($fields['byear_len']);
        $card->setByearState($fields['byear_state']);

        $card->setPhoto($fields['photo']);

        $card->setBplaceId($fields['bplace_id']);

        $card->setPrim($fields['prim']);
        // echo "@@@<hr>";
// 

        // $bplace->setVolost($fields['volost']);
        // $bplace->setUezd($fields['uezd']);
        // $bplace->setState(1);

        // var_dump($card);
        // print_r(">>>><hr>");
        // print_r($card);
        $card->save();
        // echo "<hr>THE END";


        return $card;
    }


    public static function findAll() :array
    {
        $tmp    = parent::findAll();
        $card   = [];

        foreach ($tmp as $key => $value) {
            $tmp[$key]->bplace  = Bplace::getById($value->getBplaceId());
            $tmp[$key]->finder  = Finder::getById($value->getFinderId());
        }

        return($tmp);
    }

    public static function getById(int $id)
    {

        // $db = Db::getInstance();

        // $entities = $db->query(
        //     'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
        //     [':id' => $id],
        //     static::class
        // );

        $entities   = parent::getById($id);

        // var_dump($entities);
        if ($entities){

            $entities->bplace    = Bplace::getById($entities->getBplaceId());
            $entities->finder    = Finder::getById($entities->getFinderId());
        }

        return $entities ? $entities : null;
    }

    public static function getById2(int $id)
    {

        // $db = Db::getInstance();

        // $entities = $db->query(
        //     'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
        //     [':id' => $id],
        //     static::class
        // );

        $entities   = parent::getById($id);

        // // var_dump($entities);
        // if ($entities){

        //     $entities->bplace    = Bplace::getById($entities->getBplaceId());
        //     $entities->finder    = Finder::getById($entities->getFinderId());
        // }

        return $entities ? $entities : null;
    }
    
    public static function findByFiltrForm(){
    	
    	$fields	= ["fname", "name", "sname", "byear", "punkt", "volost", "uezd", "photo", "prim"];
    	$SQL	= "SELECT * FROM cards ";
    	$WHR	= [];
    	foreach($fields AS $field){

    		if (in_array($field, ["punkt", "volost", "uezd"])) continue;

			if ($field=="photo"){
				
				// если =-1 то значит любое и условие не нужно - пропускаем
				if ($_POST["filtr-".$field]=="-1") continue;
				
				// выбрано либо да либо нет - для унификации использую like
				$WHR[]	= "(".$field." LIKE '%".$_POST["filtr-".$field]."%')";
    			continue;
			}
			
    		if (($field=="prim")&&(!empty($_POST["filtr-".$field]))){
    			$WHR[]	= "(".$field." LIKE '%".$_POST["filtr-".$field]."%')";
    			continue;
    		};

    		if (!empty($_POST["filtr-".$field])){
    			$WHR[]	= "((".$field." LIKE '%".$_POST["filtr-".$field]."%')OR(".$field."_title LIKE '%".$_POST["filtr-".$field]."%' ))";
    		}
    		
    	}
    	// echo "<pre>";
    	// 
    	// print_r($WHR);
    	
    	$SQL_BP = "SELECT id FROM bps ";
    	$WHR_BP	= [];
    	foreach (["punkt", "volost", "uezd"] AS $field){
    		// echo "<br>".$field;
    		if (!empty($_POST["filtr-".$field])){
    			$WHR_BP[]	= "(".$field." LIKE '%".$_POST["filtr-".$field]."%')";
    			// print_r($WHR_BP);
    		}
    			
    	}
    	
    	if (count($WHR_BP)>0){
	    	$db = Db::getInstance();
		    	
		    $SQL_BP .= "WHERE (". implode("AND", $WHR_BP).");";
		    // echo $SQL_BP;
		    $result = $db->query(
		        $SQL_BP,
		        []
		    );
		    $bps	= [];
		    // var_dump($result);
		    foreach($result AS $bp){
		    	$bps[]	= (int) get_object_vars($bp)["id"];
		    }
	
			if (count($bps)>0){
				// print_r(implode(",", $bps));	
				$WHR[] = "(bplace_id IN (".implode(", ", $bps)."))";
			}	
    	}
    	
	    
	    $SQL .= "WHERE (". implode(" AND ", $WHR).") ORDER BY fullname ASC";
	    echo "<hr>".$SQL;
	    
	    $tmp	= CARD::getAllByFiltrFormSQL($SQL);
	    // print_r($tmp);
    	// echo "<hr>";
    	
    	$cards	= [];
    	foreach($tmp AS $card){
    		$cards[]	= Card::getById($card->getId());
    	}
    	
    	
    	// echo "</pre>";
    	
    	return($cards);
    	
    }

}









