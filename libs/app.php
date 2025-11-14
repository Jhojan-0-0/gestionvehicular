<?php
session_start();

class App
{
function __construct()
{
    // Si no existe el parámetro "url", lo definimos vacío
    $url = isset($_GET['url']) ? $_GET['url'] : '';
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    // Verificamos si existe la sesión 'katari'
    if (isset($_SESSION['katari']) && $_SESSION['katari']) {
        if (empty($url[0])) {
            $archivoController = "controller/registro.php";
            require_once $archivoController;
            $controller = new registro();
            $controller->loadModel('registro');
            $controller->render();
            return false;
        }

        $archivoController = "controller/" . $url[0] . ".php";
        if (file_exists($archivoController)) {
            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            $nparam = sizeof($url);

            if ($nparam > 1) {
                if ($nparam > 2) {
                    $param = [];
                    for ($i = 2; $i < $nparam; $i++) {
                        array_push($param, $url[$i]);
                    }
                    $controller->{$url[1]}($param);
                } else {
                    $controller->{$url[1]}();
                }
            } else {
                $controller->render();
            }
        } else {
            require "controller/error.php";
            $controller = new ErrorGeneral();
            $controller->render();
        }
    } else {
        if (empty($url[0])) {
            $archivoController = "controller/login.php";
            require_once $archivoController;
            $controller = new Login;
            $controller->loadModel('main');
            $controller->render();
            return false;
        }

        if (isset($url[1]) && $url[1] == "logIn") {
            $archivoController = "controller/login.php";
            require_once $archivoController;
            $controller = new Login;
            $controller->loadModel('login');
            $controller->logIn();
            $controller->render();
        } else {
            header("location: " . constant('URL'));
        }
    }
}

}
