<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;

use MyProject\Models\Shifrs\Shifr;

use MyProject\Models\Cards\Card;
use MyProject\Models\Fonds\Fond;
use MyProject\Models\Opisi\Opis;
use MyProject\Models\Dela\Delo;

use MyProject\Models\Site\Site;

use MyProject\Models\Persons\Person;
use MyProject\Models\Persons\PersonTest;
use MyProject\Models\Persons\CardPerson;

use MyProject\Models\Thems\ThemList;

use MyProject\Exceptions;//\DbException;

// use MyProject\Services\UsersAuthService;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Thems\Them;
use MyProject\Models\Users\UserActivationService;

use MyProject\Services\EmailSender;
use MyProject\Services\UsersAuthService;

use function PHPSTORM_META\type;


class MainController extends AbstractController
{
    /** @var View */
    // private $view;

    /** @var Db */
    private $db;

    public function __construct()
    {

        $this->user = UsersAuthService::getUserByToken();
        // var_dump($this->user);
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
        
        $this->UserMenu	= Site::getUserMenu($this->user);
        $this->view->setVar('UserMenu', $this->UserMenu);
        // var_dump($this);

        // $this->view = new View(__DIR__ . '/../../../templates');
        // $this->db = new Db();
        $db = Db::getInstance();
    }

    public function main01()
    {
        $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        // var_dump($articles);
        return;
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function main()
    {
        // $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        // $this->view->renderHtml('main/main.php', ['articles' => $articles]);

        $title      = "Мой блог. Главная страница";
        // echo "Мой блог. Главная страница";
        $articles   = [];

        // var_dump($this->user);

        // $articles = Article::findAll();
        // $this->view->renderHtml('main/main.php', ['articles' => $articles,'title' => $title]);
        // $this->view->renderHtml('main/index.php', ['articles' => $articles,'title' => $title, 'user'=>$this->user]);
        $this->view->renderHtml('main/index.php', ['articles' => $articles,'title' => $title]);
        /*
        // echo "<pre>";
        $TREE	= Shifr::getShifrTree();
        echo "Пример вывода дерева архивного шифра";
        
        foreach($TREE["fonds"]["items"] AS $fond_id){
        	echo "<div>";
	        if (count($TREE["fonds"][$fond_id]["opisi"]["items"])==0){
	        	echo "</div>";
	        	continue;
	        }
        	echo "&nbsp;".$TREE["fonds"][$fond_id]["name"];
        	
	        foreach($TREE["fonds"][$fond_id]["opisi"]["items"] AS $opis_id){
	        	echo "<div>";
	        	echo "&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["name"];

    	        foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"]["items"] AS $delo_id){
		        	echo "<div>";
		        	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["name"];
		        	
					foreach($TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"]["items"] AS $list_id){
			        	echo "<div>";
			        	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			        	echo $TREE["fonds"][$fond_id]["opisi"][$opis_id]["dela"][$delo_id]["lists"][$list_id]["name"];
			        	
			        	
			        	
			        	echo "</div>";
			        };
		        	
		        	echo "</div>";
		        };

	        	echo "</div>";
	        };
        	
        	echo "</div>";
        };
        */
        
    }

    public function m404()
    {
        // $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        // $this->view->renderHtml('main/main.php', ['articles' => $articles]);

        $title      = "Мой блог. Главная страница";
        // echo "Мой блог. Главная страница";
        $articles   = [];

        // var_dump($this->user);

        // $articles = Article::findAll();
        // $this->view->renderHtml('main/main.php', ['articles' => $articles,'title' => $title]);
        $this->view->renderHtml('404.php', ['articles' => $articles,'title' => $title, 'user'=>$this->user]);
    }
    
    public function release()
    {
        $this->view->renderHtml('main/release.php');

    }

    public function test0()
    {

        $SQL    = "ORDER BY name;";
    	$fonds	= Fond::findAllByColumnWhere($SQL);

        echo "<pre>";

        // var_dump($fonds);

        $k = 0;
        foreach($fonds AS $fond)
        {
           echo "<hr> # ".$k++;
           echo "<br>".$fond->getName();
           echo "<br>";
           echo Shifr::transliter($fond->getName());
           echo "<br>";
           echo Fond::convertFondById(Shifr::transliter($fond->getName()));
           $fond->setPath(Fond::convertFondById(Shifr::transliter($fond->getName())));
           $fond->save();

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

            // для каждой описи $opis из списка всех описей $opisi_items  в конкретном фонде $fond
            foreach($opisi_items AS $opis)
            {
                $SQL3	= 'WHERE (fond_id="'.$fond->getId().'") AND(opis_id="'.$opis->getId().'") ORDER BY name';
                $dela	= Delo::findAllByColumnWhere($SQL3);

	    		if ($dela===null){
					continue;
				};

	    		if ((count($dela)==0)||($dela===null)){
	    			continue;
	    		};

    			// $Tree["fonds"][$fond->getId()]["opisi"]["items"][]	= $opis->getId();
    			// $Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]	= [
    			// 	"name"	=> $opis->getName(),
    			// 	"dela"	=> [],
    			// ];

                $opis_name  = Opis::convertOpisName(Opis::transliter($opis->getName()));
                echo "<br>      ".$opis_name;
                $opis->setPath(Opis::convertOpisName(Opis::transliter($opis->getName())));
                $opis->save();

                foreach($dela AS $delo){

                    $delo_name  = Delo::convertDeloName(Delo::transliter($delo->getName()));
                    echo "<br>                  ".$delo_name;
                    $delo->setPath($delo_name);
                    $delo->save();
    

    				// $SQL4	= 'WHERE (fond_id="'.$fond->getId().'") AND(opis_id="'.$opis->getId().'") AND(delo_id="'.$delo->getId().'")  ORDER BY list';
    				// $lists	= Shifr::findAllByColumnWhere($SQL4);


					// if ($lists===null){
					// 	continue;
					// };

    				// if(count($lists)==0){
    				// 	continue;
    				// };
    		
    				// $Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"]["items"][]		= $delo->getId();
    				// $Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"][$delo->getId()]	= [
    				// 	// "name"	=> $fond->getName()." ". $opis->getName()." ".$delo->getName(),
    				// 	"name"	=> $delo->getName(),
    				// 	"html"	=> $fond->getName()." ". $opis->getName()." ".$delo->getName(),
    				// 	"lists"	=> [],
    				// ];
    				

    				// foreach($lists AS $list){
    					
					// 	$Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"][$delo->getId()]["lists"]["items"][] 		= $list->getId();
					// 	$Tree["fonds"][$fond->getId()]["opisi"][$opis->getId()]["dela"][$delo->getId()]["lists"][$list->getId()]	= [
					// 		"name"	=> $list->getList()
					// 	];
    				// 	// "name"	=> $delo->getName(),
    				// 	// "lists"	=> [],
    				
    				// }
    				
    			};
            }


        }
        echo "</pre>";

    }

    public static function trim_value(&$value)
    {
        $value  = ucwords($value);
        $value  = trim($value);
    }

    public function test1()
    {

        // $q = "                                                  дементьев                      ";
        // // $q  = ucfirst($q);
        // $q  = mb_convert_case($q, MB_CASE_TITLE, "UTF-8");
        // // $q = trim($q);
        // echo "Q".$q."S";
        
        $persons    = [];
        // $persons1 = Card::findAllByWhere("DISTINCT persons", " ORDER BY persons");
        // $persons1 = Card::findAllByWhere("DISTINCT persons", " ORDER BY persons");
        // $SQL    = "ORDER BY name;";
    	// $fonds	= Fond::findAllByColumnWhere($SQL);

        $persons1 = Card::query('SELECT DISTINCT persons FROM cards ORDER BY persons;');

        echo "<pre>";
        
        // var_dump($persons1);
        
        foreach($persons1 AS $person){
            
            $tmp  = explode(", ", ucwords($person->persons));
            
            array_walk($tmp, 'self::trim_value');
            // $tmp = trim($person->persons, " ");
            // $tmp = trim($person->persons, " ");
            // $tmp = trim($person->persons, " ");
            // echo("<br>");
            // print_r($tmp);
            foreach($tmp AS $t)
            {
                // echo("<hr>");
                // echo($t);
                // echo("<br>");
                
                $words  = explode(" ", $t);
                // print_r($words);
                
                $t = '';
                foreach($words AS $word)
                {
                    // echo("<br>");
                    // echo $word;
                    $w   = strtolower($word);
                    $w   = ucfirst($w);
                    $w   = mb_convert_case($w, MB_CASE_TITLE, "UTF-8");
                    $word   = trim($w);
                    $t      .= $word." ";


                }

                // $persons[] = ucfirst(ucwords($t));
                $t  = trim($t);
                // $t  = (strtolower($t));
                // $t  = ucfirst($t);
                // $t  = ucwords($t);

                // $persons[] = ucfirst($t);
                $persons[] = $t;

                
                // echo("<br>");
                // echo($t);
            }
            
        }
    
        sort($persons);

        $persons    = array_unique($persons);

        foreach($persons AS $person)
        {
            echo("<br>");
            echo(ucfirst($person));
        }

        // var_dump($persons);
        echo "</pre>";
        

    }
    
    public function test2()
    {
        
        // Получаю все карточки из гдавной таблицы по ним cards
        
        $cards = Card::findAll();
        
        // проход по карточкам вывод для каждой из них списка персоналий
        
        echo "<pre>";
        foreach($cards AS $card)
        {
            
            echo("<hr>");
            $card_id    = $card->getId();
            print_r($card_id);

            echo ":<br>";

            $persons_str    = $card->getPersons();
            echo $persons_str."^";

            // if ($persons_str=="") continue;

            $persons_arr    = explode(", ", $card->getPersons());

            // // print_r($persons_arr);

            // $persons    = [];

            echo "<br>-----------------";
            foreach($persons_arr AS $person)
            {
            //     $person = trim($person," ");
                $person = str_replace("  ", " ", $person);
            //     echo "<br>->".strlen($person),"->".$person;

                $person_id = PersonTest::findOneByColumn("old", $person);
                if ($person_id === null) continue;
                if ($person_id->getNew() === "") continue;
                echo "<br>";
                // $new_person = $person_id->getNew();
                $person_new = Person::findOneByColumn("name", $person_id->getNew());
                // $new_person = $person_id->getNew();
                echo "<br>".$person_new->getId()." |-> ".$person_new->getName();

                $card_person    = new CardPerson();
                $card_person->setCard($card_id);
                $card_person->setPerson($person_new->getId());
                $card_person->save();
            }

            // echo "<br>=>>>>>>>";
            // echo implode(", ",$persons);
            // // print_r($persons);

            
        }

        echo "</pre>";

    }
    
    public function test()
    {
        
        // Получаю все карточки из гдавной таблицы по ним cards
        
        $cards = Card::findAll();
        
        // проход по карточкам вывод для каждой из них списка персоналий
        
        echo "<pre>";
        foreach($cards AS $card)
        {
            
            echo("<hr>");
            $card_id    = $card->getId();
            print_r($card_id);

            echo ":<br>";

            $persons_str    = $card->getPersons();
            echo $persons_str."^";

            if ($persons_str==="")
            {
                continue;
            }

            print_r($card->getCardPersons($card));
            // $persons_arr    = explode(", ", $card->getPersons());

            // echo "<br>-----------------";
            // foreach($persons_arr AS $person)
            // {
            // //     $person = trim($person," ");
            //     $person = str_replace("  ", " ", $person);
            //     echo "<br>->".$person;

            //     $person_id = PersonTest::findOneByColumn("old", $person);
            //     if ($person_id === null) continue;
            //     if ($person_id->getNew() === "") continue;
            //     // echo "<br>";
            //     // $new_person = $person_id->getNew();
            //     $person_new = Person::findOneByColumn("name", $person);
            //     if ($person_new === null) continue;
            //     // $new_person = $person_id->getNew();
            //     echo " |-> ".$person_new->getId()." |-> ".$person_new->getName();

            //     // $card_person    = new CardPerson();
            //     // $card_person->setCard($card_id);
            //     // $card_person->setPerson($person_new->getId());
            //     // $card_person->save();
            // }

            // // echo "<br>=>>>>>>>";
            // // echo implode(", ",$persons);
            // // // print_r($persons);

            
        }

        echo "</pre>";

    }

    public function poisktest()
    {
        // $this->view->renderHtml('404.php', ['articles' => $articles,'title' => $title, 'user'=>$this->user]);
        $this->view->renderHtml('poisk/poisk-test.php', []);
    }

    public function poisk()
    {

        $Fields = [
            'doc_type',
            'event_date',
            'card_date',
            'event_place',
            'card_place',
            'doc_header',
            // 'new_fond',
            // 'new_opis',
            // 'new_delo',
            // 'new_list',
            'original',
            'langs',
            'playback',
            'state',
            'compiler',
            'compilation_date',
            'summary',
            // 'thems',
            // 'new_thems',
            // 'new_person',
            // 'persons',
            // 'edit_card',
        ];

        $FiltrFields = [
            'doc_type_filtr',
            'event_date_filtr',
            'doc_header_filtr',
            'original_filtr',
            'langs_filtr',
            'playback_filtr',
            'state_filtr',
            'compiler_filtr',
            'compilation_date_filtr',
            'summary_filtr',
            'thems_filtr',
            'persons_filtr',
        ];
        // $this->user = UsersAuthService::getUserByToken();
        // $this->view = new View(__DIR__ . '/../../../templates');
        // $this->view->setVar('user', $this->user);


        // if ($this->user === null) {
        //     throw new UnauthorizedException();
        // }

        // $this->view2    = new View(__DIR__ . '/../../../templates');
        // $this->view->setVar('view2', $this->view2);

        // echo "<pre>";
    	// echo "СПИСОК";
    	$msg        = [];
    	$error      = [];
        $persons    = Person::findAllByASC("name");
        $cards      = Card::findAllByASC("doc_header");
        $ThemList   = ThemList::findAllByASC("name");

        // var_dump($persons);
        $count_all	= count($persons);
        $this->view->setVar('count_all', $count_all);

        $cards_poisk    = [];
        
        if (!empty($_POST)){

            $lines  = [];
            foreach($Fields AS $field)
            {
                $con1   = (!isset($_REQUEST[$field."_filtr"]));
                $con2   = ($_REQUEST[$field."_filtr"]=="0");
                $con3    = (strlen($_REQUEST[$field])>0);
                $con    = (($con1))||(($con2)||(!$con3));
                // echo "<br>".$field."    >   ".$con1."    >   ".$con2."    >   ".$con;
                
                // Пропускаем невыбранные и не поступившие в форме поля фильтра поиска
                // if ((!isset($_REQUEST[$field."_filtr"]))||($_REQUEST[$field."_filtr"]=="0"))
                if ($con){
                    continue;
                }

                if ($_REQUEST[$field."_filtr"]=="1")
                {

                    $lines[] = '('.$field.' = "'.$_REQUEST[$field].'")';
                }

                if ($_REQUEST[$field."_filtr"]=="2")
                {

                    $lines[] = '('.$field.'<>"'.$_REQUEST[$field].'")';
                }

                if ($_REQUEST[$field."_filtr"]=="3")
                {

                    $lines[] = '('.$field.' LIKE "%'.$_REQUEST[$field].'%")';
                }

                if ($_REQUEST[$field."_filtr"]=="4")
                {

                    // echo "@@@@@@@@@@@@", $_REQUEST[$field];
                    $tmp        = explode(",", $_REQUEST[$field]);
                    // print_r($tmp);
                    // foreach($tmp AS $k=>$v)
                    // {
                        $t      = str_replace('"', "", $tmp);
                        $tmp    = str_replace("'", "", $t);
                        $tmp    = "'".implode("', '", $tmp)."'";
                        $tmp    = str_replace(", ' ", ", '", $tmp);

                        // print_r($tmp);
                        // str_re
                    // }
                    // $lines[]    = '('.$field.' IN ('.$_REQUEST[$field].'))';
                    $lines[]    = '('.$field.' IN ('.$tmp.'))';
                }

            }

            
            // echo "<pre>";
            // echo "<br>";
            // var_dump($_REQUEST);

            // echo "<hr>{".$_POST["shifr_filtr"]."}";


            // echo "<pre>";
            // echo "<br>";
            // echo $_REQUEST["fond"];
            // echo "<br>";
            // echo $_REQUEST["opis"];
            // echo "<br>";
            // echo $_REQUEST["delo"];
            // echo "<br>";
            // echo $_REQUEST["list"];

            // $fond_name  = Fond::findOneByColumn("name", $_REQUEST["fond"]);
            // var_dump($fond_name->getId());
            // $opis_name  = Opis::findOneByColumn("name", $_REQUEST["opis"])->getId();
            // $delo_name  = Delo::findOneByColumn("name", $_REQUEST["delo"]);
            // $list_name  = $_REQUEST["list"];

            // echo "<pre>";
            // echo "<hr>". $_REQUEST["fond"];
            // echo "<hr>". $_REQUEST["opis"];
            // var_dump($opis_name);
            // echo "<hr>". $_REQUEST["delo"];
            // var_dump($delo_name);

            if ((isset($_POST["shifr_filtr"]))&&($_REQUEST["shifr_filtr"]>0)){

                // $shifrs = [];
                // $fonds  = [];
                // if ($_REQUEST["fond_filtr"]=="1")
                // {

                // }
            

                
                $shifrs     = Shifr::getShifrPoisk($_REQUEST);
                // var_dump($shifrs);

                if (count($shifrs)>0)
                {
                    $lines[]    = '(shifr_id IN ('.implode(',', $shifrs).'))';
                }

                // if ($_REQUEST["shifr_filtr"]=="1")
                // {
                //     $SQL_shifr = 'SELECT * FROM shifr ';
                //     $WHR_shifr = 'WHERE (fond=""';

                //     $fond_name  = Fond::findOneByColumn("name", $_REQUEST["fond"]);
                //     $opis_name  = Opis::findOneByColumn("name", $_REQUEST["opis"]);
                //     $delo_name  = Delo::findOneByColumn("name", $_REQUEST["delo"]);


                //     $lines[] = '('.$field.' = "'.$_REQUEST[$field].'")';
                // }

                if ($_REQUEST[$field."_filtr"]=="2")
                {

                    $lines[] = '('.$field.'<>"'.$_REQUEST[$field].'")';
                }

                if ($_REQUEST[$field."_filtr"]=="3")
                {

                    $lines[] = '('.$field.' LIKE "%'.$_REQUEST[$field].'%")';
                }
            }


            // Если включено поле персоналии в фильтре карточки и есть значения поля персоналии - те которые только добавились
            if ((intval($_REQUEST["persons_filtr"])>0) &&(isset($_REQUEST["persons"]))&&(count($_REQUEST["persons"])>0))
            {
                $persons_filtr  = $_REQUEST["persons_filtr"];
                $persons_field  = $_REQUEST["persons"];
                // var_dump($persons_field);

                $persons    = [];
                $SQL        = "";
                switch ($persons_filtr) {
                    case 1:
                        # code...
                        $WNR    = [];
                        foreach($persons_field AS $person)
                        {
                            $WNR[]  = "(name = '".$person."')";
                        }

                        $SQL    = "SELECT * FROM persons WHERE (".implode(" AND ",$WNR).")";
                        break;

                    case 2:
                        $WNR    = [];
                        foreach($persons_field AS $person)
                        {
                            $WNR[]  = "(name <> '".$person."')";
                        }

                        $SQL    = "SELECT * FROM persons WHERE (".implode(" AND ",$WNR).")";
                        break;

                    case 3:

                        $WNR    = [];
                        foreach($persons_field AS $person)
                        {
                            $WNR[]  = "(name LIKE '%".$person."%')";
                        }

                        $SQL    = "SELECT * FROM persons WHERE (".implode(" OR ",$WNR).")";
                        break;

                    default:
                        # code...
                        $SQL    = "SELECT * FROM persons WHERE name IN ('".implode("','", $persons_field)."')";
                        break;
                }

                // echo "<hr>";
                // var_dump($SQL);

                $tmp            = Person::query($SQL);
                // var_dump($tmp);
                $persons  = [];
                
                if ($tmp!==null)
                {

                    foreach ($tmp as $ti) {
                        # code...
                        $persons[]    = $ti->getId();
                    }
                }

                // $card_persons = "(".implode(', ',$persons).")";
                $card_persons = [];

                // echo "<hr>";
                var_dump($card_persons);
                // echo "<hr>";
                
                $SQL    = "SELECT * FROM cards_persons WHERE person IN (".implode(', ',$persons).")";
                // echo $SQL;
                $tmp    = CardPerson::query($SQL);
                // var_dump($tmp);

                $WHR_persons    = " ";
                if ($tmp!==null)
                {

                    foreach ($tmp as $ti) {
                        # code...
                        $card_persons[]    = $ti->getCard();
                    }

                    if (count($card_persons)>0)
                    {
                        $WHR_persons    = ' (id IN ('.implode(', ', $card_persons).'))';
                    }
                }


                $lines[]    = $WHR_persons;

                
            }

            /// Тематики
            // Отбираем ранее и только что выбранные тематики
            // echo "<hr>/// Тематики";
            $con1   = ((isset($_REQUEST["thems_filtr"]))&&((intval($_REQUEST["thems_filtr"])>0)));
            $con2   = (isset($_REQUEST["thems"]))&&(count($_REQUEST["thems"])>0);
            $con3   = (isset($_REQUEST["new_thems"]))&&(count($_REQUEST["new_thems"])>0);
 
            // Если были хоть какие-то тематики то обрабатываем по ним
            // if ((intval($_REQUEST["thems_filtr"])>0) &&(isset($_REQUEST["thems"]))&&(count($_REQUEST["thems"])>0))
            if (($con1) &&(($con2)||($con3)))
            {
                // echo "12345";
                $thems_filtr    = $_REQUEST["thems_filtr"];

                $tmp            = [];
                $thems_field    = [];

                // if (count($_REQUEST["thems"])>0){
                if ($con2){
                    $thems_field    = array_merge($tmp, $_REQUEST["thems"]);
                }
                
                // if (count($_REQUEST["new_thems"])>0){
                if ($con3){
                    $thems_field    = array_merge($thems_field, $_REQUEST["new_thems"]);
                }

                // var_dump($thems_field);

                $persons    = [];
                $SQL        = "";
                switch ($thems_filtr) {
                    case 1:
                        # code...
                        $WNR    = [];
                        foreach($thems_field AS $person)
                        {
                            $WNR[]  = "(name = '".$person."')";
                        }

                        $SQL    = "SELECT * FROM thems_list WHERE (".implode(" AND ",$WNR).")";
                        break;

                    case 2:
                        $WNR    = [];
                        foreach($thems_field AS $person)
                        {
                            $WNR[]  = "(name <> '".$person."')";
                        }

                        $SQL    = "SELECT * FROM thems_list WHERE (".implode(" AND ",$WNR).")";
                        break;

                    case 3:

                        $WNR    = [];
                        foreach($thems_field AS $person)
                        {
                            $WNR[]  = "(name LIKE '%".$person."%')";
                        }

                        $SQL    = "SELECT * FROM thems_list WHERE (".implode(" OR ",$WNR).")";
                        break;

                    default:
                        # code...
                        $SQL    = "SELECT * FROM thems_list WHERE name IN ('".implode("','", $thems_field)."')";
                        break;
                }

                // echo "<hr>";
                // var_dump($SQL);

                $tmp            = ThemList::query($SQL);
                // var_dump($tmp);
                $thems  = [];
                
                if ($tmp!==null)
                {

                    foreach ($tmp as $ti) {
                        # code...
                        $thems[]    = $ti->getId();
                    }
                }
                // var_dump($thems);

                // $card_persons = "(".implode(', ',$persons).")";
                $card_thems = [];

                // echo "<hr>";
                // var_dump($card_thems);
                // echo "<hr>";
                
                $SQL    = "SELECT * FROM thems WHERE (type_id=6) AND them_id IN (".implode(', ',$thems).")";
                $tmp    = Them::query($SQL);
                // var_dump($tmp);

                $WHR_persons    = " ";
                if ($tmp!==null)
                {

                    foreach ($tmp as $ti) {
                        # code...
                        $card_thems[]    = $ti->getValue();
                    }

                    if (count($card_thems)>0)
                    {
                        $WHR_persons    = ' (id IN ('.implode(', ', $card_thems).'))';
                    }
                }


                $lines[]    = $WHR_persons;

                
            }

            // echo "</pre>";

            // echo "<pre> Получена форма поиска";
            // var_dump($_POST);
            // echo"<hr>";
            // var_dump($lines);
            // echo "</pre>";



            // echo "State:";
            // echo intval((isset($_REQUEST["state"])));
            // echo intval(($_REQUEST["state"]=="1"));


            // if (isset($_POST["poisk-btn"])){
            //     echo "<pre> Запрошены поля:";
            //     print_r(array_keys($_POST));
            //     echo "</pre>";
            // }

            
            if (count($lines)>0)
            {

                $SQL    = 'SELECT * from cards ';
                $WHERE  = implode(" AND ", $lines) ;
                $SQL    .= " WHERE ".$WHERE.";";
                // echo($SQL);
                $cards_poisk    = Card::query($SQL);

                $cards_poisk    = $cards_poisk===null?[]:$cards_poisk;


                for($i=0; $i<count($cards_poisk); $i++)
                {
                    $card               = $cards_poisk[$i];
                    $card               = Card::getCardView($card->getId());
                    $cards_poisk[$i]    = $card;
                }
                // echo "<pre>";
                // var_dump($cards_poisk);
                // echo "</pre>";
            }

            
        }

            $PersonList = Person::findAll();
            // $this->view->renderHtml('poisk/poisk.php', ['persons' => $persons, 'cards' => $cards, 'error' => $error, 'msg'=>$msg, "UserMenu" =>$this->UserMenu]);
            $this->view->renderHtml('poisk/poisk.php', ['ThemList' => $ThemList,'PersonList' => $PersonList, 'cards' => $cards_poisk, 'error' => $error, 'msg'=>$msg, "cards" => $cards_poisk]);

            // echo "<pre>";
            // Shifr::getFondsDataList();
            // echo "</pre>";
    }
}