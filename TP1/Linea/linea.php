<?php

class Linea
{

    private $pA;
    private $pB;
    private $pC;
    private $pD;

    public function __construct($puntoA, $puntoB, $puntoC, $puntoD)
    {
        $this->pA = $puntoA;
        $this->pB = $puntoB;
        $this->pC = $puntoC;
        $this->pD = $puntoD;
    }

    public function getPuntoA()
    {
        return $this->pA;
    }
    public function getPuntoB()
    {
        return $this->pB;
    }
    public function getPuntoC()
    {
        return $this->pC;
    }
    public function getPuntoD()
    {
        return $this->pD;
    }

    public function setPuntoA($valor) {
        $this->pA = ($valor);
    }
    public function setPuntoB($valor) {
        $this->pB = ($valor);
    }
    public function setPuntoC($valor) {
        $this->pC = ($valor);
    }
    public function setPuntoD($valor) {
        $this->pD = ($valor);
    }

    public function mueveDerecha($distancia)
    { 
        $this->setPuntoA($this->getPuntoA() + $distancia);
        $this->setPuntoC($this->getPuntoC() + $distancia);
    }

    public function mueveIzquierda($distancia)
    {
        $this->setPuntoA($this->getPuntoA() - $distancia);
        $this->setPuntoC($this->getPuntoC() - $distancia);
    }

    public function mueveArriba($distancia) {
        $this->setPuntoB($this->getPuntoB() + $distancia);
        $this->setPuntoD($this->getPuntoD() + $distancia);
    }

    public function mueveAbajo($distancia) {
        $this->setPuntoB($this->getPuntoB() - $distancia);
        $this->setPuntoD($this->getPuntoD() - $distancia);
    }

    public function __toString()
    {
        return "(" . $this->getPuntoA() . ", " . $this->getPuntoB() . ") (" . $this->getPuntoC() . ", " . $this->getPuntoD() . ")";
    }
}
