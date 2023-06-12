<?php

use function PHPSTORM_META\type;

require_once 'classes/session.php';
require_once 'template.php';
require_once 'classes/sessionController.php';
class View
{
    public $mensaje;

    public $data = [];
    private $content;
    public function __construct()
    {
    }

    public function render($path, $data = [])
    {
        $this->handleMessages();
        $this->data = ["message" => $this->showMessagess()];
        // require 'Views/' . $path . '.php';
        $template = 'Views/' . $path . '.html';
        array_push($data, $this->data);
        $child = new Template($template, $data);

        $renderLayout = substr($path, 0, 5);

        if ($renderLayout == "Admin") {
            $sesionController = new SessionController();
            $user = $sesionController->getUserSessionData();
            $view = new Template('./Views/Admin/layoutAdmin.html', [
                "title" => "Admin",
                "user" => $user,
                "child" => $child
            ]);
            echo $view;
        } else if ($renderLayout == "Login") {
            // print_r($this->data);
            echo $child;
        } else if ($renderLayout == "Singup") {
            echo $child;
        } else if ($renderLayout == "Error") {
            echo $child;
        } else {
            $sesion = new Session();
            $userModel = new UserModel();
            $user = $userModel->get($sesion->getCurrentUser());
            $view = new Template('./Views/layout.html', [
                "title" => "Principal",
                "child" => $child,
                "sesion" => $sesion,
                "user"=> $user
            
            ]);
            echo $view;
        }
    }

    function handleMessages()
    {
        if (isset($_GET['success']) && isset($_GET['error'])) {
            //! error
        } else if (isset($_GET['success'])) {
            $this->handleSucces();
        } else if (isset($_GET['error'])) {
            $this->handleError();
        }
    }

    function handleSucces()
    {
        // echo "success";
        $hash = $_GET['success'];
        $success = new SuccessMessages();

        if ($success->existsKey($hash)) {
            $this->data['success'] = $success->get($hash);
        }
    }

    function handleError()
    {
        $hash = $_GET['error'];
        $error = new ErrorMessages();

        if ($error->existsKey($hash)) {
            $this->data['error'] = $error->get($hash);
        }
    }

    public function showMessagess()
    {
        $this->showSuccess();
        $this->showErrors();
    }

    function showSuccess()
    {
        if (array_key_exists('success', $this->data)) {
            echo '<div class="success">' . $this->data['success'] . '</div>';
        }
    }
    function showErrors()
    {
        if (array_key_exists('error', $this->data)) {
            echo '<div class="error">' . $this->data['error'] . '</div>';
        }
    }
}
?>