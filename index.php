<?php
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_set_cookie_params(86400 * 30, '/');
session_start();

spl_autoload_register(function ($class) {
    require_once("{$class}.php");
});

$controller = 'home';
$action = 'index';
$id = null;

if (isset($_SERVER["PATH_INFO"])) {
    $arr = explode('/', trim($_SERVER["PATH_INFO"]));
    $controller = $arr[1];
    if (isset($arr[2])) {
        $action = $arr[2];
        if (isset($arr[3])) {
            $id = $arr[3];
        }
    }
}

try {
    $class = "controllers\\" . ucfirst($controller) . "Controller";
    $controller = new $class;
    $controller->$action($id);
} catch (Error $v) {
    header('location:/Web_HaiTrieu/error/notFound');
}
