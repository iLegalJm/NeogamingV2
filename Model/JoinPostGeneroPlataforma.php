<?php
class JoinPostGeneroPlataformaModel extends Model
{
    private $postId;
    private $titulo;
    private $desarrollador;
    private $lanzador;
    private $trailer;
    private $lanzamiento;
    private $descripcion;
    private $foto;
    private $userId;
    private $create_at;
    private $update_at;
    private $generoId;
    private $generoNombre;
    private $plataformaId;
    private $plataformaNombre;

    public function __construct()
    {
        parent::__construct();
        error_log("JOINPOSTGENEROPLATAFORMA::construct()");
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function getPostId()
    {
        return $this->postId;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setDesarrollador($desarrollador)
    {
        $this->desarrollador = $desarrollador;
    }
    public function getDesarrolllador()
    {
        return $this->desarrollador;
    }

    public function setLanzador($lanzador)
    {
        $this->lanzador = $lanzador;
    }
    public function getLanzador()
    {
        return $this->lanzador;
    }

    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;
    }
    public function getTrailer()
    {
        return $this->trailer;
    }

    public function setLanzamiento($lanzamiento)
    {
        $this->lanzamiento = $lanzamiento;
    }
    public function getLanzamiento()
    {
        return $this->lanzamiento;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
    public function getFoto()
    {
        return $this->foto;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function getUserId()
    {
        return $this->userId;
    }

    public function setCreateAt($create_at)
    {
        $this->create_at = $create_at;
    }
    public function getCreateAt()
    {
        return $this->create_at;
    }

    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;
    }
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    public function setGeneroId($generoId)
    {
        $this->generoId = $generoId;
    }
    public function getGeneroId()
    {
        return $this->generoId;
    }

    public function setGeneroNombre($generoNombre)
    {
        $this->generoNombre = $generoNombre;
    }
    public function getGeneroNombre()
    {
        return $this->generoNombre;
    }

    public function setPlataformaId($plataformaId)
    {
        $this->plataformaId = $plataformaId;
    }
    public function getPlataformaId()
    {
        return $this->plataformaId;
    }

    public function setPlataformaNombre($plataformaNombre)
    {
        $this->plataformaNombre = $plataformaNombre;
    }
    public function getPlataformaNombre()
    {
        return $this->plataformaNombre;
    }

    public function get($postId)
    {
        $items = [];

        try {
            $query = $this->prepare("SELECT p.*, pg.genero_id, g.nombre as nombreGenero, pp.plataformas_id, pl.nombre as nombrePlataforma from post p 
            inner join post_has_genero pg on pg.post_id = p.id
            inner join post_has_plataformas pp on pp.post_id = p.id
            inner join genero g on g.id = pg.genero_id
            inner join plataformas pl on pl.id = pp.plataformas_id
            where p.id = :postId");

            $query->execute([
                "postId" => $postId
            ]);

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new JoinPostGeneroPlataformaModel();
                $item->from($p);
                array_push($items, $item);
            }

           
            return $items;
        } catch (PDOException $e) {
            error_log('JOINPOSTGENEROPLATAFORMA::getAll()->PDOEXCEPTION ' . $e);
            return null;
        }
    }

    public function getAll($postId)
    {
        $items = [];

        try {
            $query = $this->prepare("SELECT p.*, pg.genero_id, g.nombre as nombreGenero, pp.plataformas_id, pl.nombre as nombrePlataforma from post p 
            inner join post_has_genero pg on pg.post_id = p.id
            inner join post_has_plataformas pp on pp.post_id = p.id
            inner join genero g on g.id = pg.genero_id
            inner join plataformas pl on pl.id = pp.plataformas_id
            where p.id = :postId");

            $query->execute([
                "postId" => $postId[0]
            ]);

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new JoinPostGeneroPlataformaModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            error_log('JOINPOSTGENEROPLATAFORMA::getAll()->PDOEXCEPTION ' . $e);
            return null;
        }
    }

    public function from($array)
    {
        $this->postId = $array['id'];
        $this->userId = $array['user_id'];
        $this->titulo = $array['titulo'];
        $this->desarrollador = $array['desarrollador'];
        $this->lanzador = $array['lanzador'];
        $this->trailer = $array['trailer'];
        $this->lanzamiento = $array['lanzamiento'];
        $this->descripcion = $array['descripcion'];
        $this->foto = $array['foto'];
        $this->create_at = $array['create_at'];
        $this->update_at = $array['update_at'];
        $this->generoId = $array['genero_id'];
        $this->generoNombre = $array['nombreGenero'];
        $this->plataformaId = $array['plataformas_id'];
        $this->plataformaNombre = $array['nombrePlataforma'];
    }

    public function toArray()
    {
        $array = [];

        $array['id'] = $this->postId;
        $array['userId'] = $this->userId;
        $array['titulo'] = $this->titulo;
        $array['desarrollador'] = $this->desarrollador;
        $array['lanzador'] = $this->lanzador;
        $array['trailer'] = $this->trailer;
        $array['lanzamiento'] = $this->lanzamiento;
        $array['descripcion'] = $this->descripcion;
        $array['foto'] = $this->foto;
        $array['create_at'] = $this->create_at;
        $array['update_at'] = $this->update_at;
        $array['generoId'] = $this->generoId;
        $array['generoNombre'] = $this->generoNombre;
        $array['plataformaId'] = $this->plataformaId;
        $array['plataformaNombre'] = $this->plataformaNombre;

        return $array;
    }
}
