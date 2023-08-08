<?php
require 'controladorBD.php';
require 'controladorLogin.php';

class superControlador
{
    public static function controladorBD()
    {
        $conn = controladorBD::conectar();
        return $conn;
    }

    public static function controladorLogin()
    {
        $conn = json_decode(self::controladorBD());
        controladorLogin::controladorUsuario($conn, $_POST['$ci'], $_POST['$contrasenia']);
    }
}
