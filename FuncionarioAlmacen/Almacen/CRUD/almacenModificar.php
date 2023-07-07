<?php
require "dbconection.php";
$id = $_POST['id'];
$codigo = $_POST['Codigo'];
$nombre = $_POST['Nombre'];
$precio = $_POST['Precio'];
$stock = $_POST['Stock'];


$query = "UPDATE articulos SET  Codigo = $codigo , Nombre = '$nombre' , Precio = $precio , Stock = $stock WHERE ID = $id";
$result = mysqli_query($conectionn, $query);
if($conectionn->query($query) === TRUE  ){
    header("Location:http://localhost/LogiQuick/Almacen/index.php");
    
}

?>