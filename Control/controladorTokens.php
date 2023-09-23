<?php
require '../Modelo/modeloTokens.php';

class controladorTokens
{
    private $conn;
    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createToken($context)
    {
        $ci = $context;
        $token = modeloTokens::generateToken();
        modeloTokens::setToken($token, $ci, $this->conn);
        return $token;
    }

    public function verify($context)
    {
        $token = $context['post']['chkToken'];
        if (modeloTokens::chkToken($token,  $this->conn) == 0) {
            echo "<script>alert('Hubo un error en la sesión, intente volverse a ingresar.');window.location='../../../Vista/login.php'</script>";
        }
    }

    public function exists($context){
        $ci = $context;
        $existence = modeloTokens::chkUser($ci, $this->conn);
        return $existence;
    }
}