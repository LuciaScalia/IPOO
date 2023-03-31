<?php 

include "linea.php";

$linea = new Linea(-4, 1, -1, -5);

$linea-> mueveDerecha(2);
echo $linea-> __toString()."\n";

$linea-> mueveIzquierda(1);
echo $linea-> __toString()."\n";

$linea-> mueveArriba(2);
echo $linea-> __toString()."\n";

$linea-> mueveAbajo(1);
echo $linea-> __toString();