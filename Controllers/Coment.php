<?php
class Coment extends SessionController
{

    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    public function insert()
    {
        header('Content-Type: aplication/json');

        if ($this->user == null) {
            $this->redirect('', []);
            return;
        }

        if (!$this->existPOST(['id', 'texto'])) {
            $this->redirect('', []);
            return;
        }

        $coment = new ComentModel();
        $coment->setUserId($this->user->getId());
        $coment->setPostId($this->getPost('id'));
        $coment->setTexto($this->getPost('texto'));

        if ($coment->create()) {
            echo json_encode('Coment creado bien');
            // $this->redirect('Post/show/' . $this->getPost('id'), []);
        } else {
            // $this->redirect('Post/show/' . $this->getPost('id'), []);
        }
    }

    public function getComentsJSON()
    {
        if (!$this->existPOST(['idPost'])) {
            $this->redirect('', []);
            return;
        }

        $searchById = $this->getPost('idPost');

        error_log($searchById . 'Esta funcionando');
        header('Content-Type: aplication/json');
        $res = [];
        require_once 'Model/JoinComentHasUser.php';
        $comentHasUserModel = new ComentHasUser();

        if ($searchById != null) {
            $coments = $comentHasUserModel->getComentByPostId($searchById);
        }

        // ? SI EXISTE EL VALOR DE DATA DENTRO DEL ARRAY POSTS RES SERA FALSE
        if ($coments['data'] !== false) {
            foreach ($coments as $coment) {
                array_push($res, $coment->toArray());
            }

            // * DECODIFICARA MI ARREGLO EN UN ARREGLO JSON
            echo json_encode($res);
        } else {
            $resp = $coments;
            echo json_encode($resp);
        }
    }
}

?>