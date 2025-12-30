<?php
require_once 'interface/ListaPrestamos.php';

class ColeccionPrestamos implements ListaPrestamos {
    // Almacena los prestamos
    private $coleccion = [];

    // Retorna todos los prestamos
    public function getColeccion() {
        return $this->coleccion;
    }

    // Añade un prestamo a la colección
    public function insertar_prestamo($prestamo) {
        $this->coleccion = [...$this->coleccion, ...$prestamo];
    }

    // Elimina y retorna el primer prestamo
    public function eliminar_prestamo(): Prestamo {
        $primeraClave = array_key_first($this->coleccion);
        $eliminado = $this->coleccion[$primeraClave];
        
        unset($this->coleccion[$primeraClave]);
        return $eliminado;
    }

    // Devuelve los prestamos ordenados por cuota
    public function ordenar_por_cuota(): array {
        $copia = $this->coleccion;
        uasort($copia, fn($a, $b) => $a->getCuota() <=> $b->getCuota());
        return $copia;
    }

    // Retorna la cantidad de prestamos
    public function contarPrestamos(){
        return count($this->coleccion);
    }
}