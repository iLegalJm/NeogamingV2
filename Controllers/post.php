
<?php

require_once 'Model/Post.php';
require_once 'Model/Genero.php';
require_once 'Model/Plataforma.php';

class Post extends SessionController
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSession();
    }

    public function render()
    {
        $this->view->render("Post/index", [
            'user' => $this->user
        ]);
    }

    public function show($id)
    {
        $this->view->render("Post/show", ["post" => $id]);
        $joinModel = new JoinPostGeneroPlataformaModel();
        $posts = $joinModel->getAll($id);

        $res = [];

        foreach ($posts as $post) {
            // array_push($res, )
        }
    }

    public function create()
    {
        $generos = new GeneroModel();
        $plataformas = new PlataformaModel();

        $this->view->render('Admin/Post/create', [
            'generos' => $generos->getAll(),
            'plataformas' => $plataformas->getAll(),
            'user' => $this->user
        ]);
    }
    public function insert()
    {
        if (!$this->existPOST(['titulo', 'desarrollador', 'lanzador', 'trailer', 'lanzamiento', 'clasificacion'])) {
            $this->redirect('Admin/Post', []);
            return;
        }

        if ($this->user == null) {
            $this->redirect('Admin/Post', []);
            return;
        }

        $post = new PostModel();
        $post->setTitulo($this->getPost('titulo'));
        $post->setDesarrollador($this->getPost('desarrollador'));
        $post->setLanzador($this->getPost('lanzador'));
        $post->setTrailer($this->getPost('trailer'));
        $post->setLanzamiento($this->getPost('lanzamiento'));
        $post->setClasificacion($this->getPost('clasificacion'));
        $post->setUserId($this->user->getId());

        $post->create();
        $this->redirect('Admin/Post', []); //TODO: Success
    }


    public function getGenerosId()
    {
        $joinModel = new JoinPostGeneroPlataformaModel();
        // $posts = $joinModel->getAll($id);
    }

    private function delete($params)
    {
        if ($params == null) {
            $this->redirect('Admin/Post', []);
        }

        $id = $params[0];
        error_log("Post::delete() id = " . $id);
        $res = $this->model->delete();

        if ($res) {
            $this->redirect('Admin/Post', []);
        } else {
            $this->redirect('Admin/Post', []);
        }
    }
}
