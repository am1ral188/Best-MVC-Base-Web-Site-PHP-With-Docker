<?php
session_start();
include_once "config.php";
//to install uncomment it
//include_once "helpers/installer.php";
include_once "helpers/cont.php";


$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';

// Debug
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}




// "PATH" => "CONTROLLER_NAME"
$allow_path = array(
    'login' => 'login_',
    'dash' => 'dash',
);


if ($url === '/') {
 include_once __DIR__."/controller/main_Page.php";
 $controller=new main_Page();
$controller->index();
    return;
} else {
    $requestedController = $url[0] ?? 'index';
    $requestedAction = $url[1] ?? 'index';
    if (key_exists($requestedController, $allow_path)) {

        $requestedController = $allow_path[$requestedController];

        $ctrlPath = __DIR__ . '/controller/' . $requestedController . '.php';

        if (file_exists($ctrlPath)) {
            require_once __DIR__ . '/model/' . $requestedController . '_model.php';
            require_once __DIR__ . '/controller/' . $requestedController . '.php';

            $modelName = $requestedController . '_model';
            $controllerName = $requestedController ;

            $controllerObj = new $controllerName(new $modelName);

            if (empty($requestedAction)) {
                $requestedAction = 'index';
            }
            if (method_exists($controllerObj, $requestedAction)) {
                print $controllerObj->$requestedAction();
                return;
            }else{
                header("HTTP/1.0 404 Not Found");
                header('Content-Type: application/json; charset=utf-8');
                die(json_encode(array('status' => 'not found', 'desc' => 'path not found')));
            }
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        header('Content-Type: application/json; charset=utf-8');
        die(json_encode(array('status' => 'not found', 'desc' => 'path not found')));
    }
}
