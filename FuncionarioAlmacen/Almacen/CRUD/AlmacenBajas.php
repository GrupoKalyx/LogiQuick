<?php
require "dbconection.php";

$idpost = $_POST['id2'];
 

$query ="DELETE FROM articulos WHERE ID = $idpost";
$result = mysqli_query($conectionn, $query);

if($conectionn->query($query) === TRUE  ){
    header("Location:http://localhost/Projectov4/Almacen/index.php");
    
}

    
    




?>