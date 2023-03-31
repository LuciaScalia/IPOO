<?php

class CuentaBancaria
{
    private $numCuenta;
    private $dni;
    private $saldoActual;
    private $interesAnual;

    public function __construct($numeroCuenta, $dniCliente, $saldo_Actual, $interes_Anual)
    {
        $this->numCuenta = $numeroCuenta;
        $this->dni = $dniCliente;
        $this->saldoActual = $saldo_Actual;
        $this->interesAnual = $interes_Anual;
    }

    public function getNumCuenta()
    {
        return $this->numCuenta;
    }
    public function getDni()
    {
        return $this->dni;
    }
    public function getSaldoActual()
    {
        return $this->saldoActual;
    }
    public function getInteresAnual()
    {
        return $this->interesAnual;
    }

    public function setNumCuenta($nuevoNum) {
        $this->numCuenta = $nuevoNum;
    }
    public function setDni($nuevoDni) {
        $this->dni = $nuevoDni;
    }
    public function setNSaldoActual($saldo) {
        $this->saldoActual = $saldo;
    }
    public function setInteresAnual($interes) {
        $this->interesAnual = $interes;
    }

    public function actualizarSaldo()
    {
        $interesDiario = $this->getInteresAnual() / 365;
        $this->setNSaldoActual(round($this-> getSaldoActual() + ($this->getSaldoActual() * $interesDiario) / 100 , 2));
        $this->getSaldoActual();
    }

    public function depositar($cantidad)
    {
       $this->setNSaldoActual($this->getSaldoActual() + $cantidad);
    }

    public function retirar($cantidad)
    {
        $this->setNSaldoActual($this->getSaldoActual() - $cantidad);
    }

    public function __toString()
    {
        return $this->getNumCuenta() . ", " . $this->getDni() . ", $" . $this->getSaldoActual() . ", " . $this->getInteresAnual();
    }
}
