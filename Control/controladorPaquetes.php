<?php
require '../Modelo/modeloPaquetes.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'GET':
        $method = $_GET['method'];
        break;
    case 'POST':
        $method = $_POST['method'];
        break;
    case 'PUT':
        $method = $_PUT['method'];
        break;
    case 'DELETE':
        $method = $_DELETE['method'];
        break;
}
controladorPaquetes::$method();

class controladorPaquetes
{
    public static function ingresar($context)
    {
        $gmailCliente = $context['post']['gmailCliente'];
        $fechaLlegada = $context['post']['fechaLlegada'];
        $num = $context['post']['num'];
        $calle = $context['post']['calle'];
        $localidad = $context['post']['localidad'];
        $departamento = $context['post']['departamento'];

        modeloPaquetes::alta($gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento);

        $url = $context['post']['url'];
        header('location: https://' . $url);
    }

    public static function eliminar($context)
    {
        $numBulto = $context['post']['numBulto'];
        modeloPaquetes::baja($numBulto);
        header('location: ../../../Vista/indexAdministrador.php');
    }

    public static function mostrar($context)
    {
        $numBulto = $context['get']['numBulto'];
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
        $numBulto = $context['post']['numBulto'];
        $gmailCliente = $context['post']['gmailCliente'];
        $fechaLlegada = $context['post']['fechaLlegada'];
        $num = $context['post']['num'];
        $calle = $context['post']['calle'];
        $localidad = $context['post']['localidad'];
        $departamento = $context['post']['departamento'];

        modeloPaquetes::modificacion($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento);
        header('location: ../../../Vista/indexAdministrador.php');
    }
}
