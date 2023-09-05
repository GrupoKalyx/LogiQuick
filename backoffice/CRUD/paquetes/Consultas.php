-<?php
    require_once('../../sql/dbconection.php');
    echo '<link rel="stylesheet" href="../../../estilos/FormStyle2.css">';

    $query = "SELECT * FROM paquetes";
    $result = mysqli_query($conn, $query);
    $arrayConsulta = array();

    foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
        $num = $row['numBulto'];
        // $vol = $row['volumen'];
        $est = $row['estado'];
        $correo = $row['gmailCliente'];
        $idr = $row['idRastreo'];
        array_push($arrayConsulta, ['Numero de bulto : ' => $num, /*'<br> volumen: ' => $vol, */ '<br>Estado: ' => $est, '<br>Correo del cliente: ' => $correo, '<br>ID de rastreo: ' => $idr . '<br><br>']);
    }

    foreach ($arrayConsulta as $value) {
        foreach ($value as $key => $v) {
            echo "<a class='form__viewContent'> " . $key . " " . $v . "</a>";
        }
    }
    ?>