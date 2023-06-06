<?php

require_once 'Model/User.php';
class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($username, $password)
    {
        error_log("Inicio de login ". " $password". " $username");
        try {
            $query = $this->prepare('SELECT * FROM user WHERE username=:username');
            $query->execute(['username' => $username]);

            if ($query->rowCount() == 1) {
                $item = $query->fetch(PDO::FETCH_ASSOC);

                $user = new UserModel();
                $user->from($item);

                //? compara la contraseña con la que esta con el hash en la bd
                if (password_verify($password, $user->getPassword())) {
                    error_log('LOGINMODEL::LOGIN()->SUCCESS = '. $password);
                    return $user;
                } else {
                    error_log('LOGINMODEL::LOGIN()->password no es igual');
                    return null;
                }
            }
        } catch (PDOException $e) {
            error_log('LOGINMODEL::login()->exception ' . $e);
            return null;
        }
    }
}
