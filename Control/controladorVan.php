<?php
require '../Modelo/modeloVan.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
  'GET' => $_GET,
  'POST' => $_POST,    
  'PUT' => $_PUT,
  'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorVan::$function($context);

class controladorVan
{ 

    public static function ingresar($context)
    {
        $idLote = $context['idLote'];
        $idAlmacen = $context['idAlmacen'];
        modeloVan::alta($idLote, $idAlmacen);
    }

    public static function eliminar($context)
    {
        $idLote = $context['idLote'];
        $idAlmacen = $context['idAlmacen'];
        modeloVan::baja($idLote, $idAlmacen);
    }

    public static function listar($context)
    {
        $result = modeloVan::listado();
        echo $result;
    }

    public static function mostrarAlmacenDeLote($context){
        $idLote = $context['idLote'];
        $result = modeloVan::muestraAlmacenDeLote($idLote);
        echo $result;
    }
}


