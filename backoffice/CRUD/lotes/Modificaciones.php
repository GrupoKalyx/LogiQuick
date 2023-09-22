<?php
require_once('../../sql/dbconection.php');

$numLote = $_POST['numeroLote'];

if ($exc) {
  echo '<p>Cliente actualizado con éxito</p>';
  header("location:http://localhost/LogiQuick/backoffice/indexAdministrator.php");
}
?>