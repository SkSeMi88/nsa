<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;

use MyProject\Models\Bplaces\Bplace;
use MyProject\Models\Finders\Finder;
use MyProject\Models\Cards\Card;
use MyProject\Models\Users\User;
use MyProject\Models\Shifrs\Shifr;
use MyProject\Models\Fonds\Fond;
use MyProject\Models\Opisi\Opis;
use MyProject\Models\Dela\Delo;

use MyProject\Models\Site\Site;

use MyProject\Models\Thems\ThemList;
use MyProject\Models\Thems\Them;

use MyProject\Models\Persons\Person;
use MyProject\Models\Persons\CardPerson;

use MyProject\Exceptions;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\InvalidArgumentException;


use MyProject\Models\Users\UserActivationService;

use MyProject\Services\EmailSender;
use MyProject\Services\UsersAuthService;

use function PHPSTORM_META\type;

// namespace MyProject\Controllers;


// use MyProject\Models\Bplaces\Bplace;
// use MyProject\Models\Finders\Finder;
// use MyProject\Models\Cards\Card;



// use MyProject\Exceptions\ForbiddenException;
// use MyProject\Models\Articles\Article;
// use MyProject\View\View;


class CardsController extends AbstractController
{

    /** @var View */
    // private $view;

    /** @var Db */
    private $db;

    public function __construct()
    {
        
        // $this->user = UsersAuthService::getUserByToken();
        // $this->view = new View(__DIR__ . '/../../../templates');
        // $this->view->setVar('user', $this->user);

        $this->user = UsersAuthService::getUserByToken();
        // var_dump($this->user);
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
        
        $this->UserMenu	= Site::getUserMenu($this->user);
        $this->view->setVar('UserMenu', $this->UserMenu);

        // $this->view = new View(__DIR__ . '/../../../templates');
        // $this->db = new Db();
        $db = Db::getInstance();
    }

    public function list(): void
    {
        $this->view2    = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('view2', $this->view2);

        // echo "<pre>";
    	// echo "СПИСОК";
    	
        $cards		= Card::findall();
        $count_all	= count($cards);
        $this->view->setVar('count_all', $count_all);
        
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        if (!empty($_POST)){
        	// echo "Получена форма фильтра поиска";
        	$cards			= Card::findByFiltrForm();
        	// $page_num		= Card::getPageNum($cards);
        	$count_filtr	= count($cards);
        }
        
        // $cards		= Card::findall();
        
        // var_dump($cards);
        
        // $bplace = Bplace::getById($card->getBplaceId());
		// $card->bplace = $bplace;
		// $card->finder = Finder::getById($card->getFinderId());
            
        //    var_dump($card->finder);
        //    var_dump($bplace->getPunkt());
        // var_dump($this->user);

        if ($cards === null) {
        	echo ">>>>>>>>";
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
        // echo "</pre>";
        // $this->view->renderHtml('cards/list2.php', ['card' => $card,'bplace' => $bplace]);
        // $this->view->renderHtml('cards/list2.php', ['cards' => $cards]);
        $this->view->renderHtml('cards/list_filtr.php', ['cards' => $cards]);
    }

    public function view(int $cardId): void
    {
    
  //  	echo "<pre>";
		// var_dump($this);
  //  	echo "</pre>";

		// var_dump($this->user->getRole());
		
        // if ($this->user === null) {
        //     throw new UnauthorizedException();
        // }

        // if ($this->user->getRole()!="user")
        // if (!in_array($this->user->getRole(),["user","admin"]))
        // {
        //     throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        // }

        
    	// echo"<pre>";
        $card = Card::getById($cardId);
        // var_dump($card);
        $bplace = Bplace::getById($card->getBplaceId());

        // var_dump($bplace);
        // var_dump($bplace->getPunkt());
        // var_dump($this->user);

        if ($card === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        // $this->view->renderHtml('cards/view.php', ['card' => $card,'bplace' => $bplace]);
        // $this->view->renderHtml('cards/view3.php', ['card' => $card]);
        $this->view->renderHtml('cards/view4.php', ['card' => $card]);
    }

    public function add(): void
    {

        // print_r($_POST);
        $Finder = Finder::getById(Finder::getMaxId());

        // var_dump($this->user);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        // if ($this->user->getRole()!="user")
        if (!in_array($this->user->getRole(),["user","admin"]))
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        if (!empty($_POST)) {
            // echo "<pre>";
            try {

                $card = CARD::createFromArrayForm($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('cards/add.php', ['error' => $e->getMessage()]);
                return;
            }
            // echo "Пришла форма";
            // echo "</pre>";
            header('Location: /cards/' . $card->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('cards/add.php',["Finder"=> $Finder]);
        
    }

    public function edit()
    {

        // var_dump($this->user);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        // if ($this->user->getRole()!="user")
        if (!in_array($this->user->getRole(),["user","admin"]))
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }



        $new_card   = [];

        $spec_chars = ["*", "!", "?", "(", ")", "{", "}", "[", "]"];

        $fullname   = "";

        echo "<pre>";
        var_dump($_POST);
        $result     = [];

        if (empty($_POST))
        {
            echo "Ошибка ввода.";
            echo '<a href="//">На главную</a>';
            exit();
        }

        $fnames_title    = explode(',',$_POST["fname"]);
        var_dump($fnames_title);

        $names_title    = explode(',',$_POST["name"]);
        var_dump($names_title);

        $snames_title    = explode(',',$_POST["sname"]);
        var_dump($snames_title);
        
        $byears_title    = explode(',',$_POST["byear"]);
        var_dump($byears_title);
        
        $punkt      = $_POST["punkt"];
        $volost     = $_POST["volost"];
        $uezd       = $_POST["uezd"];

        var_dump($punkt);
        var_dump($volost);
        var_dump($uezd);

        $photo       = $_POST["photo"];
        var_dump($photo);

        $prim       = $_POST["prim"];
        var_dump($prim);

        $fond       = $_POST["fond"];
        $opis       = $_POST["opis"];
        $delo       = $_POST["delo"];
        $list       = $_POST["list"];

        var_dump($fond);
        var_dump($opis);
        var_dump($delo);
        var_dump($list);

        $r_fields   = [
            "fnames"        => "Фамилия",
            "names"         => "Имя",
            "snames"        => "Отчество",
            "byears"        => "Год рождения"
        ];

        $arr = get_defined_vars();

        foreach($r_fields AS $k => $v ){

            echo "<hr>$k $v";
            $tmp    = $arr[$k."_title"];
            var_dump($tmp);

            if ((count($tmp)==0)&&($k!="snames")){
                $result["status"] = false;
                $result["errors"] = "Поле ".$v." должно содержать минимум одно значение.";
            }

            foreach($tmp AS $kk =>$vv)
            {

                if (($k=="byears")&&(strlen($vv)==0)){
                    $result["status"] = false;
                    $result["errors"] = "Поле год рождения содержит некорректное значение ".$vv;
                    continue;
                }
                print_r($vv);
                if ((strlen($vv)<3)&&($k!="byears")){
                    $result["status"] = false;
                    $result["errors"] = "Поле".$v."содержит некорректное значение ".$vv;
                    continue;
                }   

            }

                // массив значений поля карточки как было записано специалистом
                $field_arr_title    = $tmp;

                //Создаем для заполнения массивом значения поля карточки после удаления из них спец символов неопределенности
                $field_arr          = [];//$field_arr_title;

                // вычиcление кол-ва значений в поле карточки по самым исходным данным записанным специалистом
                $field_arr_len      = count($field_arr_title);

                // по умолчанию все хорошо  соответствие между введенными значениями и истинными
                $field_arr_state    = 1;
                
                // Для каждого поля карточки перебор каждого значения поля карточки с добавлением их в отд. массив без спец символов
                for ($i=0; $i < count($field_arr_title) ; $i++) {
                    echo "<br>+>>".$field_arr_title[$i];
                    $field_arr[]    = str_ireplace($spec_chars, "", $field_arr_title[$i]);
                }
                // echo "<br>>>".$field_arr[0];

                // print_r($field_arr);
                // Конкатенация полного ФИО для карточки из первых значений этих полей без спец символов
                $fullname   .=($k!="byears")?$field_arr[0]." ":"";
                // if ($k!="byears"){
                //     $fullname   .=$field_arr[0]." ";
                // }

                echo "<br>>>".$fullname;

                $field_str_title    = implode(", ", $field_arr_title);
                $field_str          = implode(", ", $field_arr);
                $field_arr_state    = ($field_str!==$field_str_title)?0:1;

                $new_card[$k]             = $field_str;;
                $new_card[$k."_title"]    = $field_str_title;
                $new_card[$k."_len"]      = $field_arr_len;
                $new_card[$k."_state"]    = $field_arr_state;
            echo "<br>".count($tmp);
        }

        $new_card["fullname"]   = $fullname;
        $check_bplace = true;

        if ((strlen($punkt)+strlen($volost)+strlen($uezd))<4){
            $check_bplace = false;
            $result["status"] = false;
            $result["errors"] = "Место рождения  должно содержать минимум одно значение. ";
        }
        

        $r_fields   = [
            "fond"  => "Фонд",
            "opis"  => "Опись",
            "delo"  => "Дело",
            "list"  => "Лист"
        ];

        
        foreach($r_fields AS $k => $v ){

            echo "<br>$v";
            $tmp    = $arr[$k];
            print_r($tmp);

            if (strlen($tmp)==0){
                $result["status"] = false;
                $result["errors"] = "Поле ".$v." должно содержать минимум одно значение.";
            }

        }

        var_dump($result);
        $new_bp = [
            "punkt"     => $punkt,
            "volost"     => $volost,
            "uezd"     => $uezd,
        ];

        $new_bp_id  = Bplace::getRecordByFields($new_bp);

        print_r($new_bp_id);

        $new_finder = [
            "fond"     => $fond,
            "opis"     => $opis,
            "delo"     => $delo,
            // "list"
        ];
        echo "<hr>";
        $new_finder_id  = Finder::getRecordByFields($new_finder);
        print_r($new_finder_id);

        $fnames_value       = [];
        $names_value        = [];
        $snames_value       = [];
        $byears_value       = [];


        $new_card["finder_id"] = $new_finder_id;
        // $new_card["fullname"]  = $new_card["fnames"][0]." ".$new_card["names"][0]." ".$new_card["snames"][0];
        $new_card["list"]      = $list;



        $bplace_arr = [
        ];

        $bplace_fields  =  ["punkt", "volost", "uezd"];
        foreach($bplace_fields AS $field){
            $bplace_arr[$field] = $_POST[$field];
        }

        $new_card["bplace_id"]  = Bplace::getRecordByFields($bplace_arr);
        $finder_arr = [
            "fond" => $_POST["fond"],
            "opis" => $_POST["opis"],
            "delo" => $_POST["delo"]
        ];
        $new_card["finder_id"]  = Finder::getRecordByFields($finder_arr);

        $new_card["photo"]  = $_POST["photo"];
        $new_card["prim"]  = $_POST["prim"];


        /*
            + 1 получить все пришедшие значения полей
            + 2 проверка наличия валидных значений у обязательных полей карточки(фио, год),  фото, поиск данные и место отдельно
            + 3 определить/получить ид-р места рождения
            + 4 оперделить/получить ид-р поисковых данных () (ид-р от значений полей)
            + 5 вычислить для  каждого обязательного поля value, title,state, len
            + 6 вычислить полное имя кб
            + 7 создать объект карточка
            8 сеттерами устанвоиьт все значения
            9 сохранить
            10 результат вывести(переадресация на карточку/лог область)

        */
        echo "<hr>*************************************************";
        print_r($new_card);

        $card = Card::getById2($_POST['card_id']);

        //     $entities->bplace    = Bplace::getById($entities->getBplaceId());
        //     $entities->finder    = Finder::getById($entities->getFinderId());

        var_dump($card);
        $card->setPrim("TEST");

        if ($card->getFnameTitle()!=$_POST['fname'])
        {
            print_r($card->getFname());
            print_r($_POST['fname']);

            $card->setFname($new_card['fnames']);
            $card->setFnameTitle($new_card['fnames_title']);
            $card->setFnameLen($new_card['fnames_len']);
            $card->setFnameState($new_card['fnames_state']);
            $card->setFullname($new_card['fullname']);
        }


        if ($card->getNameTitle()!=$_POST['name'])
        {
            print_r($card->getName());
            print_r($_POST['name']);

            $card->setName($new_card['names']);
            $card->setNameTitle($new_card['names_title']);
            $card->setNameLen($new_card['names_len']);
            $card->setNameState($new_card['names_state']);
            $card->setFullname($new_card['fullname']);
        }

        if ($card->getSnameTitle()!=$_POST['sname'])
        {
            print_r($card->getSname());
            print_r($_POST['sname']);

            $card->setSname($new_card['snames']);
            $card->setSnameTitle($new_card['snames_title']);
            $card->setSnameLen($new_card['snames_len']);
            $card->setSnameState($new_card['snames_state']);
            $card->setFullname($new_card['fullname']);
        }

        print_r($card->getByearTitle());
        print_r($_POST['byear']);
        if ($card->getByearTitle()!=$new_card['byears'])
        {
            print_r($card->getByearTitle());
            print_r($_POST['byear']);

            $card->setByear($new_card['byears']);
            $card->setByearTitle($new_card['byears_title']);
            $card->setByearLen($new_card['byears_len']);
            $card->setByearState($new_card['byears_state']);
        }

        if ($card->getBplaceId()!=$new_card["bplace_id"])
        {
            $card->setBplaceId($new_card['bplace_id']);
        }

        if ($card->getPhoto()!=$new_card["photo"])
        {
            $card->setPhoto($new_card['photo']);
        }
        
        if ($card->getPrim()!=$new_card["prim"])
        {
            $card->setPrim($new_card['prim']);
        }
        
        if ($card->getList()!=$_POST["list"])
        {
            $card->setList($new_card['list']);
        }

        if(($card->getFinderId()!=$new_card["finder_id"]))
        {
            $card->setFinderId($new_card['finder_id']);
        }


        $card->save();
        echo "</pre><hr>";
        echo $card->getFullName();

        
    }

    public function createCard()
    {

        $card       = [];
        $msgs       = [];
        $errors     = [];
        $ThemList   = ThemList::findAll();
        $PersonList = Person::findAll();
      
        //  var_dump($this->user->getFio());

         if ($this->user === null) {
             throw new UnauthorizedException();
         }
/*
         if ($this->user->getRole()!="user")
         {
             throw new ForbiddenException('Не достаточно прав доступа у Вас.');
         }
*/
        if (!empty($_POST)){

            echo "<pre>POST";
            var_dump($_POST);
            echo "</pre>";


            $r_fields = [

                "doc_type"         => "Тип документа",
                "event_date"        => "Дата события",
                "card_date"         => "ДАта составления карточки",
                "event_place"       => "Место события",
                "card_place"        => "Место составления карточки",
                "doc_header"        => "Заголовок документа",
                "new_fond"          => "фонд",
                "new_opis"          => "опись",
                "new_delo"          => "дело",
                "new_list"          => "лист",
                "original"          => "Подлинник/копия",
                "langs"             => "Язык документа",
                "playback"          => "Способ воспроизведения",
                "state"             => "Физическое состояние документа",
                "compiler"          => "Составитель карточки",
                "compilation_date"  => "Дата составления",
                "summary"           => "Аннотация",
                // "persons"           => "Персоналии",
                // "thems"             => "Тематики",
            ];

            
            foreach($r_fields AS $k=>$v)
            {

                // if (in_array($k,["state", "thems"])){
                if (in_array($k,["state"])){
                    $card[$k]   = $_POST[$k];
                    continue;
                }

                if ((!isset($_POST[$k]))||(strlen($_POST[$k])<1))
                // if ((!isset($v))||(strlen($v)<3))
                {
                    $errors[]   = "Ошибка ввода карточки. Поле $v имеет не верное значение $v.";
                }
                $card[$k]   = $_POST[$k];
            }

            // Проверка наличия/либо создание нового шифра из формы создания карточки, POST массива.
            $card_shifr         = Card::checkShifr();
            $card["shifr_id"]   = $card_shifr->getId();



            if ($card_shifr===null)
            {
                $errors[]   = "Ошибка ввода карточки шифр.";
                $this->view->renderHtml('cards/create_card3.php',["errors" => $errors]);
                return(0);
            }

            $card_thems = [];
            if((isset($_POST["new_thems"]))&&(count($_POST["new_thems"])>0))
            {
                foreach($_POST["new_thems"] AS $k=>$v)
                {
                    if ((!isset($v))||(strlen($v)<3))
                    {
                        $errors[]   = "Ошибка ввода. Не корректное значение в поле тематики $v.";
                        continue;
                    }
                    $card_thems[]   = ThemList::checThemByName($v);

                }
            }
            // var_dump($card_thems);
            $card["thems"]  = $card_thems;

            $card_persons = [];
            if((isset($_POST["new_persons"]))&&(count($_POST["new_persons"])>0))
            {
                foreach($_POST["new_persons"] AS $k=>$v)
                {
                    if ((!isset($v))||(strlen($v)<3))
                    {
                        $errors[]   = "Ошибка ввода. Не корректное значение в поле персоналии $v.";
                        continue;
                    }
                    $card_persons[]   = Person::checkPersonExist($v);

                }
            }
            // var_dump($card_persons);
            $card["persons"]  = $card_persons;



            // echo"<pre><hr>";
            // var_dump($card["shifr_id"]);
            // echo"<hr>";
            // var_dump($errors);
            // echo"<hr>";
            // var_dump($card);
            // echo"</pre><hr>";

            
            if (count($errors)>0){
                $this->view->renderHtml('cards/create_card3.php',["errors" => $errors, "ThemList" => $ThemList,  "PersonList" => $PersonList, "msgs" => $msgs]);
                exit;
            }
        }
        
        // echo "QWERTY";
        
        // echo "<pre>";
        // var_dump($card);
        // echo "</pre>";
        if (!empty($_POST)) {

            try {
                $new_card = Card::createCard($card);
            } catch (InvalidArgumentException $e) {
                $errors[]   = $e->getMessage();
                $this->view->renderHtml('cards/create_card3.php',["errors" => $errors, "ThemList" => $ThemList,  "PersonList" => $PersonList, "msgs" => $msgs]);
                return;
            }

            $msgs[] = "Карточка успешно создана.";
            $msgs[] = 'Карточка доступна по <a href="../cards/'.$new_card->getId().'"> ссылке</a>';
            $this->view->renderHtml('cards/create_card3.php',["errors" => $errors, "ThemList" => $ThemList,  "PersonList" => $PersonList, "msgs" => $msgs]);

            // header('Location: /cards/' . $new_card->getId(), true, 302);
            exit();
        }

        // echo"11111111111<hr>";
        // print_r($this->UserMenu);
        $this->view->renderHtml('cards/create_card3.php',["errors" => $errors, "ThemList" => $ThemList,  "PersonList" => $PersonList, "msgs" => $msgs]);

        /*
            в темплейте поставить required для всех обязательны полей
            проверить шифр
            получить его ид или нул
            если нул то вывод с ошибкой форму

            Получить массив названий полученных тем;
            Получить их ид-ры.
            Для новых тем создать их и вернуть ид-ры тоже в едином списке. 

            Получить писок всех имеющихся тем ид-р => название;
            Вывод этих тем перед созданием в даталисте;

            Вывод из ПОСТ массива переданых из формы значений;

            Проверка длины всех обязательных значений


        */
    }

    public function viewCard(int $cardId): void
    {

        $card       = [];
        $msgs       = [];
        $errors     = [];
        $ThemList   = ThemList::findAll();
        $PersonList = Person::findAll();

        if(!empty($_POST["edit_card"]))
        {
            // $them = new ThemList();
            // $them->setName("test");
            // $them->save();
            // var_dump($them);
            // echo "<pre>_POST";
            // var_dump($_POST);

            // Получаю объект карточки до отправки формы для сравнения с поступившими данными.
            $card   = Card::getCardView($cardId);
            // echo"<hr>";
            // var_dump($card);
            // echo "</pre>";
            $new_card   = [];//new Card();

            $r_fields = [

                "doc_type"          => "Тип документа",
                "event_date"        => "Дата события",
                "card_date"         => "Дaта составления карточки",
                "event_place"       => "Место события",
                "card_place"        => "Место составления карточки",
                "doc_header"        => "Заголовок документа",
                "new_fond"          => "фонд",
                "new_opis"          => "опись",
                "new_delo"          => "дело",
                "new_list"          => "лист",
                "original"          => "Подлинник/копия",
                "langs"             => "Язык документа",
                "playback"          => "Способ воспроизведения",
                "state"             => "Физическое состояние документа",
                "compiler"          => "Составитель карточки",
                "compilation_date"  => "Дата составления",
                "summary"           => "Аннотация",
                "persons"           => "Персоналии",
                "thems"             => "Тематики",
            ];

            foreach($r_fields AS $k=>$v)
            {

                if (in_array($k,["state", "thems", "persons"])){
                    $new_card[$k]   = $_POST[$k];
                    continue;
                }

                if ((!isset($_POST[$k]))||(strlen($_POST[$k])<1))
                // if ((!isset($v))||(strlen($v)<3))
                {
                    $errors[]   = "Ошибка ввода карточки. Поле $v имеет не верное значение $v.";
                }
                $new_card[$k]   = $_POST[$k];
            }


            // echo "<pre>new_card";
            // var_dump($new_card);
            // echo "</pre>123<hr>";
            // // echo "123<hr>";

            // Проверка наличия/либо создание нового шифра из формы создания карточки, POST массива.
            $new_card_shifr         = Card::checkShifr();
            // var_dump($new_card_shifr);
            // var_dump($card->getShifrId());
            $new_card_shifr_id      = $new_card_shifr->getId();

            if ($new_card_shifr===null)
            {
                $errors[]           = "Ошибка ввода карточки шифр.";
                // $this->view->renderHtml('cards/view_card.php', ["card" => $card, "errors" => $errors, "ThemList" => $ThemList, "msgs" => $msgs]);
                // exit;
            }

            if (($card->getShifrId() != $new_card_shifr_id)&&($new_card_shifr!==null))
            {
                $card->setShifrId($new_card_shifr_id);
                $new_card["shifr_id"]      = $new_card_shifr_id;
            }

            $new_card["shifr_id"]      = $card->getShifrId();

            $new_card["shifrFullName"] = [
                "fond"  => $_POST["new_fond"],
                "opis"  => $_POST["new_opis"],
                "delo"  => $_POST["new_delo"],
                "list"  => $_POST["new_list"]
            ];

            $card_thems     = Them::findAllByColumnWhere("WHERE (type_id='6') AND (value='".$cardId."')");
            // echo"<hr>card_thems=<pre>";
            // var_dump($card_thems);
            // echo"</pre>";
            // if ((count($_POST["new_thems"])<1)||(!isset($_POST["new_thems"]))){
            //     $errors[]   = "Ошибка ввода. Кaрточка должна иметь минимум одну тематику.";
            //     $this->view->renderHtml('cards/view_card.php', ["card" => $card, "errors" => $errors, "ThemList" => $ThemList, "msgs" => $msgs]);
            //     exit;
            // }

            $new_card_thems = [];

            if((isset($_POST["new_thems"]))&&(count($_POST["new_thems"])>0))
            {
                foreach($_POST["new_thems"] AS $k=>$v)
                {
                    if ((!isset($v))||(strlen($v)<3))
                    {
                        $errors[]   = "Ошибка ввода. Не корректное значение в поле тематики $v.";
                        continue;
                    }
                    $new_card_thems[ThemList::checThemByName($v)]   = ThemList::getById(ThemList::checThemByName($v))->getName();
                }
            }

            // if((isset($_POST["new_thems"]))&&(count($_POST["new_thems"])>0))
            // {
            //     foreach($_POST["new_thems"] AS $k=>$v)
            //     {
            //         if ((!isset($v))||(strlen($v)<3))
            //         {
            //             $errors[]   = "Ошибка ввода. Не корректное значение в поле тематики $v.";
            //             continue;
            //         }
            //         $new_card_thems[ThemList::checThemByName($v)]   = ThemList::getById(ThemList::checThemByName($v))->getName();
            //     }
            // }

            // тематики не должны быть строкой тк должна быть хотя бы одна тематика в карточке
            if (gettype($_POST["thems"])!="string")
            {

                if ((isset($_POST["thems"]))&&(count($_POST["thems"])>0))
                {
                //   echo "<pre>ОБработка тем при изменении карточек</PRE>";
                    foreach($_POST["thems"] AS $k=>$v)
                    {
                        // echo "<br>".$k."=>".$v;
                        if ((!isset($v))||(strlen($v)<3))
                        {
                            // echo "QWERTY";
                            $errors[]   = "Ошибка ввода. Не корректное значение в поле тематики $v.";
                            continue;
                        }
                        $new_card_thems[$k]   = ThemList::getById(ThemList::checThemByName($v))->getName();
                    }
                }
            }

            $new_card["thems"]  = $new_card_thems;

          /*
            echo "<hr>~~~<pre>";
            var_dump($new_card);
            echo "</pre>";
            */

            if ((count($new_card["thems"])<1)||(!isset($new_card["thems"]))){
                $errors[]   = "Ошибка ввода. Кaрточка должна иметь минимум одну тематику.";
                // $this->view->renderHtml('cards/view_card.php', ["card" => $card, "errors" => $errors, "ThemList" => $ThemList, "msgs" => $msgs]);
                // exit;
            }

            // echo "Обработка персоналий";
            // $new_persons    = ((isset($_POST["new_persons"]))&&($_POST["persons"]!==""))?$_POST["new_persons"]:[];
            // // $post_persons   = ((isset($_POST["persons"])))?$_POST["persons"]:[];
            // $post_persons   = ((isset($_POST["persons"]))&&($_POST["persons"]!=="")&&(gettype($_POST["persons"]!="string")))?$_POST["persons"]:[];

            //если появились в добавленных новые персоналии даже из списка то берем этот массив
            $new_persons    = (isset($_POST["new_persons"]))?$_POST["new_persons"]:[];
            
            // воспринимаем уже имеювшиеся персоналии - исключаем не массив
            $post_persons   = ((isset($_POST["persons"]))&&(gettype($_POST["persons"]!="string")))?$_POST["persons"]:[];

            if (gettype($_POST["persons"])=="string")
            {
                $post_persons   = [];
            }

            // echo "<hr>@@@@@@@@@@@@";
            // echo ($_POST["persons"]);
            // var_dump($_POST);
            // var_dump($post_persons);

            $new_card_persons   = $post_persons;

            // var_dump($new_card_persons);

            // Запись всех персоналий в карточке при её изменении - те которые изменились
            if ((isset($new_persons))&&(count($new_persons)>0))
            {
                foreach($new_persons AS $k=>$v)
                {
                    $person = Person::getByName($v);
                    // var_dump($person);
                    $new_card_persons[$person->getId()] = $v;
                    // $card_persona = $card_person->setCardRecord($card->getId(), $v);
                    
                    // if ($card_persona===null)
                    // {
                    //     $errors[]   = "Ошибка ввода. Не удалось сохранить персоналию ".$v;
                    //     break;
                    // }

                }

            }

            /*
            persons: "", [0:N]
            new_persons: [0:N];
            */

            // var_dump($new_card_persons);
            $new_card["persons"]     = $new_card_persons;
            // var_dump($new_card);


            if (count($errors)==0)
            {
                // $new_card["persons"] = "";
                $new_card = Card::editCard($new_card, $cardId);
                if ($new_card===null)
                {
                    $errors[]	= "Ошибка ввода.";
                }
                else{
                    $msgs[]		= "Изменения успешно сохранены!";
                }
            }
            
        }

        
        $card           = Card::getCardView($cardId);
        // $card_persons   = Card::getCardPersons($card);

        
        // var_dump($new_persons);





        $card->setPersons(Card::getCardPersons($card));
        
        // echo "<hr><pre>";
        // echo "Карточка документа № ".$cardId;
        // var_dump($card);
        // echo "</pre>";

        // $this->view->renderHtml('cards/view_card.php',["card" => $card, "errors" => $errors, "ThemList" => $ThemList, "msgs" => $msgs]);
        $this->view->renderHtml('cards/view_card3.php',["card" => $card, "errors" => $errors, "ThemList" => $ThemList, "PersonList" => $PersonList, "msgs" => $msgs]);
    }

    public function viewCardFiles($cardId){

        // echo "Страница находится в разработке на стадии согласования ТЗ.";
        $this->view->renderHtml('cards/view_card_files.php',[]);//["card" => $card, "errors" => $errors, "ThemList" => $ThemList, "msgs" => $msgs]);
    }

    public function deleteCard($cardId){

        $msgs       = ["Карточка помечена на удаление"];
        $errors     = [];
        $ThemList   = ThemList::findAll();
        $PersonList = Person::findAllByASC("name");
        
        // var_dump($this->user);//->getRoleTitle());
        // echo ($this->user!==null);
        // echo intval(!in_array($this->user->getRoleTitle(),["editor", "admin", "root"]));
        if (($this->user===null)||(!in_array($this->user->getRoleTitle(),["editor", "admin", "root"])))
        {
            echo "Вам не доступна данная операция.";
            $errors[]   = "Ошибка ввода.";
            $msgs[]     = "";
        }

        try {
            //code...
            $card           = Card::getById($cardId);
            $card->deleted  = 1;
            $card->save();
        } catch (\Throwable $th) {
            $errors[]   = "Ошибка при удалении карточки";
            $msgs[]     = "";
        }
        $card       = Card::getCardView($cardId);
        // echo "<pre>";
        // var_dump($card);
        // echo "</pre>";

        $this->view->renderHtml('cards/view_card3.php',["card" => $card, "errors" => $errors, "ThemList" => $ThemList, "PersonList" => $PersonList, "msgs" => $msgs]);
    }
    
    public function deletedList()
    {
        $deleted_cards  = [];
        $tmp            = Card::findAllByColumnWhere(' WHERE (deleted=1) ORDER BY id;');
        
        foreach($tmp AS $card)
        {
            $deleted_cards[$card->getId()] = Card::getCardView($card->getId());
            
        }
        // var_dump($deleted_cards);
        
        
        $this->view->renderHtml('cards/deleted_list.php',["cards" => $deleted_cards]);
    }
    
    public function listCards()
    {
        // $cards  = Card::findAll();
        // $this->view->renderHtml('cards/list_cards.php',["cards" => $cards]);
        
        $list_cards = [];
        $tmp        = Card::findAllByColumnWhere(' WHERE ((deleted IS NULL) OR (deleted ="0")) ORDER BY id;');
        // $tmp  = Card::findAll();
        // var_dump($tmp);
        
        if (($tmp!==null))
        {
            foreach($tmp AS $card)
            {
                $list_cards[$card->getId()] = Card::getCardView($card->getId());
                
            }
        }
        
        // var_dump($list_cards);
        
        $this->view->renderHtml('cards/list_cards.php',["cards" => $list_cards]);
    }
}



/*
    Получение наименование шифра по его ид-ру
    Вывод  наименований шифра в карточке документа
    Страница вывода изображений карточки документа - заглушка.
    Получение количества изображений документа.
    Вывод этого количества на кнопке со сылкой на просмотр изображений.

*/

