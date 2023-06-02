<?php

class ErrorMessages
{
    // ? ERROR_CONTROLLER_METHOD_ACTION
    const PRUEBA = "a9fd2ef4a63e8bc16ec98ea662fc2fa8";
    const ERROR_SIGNUP_NEWUSER = "ec243068b0616c6f4b0f6f0f5c920df4";
    const ERROR_SIGNUP_NEWUSER_EMPTY = "a232323sdaa4b0f6asd920df4";
    const ERROR_SIGNUP_NEWUSER_EXISTS = "a232323sdaa4b0f6asd93434cxxcxcvvbc4";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = "a23232sdfsdfhgccccsd93434cxxcxcvvbc4";
    const ERROR_LOGIN_AUTHENTICATE_DATA = "a23232sdfsdfhgccccs4443d93434cxxcxcvvbc4";
    const ERROR_LOGIN_AUTHENTICATE = "a23vvvvvvvxcxxasassfdgfbc4";

    private $errorList = [];
    public function __construct()
    {
        $this->errorList = [
            ErrorMessages::PRUEBA => "El título del post ya existe, intenta otro.",
            ErrorMessages::ERROR_SIGNUP_NEWUSER => "Error al intentar procesar la solicitud.",
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY => "Error, llena los campos de usuario y password.",
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS => "Ya existe ese nombre de usuario, escoge otro.",
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY => "Llena los campos del usuario y de password.",
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA => "El nombre de usuario o contraseña es incorrecto.",
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE => "Error al intentar procesar la solicitud"
        ];
    }

    public function get($hash)
    {
        return $this->errorList[$hash];
    }

    public function existsKey($key)
    {
        if (array_key_exists($key, $this->errorList)) {
            return true;
        } else {
            return false;
        }
    }
}
