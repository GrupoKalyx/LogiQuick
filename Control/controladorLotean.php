<?php
require '../Modelo/modeloLotean.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $context = $_GET;
        break;
    case 'POST':
        $context = $_POST;
        break;
    case 'PUT':
        $context = $_PUT;
        break;
    case 'DELETE':
        $context = $_DELETE;
        break;
}

$function = $context['function'];
controladorLotean::$function($context);

class controladorLotean
{

    public static function ingresar($context)
    {
        $idLote = $context['idLote'];
        $paquetes = $context['paquetes'];
        modeloLotean::alta($idLote, $paquetes);
    }

    public static function eliminar($context)
    {
        $idLote = $context['numBulto'];
        modeloPaquetes::baja($idLote);
    }

    public static function listar($context)
    {
        $result = modeloLotean::listado();
        echo $result;
    }

    public static function modificar($context)
    {
        $idLote = $context['idLote'];
        $numBulto = $context['numBulto'];
        $nuevoNumBulto = $context['nuevoNumBulto'];
        modeloLotean::modificacion($idLote, $numBulto, $nuevoNumBulto);
    }
}
