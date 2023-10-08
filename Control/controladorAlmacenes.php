<?php
require '../Modelo/modeloAlmacenes.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorPaquetes::$function($context);

class controladorAlmacenes
{
    public function ingresar($context)
    {
        $idAlmacen = $context['idAlmacen'];
        $ubiAlmacen = $context['ubiAlmacen'];
        $calle = $context['calle'];
        $departamento = $context['departamento'];
        $localidad = $context['localidad'];
        $N_puerta = $context['N_puerta'];
        modeloAlmacenes::alta($idAlmacen, $ubiAlmacen, $calle, $departamento, $localidad, $N_puerta);
    }

    public function eliminar($context)
    {
        $idAlmacen = $context['idAlmacen'];
        modeloAlmacenes::baja($idAlmacen);
    }

    public function mostrar($context)
    {
        $result = modeloAlmacenes::listado();
        echo $result;
    }

    public function modificar($context)
    {
        $idAlmacen = $context['idAlmacen'];
        $ubiAlmacen = $context['ubiAlmacen'];
        $calle = $context['calle'];
        $departamento = $context['departamento'];
        $localidad = $context['localidad'];
        $N_puerta = $context['N_puerta'];
        modeloAlmacenes::modificacion($idAlmacen, $ubiAlmacen, $calle, $departamento, $localidad, $N_puerta);
    }

    public function mostrarActual($context){
        $idRastreo = $context['idRastreo'];
        $result = modeloAlmacenes::muestraActual($idRastreo);
        echo $result;
    }
}
