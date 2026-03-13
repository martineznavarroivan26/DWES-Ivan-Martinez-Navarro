<?php
// como ves guardar cada formulario en el array al mismo tiempo que se van añadiendo a la base de datos
// sease termino sueño se añade a la base de datos y se pusea con un for each a su array
class Participant{
    private $cod;
    private $edad;
    private $sexo;
    private $centro;
    private $familia;
    private $sueno;
    private $antropometrico;
    private $actividad;
    private $alimentacion;

    public function __construct($cod,$centro,$familia,$edad,$sexo) {
        $this->cod = $cod;
        $this->centro = $centro;
        $this->familia = $familia;
        $this->edad = $edad;
        $this->sexo = $sexo;
        $this->sueno = [];
        $this->antropometrico = [];
        $this->actividad = [];
        $this->alimentacion = [];
    }

    public function getCodigo() {
        return $this->cod;
    }

    public function setSueno($sueno) {
        $this->sueno = $sueno;
    }

    public function getSueno() {
        return $this->sueno;
    }

    public function setAntropometrico($antropometrico) {
        $this->antropometrico = $antropometrico;
    }

    public function getAntropometrico() {
        return $this->antropometrico;
    }

    public function setActividad($actividad) {
        $this->actividad = $actividad;
    }

    public function getActividad() {
        return $this->actividad;
    }

    public function setAlimentacion($alimentacion) {
        $this->alimentacion = $alimentacion;
    }

    public function getAlimentacion() {
        return $this->alimentacion;
    }
}
?>