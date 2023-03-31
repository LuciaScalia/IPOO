<?php

class Cafetera
{
    //atributos

    private $cantidadMaxima;
    private $cantidadActual;

    //métodos
    
    public function __construct($cantMax, $cantActual)
    {
        $this->cantidadMaxima = $cantMax;
        $this->cantidadActual = $cantActual;
    }

    public function getCantMax()
    {
        return $this->cantidadMaxima;
    }
    public function getCantActual()
    {
        return $this->cantidadActual;
    }

    public function setCantMax($cant){
        $this->cantidadMaxima = $cant;
    }
    public function setCantActual($cant){
        $this->cantidadActual = $cant;
    }
   
    public function llenarCafetera()
    {
        $this->setCantActual($this->getCantMax());
    }

    public function servirTaza($cantidad)
    {
        $taza = 0;
        if ($cantidad > $this->getCantActual()) {
            $taza = $this->getCantActual();
            $this->setCantActual(0);
        } else {
            $taza = $cantidad;
            $this->setCantActual($this->getCantActual() - $cantidad);
        }
        return $taza;
    }

    public function vaciarCafetera()
    {
        $this->setCantActual(0);
    }

    public function agregarCafe($cantidad)
    {
        $this->setCantActual($this->cantidadActual + $cantidad);
    }

    public function __toString()
    {
        return $this->getCantMax() . ", " . $this->getCantActual();
    }
}
