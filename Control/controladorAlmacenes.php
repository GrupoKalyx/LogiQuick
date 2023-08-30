<?php
require '../Modelo/modeloAlmacenes.php';
class controladorUsuarios
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function mostrar($context)
    {
        $json = json_decode(modeloAlmacenes::listado($this->conn));
        $result = $json;

        $arrayConsulta = array();

        foreach ($result as $row) {
            $id = $row->id;
            $ubicaidon = $row->ubicacion;
            $descUbi = $row->desc;
            array_push($arrayConsulta, ['ID: ' => $id, '<br> Ubicaidón: ' => $ubicaidon, '<br> Descripidón de ubicaidón: ' => $descUbi . '<br><br>']);
        }

        foreach ($arrayConsulta as $value) {
            foreach ($value as $key => $v) {
                echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
            }
        }
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

    public function modificar($context)
    {
        $id = $context['post']['id'];
        $ubicacion = $context['post']['ubicacion'];
        $descUbi = $context['post']['descUbi'];
        modeloAlmacenes::modificacion($id, $ubicacion, $descUbi, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }
}
