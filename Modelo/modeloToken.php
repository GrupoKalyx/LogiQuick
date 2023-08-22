<?php
require_once 'modeloBd.php';

class modeloToken extends modeloBd
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generateToken()
    {
        mt_srand((float) microtime() * 10000);
        //optional for php 4.2.0 and up.
        $set_charid = strtoupper(md5(uniqid(rand(), true)));
        $set_hyphen = chr(45);
        // "-"
        $set_uuid = chr(123)
            . substr($set_charid, 0, 8) . $set_hyphen
            . substr($set_charid, 8, 4) . $set_hyphen
            . substr($set_charid, 12, 4) . $set_hyphen
            . substr($set_charid, 16, 4) . $set_hyphen
            . substr($set_charid, 20, 12)
            . chr(125);
        $new_GUID = $set_uuid;
        return $new_GUID;
    }

    public function setToken($token, $ci)
    {
        $query = "INSERT INTO token VALUES (?, ?)";
        $result = $this->conn->execute_query($query, [$token, $ci]);
    }

    public function chkToken($token)
    {
        $query = "SELECT * FROM tokens WHERE tokenUsuario = ? LIMIT 1";
        $result = $this->conn->execute_query($query, $token);
        $num = mysqli_num_rows($result);
        return $num;
    }
}
