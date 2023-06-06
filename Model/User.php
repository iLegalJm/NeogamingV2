<?php

// include "../Config/Connection.php";
class UserModel extends Model implements iModel
{
    private $id;
    private $username;
    private $password;
    private $rol;
    private $foto;
    private $nombre;
    private $create_at;
    private $update_at;

    public function __construct()
    {
        parent::__construct();
        $this->username = '';
        $this->password = '';
        $this->rol = '';
        $this->foto = '';
        $this->nombre = '';
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
    // ! METODO PARA ENCRIPTAR LAS CONTRASEÑAS
    private function getHashedPassword($password)
    {
        // ? CON EL METODO PAS_HASH ENCRIPTAMOS, EL COST ES EL NUMERO DE VECES QUE SE APLICARA EL ALGORITMO QUE ES PROPORCIONALMENTE DIRECTO A MAS SEGURIDAD
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

    public function setPassword($password, $hash = true)
    {
        if ($hash) {
            $this->password = $this->getHashedPassword($password);
        } else {
            $this->password = $password;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setCreateAt($create_at)
    {
        $this->create_at = $create_at;
    }

    public function getCreateAt()
    {
        return $this->create_at;
    }

    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;
    }
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    public function create()
    {
        try {
            $query = $this->prepare('INSERT INTO user (username, password, rol, foto, nombre) VALUES(:username, :password, :rol, :foto, :nombre)');
            $query->execute([
                'username' => $this->username,
                'password' => $this->password,
                'rol' => $this->rol,
                'foto' => $this->foto,
                'nombre' => $this->nombre
            ]);
            return true;
        } catch (PDOException $e) {
            error_log('USERMODEL::create->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function getAll()
    {
        $items = [];

        try {
            $query = $this->query('SELECT * FROM user');

            // ? PARA QUE ME DEVUELVA UN OBJETO
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new UserModel();
                $item->setId($p['id']);
                $item->setUsername($p['username']);
                $item->setPassword($p['password']);
                $item->setRol($p['rol']);
                $item->setFoto($p['foto']);
                $item->setNombre($p['nombre']);
                $item->setCreateAt($p['create_at']);
                $item->setUpdateAt($p['update_at']);
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            error_log('USERMODEL::getAll->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function get($id)
    {
        try {
            $query = $this->prepare('SELECT * FROM user WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $this->setId($user['id']);
            $this->setUsername($user['username']);
            $this->setPassword($user['password']);
            $this->setRol($user['rol']);
            $this->setFoto($user['foto']);
            $this->setNombre($user['nombre']);
            $this->setCreateAt($user['create_at']);
            $this->setUpdateAt($user['update_at']);
            // ? REGRESO EL OBJETO QUE CONTIENE LA INFORMACION 
            return $this;
        } catch (PDOException $e) {
            error_log('USERMODEL::get->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function delete($id)
    {
        try {
            $query = $this->prepare('DELETE FROM user WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);

            return true;
        } catch (PDOException $e) {
            error_log('USERMODEL::DELETE->PDOEXCEPTION ' . $e);
            return false;
        }
    }
    public function update()
    {
        try {
            $query = $this->prepare('UPDATE user SET nombre = :nombre, password = :password, foto = :foto, username = :username WHERE id = :id');
            $query->execute([
                'id' => $this->id,
                'nombre' => $this->nombre,
                'password' => $this->password,
                'foto' => $this->foto,
                'username' => $this->username
            ]);

            return true;
        } catch (PDOException $e) {
            error_log('USERMODEL::UPDATE()::ERROR->PDOEXCEPTION ' . $e);
            return false;
        }
    }

    public function updateNombre($name, $iduser)
    {
        try {
            $query = $this->prepare('UPDATE user SET name = :nombre WHERE id = :id');
            $query->execute(['nombre' => $name, 'id' => $iduser]);

            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log('USERMODEL::updateNombre()->PDOEXCEPTION ' . $e);
            return NULL;
        }
    }

    public function updateFoto($name, $iduser)
    {
        try {
            $query = $this->db->connect()->prepare('UPDATE user SET foto = :foto WHERE id = :id');
            $query->execute([
                'foto' => $name,
                'id' => $iduser
            ]);

            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log('USERMODEL::updateFoto()->PDOEXCEPTION ' . $e);
            return NULL;
        }
    }
    public function from($array)
    {
        $this->id = $array['id'];
        $this->username = $array['username'];
        $this->password = $array['password'];
        $this->rol = $array['rol'];
        $this->nombre = $array['nombre'];
    }

    public function exists($username)
    {
        try {
            $query = $this->prepare('SELECT username FROM user WHERE username = :username');
            $query->execute([
                'username' => $username,
            ]);

            return ($query->rowCount() > 0) ? true : false;
        } catch (PDOException $e) {
            error_log('USERMODEL::EXISTS->PDOEXCEPTION ' . $e);
            return false;
        }
    }

    public function comparePasswords($password, $userId)
    {
        try {
            $query = $this->prepare('SELECT id, password FROM user WHERE id = :id ');
            $query->execute([
                'id' => $userId
            ]);

            //? PASSWORD VERIFY ES UN METODO NATIVO DE PHP PARA VALIDAR UN HASH Y PÁSSWORD EN TEXTO PLANO SI SON LOS MISMOS
            if ($row = $query->fetch(PDO::FETCH_ASSOC)) return password_verify($password, $row['password']);
            return NULL;
        } catch (PDOException $e) {
            error_log('USERMODEL::EXISTS->PDOEXCEPTION ' . $e);
            return false;
        }
    }
}
