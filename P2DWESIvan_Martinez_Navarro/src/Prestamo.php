<?php
// Clase abstracta para gestionar prestamos
abstract class Prestamo{
    // Propiedades protegidas del prestamo
    protected $cuota;
    protected $capital;
    protected $interes;
    protected $amortizacionAños;
    protected $fecha;
    protected $tipo;

    // Calcula la cuota mensual del prestamo
    protected function calcularCuota($capital, $interes, $amortizacionAños){
        $interesAnual = ($interes/100) / 12;
        $mesesPago = $amortizacionAños * 12;
        
        // Formula para calcular la cuota
        $cuota = $capital * (($interesAnual * pow(1 + $interesAnual, $mesesPago)) /
                        //  -------------------------------------------------------------------- 
                                 (pow(1 + $interesAnual, $mesesPago) - 1 ));
    
        return round($cuota, 2);
    }
    
    // Getters para acceder a las propiedades
    public function getCuota() {
        return $this->cuota;
    }

    public function getCapital() {
        return $this->capital;
    }

    public function getInteres() {
        return $this->interes;
    }

    public function getAmortizacionAños() {
        return $this->amortizacionAños;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getTipo() {
        return $this->tipo;
    }

    // Valida que el capital no supere el maximo
    public static function controlCapital($capital, $maxima) {
        if ($capital <= $maxima && $capital >= 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function controlInteres($interes, $min, $max) {
        if ($interes <= $max && $interes >= $min) {
            return true;
        } else {
            return false;
        }
    }

    public static function controlAmortizacion($amortizacion, $maxima) {
        if ($amortizacion <= $maxima && $amortizacion >= 0) {
            return true;
        } else {
            return false;
        }
    }

    abstract public function imprimirFila($nombre);
}
