<?php
class Main extends Controller
{

    public function __construct()
    {
        parent::__construct();
        echo "<p>Nuevo controlador main</p>";
    }

    public function saludo()
    {
        echo "<p>Ejecutaste el metodo saludo</p>";
    }
}
?>