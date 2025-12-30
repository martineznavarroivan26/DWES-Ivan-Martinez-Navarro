<?php
require_once 'src/ColeccionPrestamos.php';
require_once 'src/Prestamo.php';
require_once 'src/PrestamoPersonal.php';
require_once 'src/PrestamoHipotecario.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ut2. practica Ivan Martinez</title>
    <style>
        body{
            text-align: center;
            background-color: coral;
            zoom: 130%;
        }
        fieldset {
            border: 1px solid lightgray;
            width: 58%;
            text-align: start;
        }
        .flex {
            display: flex;
            justify-content: center;
        }
        form { color: blue; }
        form div { margin-bottom: 4px; }
        form div:last-child{ margin-top: 10px; }
        input, select {
            border: 1px solid gray;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <h3>Crear cuenta banco</h3>
    <div class="flex"><fieldset>
        <legend>Cuenta</legend>
    <?php
        // Variables para almacenar datos del formulario
        $capital = "";
        $interes = "";
        $amortizacionAños = "";
        $mensaje = "";
        session_start();

        // Inicializa coleccion de prestamos
        if (!isset($_SESSION["prestamos"])) {
            $_SESSION["prestamos"] = new ColeccionPrestamos();
            $_SESSION["contador"] = 1;
        }

        // Valida y crea prestamo cuando se envia el formulario
        if(isset($_POST["capital"]) && isset($_POST["interes"]) && isset($_POST["amortizacionAños"]) && isset($_POST["pedir"])){
            $capital = $_POST["capital"];
            $interes = (float)$_POST["interes"];
            $amortizacionAños = $_POST["amortizacionAños"];
            $tipoPrestamo = $_POST["prestamo"];

            // Switch para validar por tipo de prestamo
            switch($tipoPrestamo) {
                case "personal":
                    if (!Prestamo::controlCapital($capital, 60000)) {
                        $mensaje = "Error: El capital para un prestamo personal debe estar entre 0 y 60000.";
                        $capital = "";
                    }elseif (!Prestamo::controlInteres($interes,5,15)) {
                        $mensaje = "Error: El interes para un prestamo personal debe estar entre 5% y 15%.";
                        $interes = "";
                    }elseif (!Prestamo::controlAmortizacion($amortizacionAños,10)) {
                        $mensaje = "Error: La amortizacion para un prestamo personal debe estar entre 0 y 10 años.";
                        $amortizacionAños = "";
                    } else {
                        $prestamo = new PrestamoPersonal($capital, $interes, $amortizacionAños);
                        $numeroPrestamo = "Prestamo " . $_SESSION["contador"];
                        $_SESSION["prestamos"]->insertar_prestamo([$numeroPrestamo => $prestamo]);
                        echo "<p>Prestamo personal creado, la Cuota es: " . $prestamo->getCuota() ."</p>";
                        $capital = "";
                        $interes = "";
                        $amortizacionAños = "";
                        $_SESSION["contador"]++;
                    }
                    break;

                case "hipotecario":
                    if (!Prestamo::controlCapital($capital, 250000)) {
                        $mensaje = "Error: El capital para un prestamo hipotecario debe estar entre 0 y 250000.";
                        $capital = "";
                    }elseif (!Prestamo::controlInteres($interes,0.5,8)) {
                        $mensaje = "Error: El interes para un prestamo hipotecario debe estar entre 0.5% y 8%.";
                        $interes = "";
                    }elseif (!Prestamo::controlAmortizacion($amortizacionAños,30)) {
                        $mensaje = "Error: La amortizacion para un prestamo hipotecario debe estar entre 0 y 30 años.";
                        $amortizacionAños = "";
                    } else {
                        $prestamo = new PrestamoHipotecario($capital, $interes, $amortizacionAños);
                        $numeroPrestamo = "Prestamo " . $_SESSION["contador"];
                        $_SESSION["prestamos"]->insertar_prestamo([$numeroPrestamo => $prestamo]);
                        echo "<p>Prestamo hipotecario creado, la Cuota es: " . $prestamo->getCuota() ."</p>";
                        $capital = "";
                        $interes = "";
                        $amortizacionAños = "";
                        $_SESSION["contador"]++;
                    }
                    break;
            }
        }
    ?>
        <form action="index.php" method="post">
            <div>
                <label for="capital">Capital inicial: </label>
                <input type="number" name="capital" id="capital" value="<?= $capital ?>" style="margin-left: 71px">
            </div>
            <div>
                <label for="interes">Tasa de interes: </label>
                <input type="number" name="interes" id="interes" value="<?= $interes ?>" style="margin-left: 67px">
            </div>
            <div>
               <label for="amortizacionAños">Plazo de amortizacion: </label>
                <input type="number" name="amortizacionAños" id="amortizacionAños" value="<?= $amortizacionAños ?>" style="margin-left: 20px">
            </div>
            <div>
                <label for="prestamo">Tipo de prestamo: </label>
                <select style="margin-left: 51px; width: 169px" name="prestamo">
                    <option value="personal">Prestamo personal</option>
                    <option value="hipotecario">Prestamo hipotecario</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Pedir" name="pedir" style="margin-right: 5px; color: blue;">
                <button type="submit" name="comparar" style="margin-right: 5px; color: purple;">Comparar</button>
                <button type="submit" name="eliminar" style="margin-right: 5px; color: red;">Eliminar</button>
                <input type="checkbox" name="ordenar" id="ordenar">
                <label for="ordenar">Ordenar por cuota</label>
            </div>
        </form>
    <?php
        // Muestra un mensaje de error si hay de las validaciones
        if(isset($capital) && isset($interes) && isset($amortizacionAños)){
            if(isset($mensaje) && $mensaje !== ""){
                echo "<p style='color: red;'>$mensaje</p>";
            }
        }

        // Elimina ultimo prestamo
        if(isset($_POST["eliminar"]) && $_SESSION["prestamos"]->contarPrestamos() > 0) {
            $prestamoEliminado = $_SESSION["prestamos"]->eliminar_prestamo();
            echo $prestamoEliminado->imprimirFila("Eliminado");
        } elseif (isset($_POST["eliminar"]) && $_SESSION["prestamos"]->contarPrestamos() == 0) {
            echo "<p style='color: red;'>No hay prestamos para eliminar.</p>";
        }

        // Muestra tabla comparativa de prestamos
        if (isset($_POST["comparar"]) && $_SESSION["prestamos"]->contarPrestamos() > 0) { 
            
        ?>
        <h3>Comparacion de Prestamos</h3>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Cuota</th>
                <th>Interes</th>
                <th>Duracion</th>
                <th>Capital</th>
            </tr>
            <?php
                // Ordena por cuota si esta seleccionado

                $ordenar = isset($_POST["ordenar"]);
                if ($ordenar) {
                    $prestamos = $_SESSION["prestamos"]->ordenar_por_cuota();
                } else {
                    $prestamos = $_SESSION["prestamos"]->getColeccion();
                }

                foreach ($prestamos as $nombrePrestamo => $prestamo) {
                    $prestamo->imprimirFila($nombrePrestamo);
                }
            ?>
        </table>
    <?php 
    } if (isset($_POST["comparar"]) && $_SESSION["prestamos"]->contarPrestamos() == 0) { 
        echo "<p style='color: red;'>No hay prestamos para comparar.</p>";
    }
    ?>
    </fieldset></div>
</body>
</html>