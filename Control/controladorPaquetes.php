<?php
require '../Modelo/modeloPaquetes.php';
class controladorPaquetes
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function ingresar($context)
    {
        $gmailCliente = $context['post']['gmailCliente'];
        $fechaLlegada = $context['post']['fechaLlegada'];
        $num = $context['post']['num'];
        $calle = $context['post']['calle'];
        $localidad = $context['post']['localidad'];
        $departamento = $context['post']['departamento'];

        modeloPaquetes::alta($gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $this->conn);

        $url = $context['post']['url'];
        header('location: https://' . $url);
    }

    public function eliminar($context)
    {
        $numBulto = $context['post']['numBulto'];
        modeloPaquetes::baja($numBulto, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }

    public function mostrar($context)
    {
        $numBulto = $context['post']['numBulto'];
        $result = modeloUsuarios::muestra($this->conn, $numBulto);
        return $result;
    }

    public function listar($context)
    {
        $opcion = $context['post']['opcion'];
        $json = modeloPaquetes::listado($this->conn, $opcion);
        echo $json;
        header('https')
    }

    public function modificar($context)
    {
        $numBulto = $context['post']['numBulto'];
        $gmailCliente = $context['post']['gmailCliente'];
        $fechaLlegada = $context['post']['fechaLlegada'];
        $num = $context['post']['num'];
        $calle = $context['post']['calle'];
        $localidad = $context['post']['localidad'];
        $departamento = $context['post']['departamento'];

        modeloPaquetes::modificacion($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }
}
