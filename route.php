<?php

require_once('app/controllers/PanaderiaController.php');
require_once('app/controllers/ProductoController.php');
require_once('app/controllers/adminController.php');

$controllerPanaderia = new controllerPanaderia();
$controllerProducto = new controllerProducto();
$controllerAdmin = new controllerAdmin();


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


$action = $_REQUEST['action'];

if (empty($action)) {
    $action = 'login';
}

$parametros = explode('/', $action);

switch ($parametros[0]) {

    case 'login':
        $controllerAdmin->mostrarLogin();
         break;
    case 'home':
        $controllerPanaderia->mostrarPanaderias();
}