
<?php

class Post extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {

        $this->view->render("Post/index");
    }

    public function show($id)
    {
        $this->view->render("Post/show", ["post" => $id]);
    }

    public function saludo()
    {
        echo "<p>Ejecutaste el metodo saludo</p>";
    }

    public function create()
    {
        $this->view->render("Admin/Post/create");
    }
    public function insert()
    {
        $titulo = $_POST['titulo'];
        $desarrollador = $_POST['desarrollador'];
        $lanzador = $_POST['lanzador'];
        $fechaTrailer = $_POST['trailer'];
        $fechaLanzamiento = $_POST['lanzamiento'];
        $clasificacion = $_POST['clasificacion'];

        if ($this->model->insert(['titulo' => $titulo, 'desarrollador' => $desarrollador, 'lanzador' => $lanzador, 'fechaTrailer' => $fechaTrailer, 'fechaLanzamiento' => $fechaLanzamiento, 'clasificacion' => $clasificacion])) {
            echo "Post Creado";
        }
    }
}
