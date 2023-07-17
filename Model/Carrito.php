<?php
class ProductoModel extends Model implements iModel
{
    private $id;
    private $nombre;
    private $codigo;
    private $precio;
    private $stock;
    private $descripcion;
    private $foto;
    private $activo;

    public function __construct()
    {
        error_log('POSTMODEL::CONSTRUCT -> incio de CarritoModel');
        parent::__construct();
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

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function getPrecio()
    {
        return $this->precio;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }
    public function getStock()
    {
        return $this->stock;
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

    public function isActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    public function create()
    {
        try {
            $query = $this->prepare('INSERT INTO producto (nombre, codigo, precio, stock, descripcion, foto) 
            VALUES(:nombre, :codigo, :precio, :stock, :descripcion, :foto)');

            $query->execute([
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'precio' => $this->precio,
                'stock' => $this->stock,
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

    public function getAll()
    {
        $items = [];

        try {
            $query = $this->query('SELECT * FROM producto');

            // ? PARA QUE ME DEVUELVA UN OBJETO
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new ProductoModel();
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
            $query = $this->prepare('SELECT * FROM producto WHERE id = :id');
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
            $query = $this->prepare('DELETE FROM producto WHERE id = :id');
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
            $query = $this->prepare('UPDATE producto SET nombre= :nombre, codigo= :codigo, precio = :precio, stock = :stock, descripcion = :descripcion, foto= :foto, activo = :activo WHERE id = :id');

            $query->execute([
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'precio' => $this->precio,
                'stock' => $this->stock,
                'foto' => $this->foto,
                'descripcion' => $this->descripcion,
                'activo' => $this->activo,
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

    public function activar()
    {
        try {
            $query = $this->prepare('UPDATE producto SET activo = 1 WHERE id = :id');

            $query->execute([
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

    public function desactivar()
    {
        try {
            $query = $this->prepare('UPDATE producto SET activo = 0 WHERE id = :id');

            $query->execute([
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
        $this->nombre = $array['nombre'];
        $this->precio = $array['precio'];
        $this->stock = $array['stock'];
        $this->foto = $array['foto'];
        $this->foto = $array['foto'];
        $this->descripcion = $array['descripcion'];
        $this->activo = $array['activo'];
    }

    public function toArray()
    {
        $array = [];

        $array['id'] = $this->id;
        $array['nombre'] = $this->nombre;
        $array['codigo'] = $this->codigo;
        $array['precio'] = $this->precio;
        $array['foto'] = $this->foto;
        $array['descripcion'] = $this->descripcion;
        $array['activo'] = $this->activo;
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