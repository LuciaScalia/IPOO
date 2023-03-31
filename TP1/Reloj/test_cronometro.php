<?php

include "cronometro.php";

$horaCronometro1 = new Reloj(14, 19, 58);
echo $horaCronometro1 . "\n";

$horaCronometro1->incremento();
echo $horaCronometro1->__toString() . "\n";
$horaCronometro1->incremento();
echo $horaCronometro1->__toString() . "\n";
echo $horaCronometro1-> puesta_a_cero();
echo $horaCronometro1->__toString() . "\n";

$horaCronometro2 = new Reloj(23, 59, 59);
$horaCronometro2->incremento();
echo $horaCronometro2->__toString() . "\n";