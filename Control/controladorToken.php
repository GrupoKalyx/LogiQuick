<?php
require '../Modelo/modeloToken.php';

class controladorToken
{
    private $conn;
    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createToken($content)
    {
        $ci = $content;
        $token = modeloToken::generateToken();
        modeloToken::setToken($token, $ci, $this->conn);
        return $token;
    }

    public function verify($content)
    {
        $token = $content['post']['chkToken'];
        if (modeloToken::chkToken($token,  $this->conn) == 0) {
            echo "<script>alert('Hubo un error en la sesión, intente volverse a ingresar.');window.location='../../../Vista/login.php'</script>";
        }
    }
}
