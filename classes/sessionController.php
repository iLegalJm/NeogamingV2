<?php

require_once 'classes/session.php';

class SessionController extends Controller
{
    private $userSesion;
    private $username;
    private $userId;
    private $session;
    private $sites;
    private $defaultSites;
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function getUserSession()
    {
        return $this->userSesion;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function init()
    {
        //? se crea nueva sesión
        $this->session = new Session();
        // ? se carga el archivo json con la configuración de acceso
        $json = $this->getJSONFileConfig();
        // ? se asignan los sitios
        $this->sites = $json['sites'];
        // ? se asignan los sitios por default, los que cualquier rol tiene acceso
        $this->defaultSites = $json['default-sites'];
        // ? inicia el flujo de validación para determinar, el tipo de rol y permismos
        $this->validateSession();
    }

    private function getJSONFileConfig()
    {
        //? OBTENGO EL CONTENIDO DEL JSON CODIFICADO
        $string = file_get_contents('Config/access.json');
        // ? DECODIFICO EL JSON EN VARIABLE DE PHP
        $json = json_decode($string, TRUE);
        return $json;
    }

    private function validateSession()
    {
        error_log('SESSIONCONTROLLER::validateSession()');
        //? SI EXISTE LA SESION
        if ($this->existsSession()) {
            $rol = $this->getUserSessionData()->getRol();
            error_log("sessionController::validateSession(): username:" . $this->user->getUsername() . " - role: " . $this->user->getRol());
            //? VALIDO SI LA PAGINA A ENTRAR ES PUBLICA
            if ($this->isPublic()) {
                $this->redirectDefaultSiteByRole($rol);
            } else {
                // ? SI NO ES PUBLICA LA PAGINA
                if ($this->isAuthorized($rol)) {
                    //? LO DEJO PASAR   
                } else {
                    $this->redirectDefaultSiteByRole($rol);
                }
            }
        } else {
            //? NO EXISTE LA SESION
            if ($this->isPublic()) {
                //? DEJA PASAR
            } else {
                header('Location: ' . constant('URL') . '');
            }
        }
    }
    private function existsSession()
    {
        if (!$this->session->existsSession()) return false;
        if ($this->session->getCurrentUser() == null) return false;
        //? AQUI GUARDAREMOS LA INFORMACION DEL USUARIO
        $userId = $this->session->getCurrentUser();
        if ($userId) return true;
        return false;
    }

    public function getUserSessionData()
    {
        $id = $this->session->getCurrentUser();
        $this->user = new UserModel();
        $this->user->get($id);
        error_log('SESSIONCONTROLLER::getUserSessionData-> ' . $this->user->getUsername());
        return $this->user;
    }

    private function isPublic()
    {
        $currentURL = $this->getCurrentPage();
        // ? ELIMINO CARACTERES QUE NO NECESITO EN MI URL
        $currentURL = preg_replace("/\?.*/", "", $currentURL);

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            // ? VALIDANDO SI LA URL A ENTRAR ES PUBLICA
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['access'] == 'public') {
                return true;
            }
        }

        return false;
    }
    private function getCurrentPage()
    {
        $actualLink = trim("$_SERVER[REQUEST_URI]");

        $url = explode('/', $actualLink);
        //TODO CAMBIE EL URL[2] POR URL[1], new cambios
        // if (isset($url[2])) {
        // error_log('SESSIONCONTROLLER::getCurrentPage: actualLink -> ' . $actualLink . ", url => " . $url[1] . '/' . $url[2]);
        // return $url[1] . '/' . $url[2];
        // } else {
        error_log('SESSIONCONTROLLER::getCurrentPage: actualLink -> ' . $actualLink . ", url => " . $url[1]);
        return $url[1];
        // }
    }

    private function redirectDefaultSiteByRole($rol)
    {
        $url = '';
        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($this->sites[$i]['rol'] == $rol) {
                $url = '/' . $this->sites[$i]['site'];
                error_log('SessionController::redirectDefaultSiteByRole->url = ' . $url);
                break;
            }
        }
        header('location:' . constant('URL') . $url);
    }

    private function isAuthorized($rol)
    {
        $currentURL = $this->getCurrentPage();
        // ? ELIMINO CARACTERES QUE NO NECESITO EN MI URL
        $currentURL = preg_replace("/\?.*/", "", $currentURL); //omitir get info

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            // ? VALIDANDO SI SE TIENE EL PERMISO O ROL PARA ENTRAR
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['rol'] == $rol) {
                return true;
            }
        }
        return false;
    }
    public function initialize($user)
    {
        $this->session->setCurrentUser($user->getId());
        $this->authorizeAccess($user->getRol());
    }

    private function authorizeAccess($rol)
    {
        switch ($rol) {
            case 'user':
                $this->redirect($this->defaultSites['user'], []);
                break;
            case 'admin':
                $this->redirect($this->defaultSites['admin'], []);
                break;
            default:
        }
    }

    public function logout()
    {
        $this->session->closeSession();
    }
}
