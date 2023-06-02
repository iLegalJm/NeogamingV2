<?php

class DB
{
    private $server = "127.0.0.1";
    private $dbName = "neogaming";
    private $user = "root";
    private $pass = "..MalTin2022";
    private $port = 3377;

    private $db;

    public function __construct()
    {
        $this->db = new mysqli($this->server, $this->user, $this->pass, $this->dbName, $this->port);
    }

    public function query($sql)
    {
        $result = $this->db->query($sql);

        // ? Array vacio
        $arr = [];
        
        // ? Dentro de row le intriduzo el arreglo asociativo de result
        while($row = $result->fetch_object()){
            $arr[] = $row;
        }

        return $arr;
    }

    public function queryOne($sql){
        $result = $this->db->query($sql);
        return $result->fetch_object();
    }

    public function escape($str){ // ? Metodo para evitar sql injection
        return $this->db->escape_string($str);
    }
}
