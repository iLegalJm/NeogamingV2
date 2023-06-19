<?php

class ComentModel extends Model
{
    private $id;
    private $userId;
    private $postId;
    private $texto;

    public function __construct()
    {
        parent::__construct();
        error_log('COMENTCONTROLLER::CONSTRUCT -> incio de ComentModel');
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

    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function create()
    {
        try {
            $query = $this->prepare('INSERT INTO comentario (user_id, post_id, texto) VALUES(:userId, :postId, :texto)');
            $query->execute([
                'userId' => $this->userId,
                'postId' => $this->postId,
                'texto' => $this->texto
            ]);

            // ? SI DEVUELVE EL RESULTADO DE UNA FILA INSERTADA ME DEVOLVERA TRUE   
            if ($query->rowCount())
                return true;
            return false;
        } catch (PDOException $e) {
            error_log('COMENTMODEL::create()->PDOEXCEPTION ' . $e);
            return false;
        }
    }

    // public function getComentByPostId($postId)
    // {
    //     $items = [];

    //     try {
    //         $query = $this->prepare('SELECT * from comentario where post_id = :postId');
    //         $query->execute([
    //             'postId' => $postId
    //         ]);

    //         if ($query->rowCount()) {
    //             error_log('Se encontro registros');
    //             // ? PARA QUE ME DEVUELVA UN OBJETO
    //             while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
    //                 $item = new ComentModel();
    //                 $item->from($p);
    //                 array_push($items, $item);
    //             }
    //             return $items;
    //         } else {
    //             return $items = ['data' => false];
    //         }
    //     } catch (PDOException $e) {
    //         error_log('POSTMODEL::getComentByPostId()->PDOEXCEPTION ' . $e);
    //         return false;
    //     }
    // }

    public function from($array)
    {
        $this->id = $array['id'];
        $this->userId = $array['user_id'];
        $this->postId = $array['post_id'];
        $this->texto = $array['texto'];
    }

    public function toArray()
    {
        $array = [];

        $array['id'] = $this->id;
        $array['user_id'] = $this->userId;
        $array['post_id'] = $this->postId;
        $array['texto'] = $this->texto;
        return $array;
    }
}

?>