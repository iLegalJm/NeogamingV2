<?php
class ComentHasUser extends Model
{
    private $id;
    private $postId;
    private $userId;
    private $texto;
    private $userName;
    private $userFoto;

    public function __construct()
    {
        parent::__construct();
        error_log('PostHasGeneroModel::CONSTRUCT -> incio de PostHasGeneroModel');
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserFoto($userFoto)
    {
        $this->userFoto = $userFoto;
    }

    public function getUserFoto()
    {
        return $this->userFoto;
    }

    public function getComentByPostId($postId)
    {
        $items = [];

        try {
            $query = $this->prepare('SELECT c.*, u.username, u.foto from comentario c 
            inner join user u on u.id = c.user_id
            where post_id = :postId');
            $query->execute([
                'postId' => $postId
            ]);

            if ($query->rowCount()) {
                error_log('Se encontro registros');
                // ? PARA QUE ME DEVUELVA UN OBJETO
                while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new ComentHasUser();
                    $item->from($p);
                    array_push($items, $item);
                }
                return $items;
            } else {
                return $items = ['data' => false];
            }
        } catch (PDOException $e) {
            error_log('POSTMODEL::getComentByPostId()->PDOEXCEPTION ' . $e);
            return false;
        }
    }

    public function from($array)
    {
        $this->id = $array['id'];
        $this->userId = $array['user_id'];
        $this->postId = $array['post_id'];
        $this->texto = $array['texto'];
        $this->userName = $array['username'];
        $this->userFoto = $array['foto'];
    }

    public function toArray()
    {
        $array = [];
        error_log('haciendo to array');
        $array['id'] = $this->id;
        $array['user_id'] = $this->userId;
        $array['post_id'] = $this->postId;
        $array['texto'] = $this->texto;
        $array['username'] = $this->userName;
        $array['userFoto'] = $this->userFoto;
        return $array;
    }

}