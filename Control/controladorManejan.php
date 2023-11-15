<?php
require '../Modelo/modeloManejan.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorManejan::$function($context);

class controladorManejan
{

    public static function ingresar($context)
    {
        $ci = $context['ci'];
        $matricula = $context['matricula'];
        $success = modeloManejan::alta($ci, $matricula);
        echo $success;
    }

    public static function eliminar($context)
    {
        $ci = $context['ci'];
        $matricula = $context['matricula'];
        modeloManejan::baja($ci, $matricula);
    }

    public static function listar($context)
    {
        $result = modeloManejan::listado();
        echo $result;
    }

    public static function mostrarDelivery($context)
    {
        $matricula = $context['matricula'];
        $result = modeloManejan::muestraDelivery($matricula);
        echo $result;
    }

    public static function mostrarPickup($context)
    {
        $ci = $context['ci'];
        $result = modeloManejan::muestraPickup($ci);
        echo $result;
    }
}
