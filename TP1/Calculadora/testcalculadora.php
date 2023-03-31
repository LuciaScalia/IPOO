<?php

include "calculadora.php";

echo "Num1: ";
$numero1 = trim(fgets(STDIN));
echo "Num2: ";
$numero2 = trim(fgets(STDIN));

$operaciones = new Calculadora($numero1, $numero2);

echo $operaciones-> getNum1() . "\n";
echo $operaciones-> getNum2() . "\n";
echo $operaciones-> sumar() . "\n";
echo $operaciones-> restar() . "\n";
echo $operaciones-> multiplicar() . "\n";
echo $operaciones-> dividir() . "\n\n";
echo $operaciones-> __toString();