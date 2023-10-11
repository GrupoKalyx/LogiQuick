<?php
require '../Modelo/modeloPickups.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $_GET,
        'POST' => $_POST,
        'PUT' => $_PUT,
        'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorPickups::$function($context);

class controladorPickups
{

        public static function ingresar($context)
        {
                $matricula = $context['matricula'];
                $disponibilidad = $context['disponibilidad'];
                modeloPickups::alta($matricula, $disponibilidad);
        }

        public static function eliminar($context)
        {
                $matricula = $context['matricula'];
                modeloPickups::baja($matricula);
        }

        public static function listar($context)
        {
                $result = modeloPickups::listado();
                echo $result;
        }

        public static function modificar($context)
        {
                $disponibilidad = $context['disponibilidad'];
                $matricula = $context['matricula'];
                modeloPickups::modificacion($disponibilidad, $matricula);
        }
}
