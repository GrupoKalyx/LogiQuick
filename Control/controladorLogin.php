<?php
require '../Modelo/modeloLogin.php';
require 'controladorToken.php';

class controladorLogin
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function chequear($content)
    {
        $ci = $content['post']['ci'];
        $contrasenia = $content['post']['contrasenia'];
        if (modeloLogin::existe($ci, $this->conn)) {
            if (modeloLogin::contrasenia($ci, $contrasenia, $this->conn)) {
                $t = new controladorToken($this->conn);
                $_SESSION['token'] = $t->createToken($ci);
                $objTipo = json_decode(modeloLogin::tipo($ci, $this->conn), true);
                $tipo = $objTipo['tipo'];
                switch ($tipo) {
                    case 'Admin':
                        header("Location: ../../../Vista/IndexAdministrador.php");
                        break;
                    case 'Almacen':
                        header("location: ../../../Vista/FunCentral.php");
                        break;
                    case 'Externo':
                        header("location: ../../../Vista/FunExternoCentral.php");
                        break;
                    case 'Camionero':
                        header("location: ../../../Vista/Camionero.html");
                        break;
                    default:
                        echo "<script>alert('Tipo de usuario desconocido, re intente por favor!');window.location='../../../Vista/login.php'</script>";
                        break;
                }
            } else {
                echo "<script>alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');window.location='../Vista/login.php'</script>";
            }
        } else {
            echo "<script>alert('Usuario inexistente ,re intente por favor.');window.location='../Vista/login.php'</script>";
        }
    }
}
