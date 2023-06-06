<?php

require_once 'Controllers/Errores.php';
// require_once 'Controllers/Errores.php';
class App
{
    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI']; // ? Obtenego parte de la url
        $uriParts = explode('/', $uri);
        array_shift($uriParts); // ? Borrara el primer elemento de un arreglo para que al hacer print_r me muestre lo que esta dentro de cada array
        //TODO FALTA MEJORAR ESTE METODO

        if (strpos($uriParts[0], '?') > -1) {
            $uriParts[0] = substr($uriParts[0], 0, strpos($uriParts[0], '?'));
        }
        // print_r($uriParts);
        $this->init($uriParts);
    }

    private function init($uriParts)
    {
        error_log('==================================================');
        if (empty($uriParts[0])) {
            error_log('APP::CONSTRUCT->No hay un controlador especificado');
            $archivoController = 'Controllers/Post.php';
            require_once $archivoController;
            $controller = new Post();
            $controller->loadModel('Post');
            $controller->render();
            return false;
        }

        if ($uriParts[0] == "Admin") {
            error_log('APP::ADMIN-> El controlado es Admin: ' . $uriParts[0]);
            if (isset($uriParts[1])) {
                $archivoController = 'Controllers/' . $uriParts[1] . '.php';
                // ? Inicializando controlador
                $controller = $this->loadControlador($archivoController, $uriParts[1]);
                $controller->loadModel($uriParts[1]);

                // ? Si existe un metodo
                if (isset($uriParts[2])) {
                    if (method_exists($controller, $uriParts[2])) {
                        if (isset($uriParts[3])) {
                            for ($i = 3; $i < count($uriParts); $i++) {
                                $args[] = $uriParts[$i];
                            }
                            $controller->{$uriParts[2]}($args);
                        } else {
                            // ? NO TIENE PARAMETROS SE MANDA A LLAMAR EL METODO TAL CUAL
                            $controller->{$uriParts[2]}();
                        }
                    } else {
                        // ? ERROR DE QUE EL METODO NO EXISTE

                        $controller = new Errores();
                    }
                } else {
                    $controller->renderAdmin();
                }
            } else {
                $archivoController = 'Controllers/' . $uriParts[0] . '.php';
                // ? Inicializando controlador
                $controller = $this->loadControlador($archivoController, $uriParts[0]);
                $controller->loadModel($uriParts[0]);
                $controller->render();
            }
        } else {
            $indexFatal = strpos($uriParts[0], '?'); //? OBTENGO LA POSICION DEL CARACTER QUE ME MOLESTA
            $newUriParts0 = substr($uriParts[0], 0, $indexFatal); //? OBTENGO SOLO EL NOMBRE DEL CONTROLADOR QUE ES LO QUE ME INTERESA    
            if ($newUriParts0 == "") {
                $archivoController = 'Controllers/' . $uriParts[0] . '.php';
                // ? Inicializando controlador
                $controller = $this->loadControlador($archivoController, $uriParts[0]);
                $controller->loadModel($uriParts[0]);
            } else {
                $archivoController = 'Controllers/' . $newUriParts0 . '.php';
                // ? Inicializando controlador
                $controller = $this->loadControlador($archivoController, $newUriParts0);
                $controller->loadModel($newUriParts0);
            }
            // print("cadena" . $newUriParts1);



            // ? Si existe un metodo
            if (isset($uriParts[1])) {
                if (method_exists($controller, $uriParts[1])) {
                    //? EL METODO TIENE PARAMETROS
                    if (isset($uriParts[2])) {
                        //el método tiene parámetros
                        //sacamos e # de parametros
                        $nparam = sizeof($uriParts) - 2;
                        //crear un arreglo con los parametros
                        $params = [];
                        //iterar
                        for ($i = 0; $i < $nparam; $i++) {
                            array_push($params, $uriParts[$i + 2]);
                        }
                        //pasarlos al metodo   
                        $controller->{$uriParts[1]}($params);
                    } else {
                        // ? NO TIENE PARAMETROS SE MANDA A LLAMAR EL METODO TAL CUAL
                        $controller->{$uriParts[1]}();
                    }
                } else {
                    // ? ERROR DE QUE EL METODO NO EXISTE
                    $controller = new Errores();
                }
            } else {
                // ? NO HAY METODO A CARGAR, POR TANTO SE CARGA EL DEFAULT
                $controller->render();
            }
        }
    }

    private function loadControlador($archivoController, $nameController)
    {
        if (file_exists($archivoController)) {
            require_once $archivoController;
            return new $nameController();
        } else {
            $controller = new Errores();
            return false;
        }
    }
}
