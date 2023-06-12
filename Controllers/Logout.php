<?php
class Logout extends SessionController
{
    public function __construct()
    {
        parent::__construct();
        error_log("USERCONTROLLER::CONSTRUCT -> Inicio de logout");
    }

    public function render()
    {
        $this->logout();
        $this->redirect('');
    }
}

?>