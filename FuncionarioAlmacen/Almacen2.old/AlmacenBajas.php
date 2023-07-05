<?php
require "dbconection.php";

$idpost = $_POST['id2'];
 

$query ="DELETE FROM articulos2 WHERE ID = $idpost";
$result = mysqli_query($conectionn, $query);

if($conectionn->query($query) === TRUE  ){
    header("Location:/Projecto/Projecto/Almacen2/index.php");
    
}

    
    




?>