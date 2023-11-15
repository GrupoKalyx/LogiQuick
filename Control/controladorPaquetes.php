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
        $num = $context['num'];
        $calle = $context['calle'];
        $localidad = $context['localidad'];
        $departamento = $context['departamento'];
        $lat = $context['lat'];
        $lng = $context['lng'];

        $numBulto = modeloPaquetes::alta($gmailCliente, $num, $calle, $localidad, $departamento, $lat, $lng);
        echo $numBulto;
    }

    public static function modificar($context)
    {
        $numBulto = $context['numBulto'];
        $gmailCliente = $context['gmailCliente'];
        $fechaLlegada = $context['fechaLlegada'];
        $horarioLLegada = $context['horarioLLegada'];
        $num = $context['num'];
        $calle = $context['calle'];
        $localidad = $context['localidad'];
        $departamento = $context['departamento'];

        modeloPaquetes::modificacion($numBulto, $gmailCliente, $fechaLlegada,$horarioLLegada, $num, $calle, $localidad, $departamento);
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

    public static function listarYendoQc($context)
    {
        $json = modeloPaquetes::listadoYendoQc();
        echo $json;
    }

    public static function listarEnQcExterior($context)
    {
        $json = modeloPaquetes::listadoEnQcExterior();
        echo $json;
    }

    public static function listarEnQcMontevideo($context)
    {
        $json = modeloPaquetes::listadoEnQcMontevideo();
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
        $result = modeloPaquetes::idRastreoExiste($idRastreo);
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
        echo $result;
    }

    public static function PaqueteAsignadoDelivery($context)
    {
        $ci = $context['ci'];
        $result = modeloPaquetes::PaqueteAsignadoDelivery($ci);
        var_dump($result);
        return $result;
    }

    public static function PaquetesSinEntregar()
    { 
        $result = modeloPaquetes::PaquetesSinEntregar();
        var_dump($result);
        return $result;
    }
}
