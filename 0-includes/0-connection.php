<?php
class connection
{
    private $conn;
    public function __construct()
    {
        error_reporting(E_ALL);
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cat1921ajs_sistematicket";
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($this->conn, "utf8");
    }

    public function get_connection()
    {
        if ($this->conn->connect_errno) {
            printf("Error de conexion");
            return 0;
        }
        return $this->conn;
    }
}
