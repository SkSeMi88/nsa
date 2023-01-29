<?php

return [

    '~^testapi$~' => [\MyProject\Controllers\Api\PoiskApiController::class, 'view',"GET"],
    '~^poisk/filtr$~' => [\MyProject\Controllers\Api\PoiskApiController::class, 'filtr',"POST"],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\Api\ArticlesApiController::class, 'view'],
    '~^articles/add$~' => [\MyProject\Controllers\Api\ArticlesApiController::class, 'add'],
    '~^poisk/filtr$~' => [\MyProject\Controllers\Api\PoiskApiController::class, 'filtr'],
];