<?php

class PlataformaModel extends Model implements iModel
{

    private $id;
    private $nombre;
    public function __construct()
    {
        error_log('PLATAFORMAMODEL::CONSTRUCT->inicio de plataformamodel.');
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
            $query = $this->prepare('INSERT INTO plataformas (nombre) VALUES(:nombre)');

            $query->execute([
                'nombre' => $this->nombre
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA INSERTADA ME DEVOLVERA TRUE   
            if ($query->rowCount())
                return true;
            return false;
        } catch (PDOException $e) {
            error_log('PLATAFORMAMODEL::create->PDOEXCEPTION ' . $e);
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
            $query = $this->query('SELECT * FROM plataformas');

            // ? PARA QUE ME DEVUELVA UN OBJETO
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PlataformaModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            error_log('PLATAFORMAMODEL::getAll()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function get($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM plataformas WHERE id = :id');
            $query->execute([
                'id' => $id[0]
            ]);
            $genero = $query->fetch(PDO::FETCH_ASSOC);
            $this->from($genero);

            // ? RETORNO EL OBJETO DE NUESTRA CLASE
            return $this;
        } catch (PDOException $e) {
            error_log('PLATAFORMAMODEL::get()->PDOEXCEPTION ' . $e);
            return false;
        }
    }

    public function getPlataformasHasPost($id)
    {
        $items = [];
        try {
            $query = $this->prepare("SELECT pl.id, pl.nombre from plataformas pl
            inner join post_has_plataformas pp on pp.plataformas_id =  pl.id
            inner join post p on p.id = pp.post_id
            where p.id = :id");
            $query->execute([
                'id' => $id
            ]);

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PlataformaModel();
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
            $query = $this->prepare('DELETE FROM plataformas WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);

            return true;
        } catch (PDOException $e) {
            error_log('PLATAFORMAMODEL::get()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function update()
    {
        try {
            $query = $this->prepare('UPDATE plataformas SET nombre= :nombre WHERE id = :id');

            $query->execute([
                'nombre' => $this->nombre,
                'id' => $this->id
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA MODIFICADA ME DEVOLVERA TRUE   
            if ($query->rowCount())
                return true;
            return false;
        } catch (PDOException $e) {
            error_log('PLATAFORMAMODEL::update()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function from($array)
    {
        $this->id = $array['id'];
        $this->nombre = $array['nombre'];
    }

    public function toArray()
    {
        $array = [];

        $array['id'] = $this->id;
        $array['nombre'] = $this->nombre;

        return $array;
    }

    public function exists($nombre)
    {
        try {
            $query = $this->prepare('SELECT nombre FROM plataformas WHERE nombre = :nombre');

            $query->execute([
                'nombre' => $nombre
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA INSERTADA ME DEVOLVERA TRUE   
            if ($query->rowCount())
                return true;
            return false;
        } catch (PDOException $e) {
            error_log('PLATAFORMAMODEL::exists->PDOEXCEPTION ' . $e);
            return false;
        }
    }
}
?>