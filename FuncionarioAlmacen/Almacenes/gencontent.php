<?php
$arrayResult = array();
if (isset($_POST['sub1'])){
            
   

    require '../Almacen/CRUD/dbconection.php';
    $idRecibed = $_POST['contenido'];
 

    $query = "SELECT * FROM articulos WHERE ID = '$idRecibed'";
    $result=$conectionn->query($query);
    $resultArray = array($result);
    $file = json_encode($resultArray);
    $filename = 'tempArrayArt';
    file_put_contents($file, $filename);

    $query2 = "INSERT INTO `lote`(`ID`, `ArticulosLote`) VALUES ($idRecibed,'$arrayResult')";
    $result2=$conectionn->query($query2);
}
   ?>
