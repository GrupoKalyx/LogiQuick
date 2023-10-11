<?php
require '../Modelo/modeloLotes.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
  'GET' => $_GET,
  'POST' => $_POST,    
  'PUT' => $_PUT,
  'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorLotes::$function($context);

class controladorLotes
{ 

    public static function ingresar($context)
    {
        $matricula = modeloLotes::alta();
        echo $matricula;
    }

    public static function eliminar($context)
    {
        $matricula = $context['matricula'];
        modeloLotes::baja($matricula);
    }

    public static function listar($context)
    {
        $result = modeloLotes::listado();
        echo $result;
    }
    
    public static function modificar($context){
        $matricula = $context['matricula'];
        modeloLotes::modificacion($matricula);
    }
}


