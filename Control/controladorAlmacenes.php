<?php
require '../Modelo/modeloAlmacenes.php';

    

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorAlmacenes::$function($context);

class controladorAlmacenes
{
    public static function ingresar($context)
    {
        $idAlmacen = $context['idAlmacen'];
        $ubiAlmacen = $context['ubiAlmacen'];
        $calle = $context['calle'];
        $departamento = $context['departamento'];
        $localidad = $context['localidad'];
        $N_puerta = $context['N_puerta'];
        modeloAlmacenes::alta($idAlmacen, $ubiAlmacen, $calle, $departamento, $localidad, $N_puerta);
    }

    public static function eliminar($context)
    {
        $idAlmacen = $context['idAlmacen'];
        modeloAlmacenes::baja($idAlmacen);
    }

    public static function mostrar($context)
    {
        $result = modeloAlmacenes::listado();
        echo $result;
    }

    public static function modificar($context)
    {
        $idAlmacen = $context['idAlmacen'];
        $ubiAlmacen = $context['ubiAlmacen'];
        $calle = $context['calle'];
        $departamento = $context['departamento'];
        $localidad = $context['localidad'];
        $N_puerta = $context['N_puerta'];
        modeloAlmacenes::modificacion($idAlmacen, $ubiAlmacen, $calle, $departamento, $localidad, $N_puerta);
    }

    public static function listarSecundarios($context){
        $result = modeloAlmacenes::listadoSecundarios();
        echo $result;
    }

    public static function mostrarUltimo($context){
        $idRastreo = $context['idRastreo'];
        $result = modeloAlmacenes::muestraUltimo($idRastreo);
        echo $result;
    }

    public static function mostrarDetallesAlmacen($context) {
        $idLote = $context['idLote'];
        $result = modeloAlmacenes::obtenerDetallesAlmacen($idLote);
        echo $result;
    }

    public static function mostrarAlmacenAsociadoRuta($context) {
        $idAlmacen = $context['idAlmacen'];
        $numRuta = $context['numRuta'];
        $result = modeloAlmacenes::obtenerAlmacenAsociadoRuta($idAlmacen, $numRuta);
        echo $result;
    }

    public static function mostrarAlmacenPorDepartamento($context) {
        $departamento = $context['departamento'];
        $result = modeloAlmacenes::obtenerAlmacenPorDepartamento($departamento);
        echo $result;
    }

    
}
