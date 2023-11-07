<?php
require_once('../Control/superControlador.php');
// if (isset($_POST['login'])) {
//     $_POST['login'] = NULL;
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/LogiQuick/Control/controladorLogins.php';
    superControlador($url, 'GET', array('function' => 'chequear', 'ci' => $_POST['ci'], 'contrasenia' => $_POST['contrasenia']));
// }
?>
