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
        $this->view->render("Admin/Genero/index", [
            'user' => $this->user,
            'posts' => $this->model->getAll()
        ]);
    }
}