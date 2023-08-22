<?php
class modeloBd
{
    protected $conn;

    protected function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "logiquickbd");
    }
}
