<?php

class GeneroModel extends Model
{
    private $id;
    private $nombre;
    public function __construct()
    {
        error_log('GENEROMODEL::CONSTRCUT->inicio del generoModel');
        parent::__construct();
        $this->id = "";
        $this->nombre = "";
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setNombre($nombre)
    {
        $this->id = $nombre;
    }
    public function getNombre()
    {
        return $this->id;
    }
}
