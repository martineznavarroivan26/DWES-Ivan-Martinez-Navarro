<?php
class PrestamoHipotecario extends Prestamo {

    public function __construct($capital, $interes, $amortizacionAños) {
        $this->capital = $capital;
        $this->interes = $interes;
        $this->amortizacionAños = $amortizacionAños;
        $this->cuota = $this->calcularCuota($capital, $interes, $amortizacionAños);
        $this->fecha = date('Y-m-d H:i:s');
        $this->tipo = "Prestamo Hipotecario";
    }

    // Imprime una fila de la tabla con los datos del prestamo
    public function imprimirFila($nombre) {
        echo "<tr>";
        echo "<td>{$nombre}</td>";
        echo "<td>{$this->fecha}</td>";
        echo "<td>{$this->tipo}</td>";
        echo "<td>" . number_format($this->cuota, 2) . " €</td>";
        echo "<td>{$this->interes}%</td>";
        echo "<td>{$this->amortizacionAños} años</td>";
        echo "<td>" . number_format($this->capital, 2) . " €</td>";
        echo "</tr>";
    }
}
?>