<?php

class SuccessMessages
{
    // ? ERROR_CONTROLLER_METHOD_ACTION
    const PRUEBA = "a9fd2ef4a63e8bc16ec98ea662fc2fa8";
    const SUCCESS_SIGNUP_CREATE = "a9fd2ef4a63e8bc16ec93232asdfc2fa8";
    const SUCCESS_LOGIN_AUTHENTICATE = "a9fd2ef4a63e8asdasdbc16ec93232asdfc2fa8";

    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            SuccessMessages::PRUEBA => "Este es un mensaje de éxito.",
            SuccessMessages::SUCCESS_SIGNUP_CREATE => "Nuevo usuario registrado correctamente",
            SuccessMessages::SUCCESS_LOGIN_AUTHENTICATE => "Bienvenido "
        ];
    }
    public function get($hash)
    {
        return $this->successList[$hash];
    }

    public function existsKey($key)
    {
        if (array_key_exists($key, $this->successList)) {
            return true;
        } else {
            return false;
        }
    }
}
