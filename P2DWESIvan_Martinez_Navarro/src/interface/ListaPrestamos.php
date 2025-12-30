<?php
interface ListaPrestamos {

 /**
 * Inserta un préstamo en la última posición de la lista.
 *
 * @param array
 */
 public function insertar_prestamo($prestamo);

 /**
 * Elimina el primer préstamo de la lista.
 *
 * @return Prestamo
 */
 public function eliminar_prestamo():Prestamo;

 /**
 * Devuelve una lista ordenada por cuota sin modificar la colección original.
 *
 * @return array
 */
 public function ordenar_por_cuota():array;
}
?>