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
        $idAlmacen = $context['idAlmacen'];
        $numRuta = $context['numRuta'];

        modeloLLevan::alta($matricula, $idLote, $idAlmacen, $numRuta);
    }

    public static function eliminar($context)
    {
        $matricula = $context['matricula']; 
        $idLote = $context['idLote']; 
        $idAlmacen = $context['idAlmacen'];
        $numRuta = $context['numRuta'];
        modeloLLevan::baja($matricula, $idLote, $idAlmacen, $numRuta);
    }

    public static function listar($context)
    {
        $result = modeloLlevan::listado();
        return $result;
    }
    
    public static function LoteDeConductor($context)
    {
        $ci = $context['ci'];
        $result = modeloLlevan::LoteDeConductor($ci);
        var_dump($result);
        return $result;
    }
    public static function MarcarSalida($context)
    {
        $idLote = $context['idLote'];
        var_dump($idLote);
        modeloLlevan::MarcarSalida($idLote);
    }
}