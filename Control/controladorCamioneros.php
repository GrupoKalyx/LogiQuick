<?php
require '../Modelo/modeloCamioneros.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $_GET,
        'POST' => $_POST,
        'PUT' => $_PUT,
        'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorCamioneros::$function($context);

class controladorCamioneros
{

        public static function ingresar($context)
        {
                $ci = $context['ci'];
                $nombre = $context['nombre'];
                $telefono = $context['telefono'];
                modeloCamioneros::alta($ci, $nombre, $telefono);
        }

        public static function eliminar($context)
        {
                $ci = $context['ci'];
                modeloCamioneros::baja($ci);
        }

        public static function listar($context)
        {
                $result = modeloCamioneros::listado();
                echo $result;
        }

        public static function modificar($context)
        {
                $nombre = $context['nombre'];
                $telefono = $context['telefono'];
                $ci = $context['ci'];
                modeloCamioneros::modificacion($nombre, $telefono, $ci);
        }
}
