<?php

include "cuentabancaria.php";

$numeroCuenta = 12345;
$dni = 45016480;
$saldo = 2000;
$interes = 15;

$cuentaBancaria1 = new CuentaBancaria($numeroCuenta, $dni, $saldo, $interes);

echo $cuentaBancaria1->getNumCuenta() . "\n";
echo $cuentaBancaria1->getDni() . "\n";
echo $cuentaBancaria1->getSaldoActual() . "\n";
echo $cuentaBancaria1->getInteresAnual() . "\n";

echo "Monto a retirar: ";
$monto = trim(fgets(STDIN));

while ($monto > $cuentaBancaria1->getSaldoActual() || $monto < 0) {
    echo "Saldo insuficiente. Saldo actual: $" . $cuentaBancaria1->getSaldoActual() . "\n";
    echo "Nuevo monto: ";
    $monto = trim(fgets(STDIN));
}

$cuentaBancaria1->retirar($monto);
echo $cuentaBancaria1->__toString() . "\n";
$cuentaBancaria1->depositar(60000);
echo $cuentaBancaria1->__toString() . "\n";
$cuentaBancaria1->retirar(50000);
echo $cuentaBancaria1->__toString() . "\n";

$cuentaBancaria1->actualizarSaldo() . "\n";
echo $cuentaBancaria1->__toString() . "\n";
$cuentaBancaria1->actualizarSaldo() . "\n";
echo $cuentaBancaria1->__toString();