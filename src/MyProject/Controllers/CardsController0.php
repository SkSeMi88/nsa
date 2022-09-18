<?php


namespace MyProject\Controllers;


use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;


use MyProject\Models\Bplaces\Bplace;
use MyProject\Models\Finders\Finder;
use MyProject\Models\Cards\Card;
use MyProject\Models\Users\User;

// use MyProject\Services\UsersAuthService;

use MyProject\Exceptions;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\UnauthorizedException;

// use MyProject\Exceptions\InvalidArgumentException;


use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;

use MyProject\Services\UsersAuthService;



// namespace MyProject\Controllers;


// use MyProject\Models\Bplaces\Bplace;
// use MyProject\Models\Finders\Finder;
// use MyProject\Models\Cards\Card;



// use MyProject\Exceptions\ForbiddenException;
// use MyProject\Models\Articles\Article;
// use MyProject\View\View;

// use MyProject\Models\Users\User;

// use MyProject\Services\UsersAuthService;

// use MyProject\Exceptions\UnauthorizedException;

// use MyProject\Exceptions\InvalidArgumentException;



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
    

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        // if ($this->user->getRole()!="user")
        if (!in_array($this->user->getRole(),["user","admin"]))
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        
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

        // echo "<pre><hr>Поступила форма";

        // var_dump($fields);

        // $bplace->setAuthor($author);

        // $card->setFinderId($new_finder_id);
        // $card->setList($_POST['list']);
        // $card->setFullName($new_card['fullname']);


        // $card->setFname($new_card['fname']);
        // $card->setFnameTitle($fields['fname_title']);
        // $card->setFnameLen($fields['fname_len']);
        // $card->setFnameState($fields['fname_state']);

        // $card->setName($fields['name']);
        // $card->setNameTitle($fields['name_title']);
        // $card->setNameLen($fields['name_len']);
        // $card->setNameState($fields['name_state']);

        // $card->setSname($fields['sname']);
        // $card->setSnameTitle($fields['sname_title']);
        // $card->setSnameLen($fields['sname_len']);
        // $card->setSnameState($fields['sname_state']);

        // $card->setByear($fields['byear']);
        // $card->setByearTitle($fields['byear_title']);
        // $card->setByearLen($fields['byear_len']);
        // $card->setByearState($fields['byear_state']);

        // $card->setPhoto($_POST['photo']);

        // if ($card->getBplaceId()==$new_bp_id){
        //     $card->setBplaceId($new_bp_id);
        // }
        

        // if ((!empty($_POST["prim"]))&&(isset($_POST["prim"]))){
        //     $card->setPrim($_POST["prim"]);
        // }
        
    }
}