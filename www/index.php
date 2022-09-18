<?php

// spl_autoload_register(function (string $className) {
//     require_once __DIR__ . '/../src/' . $className . '.php';
// });

// $route = $_GET['route'] ?? '';

// $pattern = '~^hello/(.*)$~';
// preg_match($pattern, $route, $matches);

// if (!empty($matches)) {
//     $controller = new \MyProject\Controllers\MainController();
//     $controller->sayHello($matches[1]);
//     return;
// }

// $pattern = '~^$~';
// preg_match($pattern, $route, $matches);

// if (!empty($matches)) {
//     $controller = new \MyProject\Controllers\MainController();
//     $controller->main();
//     return;
// }

try {
	// spl_autoload_register(function (string $className) {
	// 	// echo "<br>".__DIR__ . '/../src/' . $className . '.php';
	//     require_once __DIR__ . '/../src/' . $className . '.php';
	// });





    require __DIR__ . '/../vendor/autoload.php';

    $route = $_GET['route'] ?? '';
    

    $routes = require __DIR__ . '/../src/routes.php';
    $admin_settings		= require '../src/settings.php';
    
    echo "<pre>";
    // var_dump($routes);
    
    // var_dump($admin_settings["admin_routes"]);
    $tmp_routes			= array_merge($routes, $admin_settings["admin_routes"]);
    
    $routes		= $tmp_routes;
    // var_dump($routes);
    
    echo "</pre>";

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

	if (!$isRouteFound) {
	    throw new \MyProject\Exceptions\NotFoundException();
	}

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);
} catch (\MyProject\Exceptions\DbException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);

} catch (\MyProject\Exceptions\NotFoundException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (\MyProject\Exceptions\UnauthorizedException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
} 
// catch (\MyProject\Exceptions\ForbiddenException $e) {
//     $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
// //    var_dump($this->user);
//     $view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
// }