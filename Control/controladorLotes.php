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
        $idLote = modeloLotes::alta();
        echo $idLote;
    }

    public static function eliminar($context)
    {
        $idLote = $context['idLote'];
        modeloLotes::baja($idLote);
    }

    public static function listar($context)
    {
        $result = modeloLotes::listado();
        echo $result;
    }

    public static function listarExterno($context)
    {
        $result = modeloLotes::listadoExterno();
        echo $result;
    }

    public static function existe($context){
        $idLote = $context['idLote'];
        return modeloLotes::existe($idLote);
    }
    
    public static function muestraPaquetesAsociados($context){
        $idLote = $context['idLote'];
        $result = modeloLotes::paquetesAsociados($idLote);
        echo $result;
    }
}


