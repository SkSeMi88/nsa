<?php

return [
    '~^articles/(\d+)$~' => [\MyProject\Controllers\Api\ArticlesApiController::class, 'view'],
    '~^articles/add$~' => [\MyProject\Controllers\Api\ArticlesApiController::class, 'add'],
    '~^poisk/filtr$~' => [\MyProject\Controllers\Api\PoiskApiController::class, 'filtr'],
];