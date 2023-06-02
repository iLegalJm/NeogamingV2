<?php
require_once 'template.php';
class View
{
    public $mensaje;

    public $data;
    private $content;
    public function __construct()
    {
        // echo "<p>Vista base</p>";
    }

    public function render($path, $data = [])
    {
        $this->data = $data;
        $this->handleMessages();
        $this->data = ["message" => $this->showMessagess()];
        // require 'Views/' . $path . '.php';
        $template = 'Views/' . $path . '.html';
        $child = new Template($template, $this->data);

        $renderLayout = substr($path, 0, 5);

        if ($renderLayout == "Admin") {
            $view = new Template('./Views/Admin/layoutAdmin.html', [
                "title" => "Admin",
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
            $view = new Template('./Views/layout.html', [
                "title" => "Principal",
                "child" => $child
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
