<?php
require '../Modelo/modeloLotes.php';
class controladorLotes
{

    public static function ingresar()
    {
        $paquetes = $_POST['paquetes'];
        modeloLotes::alta($paquetes);
    }

    public static function eliminar($context)
    {
        $numBulto = $_POST['numBulto'];
        modeloPaquetes::baja($numBulto);
    }

    public static function listar()
    {
        $result = modeloPaquetes::listado();

        // $arrayConsulta = array();

        // foreach ($result as $row) {
        //     $numBulto = $row->numBulto;
        //     $gmailCliente = $row->gmailCliente;
        //     $idRastreo = $row->idRastreo;
        //     $fechaLlegada = $row->fechaLlegada;
        //     $fechaEntrega = $row->fechaEntrega;
        //     $num = $row->num;
        //     $calle = $row->calle;
        //     $localidad = $row->localidad;
        //     $departamento = $row->departamento;
        //     array_push($arrayConsulta, ['Número de bulto: ' => $numBulto, '<br> Gmail del cliente: ' => $gmailCliente, '<br> ID de rastreo: ' => $idRastreo, '<br> Fecha de llegada: ' => $fechaLlegada, '<br> Fecha de entrega: ' => $fechaEntrega, '<br> Num: ' => $num, '<br> Calle: ' => $calle, '<br> Localidad: ' => $localidad, '<br> Departamento: ' => $departamento . '<br><br>']);
        // }

        // foreach ($arrayConsulta as $value) {
        //     foreach ($value as $key => $v) {
        //         echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
        //     }
        // }
        return $result;
    }

    public static function modificar($context)
    {
        $numBulto = $_POST['numBulto'];
        $gmailCliente = $_POST['gmailCliente'];
        $fechaLlegada = $_POST['fechaLlegada'];
        $num = $_POST['num'];
        $calle = $_POST['calle'];
        $localidad = $_POST['localidad'];
        $departamento = $_POST['departamento'];

        modeloPaquetes::modificacion($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento, $conn);
    }
}
