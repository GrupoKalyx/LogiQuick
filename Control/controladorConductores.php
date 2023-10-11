<?php
require '../Modelo/modeloConductores.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $_GET,
        'POST' => $_POST,
        'PUT' => $_PUT,
        'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorConductores::$function($context);

class controladorConductores
{

        public static function ingresar($context)
        {
                $ci = $context['ci'];
                $nombre = $context['nombre'];
                $telefono = $context['telefono'];
                modeloConductores::alta($ci, $nombre, $telefono);
        }

        public static function eliminar($context)
        {
                $ci = $context['ci'];
                modeloConductores::baja($ci);
        }

        public static function listar($context)
        {
                $result = modeloConductores::listado();
                echo $result;
        }

        public static function modificar($context)
        {
                $nombre = $context['nombre'];
                $telefono = $context['telefono'];
                $ci = $context['ci'];
                modeloConductores::modificacion($nombre, $telefono, $ci);
        }
}
