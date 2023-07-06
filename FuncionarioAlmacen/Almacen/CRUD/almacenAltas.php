<?php
require "dbconection.php";




$codigo = $_POST['Codigo'];
$nombre = $_POST['Nombre'];
$precio = $_POST['Precio'];
$stock = $_POST['Stock'];


$query= "INSERT INTO articulos VALUES ( id, $codigo,'$nombre' ,$precio, $stock )";


if($conectionn->query($query) === TRUE  ){
    header("Location:http://localhost/Projectov4/FuncionarioAlmacen/Almacenes/indexPrincipal.php");
    
}

echo "ERROR 404!!!";


?>