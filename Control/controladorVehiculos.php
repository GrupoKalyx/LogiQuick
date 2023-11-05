<?php
require '../Modelo/modeloVehiculos.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $_GET,
        'POST' => $_POST,
        'PUT' => $_PUT,
        'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorVehiculos::$function($context);

class controladorVehiculos
{

        public static function ingresar($context)
        {
                $matricula = $context['matricula'];
                $disponibilidad = $context['disponibilidad'];
                modeloVehiculos::alta($matricula, $disponibilidad);
        }

        public static function eliminar($context)
        {
                $matricula = $context['matricula'];
                modeloVehiculos::baja($matricula);
        }

        public static function listar($context)
        {
                $result = modeloVehiculos::listado();
                echo $result;
        }

        public static function modificar($context)
        {
                $disponibilidad = $context['disponibilidad'];
                $matricula = $context['matricula'];
                modeloVehiculos::modificacion($disponibilidad, $matricula);
        }
}
