<?php

namespace MyProject\Models\Thems;
use MyProject\Models\Users\User;


use MyProject\Services\Db;
use MyProject\Models\ActiveRecordEntity;

use MyProject\Exceptions\InvalidArgumentException;


use MyProject\Models\Thems\Them;



class ThemList extends ActiveRecordEntity
{

    /** @var string */
    // protected $id;

    /** @var string */
    protected $name;

    /** @var int */
    protected $father;

    /** @var int */
    protected $count;

    /*
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /*
     * @return int
     */
    public function getFather(): int
    {
        return $this->father;
    }

    /*
     * @return int
     */
    public function getCount(): mixed
    {
        return $this->count;
    }


    /*
     * @Сеттеры для имени
    */

    public function setName($names): string
    {

        return $this->name = $names;
    }

    public function setFather($father): int
    {

        return $this->father = $father;
    }

    public function setCount($count): mixed
    {

        return $this->count = $count;
    }


    public static function checkFormCreateThem(array $fields): array
    {
        $errors = [];
        $fields_names = [

            "new_them_name" =>"Название темы",
            "father" =>"Родитель",
        ];

        $new_form = [
            "new_them_name"     =>[],
            "new_father"        =>[]
        ];

		if (strlen($fields["new_them_name"])<3){
            $errors[]   = "Название темы имеет некорректное значение.";

		}
        // echo "<hr>Функция проверки формы";
        // echo "<br>Поля карточки со значекниями массива:";

        $response = [
            "status"    => true,
            "errors"    => $errors,
        ];

        if (count($errors)!=0){
            $response["status"]=false;
        }

        // var_dump($response);
        return($response);

    }
    
    protected static function getTableName(): string
    {
        return 'thems_list';
    }

    

    public static function createFromArrayForm(array $fields): ThemList
    {

        $check     = self::checkFormCreateThem($fields);

        if ($check["status"]==false){
            $errors = implode("<br>", $check["errors"]);
            throw new InvalidArgumentException($errors);
        }
        
        $them = new ThemList();

        $them->setName($fields['new_them_name']);
        // $tem->setFather($fields['father']);

        $them->save();
        return $them;
    }

    
    public function updateFromArray(array $fields): ThemList
    {
        if (empty($fields['them_name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['them_name'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $this->setName($fields['them_name']);
        $this->setFather("0");

        $this->save();

        return $this;
    }

    // public static function findAllByASC1() :array
    // {

    //     $result = [];
    //     $SQL   = 'SELECT * FROM thems_list ORDER BY name ASC;';

    //     return($result);
    // }

    // public static function findAll() :array
    // {
    //     $tmp    = parent::findAll();
    //     $tem   = [];

    //     foreach ($tmp as $key => $value) {
    //         $tmp[$key]->id			= Bplace::getById($value->getBplaceId());
    //         $tmp[$key]->name		= Bplace::getById($value->getBplaceId());
    //         $tmp[$key]->father		= Finder::getById($value->getFinderId());
    //     }

    //     return($tmp);
    // }

    public static function getById1(int $id)
    {

        // $db = Db::getInstance();

        // $entities = $db->query(
        //     'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
        //     [':id' => $id],
        //     static::class
        // );

        $entities   = parent::getById($id);

        // var_dump($entities);

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
    /*
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
*/

/*
	public function createFullName(){

		$fnames	= explode(",", $this->getFname());
		$names	= explode(",", $this->getName());
		$snames	= explode(",", $this->getSname());
		
		$FullName	= rtrim(str_replace("  "," ", implode(" ", [$fnames[0], $names[0],$snames[0]])));
		// $this->setFullname($FullName);
		return($FullName);
	}
*/

    public static function checThemByName($them_name)
    {

        $them   = ThemList::findOneByColumn("name", $them_name);
        
        if ($them !==null){
            return($them->getId());
        }
        
        // $them   = new ThemList();
        // $them->setName($them_name);
        // $them->setFather(0);
        // $them->setCount(0);
        // $them->save();
        
        $them = new ThemList();
        $them->setName($them_name);
        $them->save();
        // var_dump($them);

        return($them->getId());
    }

    
    public static function getCardDatalist()
    {
        $ThemList   = ThemList::findAll();
    }

    public static function getThemCard($ThemId)
    {
        // Получаем основу объекта карточки тематики
        $Them       = ThemList::getById($ThemId);

        // // Узнаем список всех карточек документов, где есть эта тематика

        // $thems      = Them::findOneByColumnsArray("them_id", $ThemId);
        

        // // Для каждой этой карточки документа выцепляем наименование шифра 
        // // Для каждой этой карточки документа выцепляем наименование документа
        // // Передаем это в объект карточки тематики

        return($Them);
    } 

    // public static function getCardsCountByThemId(){

    // }

    public static function findAllByASC($field) :array
    {

        $thems = [];
        // // $thems = parent::findAllByASC($field);
        // $thems = ThemList::findAllByASC($field);

        $SQL    = 'SELECT * FROM thems_list ORDER BY '.$field.' ASC;';
        $db     = Db::getInstance();
    
        // return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [':field' => $field], static::class);
        // return $db->query('SELECT * FROM thems_list ORDER BY :field ASC;', [':field' => $field], static::class);
        // return $db->query($SQL, [':field' => $field], static::class);
        $thems =  $db->query($SQL, [], static::class);


        // echo "<pre>";
        foreach($thems AS $thema){
            // echo "@>";
            // echo $thema->getId()."  ".         var_dump($thema->getName());
            $SQL = "SELECT thems_list.id, thems_list.name, COUNT(thems.them_id) as count FROM thems_list JOIN thems 
                ON thems_list.id = thems.them_id 
                Where thems_list.id = :value
                GROUP BY thems_list.id  
                ORDER BY `thems_list`.`name` ASC;";
                $counter =  $db->query(
                    $SQL, 
                    [":value" => $thema->getId()],
                    static::class
                );
                if (($counter === [])||($counter[0]->count === null)) {
                    // print_r (null);
                    $thema->setCount(0);
                    continue;
                }
                $thema->setCount($counter[0]->count);


        };

        // var_dump($thems[240]);




        // $SQL = " SELECT thems_list.id, thems_list.name, count(thems.them_id)as count
        // FROM thems_list, thems
        // WHERE thems_list.id = thems.them_id 
        // GROUP BY thems_list.id
        // ORDER BY thems_list.name ASC;";

        // $db = Db::getInstance();
        // $result = $db->query(
        //     $SQL,
        //     [],
        //     static::class
        // );
        
        // echo "@@@@@@@@@@@@@";
        // echo "<pre>";
        // var_dump($result[240]);// id);
        // foreach($result AS $thema){

        //     echo "<pre>";
        //     // var_dump($thema->getId());// id);
        //     var_dump($thema);// id);
        //     // // print_r(($thema->count));
        //     // $thems[$thema->id]->setCounter($thema->count);
        //     // var_dump($thems[$thema->id]);

        //     echo "</pre>";
            
        // }
        // echo "~~~";
        
        
        
        
        // for($i=0; $i<min(count($thems),count($result)); $i++){
            
        //     echo ">>>>>>>>>>>>>>>>>>>>>>>>>";
        //     $them_id                        = $result[$i]->id;

        //     // $thems[$them_id]->cards_count = $result[$i]->count;
            
        //     var_dump($them_id);
        //     var_dump($thems[$i]);
        //     var_dump($result[$i]);
            
        // }
        // echo "</pre>";
        // echo "~~~";
        

        // echo "@@@@@@@@@@@@@<pre>";
        // print_r(($result[0]));

        // echo "</pre>~~~";

        return $thems;
    }



}