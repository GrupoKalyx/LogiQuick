<?php
require '../Modelo/modeloLotes.php';

$context = match ($_SERVER['REQUEST_METHOD']) {
  'GET' => $_GET,
  'POST' => $_POST,
  'PUT' => $_PUT,
  'DELETE' => $_DELETE,
};

$function = $context['function'];
controladorLotes::$function($context);

class controladorLotes
{ 

    public static function ingresar($context)
    {
        $idLote = modeloLotes::alta();
        echo $idLote;
    }

    public static function eliminar($context)
    {
        $idLote = $context['idLote'];
        modeloLotes::baja($idLote);
    }

    public static function listar($context)
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

    public static function existe($context){
        $idLote = $context['idLote'];
        return modeloLotes::existe($idLote);
    }
}