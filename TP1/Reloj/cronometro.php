<?php

class Reloj {
    //atributos

    private $hora;
    private $min;
    private $seg;
    
    //métodos

    public function __construct($hora, $min, $seg)
    {
        $this-> hora = $hora;
        $this-> min = $min;
        $this-> seg = $seg;
    }

    public function getHora(){
        return $this-> hora;
    }
    public function getMin(){
        return $this-> min;
    }
    public function getSeg(){
        return $this-> seg;
    }
    
    public function setHora ($hora) {
        $this-> hora = $hora;
    }
    public function setMinutos ($min) {
        $this-> min = $min;
    }
    public function setSegundos ($seg) {
        $this-> seg = $seg;
    }

    public function puesta_a_cero() {
        $this-> setHora(0);
        $this-> setMinutos(0); 
        $this-> setSegundos(0);
    }

    public function incremento() {
        $cantHora = $this-> getHora();
        $cantMin = $this-> getMin();
        $cantSeg= $this-> getSeg();

        $cantSeg++;
        if ($cantSeg <= 59) {
            $this->setSegundos($cantSeg);
        } else {
            $this->setSegundos(0);
            $cantMin++;
            if ($cantMin <= 59) {
                $this->setMinutos($cantMin);
            } else {
                $this->setMinutos(0);
                $cantHora++;
                if ($cantHora <= 23){
                    $this->setHora($cantHora);
                } else {
                    $this-> puesta_a_cero();
                }
            }
        }
    }

    public function __toString()
    {
        return $this->getHora() . ":" . $this->getMin() . ":" . $this->getSeg();
    }
}