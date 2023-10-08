<?php
    require_once('../../sql/dbconection.php');

    $query = "SELECT * FROM paquetes";
    $result = mysqli_query($conn, $query);
    $arrayConsulta = array();

    foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
        $numBulto = $row['numBulto'];
        $gmailCliente = $row['gmailCliente'];
        $idRastreo = $row['idRastreo'];
        $fechaEntrega = $row['fechaEntrega'];
        $num = $row['num'];
        $calle = $row['calle'];
        $localidad = $row['localidad'];
        $departamento = $row['departamento'];
        $lat = $row['lat'];
        $lng = $row['lng'];
        array_push($arrayConsulta, ['Número de bulto: ' => $numBulto, '<br> Gmail del cliente: ' => $gmailCliente, '<br> ID de rastreo: ' => $idRastreo, '<br> Fecha de entrega: ' => $fechaEntrega, '<br> Num: ' => $num, '<br> Calle: ' => $calle, '<br> Localidad: ' => $localidad, '<br> Departamento: ' => $departamento, '<br> Destino: ' => $lat . ", ". $lng . '<br><br>']);
    }

    foreach ($arrayConsulta as $value) {
        foreach ($value as $key => $v) {
            echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
        }
    }