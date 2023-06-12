<?php
class PostHasGeneroModel extends Model
{
    private $idPost;
    private $idGenero;
    private $generoNombre;

    public function __construct()
    {
        parent::__construct();
    }

    public function setPostId($id)
    {
        $this->idPost = $id;
    }

    public function getPostId()
    {
        return $this->idPost;
    }

    public function setGenerotId($id)
    {
        $this->idGenero = $id;
    }

    public function getGeneroId()
    {
        return $this->idGenero;
    }

    public function setGenerotNombre($generoNombre)
    {
        $this->generoNombre = $generoNombre;
    }

    public function getGeneroNombre()
    {
        return $this->generoNombre;
    }

    public function update($id)
    {
    }

    public function create()
    {
        try {
            $query = $this->prepare('INSERT INTO post_has_genero (post_id, genero_id) VALUE(:post_id, :genero_id)');
            $query->execute([
                'post_id' => $this->idPost,
                'genero_id' => $this->idGenero
            ]);
            // ? SI DEVUELVE EL RESULTADO DE UNA FILA INSERTADA ME DEVOLVERA TRUE   
            if ($query->rowCount()) return true;
            return false;
        } catch (PDOException $e) {
            error_log('POSTHASGENERO::create->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function getAll()
    {
        $items = [];

        try {
            $query = $this->query('SELECT pg.post_id, g.nombre as generoNombre, pg.genero_id from post_has_genero pg
            inner join genero g on g.id = pg.genero_id');

            // ? PARA QUE ME DEVUELVA UN OBJETO
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PostHasGeneroModel();
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
        $items = [];
        try {
            $query = $this->prepare('SELECT p.id as postId, g.id as generoId, g.nombre as generoNombre from genero g 
            inner join post_has_genero pg on pg.genero_id =  g.id
            inner join post p on p.id = pg.post_id
            where p.id = :idPost');
            $query->execute([
                'idPost' => $id
            ]);

            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new PostHasGeneroModel();
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

    public function from($array)
    {
        $this->idPost = $array['post_id'];
        $this->idGenero = $array['genero_id'];
        $this->generoNombre = $array['generoNombre'];
    }
}
?>