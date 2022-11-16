<?php

namespace MyProject\Models\Shifrs;
use MyProject\Models\Users\User;


use MyProject\Services\Db;
use MyProject\Models\ActiveRecordEntity;

use MyProject\Models\Fonds\Fond;
use MyProject\Models\Opisi\Opis;
use MyProject\Models\Dela\Delo;


class Shifr extends ActiveRecordEntity
{
	
	    // /** @var string */
    // protected $id;

    /** @var int */
    protected $fondId;

    /** @var int */
    protected $opisId;

    /** @var int */
    protected $deloId;

    /** @var string */
    protected $list;

    /** @var string */
    protected $prim;

    /*
    *   @ Геттеры
    */
    public function getFondId(): int
    {
        return $this->fondId;
    }

    public function getOpisId(): int
    {
        return $this->opisId;
    }

    public function getDeloId(): int
    {
        return $this->deloId;
    }

    public function getList(): string
    {
        return $this->list;
    }

    public function getPrim(): string
    {
        return $this->prim;
    }

	/*
	*	@ сетттеры
	*/
    public function setFondId($fond_id): int
    {
        return $this->fondId	= $fond_id;
    }

    public function setOpisId($opis_id): int
    {
        return $this->opisId	= $opis_id;
    }

    public function setDeloId($delo_id): int
    {
        return $this->deloId	= $delo_id;
    }

    public function setList($list): string
    {
        return $this->list		= $list;
    }
    

    public function setPrim($prim): string
    {
        return $this->prim		= $prim;
    }
    
    /*
    **
    */

    protected static function getTableName(): string
    {
        return 'shifrs';
    }

	public function getLastShifrId()
	{

		$LastShifr	= $this->getTableMaxId();

		var_dump($LastShifr);
		return($LastShifr);
	}

    public function createFinderRecord(array $fields)
    {
        $SQL = 'INSERT INTO '. $this->getTableName(). "('fond', 'opis', 'delo', 'list') VALUES (:fond, :opis, :delo, :list);";

        $db = Db::getInstance();
        $result = $db->query(
            $SQL,
            [":fond" => $fields["fond"],
             ":opis" => $fields["opis"],
             ":delo" => $fields["delo"],
             ":list" => $fields["list"],
            ]
//            ,            static::class
        );

        $result["id"]   = $db->getLastInsertId();

        if ($result === []) {
            return Null;
        }
        return $result;
    }

        public static function createFromArray(array $fields): Shifr
        {


            $shifr = new Shifr();

            $shifr->setFondId($fields['fond_id']);
            $shifr->setOpisId($fields['opis_id']);
            $shifr->setDeloId($fields['delo_id']);
            $shifr->setList($fields['list']);

            $shifr->save();

            // echo "!!!<hr>";
            // var_dump($fields);

            return $finder;
        }
        
//     public function createFinderRecord(array $fields)
//     {
//         $SQL = 'INSERT INTO '. $this->getTableName(). "('fond', 'opis', 'delo', 'list') VALUES (:fond, :opis, :delo, :list);";

//         $db = Db::getInstance();
//         $result = $db->query(
//             $SQL,
//             [":fond" => $fields["fond"],
//              ":opis" => $fields["opis"],
//              ":delo" => $fields["delo"],
//              ":list" => $fields["list"],
//             ]
// //            ,            static::class
//         );

//         $result["id"]   = $db->getLastInsertId();

//         if ($result === []) {
//             return Null;
//         }
//         return $result;
//     }


    public static function checkShifr(array $fields): Shifr
    {


        $fond  = Fond::findOneByColumn("fond", $fields["fond"]);

        if ($fond===null)
        return false;

        
        /*
        $SQL = 'SELECT * FROM shifrs WHERE (fond_id = :fondId)';
        $shifr = new Shifr();

        $shifr->setFondId($fields['fond_id']);
        $shifr->setOpisId($fields['opis_id']);
        $shifr->setDeloId($fields['delo_id']);
        $shifr->setList($fields['list']);

        $shifr->save();

        // echo "!!!<hr>";
        // var_dump($fields);
*/
        return $fond;
    }

    public static function createFromСard($fond_id, $opis_id, $delo_id, $list_name)
	{

		$shifr   = new Shifr;
		$shifr->setFondId($fond_id);
		$shifr->setOpisId($opis_id);
		$shifr->setDeloId($delo_id);
		$shifr->setList($list_name);
		// $shifr->setTitle('Название дела в описи фонда');
		// $delo->setDates('');
		// $delo->setPath('');

		$shifr->save();
		return($shifr);
	}


    public static function getShifrFullName($shifrId)
    {
        $ShifrFullName  = [];
        $shifr  = self::getById($shifrId);
		if ($shifr===null) return [];
        // var_dump($shifr);
        $ShifrFullName["fond"]  = Fond::getById($shifr->getFondId())->getName();
        $ShifrFullName["opis"]  = Opis::getById($shifr->getOpisId())->getName();
        $ShifrFullName["delo"]  = Delo::getById($shifr->getDeloId())->getName();
        $ShifrFullName["list"]  = $shifr->getList();
        return($ShifrFullName);
    }


    public static function getShifrTree()
    {
    	// Получить список всех фондов
    	// Получиь для каждого фонда списко всех описей
    	// Для каждой описи получить список дел
    	
    	
    	// 1
    	$Tree	= [
	    	"fonds"	> [
	    		"items"	=> [],
	    	],
    	];
    	
    	/*
    	$SQL	= Shifr::findAllByWhere( "DISTINCT(fond_id)", "ORDER BY name;");
    	*/
    	// $SQL	= self::findAllByWhere( "DISTINCT(fond_id)", "ORDER BY name;");
    	
    	// echo "SQL=>";
    	// var_dump($SQL);
    	// // $tmp	= self::
    	
		// Получение всех фондов отсортированных по имени
    	$SQL			= "ORDER BY name;";
    	$fonds_items	= Fond::findAllByColumnWhere($SQL);

		// Для каждого фонда
    	foreach($fonds_items AS $fond){
    		
			// находим все описи отсортированные по имени
    		$SQL2	= 'WHERE (fond_id="'.$fond->getId().'") ORDER BY name';

			// Получение всех описей по ид-ру фонда
    		$opisi_items	= Opis::findAllByColumnWhere($SQL2);

			// переходим к следующему фонду если нет описей у текущего
			if ($opisi_items===null){
				continue;
			};
    		if (count($opisi_items)==0){
    			continue;
    		};
    		
			// Добавляем в список фондов в дереве ид-р фонда
    		$Tree["fonds"]["items"][]	= $fond->getId();
    		
			
			// создам в общем дереве в списке фондов  вложенный массив для фонда
    		$Tree["fonds"][$fond->getId()]	= [
    			"name"	=> $fond->getPath(),
    			"opisi"	=> [],
    			"html"	=> [],
    		];

			$Tree["fonds"][$fond->getId()]["name"] = Fond::convertFondById(Shifr::transliter($fond->getName()));
    		
			// для каждой описи $opis из списка всех описей $opisi_items  в конкретном фонде $fond
    		foreach($opisi_items AS $opis)
    		{
    			$SQL3	= 'WHERE (fond_id="'.$fond->getId().'") AND(opis_id="'.$opis->getId().'") ORDER BY name';
    			$dela	= Delo::findAllByColumnWhere($SQL3);

				// echo "<pre>";
				// print_r($fond->getName());
				// print_r(Shifr::transliter($fond->getName()));
				// echo "	+>	";
				// // Fond::convertFondById($fond->getId());
				// Fond::convertFondById(Shifr::transliter($fond->getName()));
				// // var_dump(print_r($dela));
				// echo "</pre>";

	    		if ($dela===null){
					continue;
				};

	    		if ((count($dela)==0)||($dela===null)){
	    			continue;
	    		};
    		
    			$Tree["fonds"][$fond->getId()]["opisi"]["items"][]	= $opis->getId();
    			$Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]	= [
    				"name"	=> $opis->getPath(),
    				"dela"	=> [],
    			];

    			foreach($dela AS $delo){

    				$SQL4	= 'WHERE (fond_id="'.$fond->getId().'") AND(opis_id="'.$opis->getId().'") AND(delo_id="'.$delo->getId().'")  ORDER BY list';
    				$lists	= Shifr::findAllByColumnWhere($SQL4);


					if ($lists===null){
						continue;
					};

    				if(count($lists)==0){
    					continue;
    				};
    		
    				$Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"]["items"][]		= $delo->getId();
    				$Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"][$delo->getId()]	= [
    					// "name"	=> $fond->getName()." ". $opis->getName()." ".$delo->getName(),
    					"name"	=> $delo->getPath(),
    					"html"	=> $fond->getName()." ". $opis->getName()." ".$delo->getName(),
    					"lists"	=> [],
    				];
    				

    				foreach($lists AS $list){
    					
						$Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"][$delo->getId()]["lists"]["items"][] 		= $list->getId();
						$Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"][$delo->getId()]["lists"][$list->getId()]	= [
							"name"	=> $list->getList()
						];
    					// "name"	=> $delo->getName(),
    					// "lists"	=> [],
    				
    				}
    				
    			};
    		};
    	}
    	// $Tree["fonds"]["items"] = $fonds_items;
    	return($Tree);
    }
    
    public static function getDeloHtml($delo){
    	
		$tmp	= [
			'<li class="file">',
			'<a href="#" target="_blank" >',
			'Открыть дело',
			'</a>',
			'</li>'
		];
		return(implode(" ", $tmp));
    }
    
    public static function getShifrTreeHtml(){
    	
    	$tmp	= "";
    	$Tree	= self::getShifrTree();
    	// foreach($Tree["fonds"] AS $f){
    		
    	// 	foreach($Tree["fonds"][$f]["opisi"] AS $opisi){
    			
    			
    	// 		$tmp_dela	= "";
    	// 		foreach($Tree["fonds"][$f]["opisi"][$opisi]["dela"] AS $delo){
    				
    	// 			$tmp_delo	= 
    					
    	// 		}
    	// 	}
    	// 	// $tmp	.='<ol>'
    	// 	// <ol class="tree">
    	// 	// 	<li class="toggle">
    	// 	// 	f.002<input type="checkbox">
    	// 	// 	<ol class="tree">
	    // 	// 		<li class="toggle">
	    // 	// 			op.68
	    // 	// 			<input type="checkbox">
	    // 	// 			<ol class="tree">
	    // 	// 				<li class="toggle">
		   // // 					f.2-op.68-d.537
		   // // 					<input type="checkbox">
		   // // 					<ol class="tree">
		   // // 						<li class="file">
		   // // 							<a href="http://www.rkna.ru/projects/metric/f.002/op.68/f.2-op.68-d.537/page.html " target="_blank" >
		   // // 								Открыть дело
		   // // 							</a>
		   // // 						</li>
		   // // 					</ol>
	    // 	// 				</li>
	    // 	// 			</ol>
	    // 	// 		</li>
    	// 	// 	</ol>
    	// 	// 	</li>
    		
    		
    	// }
    }

}