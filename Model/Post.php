<?php
class PostModel extends Model implements iModel
{
    private $id;
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

    public function __construct()
    {
        error_log('POSTMODEL::CONSTRUCT -> incio de PostModel');
        parent::__construct();
        $this->userId = 0;
        $this->titulo = '';
        $this->desarrollador = '';
        $this->lanzador = '';
        $this->trailer = '';
        $this->lanzamiento = '';
        $this->foto = '';
        $this->descripcion = "";
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
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
    public function getDesarrollador()
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

    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;
    }
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    public function getCreateAt()
    {
        return $this->create_at;
    }

    public function create()
    {
        try {
            $query = $this->prepare('INSERT INTO POST (user_id, TITULO, DESARROLLADOR, LANZADOR, TRAILER, LANZAMIENTO, FOTO, DESCRIPCION) VALUES(:user, :titulo, :desarrollador, :lanzador, :fechaTrailer, :fechaLanzamiento, :foto, :descripcion)');

            $query->execute([
                'user' => $this->userId,
                'titulo' => $this->titulo,
                'desarrollador' => $this->desarrollador,
                'lanzador' => $this->lanzador,
                'fechaTrailer' => $this->trailer,
                'fechaLanzamiento' => $this->lanzamiento,
                'foto' => $this->foto,
                'descripcion' => $this->descripcion
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA INSERTADA ME DEVOLVERA TRUE   
            if ($query->rowCount())
                return true;
            return false;
        } catch (PDOException $e) {
            error_log('POSTMODEL::create->PDOEXCEPTION ' . $e);
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
            $query = $this->query('SELECT * FROM post');

            // ? PARA QUE ME DEVUELVA UN OBJETO
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PostModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            error_log('POSTMODEL::getAll->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function get($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM post WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);
            $post = $query->fetch(PDO::FETCH_ASSOC);
            $this->from($post);

            // ? RETORNO EL OBJETO DE NUESTRA CLASE
            return $this;
        } catch (PDOException $e) {
            error_log('POSTMODEL::get()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function getSearch($search)
    {
        $items = [];
        try {
            $query = $this->query("SELECT * FROM post where titulo like '%" . $search . "%'");

            if ($query->rowCount()) {
                // ? PARA QUE ME DEVUELVA UN OBJETO
                while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new PostModel();
                    $item->from($p);
                    array_push($items, $item);
                }
                return $items;
            } else {
                return $items = ['data' => false];
            }
        } catch (PDOException $e) {
            error_log('POSTMODEL::getSearch()->PDOEXCEPTION ' . $e);
            return false;
        }
    }

    public function getLast()
    {
        try {
            $query = $this->query('SELECT * FROM neoga.post order by id desc limit 1');
            $post = $query->fetch(PDO::FETCH_ASSOC);
            $this->from($post);

            // ? RETORNO EL OBJETO DE NUESTRA CLASE
            return $this;
        } catch (PDOException $e) {
            error_log('POSTMODEL::getLast()->PDOEXCEPTION ' . $e);
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $query = $this->prepare('DELETE FROM post WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);

            return true;
        } catch (PDOException $e) {
            error_log('POSTMODEL::get()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function update()
    {
        try {
            $query = $this->prepare('UPDATE POST SET user_id= :user, TITULO= :titulo, DESARROLLADOR = :desarrollador, LANZADOR = :lanzador, TRAILER = :fechaTrailer, LANZAMIENTO= :fechaLanzamiento, foto= :foto, descripcion = :descripcion WHERE id = :id');

            $query->execute([
                'user' => $this->userId,
                'titulo' => $this->titulo,
                'desarrollador' => $this->desarrollador,
                'lanzador' => $this->lanzador,
                'fechaTrailer' => $this->trailer,
                'fechaLanzamiento' => $this->lanzamiento,
                'foto' => $this->foto,
                'descripcion' => $this->descripcion,
                'id' => $this->id
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA MODIFICADA ME DEVOLVERA TRUE   
            if ($query->rowCount())
                return true;
            return false;
        } catch (PDOException $e) {
            error_log('POSTMODEL::update()->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function from($array)
    {
        $this->id = $array['id'];
        $this->userId = $array['user_id'];
        $this->titulo = $array['titulo'];
        $this->desarrollador = $array['desarrollador'];
        $this->lanzador = $array['lanzador'];
        $this->trailer = $array['trailer'];
        $this->lanzamiento = $array['lanzamiento'];
        $this->foto = $array['foto'];
        $this->descripcion = $array['descripcion'];
        $this->create_at = $array['create_at'];
        $this->update_at = $array['update_at'];
    }

    public function toArray()
    {
        $array = [];

        $array['id'] = $this->id;
        $array['user_id'] = $this->userId;
        $array['titulo'] = $this->titulo;
        $array['desarrollador'] = $this->desarrollador;
        $array['lanzador'] = $this->lanzador;
        $array['trailer'] = $this->trailer;
        $array['lanzamiento'] = $this->lanzamiento;
        $array['foto'] = $this->foto;
        $array['descripcion'] = $this->descripcion;
        $array['create_at'] = $this->create_at;
        $array['update_at'] = $this->update_at;
        return $array;
    }

    public function getAllByUserId($userId)
    {
        $items = [];
        try {
            $query = $this->prepare('SELECT * FROM post WHERE user_id = :userId');
            $query->execute([
                'userId' => $userId
            ]);

            // ? PARA QUE ME DEVUELVA UN OBJETO
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PostModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            error_log('POSTMODEL::getAllByUserId()->PDOEXCEPTION ' . $e);
            return [];
        }
    }

    public function getByUserIdAndLimit($userId, $numLimit)
    {
        $items = [];
        try {
            $query = $this->prepare('SELECT * FROM post WHERE user_id = :userId ORDER BY create_at DESC LIMIT 0, :numLimit');
            $query->execute([
                'userId' => $userId,
                'numLimit' => $numLimit
            ]);

            // ? PARA QUE ME DEVUELVA UN OBJETO
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PostModel();
                $item->from($p);
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            error_log('POSTMODEL::getByUserIdAndLimit()->PDOEXCEPTION ' . $e);
            return [];
        }
    }

    public function getTotalGamesRealeasedThisMonth($userId)
    {
        try {
            $year = date('Y');
            $month = date('m');

            $query = $this->prepare('SELECT count(lanzamiento) as total FROM post WHERE YEAR(lanzamiento) = :year AND MONTH(lanzamiento) = :month AND user_id = :userId');
            $query->execute([
                'userId' => $userId,
                'year' => $year,
                'month' => $month
            ]);

            // ? COMO LE DI UN APADO A MI CONTADOR, PARA ACCEDER A ESTE DEBO PONER EN EL INDICE 'TOTAL'
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];

            if ($total == null)
                $total = 0;
            return $total;
            ;
        } catch (PDOException $e) {
            error_log('POSTMODEL::getTotalGamesRealeasedThisMonth()->PDOEXCEPTION ' . $e);
            return null;
        }
    }

    // public function getMaxPostThisMonth($userId)
    // {
    //     try {
    //         $year = date('Y');
    //         $month = date('m');

    //         $query = $this->prepare('SELECT max(lanzamiento) as total FROM post WHERE YEAR(lanzamiento) = :year AND MONTH(lanzamiento) = :month AND user_id = :userId');
    //         $query->execute([
    //             'userId' => $userId,
    //             'year' => $year,
    //             'month' => $month
    //         ]);

    //         // ? COMO LE DI UN APADO A MI CONTADOR, PARA ACCEDER A ESTE DEBO PONER EN EL INDICE 'TOTAL'
    //         $total = $query->fetch(PDO::FETCH_ASSOC)['total'];

    //         if ($total == null) $total = 0;
    //         return $total;;
    //     } catch (PDOException $e) {
    //         error_log('POSTMODEL::getTotalGamesRealeasedThisMonth()->PDOEXCEPTION ' . $e);
    //         return null;
    //     }
    // }
}
?>