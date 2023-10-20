<?php
require '../Modelo/modeloUsuarios.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
    'GET' => $_GET,
    'POST' => $_POST,
    'PUT' => $_PUT,
    'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorUsuarios::$function($context);

class controladorUsuarios
{

    public function ingresar($context)
    {
        $ci = $context['ci'];
        $nombre = $context['nombre'];
        $contrasenia = $context['contrasenia'];
        $tipo = $context['tipo'];
        modeloUsuarios::alta($ci, $nombre, $contrasenia, $tipo);
    }
 
    public function eliminar($context)
    {
        $ci = $context['ci'];
        modeloUsuarios::baja($ci);
    }

    public function mostrar($context){
        $ci = $context;
        $result = modeloUsuarios::muestra($ci);
        echo $result;
    }
    
    public static function existencia($context)
    {
        $ci = $context['ci'];
        $existencia = modeloUsuarios::existe($ci);
        echo $existencia;
    }

    public function listar($context)
    {
        $result = modeloUsuarios::listado();
        echo $result;
    }

    public function modificar($context)
    {
        $ci = $context['ci'];
        $nombre = $context['nombre'];
        $contrasenia = $context['contrasenia'];
        modeloUsuarios::modificacion($ci, $nombre, $contrasenia);
    }
}
