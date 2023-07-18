<?php

class Session
{
    private $sessionName = 'user';
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setCurrentUser($user, $carrito)
    {
        if ($carrito) {
            $_SESSION[$this->sessionName][1] = $user;
        } else {
            $_SESSION[$this->sessionName][0] = $user;
        }
    }

    public function getCurrentUser($carrito)
    {
        if ($carrito) {
            return $_SESSION[$this->sessionName][1];

        } else {
            return $_SESSION[$this->sessionName][0];
        }
    }

    public function setUser($data)
    {
        $_SESSION[$this->sessionName] = $data;
    }

    public function getUser()
    {

    }

    public function getValue()
    {
        $_SESSION['user'] = 'marcos';
        return $_SESSION['user'];
    }
    public function closeSession()
    {
        session_unset();
        session_destroy();
    }

    public function existsSession()
    {
        return isset($_SESSION[$this->sessionName]);
    }
}

?>