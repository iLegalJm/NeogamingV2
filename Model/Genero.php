<?php

class GeneroModel extends Model implements iModel
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

    public function create()
    {
        try {
            $query = $this->prepare('INSERT INTO genero (nombre) VALUES(:nombre)');

            $query->execute([
                'nombre' => $this->nombre
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA INSERTADA ME DEVOLVERA TRUE   
            if ($query->rowCount()) return true;
            return false;
        } catch (PDOException $e) {
            error_log('GENEROMODEL::create->PDOEXCEPTION ' . $e);
            return false;
        }
    }

    public function createPost_has_Plataformas()
    {
    }
    public function getAll()
    {
        $items = [];

        try {
            $query = $this->query('SELECT * FROM genero');

            // ? PARA QUE ME DEVUELVA UN OBJETO
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new GeneroModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            error_log('GENEROMODEL::getAll()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function get($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM genero WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);
            $genero = $query->fetch(PDO::FETCH_ASSOC);
            $this->from($genero);

            // ? RETORNO EL OBJETO DE NUESTRA CLASE
            return $this;
        } catch (PDOException $e) {
            error_log('GENEROMODEL::get()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function delete($id)
    {
        try {
            $query = $this->prepare('DELETE FROM genero WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);

            return true;
        } catch (PDOException $e) {
            error_log('GENEROMODEL::get()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function update()
    {
        try {
            $query = $this->prepare('UPDATE genero SET nombre = :nombre WHERE id = :id');

            $query->execute([
                'nombre' => $this->nombre
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA MODIFICADA ME DEVOLVERA TRUE   
            if ($query->rowCount()) return true;
            return false;
        } catch (PDOException $e) {
            error_log('GENEROMODEL::update()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function from($array)
    {
        $this->id = $array['id'];
        $this->nombre = $array['nombre'];
    }

    public function exists($nombre)
    {
        try {
            $query = $this->prepare('SELECT name FROM genero WHERE nombre = :nombre');

            $query->execute([
                'nombre' => $nombre
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA INSERTADA ME DEVOLVERA TRUE   
            if ($query->rowCount()) return true;
            return false;
        } catch (PDOException $e) {
            error_log('GENEROMODEL::exists->PDOEXCEPTION ' . $e);
            return false;
        }
    }
}
