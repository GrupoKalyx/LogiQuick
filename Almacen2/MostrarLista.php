<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
</head>

<body>
    <h1>Lista Almacen</h1>

    <?php
    function httpRequest($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        return $data;
    }
    $dato = json_decode(httpRequest("http://127.0.0.1/Projecto/Almacen2/AlmacenLista.php"), true);
    $colores = array();
    

    ?>
    <table border="1" >

        <thead>

            <tr>
            <?php

    $array = array("ID ","Codigo ","Nombre ","Precio ","Stock ");

  foreach ($array as $valor) {

    echo '<th>'.$valor.'</th>';

  }

?>

</tr>

</thead>

<tbody>

<?php

// obtenemos los colores

foreach ($dato as $array){

echo "<tr>";

  foreach($array as $contenido)

  {

      echo "<td>".$contenido."</td>";

  }

echo "</tr>";

}

?>

</tbody>

</table>

</body>

</html>