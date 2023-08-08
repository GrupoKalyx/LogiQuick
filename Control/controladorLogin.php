<?php
// require '../Modelo/modeloLogin.php';

class controladorLogin
{
    public static function controladorUsuario($conn, $ci, $contrasenia)
    {
        if (login::existe($conn, $ci)) {
            if (login::contrasenia($conn, $ci, $contrasenia)) {
                $tipo = login::tipo($conn, $ci);
                switch ($tipo) {
                    case 'value':
                        # code...
                        break;
                }
            } else {
                echo "<script>alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');window.location='../login.php'</script>";
            }
        } else {
            echo "<script>alert('Usuario inexistente ,re intente por favor.');window.location='../login.php'</script>";
        }
    }
}
