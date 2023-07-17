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

    public function renderAdmin()
    {
        $this->view->render("Admin/Genero/index", [
            'user' => $this->user,
            'posts' => $this->model->getAll()
        ]);
    }

    public function edit($id)
    {
        $genero = $this->model->get($id);
        $this->view->render("Admin/Genero/edit", [
            "post" => $genero,
        ]);
    }

    public function update()
    {

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
        header('Content-Type: aplication/json');

        if (!$this->existPOST(['nombre'])) {
            $this->redirect('Admin/Genero', []);
            return;
        }

        $genero = new GeneroModel();
        $genero->setNombre($this->getPost('nombre'));

        if ($genero->exists($this->getPost('nombre'))) {
            $this->redirect('Admin/Genero', []);
        } else if ($genero->create()) {
            echo json_encode('Genero creado bien');
            // $this->redirect('Admin/Genero', []); //TODO: Success
        } else {
            $this->redirect('Admin/Genero', []); //TODO:
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

        $id = $params;
        error_log("Genero::delete() id = " . $id);
        $res = $this->model->delete($id);

        if ($res) {
            $this->redirect('Admin/Genero', []);
        } else {
            $this->redirect('Admin/Genero', []);
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