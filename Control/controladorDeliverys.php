<?php
require '../Modelo/modeloDeliverys.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $_GET,
        'POST' => $_POST,
        'PUT' => $_PUT,
        'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorDeliverys::$function($context);

class controladorDeliverys
{

        public static function ingresar($context)
        {
                $ci = $context['ci'];
                $nombre = $context['nombre'];
                $telefono = $context['telefono'];
                modeloDeliverys::alta($ci, $nombre, $telefono);
        }

        public static function eliminar($context)
        {
                $ci = $context['ci'];
                modeloDeliverys::baja($ci);
        }

        public static function listar($context)
        {
                $result = modeloDeliverys::listado();
                echo $result;
        }

        public static function modificar($context)
        {
                $nombre = $context['nombre'];
                $telefono = $context['telefono'];
                $ci = $context['ci'];
                modeloDeliverys::modificacion($nombre, $telefono, $ci);
        }
}
