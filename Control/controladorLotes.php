<?php
require '../Modelo/modeloLotes.php';

$requestMethod = '_' . $_SERVER['REQUEST_METHOD'];
$context = $$requestMethod; //va con doble $var_dump($)
$function = $context['function'];
controladorPaquetes::$function($context);

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

    public static function ingresar($context)
    {
        $idLote = modeloLotes::alta();
        echo $idLote;
    }

    public static function eliminar($context)
    {
        $numBulto = $context['numBulto'];
        modeloLotes::baja($numBulto);
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
}