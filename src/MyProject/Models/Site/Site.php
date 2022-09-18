<?php

namespace MyProject\Models\Site;



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


class Site //extends ActiveRecordEntity
{

    /** @var int */
    protected $user;

    /** @var string */
    protected $menu;

    /*
     * @return string
     */
    public static function getUserMenu($user)//: string
    {

    	$menu_list		= [];

    	$menu_list[]	= '<div><a href="../../">Главная</a></div>';
    	$menu_list[]	= '<div><a href="../../thems/list">Список тематик</a></div>';
    	$menu_list[]	= '<div><a href="../../fonds">Архивный шифр</a></div>';
    	
    	if (($user!==null)&&(in_array($user->getRoleTitle(),["root", "admin", "editor"]))){
    		
    		$menu_list[]	= '<div><a href="../../cards/create">Создать карточку документа</a></div>';
    	}
    	
    	if (($user!==null)&&(in_array($user->getRoleTitle(),["root", "admin"]))){
    		
    		$menu_list[]	= '<div><a href="../../admin">Администрирование</a></div>';
    	}
    	
        // return '<div class="menu-line">'.implode(" ",$menu_list).'</div>';
        return(implode(" ",$menu_list));
    }

}