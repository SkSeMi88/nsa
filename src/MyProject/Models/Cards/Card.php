<?php

namespace MyProject\Models\Cards;



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


class Card extends ActiveRecordEntity
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $docType;

    /** @var string */
    protected $eventDate;

    /** @var string */
    protected $cardDate;

    /** @var string */
    protected $eventPlace;

    /** @var string */
    protected $cardPlace;

    /** @var string */
    protected $docHeader;

    /** @var int */
    protected $shifrId;

    // /** @var string */
    protected $original;

    /** @var string */
    protected $langs;

    /** @var string */
    protected $playback;

    /** @var int */
    protected $state;

    /** @var int */
    protected $compiler;

    /** @var string */
    protected $compilationDate; 

   /** @var string */
    protected $summary; 

   /** @var string */
    protected $persons;



    /*
     * @return string
     */
    public function getDocType(): string
    {
        return $this->docType;
    }

    /*
     * @return string
     */
    public function getShifrId(): int
    {
        return $this->shifrId;
    }

    /*
     * @return string
     */
    public function getEventDate(): string
    {
        return $this->eventDate;
    }

    /*
     * @return string
     */
    public function getCardDate(): string
    {
        return $this->cardDate;
    }

    /*
     * @return string
     */
    public function getEventPlace(): string
    {
        return $this->eventPlace;
    }

    /*
     * @return string
     */
    public function getCardPlace(): string
    {
        return $this->cardPlace;
    }

    /*
     * @return string
     */
    public function getDocHeader(): string
    {
        return $this->docHeader;
    }

    /*
     * @return string
     */
    public function getOriginal(): string
    {
        return $this->original;
    }

    /*
     * @return string
     */
    public function getLangs(): string
    {
        return $this->langs;
    }

    /**
     * @return int
     */
    public function getPlayBack(): string
    {
        return $this->playback;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /*
    * @return string
    */
    public function getCompiler(): string
    {
        return $this->compiler;
    }

/*  
    * @return string
    */
    public function getCompilationDate(): string
    {
        return $this->compilationDate;
    }

    /*
    * @return string
    */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /*
    * @return string
    */
    public function getPersons(): string
    {
        return $this->persons;
    }

    protected static function getTableName(): string
    {
        return 'cards';
    }

    /* ************************************************
        Сеттеры 
    */

    
    /*
     * @return string
    */
    public function setDocType($docType): string
    {
        return $this->docType   = $docType;
    }

    /*
     * @return int
    */
    public function setShifrId($shifrId): int
    {
        return $this->shifrId   = (int)$shifrId;
    }

    /*
     * @return string
    */
    public function setEventDate($eventDate): string
    {
        return $this->eventDate     = $eventDate;
    }

    /*
     * @return string
    */
    public function setCardDate($cardDate): string
    {
        return $this->cardDate      = $cardDate;
    }

    /*
     * @return string
    */
    public function setEventPlace($eventPlace): string
    {
        return $this->eventPlace    = $eventPlace;
    }

    /*
     * @return string
    */
    public function setCardPlace($cardPlace): string
    {
        return $this->cardPlace     = $cardPlace;
    }

    /*
     * @return string
    */
    public function setDocHeader($docHeader): string
    {
        return $this->docHeader     = $docHeader;
    }

    /*
     * @return string
    */
    public function setOriginal($original): string
    {
        return $this->original      = $original;
    }

    /*
     * @return string
    */
    public function setLangs($langs): string
    {
        return $this->langs     = $langs;
    }

    /**
     * @return int
     */
    public function setPlayBack($playback): string
    {
        return $this->playback  = $playback;
    }

    /**
     * @return int
     */
    public function setState($state): int
    {
        return $this->state     = $state;
    }

    /*
    * @return string
    */
    public function setCompiler($compiler): string
    {
        return $this->compiler  = $compiler;
    }

    /*  
    * @return string
    */
    public function setCompilationDate($compilationDate): string
    {
        return $this->compilationDate   = $compilationDate;
    }

    /*
    * @return string
    */
    public function setSummary($summary): string
    {
        return $this->summary   = $summary;
    }

    /*
    * @return string
    */
    public function setPersons($persons): string
    {
        return $this->persons   = $persons;
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

    public static function getById3(int $id)
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
	    
	    $tmp	= Card::getAllByFiltrFormSQL($SQL);
	    // print_r($tmp);
    	// echo "<hr>";
    	
    	$cards	= [];
    	foreach($tmp AS $card){
    		$cards[]	= Card::getById($card->getId());
    	}
    	
    	
    	// echo "</pre>";
    	return($cards);
    }

	public function createFullName(){

		$fnames	= explode(",", $this->getFname());
		$names	= explode(",", $this->getName());
		$snames	= explode(",", $this->getSname());
		
		$FullName	= rtrim(str_replace("  "," ", implode(" ", [$fnames[0], $names[0],$snames[0]])));
		// $this->setFullname($FullName);
		return($FullName);
	}

    public static function checkShifr()
    {

        // $fond_name  = "Ф. 525";
        // $opis_name  = "Оп.1";
        // $delo_name  = "Д.1";
        // $new_list  = "л.1-1об.";

        $fond_name  = $_POST["new_fond"];
        $opis_name  = $_POST["new_opis"];
        $delo_name  = $_POST["new_delo"];
        $new_list   = $_POST["new_list"];

        $fond       = Fond::findOneByColumn("name", $fond_name);
        // var_dump($fond);

        if ($fond===null)
        {

            $fond   = Fond::createFromСard($fond_name);
            if ($fond===null)
            {

                return(false);
            }
        }

        $fond_id    = $fond->getId();


        $where      = "WHERE (fond_id='".$fond_id."') AND (name='".$opis_name."')";
        $opis       = Opis::findOneByColumnWhere($where);
        // var_dump($opis);

        if ($opis===null)
        {

            $opis   = Opis::createFromСard($fond_id, $opis_name);
            if ($opis===null)
            {

                return(false);
            }

        }

        $opis_id    = $opis->getId();

        $where      = "WHERE (fond_id='".$fond_id."') AND (opis_id='".$opis_id."') AND (name='".$delo_name."')";
        $delo       = Delo::findOneByColumnWhere($where);
        // var_dump($delo);
        
        if ($delo===null)
        {
            
            $delo       = Delo::createFromСard($fond_id, $opis_id, $delo_name);
            if ($delo===null)
            {

                return(false);
            }

        }
        $delo_id    = $delo->getId();
        // var_dump($delo);
        
        $where      = "WHERE (fond_id='".$fond_id."') AND (opis_id='".$opis_id."') AND (delo_id='".$delo_id."') AND (list='".$new_list."')";
        $shifr      = Shifr::findOneByColumnWhere($where);
        // var_dump($shifr);
        
        if ($shifr===null)
        {
            
            $shifr   = Shifr::createFromСard($fond_id, $opis_id, $delo_id, $new_list);
            if ($shifr===null)
            {
                
                return(false);
            }
            
        }
        // var_dump($shifr);
        echo "</pre>";
        return($shifr);
    }

    public static function createCard($card){

        // echo "QWERTY";
        $new_card   = new Card();

        $new_card->setDocType($card["doc_type"]);
        $new_card->setEventDate($card["event_date"]);
        $new_card->setCardDate($card["card_date"]);
        $new_card->setEventPlace($card["event_place"]);
        $new_card->setCardPlace($card["card_place"]);
        $new_card->setDocHeader($card["doc_header"]);
        $new_card->setShifrId($card["shifr_id"]);
        $new_card->setOriginal($card["original"]);
        $new_card->setLangs($card["langs"]);
        $new_card->setPlayBack($card["playback"]);
        $new_card->setState($card["state"]);
        $new_card->setCompiler($card["compiler"]);
        $new_card->setCompilationDate($card["compilation_date"]);
        $new_card->setSummary($card["summary"]);
        $new_card->setPersons($card["persons"]);

        $new_card->save();

        $new_card_id    = $new_card->getId();

        foreach($card["thems"] AS $t)
        {

            $them   = new Them;
            $them->setThemId($t);
            $them->setTypeId (6);
            $them->setValue($new_card_id);
            $them->save();
        }

        return($new_card);
    }

    public static function getCardView($cardId)
    {

        $card           = self::getById($cardId);

        // echo "<pre>@@@@@@@@@@@@";
        // // var_dump($card);
        // var_dump($card->getShifrId());
        
        if($card===null)
        {
            header('Location: /404', true, 302);
            exit;
        }
        
        // echo "<hr>card->shifrFullName";
        $card->shifrFullName    = Shifr::getShifrFullName($card->getShifrId());
        // var_dump($card->shifrFullName);
        
        $card_thems             = Them::findAllByColumnWhere("WHERE (type_id='6') AND (value='".$card->getId()."')");
        if($card_thems===null)
        {
            $card_thems = [];
        }
        // echo "</hr>";
        // echo "<pre>";
        // var_dump($card_thems);
        // echo "</pre>";

        // Декларация списка тем в объекте карточки документа
        $card->thems    = [];

        // Получаем по этому списку ид-р => название каждой темы в карточке
        foreach($card_thems AS $k=>$v)
        {
            // $card->thems[$k]  = (ThemList::getById($v->getThemId()))->getName();
            $card->thems[$v->getThemId()]  = ThemList::getById($v->getThemId())->getName();;
        }
        // echo "<pre>";
        // var_dump($card->thems);
        // echo "<hr>";
        // var_dump($card_thems);
        // $card->thems    = $card_thems;
        // echo "</pre>";
        return($card);
    }

    public static function editCard($newCard, $cardId)
    {

        // echo "<pre>newCard";
        // var_dump($newCard);
        // echo "<hr>";
        // echo "</pre>";

        $card_thems = Them::findAllByColumnWhere("WHERE (type_id='6') AND (value='".$cardId."') ORDER BY type_id");

        if ($card_thems!==null){

            // удаление всех старых ткм у карточки, чтобы все записать новые только-последние
            $old_thems  = [];
            foreach($card_thems AS $old_them)
            {
                $old_them_id                = $old_them->getThemId();
                $old_thems[$old_them_id]    = ThemList::getById($old_them_id)->getName();
                $old_them->delete();
            }
        }

        $editedCard = Card::getById($cardId);

        // foreach($newCard["thems"] AS $k=>$v)
        // {
        //     // Проверка переданной по форме редактирования каждой тематики
        //     $tmp    = Them::getThemId($k);

        //     // Если такой тематики нет/не было у этой карточки то создаем
        //     if ($tmp===null)
        //     {
        //         $new_them_card  = new Them;
        //         $new_them_card->setThemId($k);
        //         $new_them_card->setTypeId(6);
        //         $new_them_card->setValue($cardId);
        //         $new_them_card->save();
        //         continue;
        //     }

        //     // если есть такая тематика_ид-р у карточки, то проверяем ее название+изменяем
        // }
        // echo "<pre>";
        // var_dump($newCard["shifr_id"]);
        // echo "<hr>";
        // var_dump($newCard["thems"]);
        // echo "</pre>";

        foreach($newCard["thems"] AS $k=>$t)
        {
            $them   = new Them();
            $them->setThemId($k);
            $them->setTypeId(6);
            $them->setValue($cardId);
            // var_dump($them);
            $them->save();
        }

        $editedCard->setDocType($newCard["doc_type"]);
        $editedCard->setEventDate($newCard["event_date"]);
        $editedCard->setCardDate($newCard["card_date"]);
        $editedCard->setEventPlace($newCard["event_place"]);
        $editedCard->setCardPlace($newCard["card_place"]);
        $editedCard->setDocHeader($newCard["doc_header"]);
        $editedCard->setShifrId($newCard["shifr_id"]);
        $editedCard->setOriginal($newCard["original"]);
        $editedCard->setLangs($newCard["langs"]);
        $editedCard->setPlayBack($newCard["playback"]);
        $editedCard->setState($newCard["state"]);
        $editedCard->setCompiler($newCard["compiler"]);
        $editedCard->setCompilationDate($newCard["compilation_date"]);
        $editedCard->setSummary($newCard["summary"]);
        $editedCard->setPersons($newCard["persons"]);

        $editedCard->save();


        $editedCard->thems  = $newCard["thems"];

        // $editedCard_id    = $editedCard->getId();

        return($editedCard);
    }
}