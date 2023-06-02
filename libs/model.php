<?php

include_once 'libs/imodel.php';
class Model
{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function query($query)
    {
        return $this->db->connect()->query($query);
    }
    public function prepare($query)
    {
        return $this->db->connect()->prepare($query);
    }
}
