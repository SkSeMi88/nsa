<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\BP_lists\BP_list;
use MyProject\Models\Bplaces\Bplace;
use MyProject\Models\Finders\Finder;
use MyProject\Models\Cards\Card;

use MyProject\Services\Db;
use MyProject\View\View;

use MyProject\Models\Users\User;




use MyProject\Exceptions;//\DbException;

use MyProject\Services\UsersAuthService;

class MainController extends AbstractController
{
    /** @var View */
    // private $view;

    /** @var Db */
    private $db;

public function __construct()
{

        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);

        // $this->view = new View(__DIR__ . '/../../../templates');
        // $this->db = new Db();
        $db = Db::getInstance();
}

    public function main011()
    {
        $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        var_dump($articles);
        return;
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function main()
    {


        echo "<pre>";

        print_r($_REQUEST);

        if (count($_REQUEST)>0){

        // if ((!isset($_REQUEST["new_fname"]))||(strlen($_REQUEST["new_fname"])<3)) {
                if ((!isset($_REQUEST["new_fname"]))||(strlen($_REQUEST["new_fname"][0])==0)||(count($_REQUEST["new_fname"])==0)) {
                        echo "Нeт фамилии.";
                }

                $fnames = array_reverse($_REQUEST["new_fname"]);
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


                if(isset($_REQUEST["punkt"])){

                        echo"!@#111111111";
                        $BPLACES["punkt"] = $_REQUEST["punkt"];
                        $bplace_flag++;
                        if(strlen($_REQUEST["punkt"])<3){
                                $bplace_flag    = 0;
                                $BPLACES["punkt"] = null;
                                // $BPLACES["punkt"].push();
                        }


                        echo "<hr>punkt=>".$bplace_flag;

                }

                if(isset($_REQUEST["volost"])){

                        echo"!@#22222";
                        $BPLACES["volost"] = $_REQUEST["volost"];
                        $bplace_flag++;
                        if(strlen($_REQUEST["volost"])<3){
                                $BPLACES["volost"] = null;
                                $bplace_flag--;
                        }
                        echo "<hr>".$bplace_flag;
                }

                if(isset($_REQUEST["uezd"])){

                        $BPLACES["uezd"] = $_REQUEST["uezd"];
                        $bplace_flag++;
                        if(strlen($_REQUEST["uezd"])<3){
                                $BPLACES["uezd"] = null;
                                $bplace_flag--;
                        }
                        echo "<hr>".$bplace_flag;
                }
                echo "<hr>".$bplace_flag;

                if ($bplace_flag==0) {
                        echo "Место рождение должно иметь более одного значения от 3х символов.";
                }

                echo "Проверка места рождения из формы";

                $bp = new Bplace();
                var_dump($bp);
                // $check = Bplace::getRecordByFields($_REQUEST["bplace_id"], $_REQUEST["punkt"], $_REQUEST["volost"], $_REQUEST["uezd"]);
                // var_dump($BPLACES);
                $BPLACE = $bp->getRecordByFields($BPLACES);
                echo "Результат проверки существования места рождения";
                var_dump($BPLACE);
                echo "<hr>";
                if ($BPLACE==Null){
                        echo "Cоздание нового места рождения";
                        $bplace = $bp->createFromArrayForm($BPLACES);
                        var_dump($bplace);
                        echo "<hr>";
                }

                // var_dump($BPLACE);

                echo "<hr>";
                print_r (implode(',', $fnames));
                echo "<hr>";

                $fullname   = $fnames[0]." ".$names[0]." ".$snames[0];

                $CARD = [
                        "finderId"     => 0,
                        "list"          => $list,
                        "state"         => 1,

                        "fullName"      => $fullname,
                        "fname"         => $fnames,
                        "names"          => $names,
                        "sname"         => $snames,
                        "byear"         => $byear,
//                        "bplace_id"     => $BPLACE->id,
                        "photo"         => $photo,
                        "prim"          => $prim
                ];



                $card = new Card();
//                var_dump($CARD);
                // $card->setFname($fnames);
                // $card->save();
                 $card  = Card::createFromArrayForm($CARD);
//                 var_dump($card);
            echo "<hr>";

        }

//         $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
//         $this->view->renderHtml('main/main.php', ['articles' => $articles]);

        //echo phpinfo();
        $title = "Мой блог. Главная страница";
        echo $title;
        echo "</pre>";
//
//        var_dump(BP_list::getById(1));
//        $BP_LIST    = BP_list::findAll();
//        var_dump(BP_list::findAll());
//        echo "<hr>";
//        $BP_LIST    = BP_list::findAllByColumnLike("value", "Юшкозерская");
//        var_dump($BP_LIST);

//        $articles = Article::findAll();
//        var_dump($articles);
//        $this->view->renderHtml('main/main.php', ['articles' => $articles,'title' => $title]);
//
//        print_r("<hr>HELLO WORLD!");
//        $users= USER::findAllByColumnLike("role","user");
//        echo "<hr>";
//        //$users= USER::findAll();
//        var_dump($users);
//        $this->view->renderHtml('bd/list.php', ['articles' => $BP_LIST,'title' => $title]);


        $this->view->renderHtml('cards/create_card.php', []);
        echo "<hr>КОНЕЦ!";
    }

    public function test()
    {
        /*
    //        $BPLACES    = [
    //            "punkt" =>"д. Костомукша",
    ////                "volost" => "Кондокская",
    ////            "uezd"  => "Кемский"
    //        ];

            $BPLACES    = [
                "punkt" =>"Костомукша",
    //            "volost" => "",
    //            "uezd"  => ""
            ];

            echo "<pre>Тестирование проверки места рождения.";
    //        $bplace_check   = Bplace::checkRecordExisting();
            $bplace_check   = Bplace::getRecordByFields($BPLACES);
            var_dump($bplace_check);

            echo "<hr>Тестирование проверки поисковых данных.";
            $finders = [
                "fond"  =>"Ф.Р-689",
                "opis"  =>"Оп.14",
                "delo"  =>"Д.2_6"
            ];

            $finder_id = Finder::getRecordByFields($finders);
            var_dump($finder_id);
        }
        */
        echo "<pre>";
        $FORMA = [
            "new_finder_id" => "2",
            "fullname" => "Тестоман ТЕст ТЕстович 1988",
            "state" => 1,
            "new_fname" => ["Тестоман, Тестовой"],
            "new_fname_title" => ["Тестоман, Тестовой"],
            "new_fname_len" => 2,
            "new_fname_state" => 1,
            "new_name" => ["ТЕст"],
            "new_name_title" => ["ТЕст"],
            "new_name_len" => 1,
            "new_name_state" => 1,
            "new_sname" => ["ТЕстович"],
            "new_sname_title" => ["ТЕстович"],
            "new_sname_len" => 1,
            "new_sname_state" => 1,
            "new_byear" => ["1988"],
            "new_byear_title" => ["1988"],
            "new_byear_len" => 1,
            "new_byear_state" => 1,

            "new_photo" => [1],
            "new_prim" => ["Testik"],
            "bplace_id" => "29",
            "punkt" =>"Суоярви",

            "new_fond"  => "Ф.Р-689",
            "new_opis"  => "Оп.14",
            "new_delo"  => "Д.2_5",
            "new_list"  => "12345"


        ];
        Card::createFromArrayForm($FORMA);
    }

    public function checkBplaces(){

        // получить все строки
        // ид полное имя, поля пункт, волость уезд
        // пройтись по этой стркутуре получив кол-во 
        // "Ригорека Маслозерская Кемский" {
        //         id кол-во,
        //         id2     кол-во
        // }

        $SQL_arr        = [];
        echo "<pre>";
        $result = [];

        // $SQL = 'SELECT * FROM bps WHERE id IN (SELECT DISTINCT bplace_id FROM cards)';
        $SQL = 'SELECT * FROM bps ';

        $db = Db::getInstance();


        $bplaces = $db->query($SQL, [], Bplace::class);
        // var_dump($bplaces);

        foreach($bplaces AS $bp){
                $fullname       = $bp->getPunkt()." ".$bp->getVolost()." волость ".$bp->getUezd();
//                 echo "<hr>".$fullname;
//                 var_dump($bp);

                $result[$fullname][]    = $bp->getId();
        }

        $i = 0;
        foreach($result AS $k=>$bp){

                if (count($bp)>1){
                        $bp_list  = "(".implode(",", array_values($bp)).")";
                        $SQL = 'SELECT * FROM cards WHERE bplace_id IN '.$bp_list;
                        $cards = $db->query($SQL, [], Card::class);
                        if (count($cards)<2) continue;
                        echo "<hr>".$i++."<br>".$k."<br>".count($bp)."=>".$bp[0];
                        
                        echo "<br>".$bp_list;
                        // var_dump($cards);
                        print_r(count($cards));
                        $cards_list     = [];
                        foreach($cards AS $card){
                                $bp_obj         = Bplace::getById($card->getBplaceId());
                                $bp_full_name   = $bp_obj->getPunkt()." ".$bp_obj->getVolost()." ".$bp_obj->getUezd();
                                echo "<br>      ".$card->getBplaceId()." ".$card->getFullName(). " ".$bp_full_name;
                                $cards_list[]   = $card->getId();
                        }
                        print_r($cards_list);
                        $SQL_new  = 'UPDATE cards SET bplace_id='.$bp[0].' WHERE (bplace_id IN'.$bp_list.');';
                        $SQL_arr[]      = $SQL_new;

                        print_r($SQL_new);
                        print_r(array_shift($bp));
                        $bp_list  = "(".implode(",",$bp).")";
                        $SQL_new  = 'DELETE FROM bps WHERE (id IN'.$bp_list.');';
                        $SQL_arr[]      = $SQL_new;
                        print_r($SQL_new);
                        
                }
        }


        // var_dump($result);
        print_r(count($result));
        
        // print_r($SQL_arr);
        foreach($SQL_arr AS $SQL){
                echo "<br>".$SQL;
        }

        echo "КОНЕЦ!";
    }
}
