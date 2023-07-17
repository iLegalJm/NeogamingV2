<?php
class VentaModel extends Model implements iModel
{
    private $id;
    private $userId;
    private $impuesto;
    private $total;
    private $fecha;

    public function __construct()
    {
        error_log('POSTMODEL::CONSTRUCT -> incio de ProductoModel');
        parent::__construct();
        $this->total = 0;
        $this->impuesto = 0;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setImpuesto($impuesto)
    {
        $this->impuesto = $impuesto;
    }
    public function getImpuesto()
    {
        return $this->impuesto;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }
    public function getTotal()
    {
        return $this->total;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function create()
    {
        try {
            $query = $this->prepare('INSERT INTO venta (user_id, impuesto, total) VALUES(:user_id, :impuesto, :total');

            $query->execute([
                'user_id' => $this->userId,
                'impuesto' => $this->impuesto,
                'total' => $this->total
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

    public function getAll()
    {
        $items = [];

        try {
            $query = $this->query('SELECT * FROM venta');

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
            $query = $this->prepare('SELECT * FROM venta WHERE id = :id');
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
    public function getSearch($search, $search2, $search3, $by)
    {
        $items = [];
        try {

            if ($by == 'title') {
                $query = $this->query("SELECT * FROM post where titulo like '%" . $search . "%'");
            } else if ($by == 'month') {
                $query = $this->query("SELECT * from post where month(lanzamiento) = $search");
            } else if ($by == 'genero') {
                $query = $this->query("SELECT p.* from post p
                inner join post_has_genero pg on pg.post_id = p.id
                inner join genero g on g.id = pg.genero_id
                where g.id = $search");
            } else if ($by == 'title_month') {
                $query = $this->query("SELECT * FROM post where month(lanzamiento) = $search2 AND titulo like '%" . $search . "%'");
            } else if ($by == 'title_genero') {
                $query = $this->query("SELECT p.* from post p
                inner join post_has_genero pg on pg.post_id = p.id
                inner join genero g on g.id = pg.genero_id
                where g.id = $search2 and p.titulo like '%" . $search . "%'");
            } else if ($by == 'genero_mes') {
                $query = $this->query("SELECT p.* from post p
                inner join post_has_genero pg on pg.post_id = p.id
                inner join genero g on g.id = pg.genero_id
                where g.id = $search and month(p.lanzamiento) = $search2");
            } else if ($by == 'genero_mes_title') {
                $query = $this->query("SELECT p.* from post p
                inner join post_has_genero pg on pg.post_id = p.id
                inner join genero g on g.id = pg.genero_id
                where g.id = $search and month(p.lanzamiento) = $search2 and p.titulo like '%" . $search3 . "%'");
            }

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
            $query = $this->prepare('DELETE FROM venta WHERE id = :id');
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
            $query = $this->prepare('UPDATE venta SET  impuesto= :impuesto, total = :total WHERE id = :id');

            $query->execute([
                'impuesto' => $this->impuesto,
                'total' => $this->total,
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
        $this->impuesto = $array['impuesto'];
        $this->total = $array['total'];
        $this->fecha = $array['fecha'];
    }

    public function toArray()
    {
        $array = [];

        $array['id'] = $this->id;
        $array['user_id'] = $this->userId;
        $array['impuesto'] = $this->impuesto;
        $array['total'] = $this->total;
        $array['fecha'] = $this->fecha;
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
}
?>