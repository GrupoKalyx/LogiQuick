<?php
require '../Modelo/modeloPaquetes.php';

$requestMethod = '_' . $_SERVER['REQUEST_METHOD'];
$context = $$requestMethod; //va con doble $var_dump($)
$function = $context['function'];
controladorPaquetes::$function($context);

class controladorPaquetes
{
    public static function ingresar($context)
    {
        $gmailCliente = $context['gmailCliente'];
        $fechaLlegada = $context['fechaLlegada'];
        $num = $context['num'];
        $calle = $context['calle'];
        $localidad = $context['localidad'];
        $departamento = $context['departamento'];

        modeloPaquetes::alta($gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento);

        $url = $context['url'];
        header('location: https://' . $url);
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
