<?php

class Admin extends SessionController
{

    public function __construct()
    {
        parent::__construct();
        error_log('ADMIN::Construct->Inicio de Admin');
    }

    public function render()
    {
        error_log('ADMIN::render->Carga el index del Admin');
        $this->view->render('Admin/index');
    }
}
