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
        if (function_exists('com_create_guid')) {
            $new_GUID = com_create_guid();
        } else {
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
        }
        return $new_GUID;
    }

    public function setToken($token, $ci)
    {
        $query = "INSERT INTO token VALUES (?, ?)";
        $result = $this->conn->execute_query($query, $token, $ci);
        $result->fetch_array(MYSQLI_ASSOC);
        return $result;
    }

    public function chkToken($token)
    {
        mysqli_query($this->conn, "SELECT userToken FROM sessiontoken WHERE userToken = '$token'") == true;
    }
}
