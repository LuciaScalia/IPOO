<?php

include "fecha.php";

echo "Día actual: ";
$dia = trim(fgets(STDIN));
echo "Mes actual: ";
$mes = trim(fgets(STDIN));
echo "Año actual: ";
$anio = trim(fgets(STDIN));

$fecha = new Fecha($dia, $mes, $anio);

echo "Fecha actual: " . $fecha-> fechaExtendida() . "\n\n";
echo "Incremento de días a la fecha actual: ";
$incrementoFecha = trim(fgets(STDIN));
echo "Fecha dentro de $incrementoFecha días: " . $fecha->incremento($fecha,$incrementoFecha);
$fechaAbreviada = $fecha->fechaAbreviada();
echo " ($fechaAbreviada)\n"; 

echo $fecha->__toString();