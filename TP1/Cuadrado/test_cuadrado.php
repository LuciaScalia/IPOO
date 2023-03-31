<?php 

include "cuadrado.php";

$cuadrado = new Cuadrado(1,2,5,1,8,5,4,6);

echo "Area: " . $cuadrado->area() . "\n";
$cuadrado->desplazar(1);
echo $cuadrado->__toString() . "\n";

$cuadrado->aumentarTamanio(1);
echo $cuadrado->__toString();