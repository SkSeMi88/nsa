<?php

namespace MyProject\Models;

use MyProject\Services\Db;

// abstract class ActiveRecordEntity
abstract class ActiveRecordEntity implements \JsonSerializable
{
    /** @var int */
    protected $id;

    private static $translateTable = [

        1 => [

            "а"	=>	"a",
            "б"	=>	"b",
            "в"	=>	"v",
            "г"	=>	"g",
            "д"	=>	"d",
            "е"	=>	"e",
            "з"	=>	"z",
            "и"	=>	"i",
            "й"	=>	"i",
            "к"	=>	"k",
            "л"	=>	"l",
            "м"	=>	"m",
            "н"	=>	"n",
            "о"	=>	"o",
            "п"	=>	"p",
            "р"	=>	"r",
            "с"	=>	"s",
            "т"	=>	"t",
            "у"	=>	"u",
            "ф"	=>	"f",
            "х"	=>	"h",
            "ъ"	=>	"",//"``",
            "ы"	=>	"y",
            "ь"	=>	"",//"`",
        ],
        
        2 => [
            
            "ё"	=>	"yo",
            "ж"	=>	"zh",
            "ц"	=>	"ts",
            "ч"	=>	"ch",
            "ш"	=>	"sh",
            "э"	=>	"eh",
            "ю"	=>	"yu",
            "я"	=>	"ya",
        ],
        
        3 => [
            
            "щ"	=>	"shch",
        ],
        
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    /**
     * @return static[]
     */
    public static function findAll(): array
    {
        // $db = new Db();
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    abstract protected static function getTableName(): string;


        /**
     * @param int $id
     * @return static|null
     */
    public static function getById(int $id): ?self
    {
        if ($id===null){
            return 0;
        }
        // $db = new Db();
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
        // return $entities ? static::class : null;
    }


    public function save(): void
    {
        // var_dump($this);
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }

    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = $column . ' = ' . $param; // column1 = :param1
            $params2values[$param] = $value; // [:param1 => value1]
            $index++;
        }
        // var_dump($columns2params);
        // var_dump($params2values);

        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;

        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);

        // var_dump($sql);
        // var_dump($params2values);

    }

    private function insert2(array $mappedProperties): void
    {

        // var_dump($mappedProperties);

        $mappedPropertiesNotNull = array_filter($mappedProperties);

        // var_dump($mappedPropertiesNotNull);

        $columns2params = [];
        $params2values  = [];

        foreach ($mappedProperties as $column => $value) {

            if ($column=="id") continue;
            $columns2params[]   = $column;
            $params2values[] = ":".$column;
        }


        $sql = 'INSERT INTO ' . static::getTableName().' ('.implode(', ', $columns2params). ') VALUES ('. implode(', ', $params2values).');';
        
        // var_dump($sql);

        $db = Db::getInstance();
        // $db->query($sql, $params2values, static::class);
        $db->query($sql, $mappedPropertiesNotNull, static::class);

        var_dump($sql);
        // var_dump($params2values);
    }

    private function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);

        $columns        = [];
        $paramsNames    = [];
        $params2values  = [];
        foreach ($filteredProperties as $columnName => $value) {
            if($value!==null)
            {
                $columns[] = '`' . $columnName. '`';
                $paramName = ':' . $columnName;
                $paramsNames[] = $paramName;
                $params2values[$paramName] = $value;
            }
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';

        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);

        $this->id = $db->getLastInsertId();
        $this->refresh();
    }

    private function refresh(): void
    {
        $objectFromDb = static::getById($this->id);

        foreach ($objectFromDb as $property => $value) {
            $this->$property = $value;
        }

    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector          = new \ReflectionObject($this);
        $properties         = $reflector->getProperties();

        $mappedProperties   = [];
        foreach ($properties as $property) {
            $propertyName   = $property->getName();
            $propertyNameAsUnderscore   = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore]    = $this->$propertyName;
            // var_dump($mappedProperties);
        }

        return $mappedProperties;
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }


    public function delete(): void
    {
        $db = Db::getInstance();
        $db->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id',
            [':id' => $this->id]
        );
        $this->id = null;
    }

    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
            [':value' => $value],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result[0];
    }

    public static function findOneByColumnWhere(string $where): ?self
    {
        $db = Db::getInstance();
        $SQL    = 'SELECT * FROM '. static::getTableName().' '. $where;
        // echo $SQL;
        // return $SQL;
        $result = $db->query(
            $SQL,
            [],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result[0];
    }

    public static function findAllByColumnWhere(string $where)//:mixed
    {
        $db = Db::getInstance();
        $SQL    = 'SELECT * FROM '. static::getTableName().' '. $where;
        // echo $SQL;
        // return $SQL;
        $result = $db->query(
            $SQL,
            [],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result;
    }

    
    public static function findOneByColumnsArray($columnName, $values): ?self
    {

        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
            [':value' => $value],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result[0];
    }


    public function jsonSerialize() :mixed
    {
        return $this->mapPropertiesToDbFormat();
    }

    
    public static function findAllByASC($field) :array
    {
        // INSERT INTO `thems_list` (`id`, `name`, `parent`) VALUES (NULL, 'Первая', ''), (NULL, 'Вторая', '')
        // $SQL   = 'SELECT * FROM thems_list ORDER BY :field ASC;';
        
        // $SQL   = 'SELECT * FROM thems_list ORDER BY '.$field.' ASC;';
        
        $SQL   = 'SELECT * FROM '. static::getTableName().' ORDER BY '.$field.' ASC;';
        
        $db = Db::getInstance();
    
        // return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [':field' => $field], static::class);
        // return $db->query('SELECT * FROM thems_list ORDER BY :field ASC;', [':field' => $field], static::class);
        // return $db->query($SQL, [':field' => $field], static::class);
        return $db->query($SQL, [], static::class);
    }
    
    
    
    public static function findAllByWhere($from, string $where)//: array
    {
        $db = Db::getInstance();
        $SQL    = 'SELECT '.$from.' FROM '. static::getTableName().' '. $where;
        // echo $SQL;
        // return $SQL;
        $result = $db->query(
            $SQL,
            [],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result;
    }
    
    public static function query($SQL)//: array
    {
        $db = Db::getInstance();
        // $SQL    = 'SELECT '.$from.' FROM '. static::getTableName().' '. $where;
        // // echo $SQL;
        // // return $SQL;
        $result = $db->query(
            $SQL,
            [],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result;
    }
    
    public static function queryTable($SQL): array
    {
        $db = Db::getInstance();
        // $SQL    = 'SELECT '.$from.' FROM '. static::getTableName().' '. $where;
        // // echo $SQL;
        // // return $SQL;
        $result = $db->query(
            $SQL,
            [],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result;
    }

    public static function transliter($value) :string
    {

        // Привести всё значение строки в нижний регистр
        // разделить буквенную и числовую части друг от друга путем делиметра - или .
        // просто заменить делиметер на точку
        
        // $str = "Р-1480";
        // var_dump($value);

        $value = strtolower($value);
        // echo $value;

        $tmp    = strtolower($value);
        $tmp    = mb_strtolower($value);
     
        // print_r($value);
        // echo "  ";
        // print_r($tmp);
        // $trans = array("ab" => "01");
        // Последовательно заменяю в строке сначала всё по 3, потом 2 и по 1 символу
        $tmp    = strtr($tmp, self::$translateTable[3]);
        $tmp    = str_replace(array_keys(self::$translateTable[3]), array_values(self::$translateTable[3]), $tmp);
        // print_r($tmp);
        
        $tmp    = strtr($tmp, self::$translateTable[2]);
        $tmp    = str_replace(array_keys(self::$translateTable[2]), array_values(self::$translateTable[2]), $tmp);
        // print_r($tmp);
        
        $tmp    = strtr($tmp, self::$translateTable[1]);
        $tmp    = str_replace(array_keys(self::$translateTable[1]), array_values(self::$translateTable[1]), $tmp);
        // print_r($tmp);

        // Замена - на (.)
        $value  = strtr($tmp, "-",".");


        // foreach(self::$translateTable[3] AS $k => $v){
        //     str_replace($k,$v,$tmp);
        // }

        return($value);
    }

}