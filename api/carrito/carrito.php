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
        if ($this->getCurrentUser() == null) {
            return [];
        }

        return $this->getCurrentUser();
    }

    public function add($id)
    {
        if ($this->getCurrentUser() == null) {
            $items = [];
            echo "asd";
        } else {
            $items = (array) json_decode($this->getCurrentUser(), 1);

            for ($i = 0; $i < sizeof($items); $i++) {
                if ($items[$i]['id'] == $id) {
                    $items[$i]['cantidad']++;
                    $this->setCurrentUser(json_encode($items));
                    return $this->getCurrentUser();
                }
            }
        }

        //! OPERACION CUANDO EL CARRITO ESTE VACIO
        $item = ['id' => (int) $id, 'cantidad' => 1];

        array_push($items, $item);

        $this->setCurrentUser(json_encode($items));

        return $this->getCurrentUser();
    }

    public function remove($id)
    {
        if ($this->getCurrentUser() == NULL) {
            $items = [];
        } else {
            $items = (array) json_decode($this->getCurrentUser(), 1);

            for ($i = 0; $i < sizeof($items); $i++) {

                if ($items[$i]['id'] == $id) {
                    $items[$i]['cantidad']--;
                    if ($items[$i]['cantidad'] == 0) {
                        unset($items[$i]);
                        $items = array_values($items);
                    }
                    $this->setCurrentUser(json_encode($items));
                    return true;
                }
            }
        }
    }
}
?>