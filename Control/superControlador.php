<?php
function superControlador($metodo, $parameters)
{
        $comeback = $_SERVER['REQUEST_URI'];
        require '../Modelo/modeloBd.php';

        $tipo = $uri[sizeof($uri) - 2];
        $metodo = $uri[sizeof($uri) - 1];

        $controlador = "controlador" . $tipo;
        require $controlador . ".php";
        $c = new $controlador(modeloBd::conexion());
        $context = ['post' => $_POST, 'get' => $_GET];

        $c->$metodo($context);
}
