<?php
class Database {
    private $servername = "seu-local-do-servidor";
    private $username = "seu-usuario";
    private $password = "sua-senha";
    private $database = "seu-db";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
