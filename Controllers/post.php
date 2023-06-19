<?php

require_once 'Model/Post.php';
require_once 'Model/Genero.php';
require_once 'Model/Plataforma.php';
require_once 'Model/PostHasGenero.php';
require_once 'Model/PostHasPlataforma.php';
require_once 'Model/Coment.php';

class Post extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        // $this->view->render("Post/index", [
        //     'user' => $this->user,
        //     'posts' => $this->model->getAll()
        // ]);
    }

    public function render()
    {
        $generoModel = new GeneroModel();
        $generos = $generoModel->getAll();
        $this->view->render("Post/index", [
            'user' => $this->user,
            // 'posts' => $this->model->getAll()
            'generos' => $generos
        ]);
    }

    public function renderAdmin()
    {
        $this->view->render("Admin/Post/index", [
            'user' => $this->user,
            'posts' => $this->model->getAll()
        ]);
    }

    public function show($id)
    {
        require_once 'Model/JoinPostGeneroPlataforma.php';
        $joinModel = new JoinPostGeneroPlataformaModel();
        $post = $this->model->get($id);
        $generoModel = new GeneroModel();
        $plataformaModel = new PlataformaModel();
        $generos = $generoModel->getGeneroHasPost($id);
        $plataformas = $plataformaModel->getPlataformasHasPost($id);
        $this->view->render("Post/show", [
            "post" => $post,
            "generos" => $generos,
            "plataformas" => $plataformas
        ]);
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

        if (!$this->existPOST(['titulo', 'desarrollador', 'lanzador', 'trailer', 'lanzamiento', 'descripcion', 'generosId', 'plataformasId'])) {
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
            // ? SI EL TMP NAME EXISTE MOVERA LA IMG AL DESTINO DESIGNADO EN TARGET FILE
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

                $postLast = $post->getLast();

                foreach ($this->getPost('generosId') as $postHasGeneroId) {
                    $postHasGeneroModel = new PostHasGeneroModel();
                    $postHasGeneroModel->setGenerotId($postHasGeneroId);
                    $postHasGeneroModel->setPostId($postLast->getId());
                    if ($postHasGeneroModel->create()) {
                        // * Deja de pasar
                    } else {
                        $this->redirect('Admin/Post', []); //TODO
                        return;
                    }
                }

                foreach ($this->getPost('plataformasId') as $postPlataformaId) {
                    $postHasPlataformaModel = new PostHasPlataformaModel();
                    $postHasPlataformaModel->setPlataformaId($postPlataformaId);
                    $postHasPlataformaModel->setPostId($postLast->getId());
                    if ($postHasPlataformaModel->create()) {
                        // * Deja de pasar
                    } else {
                        $this->redirect('Admin/Post', []); //TODO
                        return;
                    }
                }

                $this->redirect('Admin/Post', []); //TODO: Success
                return;
            } else {
                $this->redirect('Admin/Post', []); //TODO
                return;
            }
        }
    }

    public function insertComent()
    {
        header('Content-Type: aplication/json');
        $userController = new SessionController();
        $this->user = $userController->getUserSessionData();

        if ($this->user == null) {
            $this->redirect('', []);
            return;
        }

        if (!$this->existPOST(['id', 'texto'])) {
            $this->redirect('', []);
            return;
        }

        $coment = new ComentModel();
        $coment->setUserId($this->user->getId());
        error_log('Coment creado bien' . $this->getPost('id'));
        $coment->setPostId($this->getPost('id'));
        $coment->setTexto($this->getPost('texto'));

        if ($coment->create()) {
            error_log('Coment creado bien');
            echo json_encode(array('resp' => 1));
            // $this->redirect('Post/show/' . $this->getPost('id'), []);
        } else {
            // $this->redirect('Post/show/' . $this->getPost('id'), []);
        }

    }

    public function edit($id)
    {
        require_once 'Model/JoinPostGeneroPlataforma.php';
        require_once 'Model/PostHasGenero.php';
        require_once 'Model/Genero.php';
        $joinModel = new JoinPostGeneroPlataformaModel();
        $post = $this->model->get($id);
        $generoModel = new GeneroModel();
        $plataformaModel = new PlataformaModel();
        $postGeneroModel = new PostHasGeneroModel();
        $this->view->render("Admin/Post/edit", [
            "post" => $post,
            "generos" => $generoModel->getAll(),
            "plataformas" => $plataformaModel->getAll()
        ]);
    }
    public function update()
    {
        $userController = new SessionController();
        $this->user = $userController->getUserSessionData();

        if (!$this->existPOST(['id', 'titulo', 'desarrollador', 'lanzador', 'trailer', 'lanzamiento', 'descripcion'])) {
            $this->redirect('Admin/Post/edit/' . $this->getPost('id'), []);
            return;
        }


        if ($this->user == null) {
            $this->redirect('Admin/Post', []);
            return;
        }

        $post = new PostModel();

        if ($_FILES['foto']['size'] > 0) {
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
            $chek = getimagesize($foto['tmp_name']); // ? TAMAÑO DE LA IMG 
            //? PARA SABER SI LA IMAGEN SE CREO EN LOS ARCHIVOS O NO
            if ($chek != false) {
                $uploadOk = true;
            } else {
                $uploadOk = false;
            }

            if (!$uploadOk) {
                $this->redirect('Admin/Post/edit/' . $this->getPost('id'), []); //TODO
                return;
            } else {
                // ? SI EL TMP NAME EXISTE MOVERA LA IMG AL DESTINO DESIGNADO EN TARGET FILE
                if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
                    $post->setFoto($hash);
                }
            }
        } else {
            $currentFoto = $post->get($this->getPost('id'));
            $fotoActual = $currentFoto->getFoto();
            $post->setFoto($fotoActual);
            error_log('Foto anterior');
        }

        $post->setId($this->getPost('id'));
        $post->setTitulo($this->getPost('titulo'));
        $post->setDesarrollador($this->getPost('desarrollador'));
        $post->setLanzador($this->getPost('lanzador'));
        $post->setTrailer($this->getPost('trailer'));
        $post->setLanzamiento($this->getPost('lanzamiento'));
        $post->setDescripcion($this->getPost('descripcion'));
        $post->setUserId($this->user->getId());

        if ($post->update()) {
            $this->redirect('Admin/Post/edit/' . $this->getPost('id'), []); //TODO: Success
            return;
        } else {
            $this->redirect('Admin/Post/edit/' . $this->getPost('id'), []);
        }
    }

    public function getGenerosId()
    {
        $joinModel = new JoinPostGeneroPlataformaModel();
        // $posts = $joinModel->getAll($id);
    }

    public function delete($id)
    {
        if ($id == null) {
            $this->redirect('Admin/Post', []);
        }
        error_log("Post::delete() id = " . $id);
        $res = $this->model->delete($id);

        if ($res) {
            $this->redirect('Admin/Post', []);
        } else {
            $this->redirect('Admin/Post', []);
        }
    }

    function getPostsJSON()
    {
        $searchByTitulo = $this->getPost('searchByTitulo');
        $searchByMes = $this->getPost('searchByMes');
        $searchByGenero = $this->getPost('searchByGenero');
        header('Content-Type: aplication/json');
        $res = [];
        $postModel = new PostModel();

        if ($searchByMes == '' && $searchByTitulo == '' && $searchByGenero == '') {
            $posts = $postModel->getSearch($searchByTitulo, null, null, 'title');
        } else if ($searchByTitulo != '' && $searchByMes == '' && $searchByGenero == '') {
            $posts = $postModel->getSearch($searchByTitulo, null, null, 'title');
        } else if ($searchByMes != '' && $searchByTitulo == '' && $searchByGenero == '') {
            $posts = $postModel->getSearch($searchByMes, null, null, 'month');
        } else if ($searchByGenero != '' && $searchByTitulo == '' && $searchByMes == '') {
            $posts = $postModel->getSearch($searchByGenero, null, null, 'genero');
        } else if ($searchByMes != '' && $searchByTitulo != '' && $searchByGenero == '') {
            $posts = $postModel->getSearch($searchByTitulo, $searchByMes, null, 'title_month');
        } else if ($searchByMes == '' && $searchByTitulo != '' && $searchByGenero != '') {
            $posts = $postModel->getSearch($searchByTitulo, $searchByGenero, null, 'title_genero');
        } else if ($searchByMes != '' && $searchByTitulo == '' && $searchByGenero != '') {
            $posts = $postModel->getSearch($searchByGenero, $searchByMes, null, 'genero_mes');
        } else if ($searchByMes != '' && $searchByTitulo != '' && $searchByGenero != '') {
            $posts = $postModel->getSearch($searchByGenero, $searchByMes, $searchByTitulo, 'genero_mes_title');
        }

        // ? SI EXISTE EL VALOR DE DATA DENTRO DEL ARRAY POSTS RES SERA FALSE
        if ($posts['data'] !== false) {
            foreach ($posts as $post) {
                array_push($res, $post->toArray());
            }

            // * DECODIFICARA MI ARREGLO EN UN ARREGLO JSON
            echo json_encode($res);
        } else {
            $resp = $posts;
            echo json_encode($resp);
        }
    }
}
?>