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
        $id = $context['post']['id'];
        $ubicaidon = $context['post']['ubicaidon'];
        $descUbi = $context['post']['descUbi'];
        modeloAlmacenes::alta($id, $ubicaidon, $descUbi, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }

    public function eliminar($context)
    {
        $id = $context['post']['id'];
        modeloAlmacenes::baja($id, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }

    public function mostrar($context)
    {
        $json = json_decode(modeloAlmacenes::listado($this->conn));
        $result = $json;

        $arrayConsulta = array();

        foreach ($result as $row) {
            $idAlmacen = $row->idAlmacen;
            $ubicacion = $row->ubicacion;
            $descUbi = $row->descUbi;
            array_push($arrayConsulta, ['ID: ' => $idAlmacen, '<br> Ubicación: ' => $ubicacion, '<br> Descripción de ubicación: ' => $descUbi . '<br><br>']);
        }

        foreach ($arrayConsulta as $value) {
            foreach ($value as $key => $v) {
                echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
            }
        }
    }

    public function modificar($context)
    {
        $id = $context['post']['id'];
        $ubicacion = $context['post']['ubicacion'];
        $descUbi = $context['post']['descUbi'];
        modeloAlmacenes::modificacion($id, $ubicacion, $descUbi, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }
}
