<?php
require '../Modelo/modeloLotes.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'GET':-
        $function = $_GET['function'];
        break;
    case 'POST':
        $function = $_POST['function'];
        break;
    case 'PUT':
        $function = $_PUT['function'];
        break;
    case 'DELETE':
        $function = $_DELETE['function'];
        break;
}

controladorLotes::$function();

class controladorLotes
{

    public static function ingresar()
    {
        $idLote = modeloLotes::alta();
        echo $idLote;
    }

    public static function eliminar($context)
    {
        $numBulto = $_DELETE['numBulto'];
        modeloLotes::baja($numBulto);
    }

    // public static function rastrear()
    // {
    //     $ci = $_GET['ci'];
    //     $result = modeloUsuarios::muestra($ci);
    //     return $result;
    // }

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

    public static function modificar()
    {
        $numBulto = $_PUT['numBulto'];
        $gmailCliente = $_PUT['gmailCliente'];
        $fechaLlegada = $_PUT['fechaLlegada'];
        $num = $_PUT['num'];
        $calle = $_PUT['calle'];
        $localidad = $_PUT['localidad'];
        $departamento = $_PUT['departamento'];

        modeloPaquetes::modificacion($numBulto, $gmailCliente, $fechaLlegada, $num, $calle, $localidad, $departamento);
    }
}
