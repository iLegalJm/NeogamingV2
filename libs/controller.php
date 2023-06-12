<?php
class Controller
{
    public $view;
    public $mensaje;
    public $model;
    public function __construct()
    {
        // echo "<p>Aqui el controlador base</p>";
        $this->view = new View();
        $this->view->mensaje;
    }

    public function loadModel($model)
    {
        $url = 'Model/' . $model . '.php';

        if (file_exists($url)) {
            require_once $url;

            $modelName = $model . 'Model';
            $this->model = new $modelName();
        }
    }

    public function existPOST($params)
    {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                error_log('CONTROLLER::existsPOST -> No existe el parametro ' . $param);
                return false;
            }
        }
        error_log("ExistPOST: Existen parámetros");
        return true;
    }

    public function existGET($params)
    {
        foreach ($params as $key => $param) {
            if (isset($_POST[$param])) {
                error_log('CONTROLLER::existsGET -> No existe el parametro ' . $param);
                return false;
            }
        }

        return true;
    }

    public function getPost($name)
    {
        return $_POST[$name];
    }

    public function getName($name)
    {
        return $_GET[$name];
    }

    public function redirect($url, $mensajes = [])
    {
        $data = [];
        $params = '';

        // ? atacheando
        foreach ($mensajes as $key => $mensaje) {
            array_push($data, $key . '=' . $mensaje);
        }

        //? UNIMOS LOS ELEMENTOS DEL ARREGLO CON UN CARACTER
        $params = join("&", $data);

        // ? Ejemplo: nombre=Jose&apellido=Farje
        if ($params != "") {
            $params = "?" . $params;
        }

        header('Location:' . constant('URL') . '/' . $url . $params);
    }
}
?>