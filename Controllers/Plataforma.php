<?php

class Plataforma extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function renderAdmin()
    {
        $this->view->render("Admin/Plataforma/index", [
            'user' => $this->user,
        ]);
    }

    function getPlataformasJSON()
    {
        header('Content-Type: aplication/json');
        $res = [];
        $plataformaModel = new PlataformaModel();
        $plataformas = $plataformaModel->getAll();

        foreach ($plataformas as $plataforma) {
            array_push($res, $plataforma->toArray());
        }

        // * DECODIFICARA MI ARREGLO EN UN ARREGLO JSON
        echo json_encode($res);
    }

    public function insert()
    {
        header('Content-Type: aplication/json');

        if (!$this->existPOST(['nombre'])) {
            $this->redirect('Admin/Plataforma', []);
            return;
        }

        $plataforma = new PlataformaModel();
        $plataforma->setNombre($this->getPost('nombre'));

        if ($plataforma->exists($this->getPost('nombre'))) {
            $this->redirect('Admin/Plataforma', []);
        } else if ($plataforma->create()) {
            echo json_encode('Plataforma creada bien');
            // $this->redirect('Admin/Genero', []); //TODO: Success
        } else {
            $this->redirect('Admin/Plataforma', []); //TODO:
        }
    }

    public function delete($params)
    {
        if ($params == null) {
            $this->redirect('Admin/Post', []);
        }

        $id = $params;
        error_log("Plataforma::delete() id = " . $id);
        $res = $this->model->delete($id);

        if ($res) {
            $this->redirect('Admin/Plataforma', []);
        } else {
            $this->redirect('Admin/Plataforma', []);
        }
    }
}