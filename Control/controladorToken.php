<?
require '../Modelo/modeloToken.php';

class controladorToken
{
    function createToken($content)
    {
        $ci = $content['post']['ci'];
        $t = new modeloToken();
        $token = $t->generateToken();
        $t->setToken($token, $ci);
    }

    function chkToken($content)
    {
        $t = new modeloToken();
        $token = $_SESSION['chkToken'];
        if (!($t->chkToken($token) == 0)) {
            if (isset($_POST['btncerrar'])) {
                session_destroy();
                header("location: http://localhost/LogiQuick/Vista/login.php");
            } else {
                echo "ERROOOOOOOOOOOOOOOOOOOR";
                header("location: http://localhost/LogiQuick/Vista/Login.php");
            }
        }
    }
}
