<?php
class Template
{

    private $content;
    public function __construct($path, $data = [])
    {
        // ? Ejemplo con extract
        /*  
            $data = ["nombre" = "maltin"]

            Luego de extract()
            $nombre = "maltin"
        */
        extract($data);
        ob_start(); //  * Obteniendo el buffer de salida para que sera el hijo
        include($path);
        $this->content = ob_get_clean(); // * Obtiene el buffer de salida y lo borra
    }

    // * Aqui regreso el contenido con el metodo magico en php toString
    public function __toString()
    {
        return $this->content;
    }
}
?>