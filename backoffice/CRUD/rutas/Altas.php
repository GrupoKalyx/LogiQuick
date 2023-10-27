<?php
require_once('../../sql/dbconection.php');

$numRuta = $_POST['numRuta'];
$departamentos = $_POST['departamentos'];

$stringDep = $departamentos[0];
foreach ($departamentos as $dep => $nombreDep) {
  if ($dep != 0){
    $stringDep .= ", " . $nombreDep;
  }
}

$query = "INSERT INTO rutas (numRuta, departamentos) VALUES (?, ?)";
$exc = $conn->execute_query($query, [$numRuta, $stringDep]);

if ($exc) {
  echo "<script>alert('Almacen ingresado con éxito.');window.location='../../indexAdmin.php'</script>";
} else {
  echo "<script>alert('Ha ocurrido un error inesperado.');window.location='../../indexAdmin.php'</script>";
}