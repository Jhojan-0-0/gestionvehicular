<?php
session_start();

class App
{
  function __construct()
  {
    $url = $_GET['url'];
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    if ($_SESSION['katari']) {
      if (empty($url[0])) {

        $archivoController = "controller/dashboard.php";
        require_once $archivoController;
        $controller = new Dashboard();
        $controller->loadModel('dashboard');
        $controller->render();
        return false;
      }
      #echo "con parametros";
      $archivoController = "controller/" . $url[0] . ".php";
      if (file_exists($archivoController)) {
        #echo "Si existe";
        require_once $archivoController;
        $controller = new $url[0];
        $controller->loadModel($url[0]);

        # numero de elementos del arreglo
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
        #echo "no existe";
        require "controller/error.php";
        $controller = new ErrorGeneral();
        $controller->render();
      }
    }else{
      if (empty($url[0])) {
        #echo "URL vacia";
        $archivoController = "controller/login.php";
        require_once $archivoController;
        $controller = new Login;
        $controller->loadModel('main');
        $controller->render();
        return false;
      }
      #echo "Segundo: ".$url[1];
      if (isset($url[1]) && $url[1] == "logIn") {
        $archivoController = "controller/login.php";
        require_once $archivoController;
        $controller = new Login;
        $controller->loadModel('login');
        $controller->logIn();
        $controller->render();
      } else {
        #echo "nada";
        header("location: " . constant('URL'));
      }
    }

  }
}
