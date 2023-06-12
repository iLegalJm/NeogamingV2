<?php

require_once 'Model/Post.php';
require_once 'Model/Genero.php';
require_once 'Model/Plataforma.php';

class Genero extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->view->render("Post/index", [
            'user' => $this->user,
            'posts' => $this->model->getAll()
        ]);
    }

    public function renderAdmin()
    {
        $this->view->render("Admin/Genero/index", [
            'user' => $this->user,
            'posts' => $this->model->getAll()
        ]);
    }

    public function show($id)
    {
        require_once 'Model/JoinPostGeneroPlataforma.php';
        $joinModel = new JoinPostGeneroPlataformaModel();
        $post = $this->model->get($id);
        $generoModel = new GeneroModel();
        $plataformaModel = new PlataformaModel();
        $generos = $generoModel->getGeneroHasPost($id);
        $plataformas = $plataformaModel->getPlataformasHasPost($id);
        $this->view->render("Post/show", [
            "post" => $post,
            "generos" => $generos,
            "plataformas" => $plataformas
        ]);
    }

    public function create()
    {
        $this->view->render('Admin/Genero/create', []);
    }
    public function insert()
    {
        if (!$this->existPOST(['nombre'])) {
            $this->redirect('Admin/Genero', []);
            return;
        }

        $genero = new GeneroModel();
        $genero->setNombre($this->getPost('nombre'));
        if ($genero->exists($this->getPost('nombre'))) {
            $this->redirect('Admin/Genero', []);
        } else if ($genero->create()) {
            $this->redirect('Admin/Genero', []); //TODO: Success
        } else {
            $this->redirect('Admin/Genero', []); //TODO: Success
        }
    }


    public function getGenerosId()
    {
        $joinModel = new JoinPostGeneroPlataformaModel();
        // $posts = $joinModel->getAll($id);
    }

    public function delete($params)
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

    function getGenerosJSON()
    {
        header('Content-Type: aplication/json');
        $res = [];
        $generoModel = new GeneroModel();
        $generos = $generoModel->getAll();

        foreach ($generos as $genero) {
            array_push($res, $genero->toArray());
        }

        // * DECODIFICARA MI ARREGLO EN UN ARREGLO JSON
        echo json_encode($res);
    }
}
?>