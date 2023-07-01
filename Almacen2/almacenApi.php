<?php
require "dbconection.php";




$codigo = $_POST['Codigo'];
$nombre = $_POST['Nombre'];
$precio = $_POST['Precio'];
$stock = $_POST['Stock'];


$query= "INSERT INTO articulos2 VALUES ( id, $codigo,'$nombre' ,$precio, $stock )";


if($conectionn->query($query) === TRUE  ){
    header("Location:/Projecto/Projecto/Almacen2/index.php");
    
}

echo "ERROR 404!!!";


?>