<?php
require '../Modelo/modeloLotes.php';

$requestMethod = '_' . $_SERVER['REQUEST_METHOD'];
$context = $$requestMethod; //va con doble $var_dump($)
$function = $context['function'];
controladorPaquetes::$function($context);

class controladorLotean
{

    public static function ingresar()
    {
        $idLote = $_POST['idLote'];
        $paquetes = $_POST['paquetes'];
        modeloLotean::alta($idLote, $paquetes);
    }

    public static function eliminar()
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
        echo $result;
    }

    public static function modificar($context)
    {
        $numBulto = $context['numBulto'];
        $idLote = $context['idLote'];
        modeloLotean::modificacion($numBulto, $idLote);
    }
}
