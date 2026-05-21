<?php
//guardar aqui username y rol para sacarlo en los controles e info
class User {
    private $username;
    private $rol;

    public function __construct($username, $rol) {
        $this->username = $username;
        $this->rol = $rol;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }
}
?>