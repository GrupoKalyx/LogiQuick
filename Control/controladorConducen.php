<?php
require '../Modelo/modeloConducen.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorConducen::$function($context);

class controladorConducen
{

    public static function ingresar($context)
    {
        $matricula = $context['matricula'];
        $ci = $context['ci'];
        $success = modeloConducen::alta($matricula, $ci);
        echo $success;
    }

    public static function eliminar($context)
    {
        $matricula = $context['matricula'];
        $ci = $context['ci'];
        modeloConducen::baja($matricula, $ci);
    }

    public static function listar($context)
    {
        $result = modeloConducen::listado();
        echo $result;
    }

    public static function mostrarCamionero($context)
    {
        $matricula = $context['matricula'];
        $result = modeloConducen::muestraCamionero($matricula);
        echo $result;
    }

    public static function mostrarCamion($context)
    {
        $ci = $context['ci'];
        $result = modeloConducen::muestraCamion($ci);
        echo $result;
    }
}
