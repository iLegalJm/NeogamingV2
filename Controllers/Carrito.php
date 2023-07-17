<?php
class Carrito extends Session
{
    private $session;

    function __construct()
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
        } else {
            $items = json_decode($this->getCurrentUser(), 1);

            for ($i = 0; $i < sizeof($items); $i++) {
                if ($items[$i]['id'] == $id) {
                    $items[$i]['cantidad']++;

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
        if ($this->session->getCurrentUser() == null) {
            $items = [];
        } else {
            $items = json_decode($this->session->getCurrentUser(), 1);

            for ($i = 0; $i < sizeof($items); $i++) {
                if ($items[$i]['id'] = $id) {
                    $items[$i]['cantidad']--;

                    if ($items[$i]['cantidad'] == 0) {
                        unset($items[$i]);
                        // ! Para reanudar los indices
                        $items = array_values($items);
                    }

                    $this->session->setCurrentUser(json_decode(($items)));
                    return true;
                }
            }
        }
    }


}
?>