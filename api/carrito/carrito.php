<?php
// require_once '../../classes/session.php';

class Carrito extends Session
{
    private $session;

    public function __construct()
    {
        parent::__construct();
    }

    public function load()
    {
        if ($this->getCurrentUser(1) == null) {
            return [];
        }

        return $this->getCurrentUser(1);
    }

    public function add($id)
    {
        $session = new Session();
        if ($session->getCurrentUser(1) == null) {
            $items = [];
        } else {

            $items = (array) json_decode($session->getCurrentUser(1), 1);

            for ($i = 0; $i < sizeof($items); $i++) {
                if ($items[$i]['id'] == $id) {
                    $items[$i]['cantidad']++;
                    $session->setCurrentUser(json_encode($items), 1);
                    return $session->getCurrentUser(1);
                }
            }
        }

        //! OPERACION CUANDO EL CARRITO ESTE VACIO
        $item = ['id' => (int) $id, 'cantidad' => 1];

        array_push($items, $item);

        $session->setCurrentUser(json_encode($items), 1);

        return $session->getCurrentUser(1);
    }

    public function remove($id)
    {
        if ($this->getCurrentUser(1) == NULL) {
            $items = [];
        } else {
            $items = (array) json_decode($this->getCurrentUser(1), 1);

            for ($i = 0; $i < sizeof($items); $i++) {

                if ($items[$i]['id'] == $id) {
                    $items[$i]['cantidad']--;
                    if ($items[$i]['cantidad'] == 0) {
                        unset($items[$i]);
                        $items = array_values($items);
                    }
                    $this->setCurrentUser(json_encode($items), 1);
                    return true;
                }
            }
        }
    }
}
?>