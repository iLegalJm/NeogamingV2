
<?php

class Ayuda extends Controller{

    public function __construct(){
        parent::__construct();
        $this->view->render("Ayuda/index");
        echo "<p>Nuevo controlador Ayuda</p>";
    }

    public function saludo(){
        echo "<p>Ejecutaste el metodo saludo</p>";
    }
}
?>