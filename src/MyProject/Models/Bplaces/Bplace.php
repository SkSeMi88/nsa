<?php

namespace MyProject\Models\Bplaces;
use MyProject\Models\Users\User;

use MyProject\Models\ActiveRecordEntity;

use MyProject\Services\Db;

use MyProject\Exceptions\UnauthorizedException;

use MyProject\Exceptions\InvalidArgumentException;

use MyProject\Exceptions\NotFoundException;


class Bplace extends ActiveRecordEntity
{
    /** @var string */
    // protected $type;

    /** @var string */
    protected $punkt;

    /** @var string */
    protected $volost;

    /** @var string */
    protected $uezd;

    /** @var string */
    protected $state;


    // public function getRecordByFields($id==null, $punkt==null, $volost==null, $uezd==null )
    // public function getRecordByFields($id, $punkt, $volost, $uezd)
//    public static function checkRecordExisting(){
//        echo "QWERTY";
//    }

public static function getAllVolost($name)
{
    $db = Db::getInstance();

    $SQL = "SELECT DISTINCT volost FROM ". self::getTableName();
    // echo $SQL;
    $result = $db->query(
        $SQL,
        []
    );

    if ($result === null) {

        // $new_bplace  = self::createFromArrayForm($BPLACE);
        return null;
    }

    $datalist  = '<input type="text" name="find_volost" id="filtr_field" list="volost-value">';
    $datalist .= '<datalist id="volost-value">';

    $response = [
        "volost"    => []
    ];

    foreach ($result AS $r)
    {
        if (($r->volost===null)||(strlen($r->volost)==0)) continue;

        $datalist .= '<option value="'.$r->volost.'">'.$r->volost.'</option>';
        $response["volost"][]   = $r->volost;
    }

    $datalist .= '</datalist>';

    $response["datalist"]   = $datalist;

    return $response;
}

public static function getAllUezd($name)
{
    $db = Db::getInstance();

    $SQL = "SELECT DISTINCT uezd FROM ". self::getTableName();

    // echo $SQL;
    $result = $db->query(
        $SQL,
        []
    );

    if ($result === null) {

        // $new_bplace  = self::createFromArrayForm($BPLACE);
        return null;
    }

    $datalist  = '<input type="text" name="find_uezd" id="filtr_field" list="uezd-value">';
    $datalist .= '<datalist id="uezd-value">';

    $response = [
        "uezd"    => []
    ];

    foreach ($result AS $r)
    {
        if (($r->uezd===null)||(strlen($r->uezd)==0)) continue;

        // echo $r->uezd;
        $datalist .= '<option value="'.$r->uezd.'">'.$r->uezd.'</option>';
        $response["uezd"][]   = $r->uezd;
    }

    $datalist .= '</datalist>';

    $response["datalist"]   = $datalist;

    return $response;
    }

    public static function getSQLFromSaveForm()
    {
        // echo "@@@@@@@@@@@@@@@";
        $fields = [
            "punkt"     => "", 
            "volost"    =>  "", 
            "uezd"      => ""
        ];

        $state = 1;

        $values = [];

        $check  = false;
        $state  = 1;

        $SQL = 'UPDATE bps SET ';
        $U   = [];

        foreach(array_keys($fields) AS $k=> $field)
        {
            if (strlen($_REQUEST[$field])>3) 
            {
                $fields[$field] = '"'.$_REQUEST[$field].'"';
                $check          = true;
                $U[]            = $field.'='.$fields[$field];
                // $WHR[] = '('.$field.'="'.$_REQUEST["find_".$field].'")';
                // $WHR[] = '('.$field.' LIKE "%'.$_REQUEST[$field].'%")';
            }
        }

        if (!$check) return null;
        // echo "<br>@@@@@@@@@@@@@@@";
        $f          = implode("' , '",array_keys($fields));
        // echo "<br>@@@@@@@@@@@@@@@";
        $values     = implode(", ",array_values($fields));

        
        $SQL    .= implode(',', $U). ' WHERE (id='.$_REQUEST["save_bplace_id"].');';

        // $SQL = 'INSERT INTO '.self::getTableName().' ("'.$f.'", "state") VALUES ('.$values.','.$state.');';

        // UPDATE `bps` SET `id`=[value-1],`punkt`=[value-2],`volost`=[value-3],`uezd`=[value-4],`state`=[value-5] WHERE 1
        // echo "<br>$SQL";
        return($SQL);
    }

    public static function getSQLFromFiltrForm()
    {
        $fields = ["punkt", "volost", "uezd"];

        $WHR    = [];
        foreach($fields AS $k=> $field)
        {
            if ((isset($_REQUEST["find_".$field]))&&(strlen($_REQUEST["find_".$field])>0))
            {
                // $WHR[] = '('.$field.'="'.$_REQUEST["find_".$field].'")';
                $WHR[] = '('.$field.' LIKE "%'.$_REQUEST["find_".$field].'%")';
            }
        }

        $SQL    = 'SELECT * FROM '.self::getTableName();
        if (count($WHR)>0){
            // $sprtr  = "A N D";
            // $sprtr  = str_replace(" ", "", $sprtr);
            $SQL .= ' WHERE '.implode('AND', $WHR);
        }

        $SQL .= ";";
        
        // echo $SQL;
        return($SQL);
    }
/*
    public static function getAllByFiltrFormSQL($SQL)
    {
        $db = Db::getInstance();
        $result = $db->query(
            $SQL,
            []
        );
    
        if ($result === null) {
    
            return null;
        }
    
        $datalist  = '<input type="text" name="find_uezd" id="filtr_field" list="country-value">';
        $datalist .= '<datalist id="country-value">';
    
        $response = [
            "uezd"    => []
        ];
    
        foreach ($result AS $r)
        {
            if (($r->uezd===null)||(strlen($r->uezd)==0)) continue;
    
            echo $r->uezd;
            $datalist .= '<option value="'.$r->uezd.'">'.$r->uezd.'</option>';
            $response["uezd"][]   = $r->uezd;
        }
    
        $datalist .= '</datalist>';
    
        $response["datalist"]   = $datalist;
    
        return $response;
    }
*/


    public static function getRecordByFields($BPLACE)
    {
        // echo "<pre>start:";
		// print_r(array_keys($BPLACE));//, $punkt, $volost, $uezd;
        // var_dump($BPLACE);//, $punkt, $volost, $uezd;
        $db = Db::getInstance();
//        $SQL = "SELECT * FROM ". $this->getTableName();
        $SQL = "SELECT * FROM ". self::getTableName();
//        echo $SQL;
        $WHR = [];

        $fields_names = ["punkt", "volost", "uezd"];
        foreach($fields_names AS $field)
        {
        	// echo "<br>".$field."	".strlen($BPLACE[$field]);
        	// echo (int)((in_array($field, array_keys($BPLACE))));
			// echo (int) (strlen($BPLACE[$field])>3);
            // if ((array_key_exists($field, $BPLACE))&&(strlen($BPLACE[$field]>3))){
			if ((in_array($field, array_keys($BPLACE)))&&(strlen($BPLACE[$field])>3)){            	
                $WHR[] = "(".$field."='".$BPLACE[$field]."')";
                continue;
            }
            $WHR[] = "(".$field." IS NULL)";
        }


        if (count($WHR)>0){
//            echo implode(" ", $WHR);
            $WHERE   = " WHERE ".implode((string)" AND ", $WHR);
            $SQL    .= $WHERE;
            
        }

        $SQL    .= ";";
        // echo "<hr>".$SQL;

        $result = $db->query(
            $SQL,
            []
        );
        // echo "<hr> Получение записи места рождени я по полям result= ";
        // var_dump($result);
        if ($result === []) {
            // echo "СОздание нового места";
            $new_bplace  = self::createFromArrayForm($BPLACE);
            // echo"QAZ";
            // var_dump($new_bplace);
            return $new_bplace->getId();
//            return null;

        }
        // var_dump($result[0]->id);
        return $result[0]->id;
    }


    public static function getRecordByFields123($BPLACE)
    {
        // echo "start:";

        // var_dump($BPLACE);//, $punkt, $volost, $uezd;
        $db = Db::getInstance();
//        $SQL = "SELECT * FROM ". $this->getTableName();
        $SQL = "SELECT * FROM ". self::getTableName();
//        echo $SQL;
        $WHR = [];
//        if ($BPLACE["punkt"]!=null) {
//            $WHR[] = "(punkt='".$BPLACE["punkt"]."')";
//        }
//        else{
//            $WHR[] = "(punkt='')";
//        }
//
//        if ($BPLACE["volost"]!=null) {
//            $WHR[] = "(volost='".$BPLACE["volost"]."')";
//        }
//        else{
//            $WHR[] = "(volost='')";
//        }
//
//        if ($BPLACE["uezd"]!=null) {
//            $WHR[] = "(uezd='".$BPLACE["uezd"]."')";
//        }
//        else{
//            $WHR[] = "(uezd='')";
//        }

        $fields_names = ["punkt", "volost", "uezd"];
        foreach($fields_names AS $field)
//        foreach(array_keys($BPLACE) AS $field)
        {
            if ((array_key_exists($field, $BPLACE))&&(strlen($BPLACE[$field]>3))){
                $WHR[] = "(".$field."='".$BPLACE[$field]."')";
                continue;
            }
            $WHR[] = "(".$field." IS NULL)";
        }


        if (count($WHR)>0){
//            echo implode(" ", $WHR);
            $WHERE   = " WHERE ".implode((string)" AND ", $WHR);
            $SQL    .= $WHERE;
            
        }

        $SQL    .= ";";
        // echo "<hr>".$SQL;



        $result = $db->query(
            $SQL,
            []
        );
        // echo "<hr> Получение записи места рождени я по полям result= ";
        // var_dump($result);
        if ($result === []) {
            // echo "СОздание нового места";
            $new_bplace  = self::createFromArrayForm($BPLACE);
            // echo"QAZ";
            // var_dump($new_bplace);
            return $new_bplace->getId();
//            return null;

        }
        return $result[0]->id;

    }

    /**
     * @return string
    */
    public function getBplaceEditor(): Bplace
    {

        $BP_LIST    = self::findAll();


        return($this);
    }

    /**
     * @return string
    */
    public function getFullName(): string
    {
        $FullName = "";
        $punkt  = $this->punkt;
        $volost = $this->volost;
        $uezd   = $this->uezd;

        if (strlen($punkt)>0) {
            $FullName   .= $punkt;
        }

        if (strlen($volost)>0) {
            $FullName   .= " ".$volost." волость";
        }

        if (strlen($uezd)>0) {
            $FullName   .= " ".$uezd. " уезд";
        }

        return($FullName);
    }

    public function getPunkt(): string
    {
        // return $this->punkt;
        return ($this->punkt)?$this->punkt:"";
    }

    /**
     * @return string
     */
    public function getVolost(): string
    {
        return ($this->volost)?$this->volost:"";
    }

    /**
     * @return string
     */
    public function getUezd(): string
    {
        // return $this->uezd;
        return ($this->uezd)?$this->uezd:"";
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

//    /*
//     * @return string
//     */
//    public function getType(): string
//    {
//        return $this->type;
//    }

    /*
     * @return string
     /
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     /
    public function getTitle(): string
    {
        return $this->title;
    }
*/
    protected static function getTableName(): string
    {
        return 'bps';
    }

    /**
     * @return int
     */


    public function setPunkt($punkt): string
    {

        return $this->punkt = $punkt;
//        return $this->punkt=implode(", ",$punkt);
    }

    public function setVolost($volost): string
    {
        return $this->volost=$volost;
    }

    public function setUezd($uezd): string
    {
        return $this->uezd=$uezd;
    }

    public function setState($state): string
    {
        return $this->state=$state;
    }


    public static function createFromArrayForm(array $fields): Bplace
    {
        // if (empty($fields['name'])) {
        //     throw new InvalidArgumentException('Не передано название статьи');
        // }

        // if (empty($fields['text'])) {
        //     throw new InvalidArgumentException('Не передан текст статьи');
        // }

        
        $bplace = new Bplace();
        // echo "<hr>>>>";
        // var_dump($fields);

        // $bplace->setAuthor($author);
        if (array_key_exists("punkt", $fields)){
            $bplace->setPunkt($fields['punkt']);
            // echo "<hr>1";
        }

        if (array_key_exists("volost", $fields)) {
            $bplace->setVolost($fields['volost']);
            // echo "<hr>2";
        }

        if (array_key_exists("uezd", $fields)) {
            $bplace->setUezd($fields['uezd']);
            // echo "<hr>3";
        }
        $bplace->setState(1);

        $bplace->save();

        // echo "<hr>save";
        // var_dump($bplace);

        return $bplace;
    }




    public function updateFromArray(array $fields): Bplace
    {

        $fields = [
            "punkt"     => "", 
            "volost"    =>  "", 
            "uezd"      => ""
        ];

        $state = 1;

        $values = [];

        $check  = false;
        $state  = 1;


        foreach(array_keys($fields) AS $k=> $field)
        {
            if (strlen($_REQUEST[$field])>3) 
            {
                $check          = true;
            }
        }



        if (!$check) {
            throw new InvalidArgumentException('Место рождения должно иметь минимум одно значение.');
        }

        // if (empty($fields['text'])) {
        //     throw new InvalidArgumentException('Не передан текст статьи');
        // }

        // $this->setName($fields['name']);
        // $this->setText($fields['text']);
        // $this->save();

        $this->setPunkt($fields["punkt"]);
        $this->setVolost($fields["volost"]);
        $this->setUezd($fields["uezd"]);
        $this->save();

        return $this;
    }
    
}