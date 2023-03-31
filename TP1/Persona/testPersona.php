<?php

include "clasepersona.php";

echo "Año nacimiento: ";
$anioNacimiento = trim(fgets(STDIN));
echo "Año actual: ";
$actualAnio = trim(fgets(STDIN));
echo "Documento: ";
$documentoDado = trim(fgets(STDIN));

$persona1 = new Persona($anioNacimiento, $actualAnio, $documentoDado);
echo "Edad: ".$persona1-> edad() . "\n";
echo "Turno: ".$persona1-> turnoAtencion() . "\n\n";

echo $persona1-> __toString() . "\n";