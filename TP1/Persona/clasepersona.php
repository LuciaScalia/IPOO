<?php

class Persona
{
    private $anioNac;
    private $anioActual;
    private $documento;
    
    public function __construct($anioNac, $anioActual, $documento)
    {
        $this->anioNac = $anioNac;
        $this->anioActual = $anioActual;
        $this->documento = $documento;
    }

    public function getAnioNac(){
        return $this-> anioNac;
    }
    public function getAnioActual(){
        return $this-> anioActual;
    }
    public function getDocumento(){
        return $this-> documento;
    }

    public function setAnioNac($anio) {
        $this->anioActual = $anio;
    }
    public function setAnioActual($anio) {
        $this->anioActual = $anio;
    }
    public function setDocumento($doc) {
        $this->documento = $doc;
    }

    public function edad(){
        $edad = ($this-> anioActual) - ($this-> anioNac);
        return $edad;
    }

    public function turnoAtencion() {
        $ultimoNumDoc = $this-> documento[7];

        switch ($ultimoNumDoc) {
            case 0:
                $turno = 1;
                break;
            case 1:
                $turno = 2;
                break;
            case 2:
                $turno = 3;
                break;
            case 3:
                $turno = 4;
                break;
            case 4:
                $turno = 5;
                break;
            case 5:
                $turno = 6;
                break;
            case 6:
                $turno = 7;
                break;
            case 7:
                $turno = 8;
                break;
            case 8:
                $turno = 9;
                break;
            case 9:
                $turno = 10;
                break;
        }
        return $turno;
    }

    public function __toString() {
        return $this-> anioNac . ", " . $this-> anioActual . ", " . $this-> documento;
    }
}