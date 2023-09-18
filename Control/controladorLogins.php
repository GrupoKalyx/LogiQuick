<?php
require '../Modelo/modeloLogins.php';
require 'controladorTokens.php';
require 'controladorUsuarios.php';

session_start();

class controladorLogins
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
        if (modeloLogins::existe($ci, $this->conn)) {
            if (modeloLogins::contrasenia($ci, $contrasenia, $this->conn)) {
                $t = new controladorTokens($this->conn);
                $_SESSION['ci'] = $ci;
                $_SESSION['token'] = $t->createToken($ci);
                $objTipo = json_decode(modeloLogins::tipo($ci, $this->conn), true);
                $tipo = $objTipo['tipo'];
                switch ($tipo) {
                    case 'Almacen':
                        header("location: ../../../Vista/FunCentral.php");
                        break;
                    case 'Externo':
                        header("location: ../../../Vista/FunExternoCentral.php");
                        break;
                    case 'Camionero':
                        header("location: ../../../Vista/Camionero.html");
                        break;
                    case 'Delivery':
                        header("location: ../../../Vista/Delivery.html");
                        break;
                    default:
                        echo "<script>alert('Tipo de usuario desconocido, re intente por favor!');window.location='../../../Vista/login.php</script>";
                }
            } else {
                echo "<script>alert('La contraseña ingresada es incorrecta, revise los datos ingresados y vuelva a intentar.');window.location='../../../Vista/login.php</script>";
            }
        } else {
            echo "<script>alert('Usuario inexistente, re intente por favor.');window.location='../../../Vista/login.php'</script>";
        }
    }
}
