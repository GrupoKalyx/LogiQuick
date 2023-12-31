<?php
require_once('../../sql/dbconection.php');

$matricula = $_POST['matricula'];

$queryIsCamion = "SELECT matricula FROM `camiones` WHERE matricula = ? LIMIT 1";
$excIsCamion = $conn->execute_query($queryIsCamion, [$matricula]);
$camion = $excIsCamion->num_rows;
echo $camion;

$queryIsPickup = "SELECT matricula FROM `camiones` WHERE matricula = ? LIMIT 1";
$excIsPickup = $conn->execute_query($queryIsPickup, [$matricula]);
$pickup = $excIsPickup->num_rows;
echo $pickup;

if ($camion) {
  $queryCam = "DELETE FROM conducen WHERE matricula = ?";
  $excCam = $conn->execute_query($queryCam, [$matricula]);

  $queryCam = "DELETE FROM llevan WHERE matricula = ?";
  $excCam = $conn->execute_query($queryCam, [$matricula]);

  $queryCam = "DELETE FROM camiones WHERE matricula = ?";
  $excCam = $conn->execute_query($queryCam, [$matricula]);
} else if ($pickup) {
  $queryPick = "DELETE FROM manejan WHERE matricula = ?";
  $excPick = $conn->execute_query($queryPick, [$matricula]);

  $queryPick = "DELETE FROM entregan WHERE matricula = ?";
  $excPick = $conn->execute_query($queryPick, [$matricula]);

  $queryPick = "DELETE FROM pickups WHERE matricula = ?";
  $excPick = $conn->execute_query($queryPick, [$matricula]);
}

$query = "DELETE FROM vehiculos WHERE matricula = ?";
$excVehic = $conn->execute_query($query, [$matricula]);
$exc = ($excVehic and $excPick and $excCam);


if ($exc) {
  echo "<script> alert('Vehiculo eliminado con éxito.');window.location='../../indexAdmin.php'; </script>";
} else {
  echo "<script> alert('Un error inesperado ocurrió.');window.location='../../indexAdmin.php'; </script>";
}
