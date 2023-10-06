<?php
require '../Modelo/modeloPaquetes.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

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
    }
    public static function eliminar($context)
    {
        $numBulto = $context['numBulto'];
        modeloPaquetes::baja($numBulto);
    }
    public static function listar($context)
    {
        $json = modeloPaquetes::listado();
        echo $json;
    }

    public static function listarSinLote($context)
    {
        $json = modeloPaquetes::listadoSinLote();
        echo $json;
    }

    public static function listarEnQC($context)
    {
        $json = modeloPaquetes::listadoEnQC();
        echo $json;
    }

    public static function mostrar($context)
    {
        $numBulto = $context['numBulto'];
        $result = modeloPaquetes::muestra($numBulto);
        echo $result;
    }

    public static function rastrear($context)
    {
        $idRastreo = $context['idRastreo'];
        $result = modeloPaquetes::rastreo($idRastreo);
        echo $result;
    }

    public static function verificar($context)
    {
        $tipoId = $context['tipoId'];
        $id = $context[$tipoId];
        $result = modeloPaquetes::existe($tipoId, $id);
        echo $result;
    }

    public static function mostrarEstado($context)
    {
        $tipoId = $context['tipoId'];
        $id = $context[$tipoId];
        $result = modeloPaquetes::muestraEstado($tipoId, $id);
        echo ($result);
    }
}
