<?php
date_default_timezone_set('Europe/Madrid');
$val1 = date("d");
$val2 = date("m");

/*  VARIABLES USABLES EN TODO EL CODIGO */
$empresa = "QR";




class Database {

    private $host = "localhost";
    private $db_name = "qr";
    private $username = "qr";
    private $password = "qr";
    public $conn;

    public function dbConnection() {

        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}
