<?php
class modeloBd
{
    protected function dbConection()
    {
        return $conn = new mysqli("localhost", "root", "", "logiquickbd");
    }
}
