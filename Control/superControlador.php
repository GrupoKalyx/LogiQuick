<?php
//http://localhost/Logiquick/Control/superControlador.php/Login/chequear
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$Controlador = "controlador" . $uri[sizeof($uri) - 2];
$metodo = $uri[sizeof($uri) - 1];

require  "$Controlador" . ".php";
$context = ['post' => $_POST, 'get' => $_GET];
call_user_func("$Controlador::$metodo", $context);
