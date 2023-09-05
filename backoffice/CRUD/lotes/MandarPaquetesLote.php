<?php
require_once('../../sql/dbconection.php');

if (isset($_POST['btn'])) {
    $lote = isset($_SESSION['numLoteRecibed']);
    $paquete = isset($_SESSION['numPaqueteRecibed']);

  $sql = "INSERT  INTO lotes VALUES idPaquete = $paquete WHERE numLote = $lote ";
  if ($conn->query($sql3)) {
    echo '<p>Cliente actualizado con éxito</p>';
    header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
  }
}



?>