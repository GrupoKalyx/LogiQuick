<?php

require '../Modelo/modeloConducen.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $_GET,
        'POST' => $_POST,
        'PUT' => $_PUT,
        'DELETE' => $_DELETE,
    };
    
    $function = $context['function'];
    controladorConducen::$function($context);

class controladorConducen
{

        public static function camionAsignado($context)
        {
                $result = modeloConducen::camionAsignado();
                echo $result;
        }
}