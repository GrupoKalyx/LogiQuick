<?php
require '../Modelo/modeloCamiones.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $_GET,
        'POST' => $_POST,
        'PUT' => $_PUT,
        'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorCamiones::$function($context);

class controladorCamiones
{

        public static function ingresar($context)
        {
                $matricula = $context['matricula'];
                $disponibilidad = $context['disponibilidad'];
                modeloCamiones::alta($matricula, $disponibilidad);
        }

        public static function eliminar($context)
        {
                $matricula = $context['matricula'];
                modeloCamiones::baja($matricula);
        }

        public static function listar($context)
        {
                $result = modeloCamiones::listado();
                echo $result;
        }

        public static function listarSinConductor($context)
        {
                $result = modeloCamiones::listadoSinConductor();
                echo $result;
        }

        public static function modificar($context)
        {
                $disponibilidad = $context['disponibilidad'];
                $matricula = $context['matricula'];
                modeloCamiones::modificacion($disponibilidad, $matricula);
        }
}
