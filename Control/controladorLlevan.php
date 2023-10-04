<?php
require '../Modelo/modeloLlevan.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
  'GET' => $_GET,
  'POST' => $_POST,    
  'PUT' => $_PUT,
  'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorLlevan::$function($context);

class controladorLlevan
{ 

    public static function ingresar($context)
    {
        $matricula = $context['matricula']; 
        $idLote = $context['idLote']; 
        $numBulto = $context['numBulto'];
        modeloLLevan::alta($matricula, $idLote, $numBulto);
    }

    public static function eliminar($context)
    {
        $matricula = $context['matricula']; 
        $idLote = $context['idLote']; 
        $numBulto = $context['numBulto'];
        modeloLLevan::baja($matricula, $idLote, $numBulto);
    }

    public static function listar($context)
    {
        $result = modeloLlevan::listado();
        return $result;
    }

    public static function listarEnLote($context)
    {
        $result = modeloLlevan::listado();
        return $result;
    }
}