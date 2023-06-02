<?php

require_once 'Model/User.php';
class Signup extends SessionController
{
    public function __construct()
    {
        parent::__construct();
        error_log('SIGNUP::CONSTRUCT -> INICIO DE SINGUP');
    }

    public function render()
    {
        error_log('SIGNUP::render -> Carga el index de signup');
        $this->view->render('Login/singup', []);
    }

    public function create()
    {
        if ($this->existPOST(['username', 'password'])) {
            $username = $this->getPost('username');
            $password = $this->getPost('password');

            if ($username == "" || empty($username) || $password = "" || empty($password)) {
                $this->redirect('Signup',  ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }
            $user = new UserModel();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRol('user');

            if ($user->exists($username)) {
                $this->redirect('Signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
            } else if ($user->create()) {
                $this->redirect('', ['success' => SuccessMessages::SUCCESS_SIGNUP_CREATE]);
            } else {
                $this->redirect('Signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
            }
        } else {
            $this->redirect('Signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
        }
    }

    public function creates()
    {
        echo "asdasd";
    }
}
