<?php
require_once('../../../Control/superControlador.php');
$url = 'http://' . $_SERVER['HTTP_HOST'] . '/LogiQuick/Control/controladorPaquetes.php';
$numBulto = superControlador($url, 'POST', array('function' => 'ingresar', 'gmailCliente' => $_POST['gmailCliente'], 'num' => $_POST['num'], 'calle' => $_POST['calle'], 'localidad' => $_POST['localidad'], 'departamento' => $_POST['departamento']));
$url = 'http://' . $_SERVER['HTTP_HOST'] . '/LogiQuick/Control/controladorPaquetes.php';
$infoPaquete = superControlador($url, 'GET', array('function' => 'mostrar', 'numBulto' => $numBulto));
var_dump($infoPaquete);
?>