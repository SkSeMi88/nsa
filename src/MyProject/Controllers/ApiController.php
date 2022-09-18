<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Models\Articles\Article;
use MyProject\Models\BP_lists\BP_list;
use MyProject\Models\Bplaces\Bplace;
use MyProject\Models\Finders\Finder;
use MyProject\Models\Cards\Card;
use MyProject\View\View;

use MyProject\Models\Users\User;

use MyProject\Services\UsersAuthService;

use MyProject\Exceptions\UnauthorizedException;

use MyProject\Exceptions\InvalidArgumentException;

use MyProject\Exceptions\NotFoundException;

class ApiController  //extends AbstractController
{
    /** @var View */
    // private $view;

    public function live_search()
    {
        //        var_dump(BP_list::getById(1));
        //        print_r($_REQUEST);
        //        print_r($_POST);
        if ((!isset($_REQUEST["bp_type"]))||(!isset($_REQUEST["bp_value"]))){
            return (null);
            exit();
        }

        $columns = [
            1   => "punkt",
            2   => "volost",
            3   => "uezd"
        ];

        $response = Bplace::findAllByColumnLike($columns[$_REQUEST["bp_type"]], $_REQUEST["bp_value"]);


        // $result = ' <ul>';
        $result = ' <ul id="live_search_r'.$_REQUEST["bp_type"].'" class="live_search_items">';
        // $result = '<a href="/" onclick="return false; alert(25);">Нажми здесь</a>';
        // $result .= '<li><a href="/" onclick="event.preventDefault(); alert(25);">Нажми здесь</a></li>';
        // $i =0;
        // print_r($response);
        foreach($response AS $i=>$o)
        {

            // print_r($o);
            $tmp = [
                "id"    => $o->getId(),
                "t1"    => $o->getPunkt(),
                "t2"    => $o->getVolost(), 
                "t3"    => $o->getUezd()
            ];

            // print_r($tmp);
            $param2 = implode("^", $tmp);
            // print_r($param2);
            // // $param2 = str_replace('"', "'", json_encode($tmp));
            // // $param2 = json_encode($tmp);

            // $p = "'Нажми это ". $param2."'";
            $p = $_REQUEST["bp_type"].",'". $param2."'";

            $result .= '<li><a href="/" onclick="event.preventDefault(); SelectedLiveSearch('.$p.');">'.$o->getFullName().'</a></li>';
            // echo $result;
        }

        $result .= ' </ul>';
            // $result .='<li>';
            // // $result .='<a href="/" onclick="event.preventDefault(); SelectedSearch('.$param2.');">';
            // $result .='<a href="/" onclick="event.preventDefault(); alert('.$param2.');">';
            // // $result .='<a href="/" onclick="event.preventDefault(); SelectedSearch('.$param2.');"'
            // $result .= $o->getFullName();
            // $result .='</a>';
            // $result .='</li>';

//            echo '<li><a href="#" onClik="SelectLiveSearch('.$columns[1].'",this.value)"></a></li>';

            // $result .= '<li class="live_search_items" onCliсk="event.preventDefault(); SelectLiveSearch('.$columns[1].'",this.value);">'.$o->getFullName().'</label></li>';
            // // $result .= '<li class="live_search_items" onCliсk="SelectLiveSearch('.$columns[1].'",'.$param2.');">'.$o->getFullName().'</li>';
            // $result .= '<li class="live_search_items">';
            // // $result .= '<a href="'.$param2.'" onCliсk="return false;">';
            // $result .= '<a href="/" onCliсk="event.preventDefault();console.log('."'".$param2."'".');">';
            // $result .= $o->getFullName().'</a></li>';

            // $result .= '<div class="r_items" onCliсk="console.log('.random_int(1, 25).')"><label>'.$o->getFullName().'</label></div>';

             // onCliсk="SelectLiveSearch('.$columns[1].'",'.$param2.');">'.$o->getFullName().'</li>';


            // $result .= '<li><a class="live_search_items" href="" onCliсk="event.preventDefault(); SelectLiveSearch('.$columns[1].'",this.value);">'.$o->getFullName().'</a></li>';

//            $result .= '<li onCliсk="SelectLiveSearch('.$columns[1].'",this.value)"><span >'.$o->getPunkt().'</span></li>';
//            $result .= '<li onCliсk="SelectLiveSearch('.$columns[1].'",this.value)">'.$o->getPunkt().'</li>';

        print_r($result);
        exit();
    }

    public function __construct()
    {
        // $this->view = new View(__DIR__ . '/../../../templates');
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
    }

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

//        var_dump($article);
        var_dump($this->user);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);
    }

    public function edit0(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        var_dump($this->user);

//        var_dump($this->user->getRole());

        if ($this->user->getRole()!="admin")
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article, 'user1'=>$this->user]);
    }

    // public function insert(): void
    // {

    //     $article = Article::getById(1);
    //     $article->id = null;

    //     if ($article === null) {
    //         $this->view->renderHtml('errors/404.php', [], 404);
    //         return;
    //     }

    //     $article->setName('Добавлени статья : название статьи');
    //     $article->setText('Новый текст добавленной  статьи');
    //     $article->setcreatedAt(date("Y-m-d H:i:s"));
    //     $article->setauthorId(1);


    //     $article->save();
    // }


    public function add1(): void
    {
        $author = User::getById(1);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole()!="admin")
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название новой статьи');
        $article->setText('Новый текст новой статьи');
        $article->setcreatedAt(date("Y-m-d H:i:s"));

        $article->save();

        var_dump($article);
    }

    public function delete(int $articleId): void
    {
        $article = Article::getById($articleId);

        var_dump($article);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article
        ]);

        $article->delete();
        // $article->save();
        var_dump($article);
    }


    public function add(): void
    {

        var_dump($this->user);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole()!="user")
        {
            throw new ForbiddenException('Не достаточно прав доступа у Вас.');
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php',['user' => $this->user]);
    }

    public function bplacesFiltr()
    {

        // echo "<pre>";
        $SQL_filtr  = Bplace::getSQLFromFiltrForm();
        // echo $SQL_filtr;
        $Bplaces    = Bplace::getAllByFiltrFormSQL($SQL_filtr);

        // var_dump($Bplaces);
        if (count($Bplaces)==0){
            echo "Нет записей";
            exit();
        }
        $bp_editor = [

            "filtr" => [
                "find_punkt"    => "",
                "find_volost"   => "",
                "find_uezd"     => ""
            ],

            "find_uezd"     => Bplace::getAllUezd("uezd")["datalist"],
            "find_volost"   => Bplace::getAllVolost("volost")["datalist"]
        ];

        // var_dump($bp_editor);

        if (isset($_REQUEST["find_punkt"])){
            $bp_editor["filtr"]["find_punkt"]       = $_REQUEST["find_punkt"];
        }
        
        if (isset($_REQUEST["find-volost"])){
            $bp_editor["filtr"]["find_volost"]      = $_REQUEST["find-volost"];
        }
        
        
        if (isset($_REQUEST["find-uezd"])){
            $bp_editor["filtr"]["find_uezd"]        = $_REQUEST["find-uezd"];
        }
  
        $result = "";
        
        // echo (__DIR__ . '/../../../templates');
        // C:\OpenServer\domains\mvckb3\templates\bd\bpeditor_line.php
        $fname = str_replace("\\","/", __DIR__ . '/../../../templates');
        $fname = __DIR__ . '/../../../templates';
        // $fname = str_replace("\\","/", '/../../../templates');
        // echo "<br>".$fname;
        $this->view = new View($fname);

        // $line   = $this->view->getRenderHtml('bd/bpeditor_line.php', ["Bplace" => $Bplaces[0]]);
        // print_r($line);

        // dirname(__DIR__ . '/../../../templates');// - Возвращает имя родительского каталога из указанного пути
        // pathinfo();// - Возвращает информацию о пути к файлу
        echo "</pre>";
        $i = 0;
        foreach ($Bplaces as $Bplace)
        {
            $i++;
            // echo $i;
            $line   = $this->view->getRenderHtml('bd/bpeditor_line.php', ["Bplace" => $Bplace, "i"=>$i]);
            $result .= $line."<hr>";
        }

        echo (strlen($result)==0)?"Нет записей":$result;
        
        return ($result);
    }

    public function bplacesEdit()
    {

        $result = [
            "status"    => true,
            "msg"       => "",
            "err"       => ""
        ];

        // если пусто вывожу что ошибка 
        if (empty($_POST)){
            $result["status"]   = false;
            $result["err"]      = "Ошибка запроса";
            print_r($result);
            exit;
        }

        // print_r($_REQUEST);
        // exit;
        if(isset($_POST["save_bplace_id"]))
        {
            $bp_id  = (int) $_REQUEST["save_bplace_id"];

            // echo "<pre>";
            // var_dump($_REQUEST);
            // echo "пришла форма сохранения";

            $check = Bplace::getSQLFromSaveForm();

            if ($check===null){
                // echo "Ошибка ввода";
                $result["status"]   = false;
                $result["err"]      = "Ошибка ввода. Место рождения должно иметь минимум одно значение.";
                print_r(json_encode($result));
                exit;

            }
            else {

                $bplace    = Bplace::getById($bp_id);
                // var_dump($bplace);
                // echo "<hr></pre>".$bplace->getId();
                $bplace->setPunkt($_POST["punkt"]);
                $bplace->setVolost($_REQUEST["volost"]);
                $bplace->setUezd($_REQUEST["uezd"]);
                $bplace->save();

                // header('Location: /bplaces/', true, 302);
                // header("Refresh: 0");

                $result["msg"]      = "Операция успешно выполнена.";
                print_r(json_encode($result));
                exit;
            }


            
        }
        echo $result;
        return ($result);
    }


    public function bplacesDelete()
    {

        $result = [
            "status"    => true,
            "msg"       => "",
            "err"       => ""
        ];

        $bplace_id  = $_POST["delete_bplace_id"];

        $bplace     = Bplace::getById((int)$bplace_id);

        try {

            $bplace->delete();

        } catch (InvalidArgumentException $e) {

            $result["status"]   = false;
            $result["err"]      = $e->getMessage();
            print_r(json_encode($result));
            exit;
        }

        $result["status"]   = false;
        $result["msg"]      = "Место рождение удалено";
        print_r(json_encode($result));
        exit;
        return;
    }

    public function cardsEdit(){

        $result = [
            "status"    => true,
            "msg"       => "",
            "err"       => [],
            "errors"    => []
        ];

            // print_r($_POST);
            // print_r(json_encode($_POST));
            // exit;
        // если пусто вывожу что ошибка 
        if ((empty($_POST))){//||(!isset($_POST["card_id"]))){
            $result["status"]   = false;
            $result["err"][]      = "Ошибка ввода. Пустой запрос.";
            print_r($result);
            exit;
        }

        if(isset($_POST["card_id"]))
        {

            $new_card   = [];

            $spec_chars = ["*", "!", "?", "(", ")", "{", "}", "[", "]"];

            $fullname   = "";

            // $result     = [];

            if (empty($_POST))
            {
                echo "Ошибка ввода.";
                echo '<a href="//">На главную</a>';
                exit();
            }

            $fnames_title    = explode(',',$_POST["fname"]);
            $names_title    = explode(',',$_POST["name"]);
            $snames_title    = explode(',',$_POST["sname"]);

            $byears_title    = explode(',',$_POST["byear"]);

            $punkt      = $_POST["punkt"];
            $volost     = $_POST["volost"];
            $uezd       = $_POST["uezd"];

            $photo       = $_POST["photo"];

            $prim       = $_POST["prim"];

            $fond       = $_POST["fond"];
            $opis       = $_POST["opis"];
            $delo       = $_POST["delo"];
            $list       = $_POST["list"];

            $r_fields   = [
                "fnames"        => "Фамилия",
                "names"         => "Имя",
                "snames"        => "Отчество",
                "byears"        => "Год рождения"
            ];

            $arr = get_defined_vars();

            foreach($r_fields AS $k => $v ){

                $tmp    = $arr[$k."_title"];
                if ((count($tmp)==0)&&($k!="snames")){
                    $result["status"] = false;
                    $result["errors"][] = "Поле ".$v." должно содержать минимум одно значение.";
                }

                foreach($tmp AS $kk =>$vv)
                {
                    if (($k=="byears")&&(strlen($vv)==0)){
                        $result["status"] = false;
                        $result["errors"][] = "Поле год рождения содержит некорректное значение ".$vv;
                        continue;
                    }
                    if ((strlen($vv)<3)&&($k!="byears")&&($k!="snames")){
                        $result["status"] = false;
                        $result["errors"][] = "Поле".$v."содержит некорректное значение ".$vv;
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
                        // echo "<br>+>>".$field_arr_title[$i];
                        $field_arr[]    = trim(str_ireplace($spec_chars, "", $field_arr_title[$i]));
                        $field_arr_title[$i]    = trim($field_arr_title[$i]);
                    }
                    // echo "<br>>>".$field_arr[0];

                    // print_r($field_arr);
                    // Конкатенация полного ФИО для карточки из первых значений этих полей без спец символов
                    $fullname   .=($k!="byears")?$field_arr[0]." ":"";

                    $field_str_title    = implode(", ", $field_arr_title);
                    $field_str          = implode(", ", $field_arr);
                    $field_arr_state    = ($field_str!==$field_str_title)?0:1;

                    $new_card[$k]             = $field_str;;
                    $new_card[$k."_title"]    = $field_str_title;
                    $new_card[$k."_len"]      = $field_arr_len;
                    $new_card[$k."_state"]    = $field_arr_state;
            }

            $new_card["fullname"]   = $fullname;
            $check_bplace = true;

            if ((strlen($punkt)+strlen($volost)+strlen($uezd))<4){
                $check_bplace = false;
                $result["status"] = false;
                $result["errors"][] = "Место рождения  должно содержать минимум одно значение. ";
            }
            

            $r_fields   = [
                "fond"  => "Фонд",
                "opis"  => "Опись",
                "delo"  => "Дело",
                "list"  => "Лист"
            ];

            foreach($r_fields AS $k => $v ){

                // echo "<br>$v";
                $tmp    = $arr[$k];
                // print_r($tmp);

                if (strlen($tmp)==0){
                    $result["status"] = false;
                    $result["errors"][] = "Поле ".$v." должно содержать минимум одно значение.";
                }
            }

            if ($result["status"] == false){
                print_r(json_encode($result));
                exit;
            }
            else {

                $new_bp = [
                    "punkt"     => $punkt,
                    "volost"     => $volost,
                    "uezd"     => $uezd,
                ];
        
                $new_bp_id  = Bplace::getRecordByFields($new_bp);
        
                // print_r($new_bp_id);
        
                $new_finder = [
                    "fond"     => $fond,
                    "opis"     => $opis,
                    "delo"     => $delo,
                    // "list"
                ];
                // echo "<hr>";
                $new_finder_id  = Finder::getRecordByFields($new_finder);
                // print_r($new_finder_id);
        
                $fnames_value       = [];
                $names_value        = [];
                $snames_value       = [];
                $byears_value       = [];
        
        
                $new_card["finder_id"] = $new_finder_id;
                $new_card["list"]      = $list;

                $bplace_arr = [];
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
        
                $card = Card::getById2($_POST['card_id']);
        
                //     $entities->bplace    = Bplace::getById($entities->getBplaceId());
                //     $entities->finder    = Finder::getById($entities->getFinderId());
        
                if ($card->getFnameTitle()!=$_POST['fname'])
                {
                    // print_r($card->getFname());
                    // print_r($_POST['fname']);
                    $card->setFname($new_card['fnames']);
                    $card->setFnameTitle(str_replace("  ", " ", $new_card['fnames_title']));
                    $card->setFnameLen($new_card['fnames_len']);
                    $card->setFnameState($new_card['fnames_state']);
                    $card->setFullname($new_card['fullname']);
                }
        
        
                if ($card->getNameTitle()!=$_POST['name'])
                {
                    // print_r($card->getName());
                    // print_r($_POST['name']);
                    $card->setName($new_card['names']);
                    $card->setNameTitle(str_replace("  ", " ", $new_card['names_title']));
                    $card->setNameLen($new_card['names_len']);
                    $card->setNameState($new_card['names_state']);
                    $card->setFullname($new_card['fullname']);
                }
        
                if ($card->getSnameTitle()!=$new_card['snames_title'])
                {
                    // print_r($card->getSname());
                    // print_r($_POST['sname']);
                    $card->setSname($new_card['snames']);
                    $card->setSnameTitle(str_replace("  ", " ", $new_card['snames_title']));
                    $card->setSnameLen($new_card['snames_len']);
                    $card->setSnameState($new_card['snames_state']);
                    $card->setFullname($new_card['fullname']);
                }
        
                if ($card->getByearTitle()!=$new_card['byears'])
                {
                    // print_r($card->getByearTitle());
                    // print_r($_POST['byear']);
        
                    $card->setByear($new_card['byears']);
                    $card->setByearTitle(str_replace("  ", " ", $new_card['byears_title']));
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


                try {
                    $card->save();
                } catch (\Throwable $th) {
                    $result["errors"]      = "Ошибка записи изменений в систему.";
                    print_r(json_encode($result));
                    exit;
                }

                $result["msg"]      = "Операция успешно выполнена.";
                $result["data"]     = $new_card;
                print_r(json_encode($result));
                exit;
            }
        }
        // print_r( $result);
        // return ($result);
    }
}



