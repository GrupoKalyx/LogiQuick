<?php
require '../Modelo/modeloEntregan.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorEntregan::$function($context);

class controladorEntregan
{

    public static function ingresar($context)
    {
        $numBulto = $context['numBulto'];
        $matricula = $context['matricula'];
        modeloEntregan::alta($numBulto, $matricula);
    }

    public static function eliminar($context)
    {
        $numBulto = $context['numBulto'];
        $matricula = $context['matricula'];
        modeloEntregan::baja($numBulto, $matricula);
    }

    public static function listar($context)
    {
        $result = modeloEntregan::listado();
        echo $result;
    }

    public static function mostrarPickup($context)
    {
        $numBulto = $context['numBulto'];
        $result = modeloEntregan::muestraPickup($numBulto);
        echo $result;
    }

    public static function mostrarPaquetes($context)
    {
        $matricula = $context['matricula'];
        $result = modeloEntregan::muestraPaquetes($matricula);
        echo $result;
    }

    public static function MarcarSalida($context)
    {
        $numBulto = $context['numBulto'];
        var_dump($numBulto);
        modeloEntregan::MarcarSalida($numBulto);
    }
    public static function MarcarLlegada($context)
    {
        $numBulto = $context['numBulto'];
        var_dump($numBulto);
        modeloEntregan::MarcarLlegada($numBulto);
    }
}
