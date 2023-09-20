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
        header('location: ../../../Vista/indexAdministrador.php');
    }

    public function eliminar($context)
    {
        $numBulto = $context['post']['numBulto'];
        modeloPaquetes::baja($numBulto, $this->conn);
        header('location: ../../../Vista/indexAdministrador.php');
    }

    public function rastrear($context){
        $ci = $context;
        $result = modeloUsuarios::muestra($ci, $this->conn);
        return $result;
    }

    public function listar($context)
    {
        $json = json_decode(modeloPaquetes::listado($this->conn));
        $result = $json;

        $arrayConsulta = array();

        foreach ($result as $row) {
            $numBulto = $row->numBulto;
            $gmailCliente = $row->gmailCliente;
            $idRastreo = $row->idRastreo;
            $fechaLlegada = $row->fechaLlegada;
            $fechaEntrega = $row->fechaEntrega;
            $num = $row->num;
            $calle = $row->calle;
            $localidad = $row->localidad;
            $departamento = $row->departamento;
            array_push($arrayConsulta, ['Número de bulto: ' => $numBulto, '<br> Gmail del cliente: ' => $gmailCliente, '<br> ID de rastreo: ' => $idRastreo, '<br> Fecha de llegada: ' => $fechaLlegada, '<br> Fecha de entrega: ' => $fechaEntrega, '<br> Num: ' => $num, '<br> Calle: ' => $calle, '<br> Localidad: ' => $localidad, '<br> Departamento: ' => $departamento . '<br><br>']);
        }

        foreach ($arrayConsulta as $value) {
            foreach ($value as $key => $v) {
                echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
            }
        }
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
