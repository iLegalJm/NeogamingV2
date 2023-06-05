<?php

class User extends SessionController
{
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = $this->getUserSessionData();
        error_log("USERCONTROLLER::CONSTRUCT -> " . "User: " . $this->user->getUsername());
    }

    function render()
    {
        $this->view->render('Admin/User/index', [
            'user' => $this->user
        ]);
    }

    function info()
    {
        $this->view->render('User/info', [
            'user' => $this->user,
            'post' => 2
        ]);
    }
    function updateNombre()
    {
        if (!$this->existPOST(['nombre'])) {
            $this->redirect('User/info', []); //TODO
            return;
        }

        $nombre = $this->getPost('nombre');

        if (empty($nombre) || $nombre == NULL) {
            $this->redirect('User/info', []); //TODO
            return;
        }

        $this->user->setNombre($nombre);
        if ($this->user->update()) {
            $this->redirect('User/info', []); //TODO
        }
    }

    function updatePassword()
    {
        if (!$this->existPOST(['current_password', 'new_password'])) {
            $this->redirect('User/info', []); //TODO
            return;
        }

        $current = $this->getPost('current_password');
        $new = $this->getPost('new_password');

        if (empty($current) || empty($new)) {
            $this->redirect('User/info', []); //TODO
            return;
        }

        if ($current == $new) {
            $this->redirect('User/info', []); //TODO
            return;
        }

        $newHash = $this->model->comparePasswords($current, $new);

        if ($newHash) {
            $this->user->setPassword($new);

            if ($this->user->update()) {
                $this->redirect('User/info', []); //TODO
                return;
            } else {
                $this->redirect('User/info', []); //TODO
            }
        } else {
            $this->redirect('User/info', []); //TODO
        }
    }

    function updateFoto()
    {
        if (!isset($_FILES['foto'])) {
            $this->redirect('User/info', []); //TODO
            return;
        }

        $foto = $_FILES['foto'];
        
        $targetDir = "public/img/fotos/";
        $extension = explode('.', $foto['name']); // ? Separando en un array por el punto
        $fileName = $extension[sizeof($extension) - 2]; //?nombre del archivo
        $ext = $extension[sizeof($extension) - 1];
        //? GUARDARE CON EL NOMBRE PERO EMPEZANDO POR LA FECHA, PERO HASHEADO
        $hash = md5(Date('Ymdgi') . $fileName) . '.' . $ext;
        $targetFile = $targetDir . $hash;
        $uploadOk = false;
        // $imgFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // ? TAMAÑO DE LA IMG 
        $chek = getimagesize($foto['tmp_name']);

        if ($chek != false) {
            $uploadOk = true;
        } else {
            $uploadOk = false;
        }

        if (!$uploadOk) {
            $this->redirect('User/info', []); //TODO
            return;
        } else {
            if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
                $this->model->updateFoto($hash, $this->user->getId());
                $this->redirect('User/info', []); //TODO
                return;
            } else {
                $this->redirect('User/info', []); //TODO
                return;
            }
        }
    }
}
