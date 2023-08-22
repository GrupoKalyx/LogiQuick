<?php
class modeloBd
{
    protected $conn;

    protected function __construct()
    {
        $this->conn = new mysqli("127.0.0.1", "root", "", "logiquickbd");
    }
}
