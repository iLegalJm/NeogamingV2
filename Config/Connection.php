<?php
class Connection
{
    private $host;
    private $user;
    private $pass;
    private $dbName;
    public $conn;
    private $port;

    public function __construct()
    {
        $this->host = "mysql:host=localhost;dbname=";
        $this->user = "root";
        $this->pass = "..DoubleJ221102";
        $this->dbName = "neogaming";
        $this->port = 3377;

        try {
            $this->conn = new PDO(
                "mysql:host=localhost;port=$this->port;
                dbname=" . $this->dbName,
                $this->user,
                $this->pass
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
