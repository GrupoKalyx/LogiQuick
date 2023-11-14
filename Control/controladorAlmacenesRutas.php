<?php
require '../Modelo/modeloAlmacenesRutas.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_POST,
    'DELETE' => $_POST,
};

$function = $context['function'];
controladorAlmacenesRutas::$function($context);

class controladorAlmacenesRutas
{

    public static function ingresar($context)
    {
        $numRuta = $context['numRuta'];
        $idAlmacen = $context['idAlmacen'];
        modeloAlmacenesRutas::alta($numRuta, $idAlmacen);
    }

    public static function eliminar($context)
    {
        $numRuta = $context['numRuta'];
        $idAlmacen = $context['idAlmacen'];
        modeloAlmacenesRutas::baja($numRuta, $idAlmacen);
    }

    public static function listar($context)
    {
        $result = modeloAlmacenesRutas::listado();
        echo $result;
    }

    public static function mostrarRutaDeAlmacen($context){
        $idAlmacen = $context['idAlmacen'];
        $result = modeloAlmacenesRutas::muestraRutaDeAlmacen($idAlmacen);
        echo $result;
    }
}

