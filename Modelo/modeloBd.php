<?php
class modeloBd
{
    public static function conexion()
    {
        return $conn = new mysqli("localhost", "root", "", "logiquickbd");
    }
}
