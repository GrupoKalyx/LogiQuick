<?php
require "dbconection.php";
mysqli_set_charset($conectionn, "utf8");
$query = "SELECT * FROM articulos";
$result=$conectionn->query($query);

$arrayArticulos = array();
while($row = mysqli_fetch_array($result)){

    $id = $row['ID'];
    $codigo = $row['Codigo'];
    $nombre = $row['Nombre'];
    $precio = $row['Precio'];
    $stock = $row['Stock'];

    array_push( $arrayArticulos,[ 'ID' => $id ,'codigo' =>  $codigo , 'Nombre' => $nombre,'Precio' => $precio,'Stock' => $stock ]);
}



  

    
    
    




header('content-type: application/json');

echo json_encode($arrayArticulos);

    ?>


