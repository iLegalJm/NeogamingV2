<?php
class PostModel extends Model implements iModel
{

    private $id;
    private $titulo;
    private $desarrollador;
    private $lanzador;
    private $trailer;
    private $lanzamiento;
    private $clasificacion;
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
        $this->clasificacion = '';
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

    public function setClasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;
    }
    public function getClasificacion()
    {
        return $this->clasificacion;
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
            $query = $this->prepare('INSERT INTO POST (user_id, TITULO, DESARROLLADOR, LANZADOR, TRAILER, LANZAMIENTO, CLASIFICACION) VALUES(:user, :titulo, :desarrollador, :lanzador, :fechaTrailer, :fechaLanzamiento, :clasificacion)');

            $query->execute([
                'user' => $this->userId,
                'titulo' => $this->titulo,
                'desarrollador' => $this->desarrollador,
                'lanzador' => $this->lanzador,
                'fechaTrailer' => $this->trailer,
                'fechaLanzamiento' => $this->lanzamiento,
                'clasificacion' => $this->clasificacion
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA INSERTADA ME DEVOLVERA TRUE   
            if ($query->rowCount()) return true;
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
            $query = $this->prepare('UPDATE POST SET user_id= :user, TITULO= :titulo, DESARROLLADOR = :desarrollador, LANZADOR =: lanzador, TRAILER = :fechaTrailer, LANZAMIENTO= :fechaLanzamiento, CLASIFICACION= :clasificacion WHERE id = :id');

            $query->execute([
                'user' => $this->userId,
                'titulo' => $this->titulo,
                'desarrollador' => $this->desarrollador,
                'lanzador' => $this->lanzador,
                'fechaTrailer' => $this->trailer,
                'fechaLanzamiento' => $this->lanzamiento,
                'clasificacion' => $this->clasificacion,
                'id' => $this->id
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA MODIFICADA ME DEVOLVERA TRUE   
            if ($query->rowCount()) return true;
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
        $this->clasificacion = $array['clasificacion'];
        $this->create_at = $array['create_at'];
        $this->update_at = $array['update_at'];
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

            if ($total == null) $total = 0;
            return $total;;
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
