<?php
require '../Modelo/modeloPaquetes.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
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
controladorPaquetes::$function($context);

class controladorPaquetes
{
    public static function ingresar($context)
    {
        $gmailCliente = $context['gmailCliente'];
        $fechaLlegada = $context['fechaLlegada'];
        $horaLlegada = $context['horaLlegada'];
        $num = $context['num'];
        $calle = $context['calle'];
        $localidad = $context['localidad'];
        $departamento = $context['departamento'];

        modeloPaquetes::alta($gmailCliente, $fechaLlegada, $horaLlegada, $num, $calle, $localidad, $departamento);
    }

    public static function eliminar($context)
    {
        $numBulto = $context['numBulto'];
        modeloPaquetes::baja($numBulto);
        header('location: ../../../Vista/indexAdministrador.php');
    }

    public static function mostrar($context)
    {
        $numBulto = $context['numBulto'];
        $result = modeloPaquetes::muestra($numBulto);
        return $result;
    }

    public static function listar()
    {
        $json = modeloPaquetes::listado();
        echo $json;
        header('https');
    }

    public static function listarSinLote()
    {
        $json = modeloPaquetes::listadoSinLote();
        echo $json;
    }

    public static function modificar($context)
    {
        $numBulto = $context['numBulto'];
        $gmailCliente = $context['gmailCliente'];
        $fechaLlegada = $context['fechaLlegada'];
        $num = $context['num'];
        $calle = $context['calle'];
        $localidad = $context['localidad'];
        $departamento = $context['departamento'];

        modeloPaquetes::modificacion($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento);
        header('location: ../../../Vista/indexAdministrador.php');
    }
}
