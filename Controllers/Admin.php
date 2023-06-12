<?php

class Admin extends SessionController
{
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
        error_log('ADMIN::Construct->Inicio de Admin');
    }

    public function render()
    {
        error_log('ADMIN::render->Carga el index del Admin');
        $this->view->render('Admin/index', [
            'user' => $this->user
        ]);
    }
}
?>