<?php

spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/src/' . $className . '.php';
});

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . '/src/routes.php';
var_dump($routes);


// error_reporting "E_ALL" php_flag display_errors On