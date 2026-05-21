<?php
require_once "./model/conexion.php";
require_once "./class/User.php";

class UserModel {
    private $conexionDB;

    public function __construct() {
        $this->conexionDB = ConectarDB::conexion();
    }

    public function comprobarUser($nombre, $pass) {
        $sql= 'SELECT id_user FROM usuario WHERE username=:nombre AND password=:pass';
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarRol($id) {
        /*guardar este dato en session para el script del nav*/

        // yo lo guardaba en la clase user junto aL USERNAME
        $sql= 'SELECT id_rol FROM user_rol WHERE id_user=:id';
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    public function mostrarUsuarios(){
        $sql= 'SELECT u.id_user, u.username, u.password, COALESCE(r.id_rol, 2) AS id_rol FROM usuario u LEFT JOIN user_rol r ON r.id_user = u.id_user ORDER BY u.id_user ASC';
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearUsuario($username, $password, $rol) {
        try {
            $this->conexionDB->beginTransaction();

            $sqlUsuario = 'INSERT INTO usuario (username, password) VALUES (:username, :password)';
            $stmtUsuario = $this->conexionDB->prepare($sqlUsuario);
            $stmtUsuario->bindParam(':username', $username);
            $stmtUsuario->bindParam(':password', $password);
            $stmtUsuario->execute();

            $idUser = (int) $this->conexionDB->lastInsertId();
            if ($idUser <= 0) {
                $this->conexionDB->rollBack();
                return false;
            }

            $sqlRol = 'INSERT INTO user_rol (id_user, id_rol) VALUES (:id_user, :id_rol)';
            $stmtRol = $this->conexionDB->prepare($sqlRol);
            $stmtRol->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmtRol->bindParam(':id_rol', $rol, PDO::PARAM_INT);
            $stmtRol->execute();

            $this->conexionDB->commit();
            return true;
        } catch (Throwable $e) {
            if ($this->conexionDB->inTransaction()) {
                $this->conexionDB->rollBack();
            }
            return false;
        }
    }

    public function eliminarUsuario($idUser) {
        try {
            $this->conexionDB->beginTransaction();

            $sqlRol = 'DELETE FROM user_rol WHERE id_user = :id_user';
            $stmtRol = $this->conexionDB->prepare($sqlRol);
            $stmtRol->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmtRol->execute();

            $sqlUsuario = 'DELETE FROM usuario WHERE id_user = :id_user';
            $stmtUsuario = $this->conexionDB->prepare($sqlUsuario);
            $stmtUsuario->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmtUsuario->execute();

            $filasEliminadas = $stmtUsuario->rowCount();
            $this->conexionDB->commit();

            return $filasEliminadas > 0;
        } catch (Throwable $e) {
            if ($this->conexionDB->inTransaction()) {
                $this->conexionDB->rollBack();
            }
            return false;
        }
    }

    public function obtenerUsuarioEntidad($nombre, $pass) {
        $sql = 'SELECT u.username, r.id_rol FROM usuario u INNER JOIN user_rol r ON r.id_user = u.id_user WHERE u.username = :nombre AND u.password = :pass LIMIT 1';
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$fila) {
            return null;
        }

        return new User($fila['username'], (int) $fila['id_rol']);
    }
}
?>