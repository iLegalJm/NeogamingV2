<?php

class AdminModel extends Model
{
    public $db;

    public function __construct()
    {
        parent::__construct();
    }

    public function index($forAdmin)
    {
        $posts = $this->db->query("SELECT * FROM posts");

        if ($forAdmin) {
            return new Template(  // ? Con esta instancia obtengo el contenido que ira en mi layout principal
                "./Views/Admin/Posts/index.html",
                ["posts" => $posts]
            );
        } else {
            return new Template(  // ? Con esta instancia obtengo el contenido que ira en mi layout principal
                "./Views/index.html",
                ["posts" => $posts]
            );
        }
    }
}
?>