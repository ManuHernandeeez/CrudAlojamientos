<?php
session_start();


require_once "config/database.php";


define('BASE_URL', '/CrudAlojamiento/');


$request_uri = $_SERVER['REQUEST_URI'];
$base_path = parse_url(BASE_URL, PHP_URL_PATH);
$path = str_replace($base_path, '', $request_uri);
$path = parse_url($path, PHP_URL_PATH);


switch ($path) {
    case '':
    case '/':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
        
    case 'login':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;
        
    case 'register':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->register();
        break;
        
    case 'logout':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'user/alojamientos':
        require_once 'controllers/UserController.php';
        $controller = new UserController();
        $controller->index();
        break;

    case 'user/alojamientos/agregar':
        require_once 'controllers/UserController.php';
        $controller = new UserController();
        $controller->agregarAlojamiento();
        break;

    case 'user/alojamientos/eliminar':
        require_once 'controllers/UserController.php';
        $controller = new UserController();
        $controller->eliminarAlojamiento();
        break;

    case 'admin/alojamientos':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController();
        $controller->index();
        break;

    case 'admin/alojamientos/crear':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController();
        $controller->crearAlojamiento();
        break;
    
    case 'admin/alojamientos/editar':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController();
        $controller->editarAlojamiento();
        break;

    case 'admin/alojamientos/eliminar':
        require_once 'controllers/AdminController.php';
        $controller = new AdminController();
        $controller->eliminarAlojamiento();
        break;
        
    default:
        
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}
?>