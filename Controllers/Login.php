<?php

class Login extends SessionController
{
    public function __construct()
    {
        parent::__construct();
        error_log('LOGIN::CONSTRUCT -> INICIO DE LOGIN');
    }

    public function render()
    {
        error_log('LOGIN::render -> Carga el index de login');
        $this->view->render('Login/index');
    }

    public function authenticate()
    {
        if ($this->existPOST(['username', 'password'])) {
            $username = $this->getPost('username');
            $password = $this->getPost('password');
            error_log($password . " aqui la contra");

            if ($username == "" || empty($username) || $password == "" || empty($password)) {
                $this->redirect('Login', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
            }
            $user = $this->model->login($username, $password);

            if ($user != null) {
                $this->initialize($user);
            } else {
                $this->redirect('Login', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA]);
                return;
            }
        } else {
            $this->redirect('Login', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE]);
        }
    }
}
?>