<?php
//http://localhost/Logiquick/Control/superControlador.php/Login/chequear
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[sizeof($uri) - 3]=="superControlador.php") {
    require '../Modelo/modeloBd.php';

    $tipo = $uri[sizeof($uri) - 2];
    $metodo = $uri[sizeof($uri) - 1];

    $controlador = "controlador" . $tipo;
    require $controlador . ".php";
    $c = new $controlador(modeloBd::conexion());
    $context = ['post' => $_POST, 'get' => $_GET];

    $c->$metodo($context);
}
