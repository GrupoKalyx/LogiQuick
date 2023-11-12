<?php
require '../Modelo/modeloRutas.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorRutas::$function($context);

class controladorRutas
{
    public static function ingresar($context)
    {
        $numRuta = $context['numRuta'];
        $departamentos = $context['departamentos'];
        modeloRutas::alta($numRuta, $departamentos);
    }

    public static function eliminar($context)
    {
        $numRuta = $context['numRuta'];
        modeloRutas::baja($numRuta);
    }

    public static function mostrar($context)
    {
        $result = modeloRutas::listado();
        echo $result;
    }

    public static function modificar($context)
    {
        $numRuta = $context['numRuta'];
        $departamentos = $context['departamentos'];
        modeloRutas::modificacion($numRuta, $departamentos);
    }

    public static function mostrarDetallesRuta($context) {
        $idLote = $context['idLote'];
        $result = modeloRutas::obtenerDetallesRuta($idLote);
        echo $result;
    }
}
