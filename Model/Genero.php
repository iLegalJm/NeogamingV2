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
        $this->nombre = $nombre;
    }
    public function getNombre()
    {
        return $this->nombre;
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

    public function getGeneroHasPost($id)
    {
        $items = [];
        try {
            $query = $this->prepare('SELECT g.id, g.nombre from genero g 
            inner join post_has_genero pg on pg.genero_id =  g.id
            inner join post p on p.id = pg.post_id
            where p.id = :id');
            $query->execute([
                'id' => $id
            ]);

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new GeneroModel();
                $item->from($p);
                array_push($items, $item);
            }

            // ? RETORNO EL OBJETO DE NUESTRA CLASE
            return $items;
        } catch (PDOException $e) {
            error_log('POSTMODEL::get()->PDOEXCEPTION ' . $e);
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
            $query = $this->prepare('SELECT nombre FROM genero WHERE nombre = :nombre');

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

    public function toArray()
    {
        $array = [];

        $array['id'] = $this->id;
        $array['nombre'] = $this->nombre;

        return $array;
    }
}

?>