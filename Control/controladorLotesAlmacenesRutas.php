<?php
require '../Modelo/modeloLotesAlmacenesRutas.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_POST,
    'DELETE' => $_POST,
};

$function = $context['function'];
controladorLotesAlmacenesRutas::$function($context);

class controladorLotesAlmacenesRutas
{

    public static function ingresar($context)
    {
        $idLote = $context['idLote'];
        $numRuta = $context['numRuta'];
        $idAlmacen = $context['idAlmacen'];
        modeloLotesAlmacenesRutas::alta($idLote, $numRuta, $idAlmacen);
    }

    public static function eliminar($context)
    {
        $idLote = $context['idLote'];
        $numRuta = $context['numRuta'];
        $idAlmacen = $context['idAlmacen'];
        modeloLotesAlmacenesRutas::baja($idLote, $numRuta, $idAlmacen);
    }

    public static function listar($context)
    {
        $result = modeloLotesAlmacenesRutas::listado();
        echo $result;
    }
}

