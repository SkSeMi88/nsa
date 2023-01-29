<?php

return [

    '~^test$~'                      => [\MyProject\Controllers\MainController::class, 'test'],

    '~^release$~'				    => [\MyProject\Controllers\MainController::class, 'release'],
    '~^$~'						    => [\MyProject\Controllers\MainController::class, 'main'],
    '~^404$~'                       => [\MyProject\Controllers\MainController::class, 'm404'],
    '~^fonds$~'					    => [\MyProject\Controllers\FondsController::class, 'list'],
    '~^fond/(\d+)$~'		        => [\MyProject\Controllers\FondsController::class, 'viewCard'],
    
    '~^cards/create$~'		        => [\MyProject\Controllers\CardsController::class, 'createCard'],
    '~^cards/(\d+)$~'		        => [\MyProject\Controllers\CardsController::class, 'viewCard'],
    '~^cards/(\d+)/files$~'         => [\MyProject\Controllers\CardsController::class, 'viewCardFiles'],
    '~^cards/delete/(\d+)$~'        => [\MyProject\Controllers\CardsController::class, 'deleteCard'],
    '~^cards/(\d+)/delete$~'        => [\MyProject\Controllers\CardsController::class, 'deleteCard'],
    '~^cards/deleted$~'             => [\MyProject\Controllers\CardsController::class, 'deletedList'],
    
    '~^cards/list$~'             => [\MyProject\Controllers\CardsController::class, 'listCards'],
    
    // Список тематик
    '~^thems/list$~'                => [\MyProject\Controllers\ThemsController::class, 'list'],

    // Карточка тематики
    '~^thems/card/(\d+)$~'          => [\MyProject\Controllers\ThemsController::class, 'viewCard'],
    
    // Список персоналий
    '~^persons/list$~'		        => [\MyProject\Controllers\PersonsController::class, 'list'],

    // Карточка персоналии
    '~^persons/card/(\d+)$~'        => [\MyProject\Controllers\PersonsController::class, 'viewCard'],
    
    // поиск
    '~^poisk$~'        => [\MyProject\Controllers\MainController::class, 'poisk'],
    '~^poisk-test$~'        => [\MyProject\Controllers\MainController::class, 'poisktest'],



    // '~^users/register$~'            => [\MyProject\Controllers\UsersController::class, 'signUp'],
    // '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
    // '~^users/login$~'               => [\MyProject\Controllers\UsersController::class, 'login'],
    // // '~^users/logout/(\d+)$~' => [\MyProject\Controllers\UsersController::class, 'logout'],
    // '~^users/logout/$~'             => [\MyProject\Controllers\UsersController::class, 'logout'],

    // '~^users/profile/(\d+)$~'       => [\MyProject\Controllers\UsersController::class, 'profile'],

    
    /*
    '~^hello/(.*)$~'			=> [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^bye/(.*)$~'				=> [\MyProject\Controllers\MainController::class, 'sayBye'],
    '~^$~'						=> [\MyProject\Controllers\MainController::class, 'main'],
    '~^articles/(\d+)$~'		=> [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~'	=> [\MyProject\Controllers\ArticlesController::class, 'edit'],
    // '~^articles/insert$~'		=> [\MyProject\Controllers\ArticlesController::class, 'insert'],
    '~^articles/add$~'			=> [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete$~'	=> [\MyProject\Controllers\ArticlesController::class, 'delete'],


    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],


    '~^articles/(\d+)/comments$~' => [\MyProject\Controllers\CommentsController::class, 'add'],

*/
    
];