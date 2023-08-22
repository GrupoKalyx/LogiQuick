<?php
class modeloBd
{
    protected static function conexion()
    {
        return $conn = new mysqli("localhost", "root", "", "logiquickbd");
    }
}
