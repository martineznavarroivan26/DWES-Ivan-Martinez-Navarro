<?php
require_once "./model/conexion.php";
require_once "./class/Participant.php";

class ParticipanteModel {
    private $conexionDB;

    public function __construct() {
        $this->conexionDB = ConectarDB::conexion();
    }

    public function insertarParticipante($cod, $centro, $familia, $edad, $sexo) {
        try{
            $sql = 'INSERT INTO participante (cod_participante,centro_educativo,familia_profesional,edad,sexo) VALUES (:cod, :centro, :familia, :edad, :sexo)';
            $stmt = $this->conexionDB->prepare($sql);
            $stmt->bindParam(':cod', $cod);
            $stmt->bindParam(':centro', $centro);
            $stmt->bindParam(':familia', $familia);
            $stmt->bindParam(':edad', $edad);
            $stmt->bindParam(':sexo', $sexo);
            return $stmt->execute();
        }catch (PDOException $e) {
            return false;
        }
    }

    public function insertarActividad($cod_participante,$acF1,$acF2,$acF3,$acF4,$acF5,$acF6,$acF7) {
        try {
            $sql = 'INSERT INTO actividad (cod_participante, AcF1, AcF2, AcF3, AcF4, AcF5, AcF6, AcF7) VALUES (:cod_participante, :acF1, :acF2, :acF3, :acF4, :acF5, :acF6, :acF7)';
            $stmt = $this->conexionDB->prepare($sql);
            $stmt->bindParam(':cod_participante', $cod_participante);
            $stmt->bindParam(':acF1', $acF1);
            $stmt->bindParam(':acF2', $acF2);
            $stmt->bindParam(':acF3', $acF3);
            $stmt->bindParam(':acF4', $acF4);
            $stmt->bindParam(':acF5', $acF5);
            $stmt->bindParam(':acF6', $acF6);
            $stmt->bindParam(':acF7', $acF7);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

        public function insertarAlimentacion($cod_participante,$Ali1,$Ali2,$Ali3,$Ali4,$Ali5,$Ali6,$Ali7,$Ali8,$Ali9,$Ali10,$Ali11,$Ali12,$Ali13,$Ali14) {
            try {
                $sql = 'INSERT INTO alimentacion (cod_participante, Ali1, Ali2, Ali3, Ali4, Ali5, Ali6, Ali7, Ali8, Ali9, Ali10, Ali11, Ali12, Ali13, Ali14) VALUES (:cod_participante, :ali1, :ali2, :ali3, :ali4, :ali5, :ali6, :ali7, :ali8, :ali9, :ali10, :ali11, :ali12, :ali13, :ali14)';
                $stmt = $this->conexionDB->prepare($sql);
                $stmt->bindParam(':cod_participante', $cod_participante);
                $stmt->bindParam(':ali1', $Ali1);
                $stmt->bindParam(':ali2', $Ali2);
                $stmt->bindParam(':ali3', $Ali3);
                $stmt->bindParam(':ali4', $Ali4);
                $stmt->bindParam(':ali5', $Ali5);
                $stmt->bindParam(':ali6', $Ali6);
                $stmt->bindParam(':ali7', $Ali7);
                $stmt->bindParam(':ali8', $Ali8);
                $stmt->bindParam(':ali9', $Ali9);
                $stmt->bindParam(':ali10', $Ali10);
                $stmt->bindParam(':ali11', $Ali11);
                $stmt->bindParam(':ali12', $Ali12);
                $stmt->bindParam(':ali13', $Ali13);
                $stmt->bindParam(':ali14', $Ali14);
                return $stmt->execute();
            } catch (PDOException $e) {
                return false;
            }
        }


    public function insertarSuenyo($cod_participante,$Sue1,$Sue2,$Sue3,$Sue4,$Sue5a, $Sue5b,$Sue5c,$Sue5d,$Sue5e,$Sue5f,$Sue5g,$Sue5h,$Sue5i,$Sue5j,$Sue5j_Desc,$Sue6,$Sue7,$Sue8,$Sue9,$Sue10) {
        try {
            $sql = 'INSERT INTO sueno (cod_participante, Sue1, Sue2, Sue3, Sue4, Sue5a, Sue5b, Sue5c, Sue5d, Sue5e, Sue5f, Sue5g, Sue5h, Sue5i, Sue5j, Sue5j_Desc, Sue6, Sue7, Sue8, Sue9, Sue10) VALUES (:cod_participante, :sue1, :sue2, :sue3, :sue4, :sue5a, :sue5b, :sue5c, :sue5d, :sue5e, :sue5f, :sue5g, :sue5h, :sue5i, :sue5j, :sue5j_Desc, :sue6, :sue7, :sue8, :sue9, :sue10)';
            $stmt = $this->conexionDB->prepare($sql);
            $stmt->bindParam(':cod_participante', $cod_participante);
            $stmt->bindParam(':sue1', $Sue1);
            $stmt->bindParam(':sue2', $Sue2);
            $stmt->bindParam(':sue3', $Sue3);
            $stmt->bindParam(':sue4', $Sue4);
            $stmt->bindParam(':sue5a', $Sue5a);
            $stmt->bindParam(':sue5b', $Sue5b);
            $stmt->bindParam(':sue5c', $Sue5c);
            $stmt->bindParam(':sue5d', $Sue5d);
            $stmt->bindParam(':sue5e', $Sue5e);
            $stmt->bindParam(':sue5f', $Sue5f);
            $stmt->bindParam(':sue5g', $Sue5g);
            $stmt->bindParam(':sue5h', $Sue5h);
            $stmt->bindParam(':sue5i', $Sue5i);
            $stmt->bindParam(':sue5j', $Sue5j);
            $stmt->bindParam(':sue5j_Desc', $Sue5j_Desc);
            $stmt->bindParam(':sue6', $Sue6);
            $stmt->bindParam(':sue7', $Sue7);
            $stmt->bindParam(':sue8', $Sue8);
            $stmt->bindParam(':sue9', $Sue9);
            $stmt->bindParam(':sue10', $Sue10);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function insertarAntropometrico($cod_participante,$ant1,$ant2,$ant3,$ant4,$ant5,$ant6,$ant7,$ant8,$ant9,$ant10,$ant11,$ant12,$ant13,$ant14,$ant15,$ant16,$ant17,$ant18_BD,$ant18_BI,$ant18_PD,$ant18_PI,$ant19_BD,$ant19_BI,$ant19_PD,$ant19_PI,$ant20,$ant21) {
        try {
            $sql = 'INSERT INTO antropometrico (cod_participante, Ant1, Ant2, Ant3, Ant4, Ant5, Ant6, Ant7, Ant8, Ant9, Ant10, Ant11, Ant12, Ant13, Ant14, Ant15, Ant16, Ant17, Ant18_BD, Ant18_BI, Ant18_PD, Ant18_PI, Ant19_BD, Ant19_BI, Ant19_PD, Ant19_PI, Ant20, Ant21) VALUES (:cod_participante, :ant1, :ant2, :ant3, :ant4, :ant5, :ant6, :ant7, :ant8, :ant9, :ant10, :ant11, :ant12, :ant13, :ant14, :ant15, :ant16, :ant17, :ant18_BD, :ant18_BI, :ant18_PD, :ant18_PI, :ant19_BD, :ant19_BI, :ant19_PD, :ant19_PI, :ant20, :ant21)';
            $stmt = $this->conexionDB->prepare($sql);
            $stmt->bindParam(':cod_participante', $cod_participante);
            $stmt->bindParam(':ant1', $ant1);
            $stmt->bindParam(':ant2', $ant2);
            $stmt->bindParam(':ant3', $ant3);
            $stmt->bindParam(':ant4', $ant4);
            $stmt->bindParam(':ant5', $ant5);
            $stmt->bindParam(':ant6', $ant6);
            $stmt->bindParam(':ant7', $ant7);
            $stmt->bindParam(':ant8', $ant8);
            $stmt->bindParam(':ant9', $ant9);
            $stmt->bindParam(':ant10', $ant10);
            $stmt->bindParam(':ant11', $ant11);
            $stmt->bindParam(':ant12', $ant12);
            $stmt->bindParam(':ant13', $ant13);
            $stmt->bindParam(':ant14', $ant14);
            $stmt->bindParam(':ant15', $ant15);
            $stmt->bindParam(':ant16', $ant16);
            $stmt->bindParam(':ant17', $ant17);
            $stmt->bindParam(':ant18_BD', $ant18_BD);
            $stmt->bindParam(':ant18_BI', $ant18_BI);
            $stmt->bindParam(':ant18_PD', $ant18_PD);
            $stmt->bindParam(':ant18_PI', $ant18_PI);
            $stmt->bindParam(':ant19_BD', $ant19_BD);
            $stmt->bindParam(':ant19_BI', $ant19_BI);
            $stmt->bindParam(':ant19_PD', $ant19_PD);
            $stmt->bindParam(':ant19_PI', $ant19_PI);
            $stmt->bindParam(':ant20', $ant20);
            $stmt->bindParam(':ant21', $ant21);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    //funciones de la api
    public function obtenerParticipante($cod){
        $sql="SELECT * FROM participante WHERE cod_participante=:cod";
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->bindParam(':cod', $cod);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerParticipanteEntidad($cod){
        $fila = $this->obtenerParticipante($cod);
        if (!$fila) {
            return null;
        }

        $participante = new Participant(
            $fila['cod_participante'],
            $fila['centro_educativo'],
            $fila['familia_profesional'],
            $fila['edad'],
            $fila['sexo']
        );

        $participante->setSueno($this->encuestaSuenio($cod));
        $participante->setActividad($this->encuestaActividad($cod));
        $participante->setAlimentacion($this->encuestaAlimentacion($cod));
        $participante->setAntropometrico($this->encuestaAntropometrico($cod));

        return $participante;
    }

    public function encuestaSuenio($cod){
        $sql="SELECT * FROM sueno WHERE cod_participante=:cod";
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->bindParam(':cod', $cod);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function encuestaActividad($cod){
        $sql="SELECT * FROM actividad WHERE cod_participante=:cod";
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->bindParam(':cod', $cod);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function encuestaAlimentacion($cod){
        $sql="SELECT * FROM alimentacion WHERE cod_participante=:cod";
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->bindParam(':cod', $cod);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function encuestaAntropometrico($cod){
        $sql="SELECT * FROM antropometrico WHERE cod_participante=:cod";
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->bindParam(':cod', $cod);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function mostrarTodo() {
        $sql = "SELECT p.*, a.*, al.*, an.*, s.*
            FROM participante p
            LEFT JOIN actividad a ON a.cod_participante = p.cod_participante
            LEFT JOIN alimentacion al ON al.cod_participante = p.cod_participante
            LEFT JOIN antropometrico an ON an.cod_participante = p.cod_participante
            LEFT JOIN sueno s ON s.cod_participante = p.cod_participante
            ORDER BY p.cod_participante";
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerResumenAnalitico() {
        $sql = "SELECT cod_participante, centro_educativo, familia_profesional, edad, sexo FROM participante ORDER BY cod_participante";
        $stmt = $this->conexionDB->prepare($sql);
        $stmt->execute();
        $participantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($participantes as &$participante) {
            $cod = (int) $participante['cod_participante'];
            $participante['actividad'] = $this->encuestaActividad($cod);
            $participante['alimentacion'] = $this->encuestaAlimentacion($cod);
            $participante['sueno'] = $this->encuestaSuenio($cod);
            $participante['antropometrico'] = $this->encuestaAntropometrico($cod);
        }

        return $participantes;
    }

    public function eliminarParticipante($cod) {
        try {
            $this->conexionDB->beginTransaction();

            $tablasEncuestas = ['actividad', 'alimentacion', 'sueno', 'antropometrico'];
            foreach ($tablasEncuestas as $tabla) {
                $sql = "DELETE FROM $tabla WHERE cod_participante = :cod";
                $stmt = $this->conexionDB->prepare($sql);
                $stmt->bindParam(':cod', $cod, PDO::PARAM_INT);
                $stmt->execute();
            }

            $sqlParticipante = 'DELETE FROM participante WHERE cod_participante = :cod';
            $stmtParticipante = $this->conexionDB->prepare($sqlParticipante);
            $stmtParticipante->bindParam(':cod', $cod, PDO::PARAM_INT);
            $stmtParticipante->execute();

            $eliminado = $stmtParticipante->rowCount() > 0;
            $this->conexionDB->commit();

            return $eliminado;
        } catch (Throwable $e) {
            if ($this->conexionDB->inTransaction()) {
                $this->conexionDB->rollBack();
            }
            return false;
        }
    }
}
?>