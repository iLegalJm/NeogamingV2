
<?php

require_once 'Model/Post.php';
require_once 'Model/Genero.php';
require_once 'Model/Plataforma.php';

class Post extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->view->render("Admin/Post/index", [
            'user' => $this->user,
            'posts' => $this->model->getAll()
        ]);
    }

    public function show($id)
    {
        $this->view->render("Post/show", ["post" => $id]);
        $joinModel = new JoinPostGeneroPlataformaModel();
        $posts = $joinModel->getAll($id);

        $res = [];

        foreach ($posts as $post) {
            // array_push($res, )
        }
    }

    public function create()
    {
        $userController = new SessionController();
        $this->user = $userController->getUserSessionData();

        $generos = new GeneroModel();
        $plataformas = new PlataformaModel();

        $this->view->render('Admin/Post/create', [
            'generos' => $generos->getAll(),
            'plataformas' => $plataformas->getAll(),
            'user' => $this->user
        ]);
    }
    public function insert()
    {
        $userController = new SessionController();
        $this->user = $userController->getUserSessionData();

        if (!$this->existPOST(['titulo', 'desarrollador', 'lanzador', 'trailer', 'lanzamiento', 'descripcion'])) {
            $this->redirect('Admin/Post', []);
            return;
        }

        if (!isset($_FILES['foto'])) {
            $this->redirect('Admin/Post', []); //TODO
            return;
        }

        if ($this->user == null) {
            $this->redirect('Admin/Post', []);
            return;
        }

        $foto = $_FILES['foto'];

        $targetDir = "public/img/posts/";
        $extension = explode('.', $foto['name']); // ? Separando en un array por el punto
        $fileName = $extension[sizeof($extension) - 2]; //?nombre del archivo
        $ext = $extension[sizeof($extension) - 1];
        //? GUARDARE CON EL NOMBRE PERO EMPEZANDO POR LA FECHA, PERO HASHEADO
        $hash = md5(Date('Ymdgi') . $fileName) . '.' . $ext;
        $targetFile = $targetDir . $hash;
        $uploadOk = false;
        $imgFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // ? TAMAÑO DE LA IMG 
        $chek = getimagesize($foto['tmp_name']);

        //? PARA SABER SI LA IMAGEN SE CREO EN LOS ARCHIVOS O NO
        if ($chek != false) {
            $uploadOk = true;
        } else {
            $uploadOk = false;
        }

        if (!$uploadOk) {
            $this->redirect('Admin/Post', []); //TODO
            return;
        } else {
            if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
                $post = new PostModel();
                $post->setTitulo($this->getPost('titulo'));
                $post->setDesarrollador($this->getPost('desarrollador'));
                $post->setLanzador($this->getPost('lanzador'));
                $post->setTrailer($this->getPost('trailer'));
                $post->setLanzamiento($this->getPost('lanzamiento'));
                $post->setDescripcion($this->getPost('descripcion'));
                $post->setFoto($hash);
                $post->setUserId($this->user->getId());

                $post->create();
                $this->redirect('Admin/Post', []); //TODO: Success
                return;
            } else {
                $this->redirect('User/info', []); //TODO
                return;
            }
        }
    }


    public function getGenerosId()
    {
        $joinModel = new JoinPostGeneroPlataformaModel();
        // $posts = $joinModel->getAll($id);
    }

    private function delete($params)
    {
        if ($params == null) {
            $this->redirect('Admin/Post', []);
        }

        $id = $params[0];
        error_log("Post::delete() id = " . $id);
        $res = $this->model->delete();

        if ($res) {
            $this->redirect('Admin/Post', []);
        } else {
            $this->redirect('Admin/Post', []);
        }
    }
}
