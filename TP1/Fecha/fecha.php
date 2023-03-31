<?php

class Fecha
{
    //atributos

    private $dia;
    private $mes;
    private $anio;

    //métodos

    public function __construct($dia, $mes, $anio)
    {
        $this->dia = $dia;
        $this->mes = $mes;
        $this->anio = $anio;
    }

    public function getDia()
    {
        return $this->dia;
    }
    public function getMes()
    {
        return $this->mes;
    }
    public function getAnio()
    {
        return $this->anio;
    }

    public function setDia($nuevoDia)
    {
        $this->dia = $nuevoDia;
    }
    public function setMes($nuevoMes)
    {
        $this->mes = $nuevoMes;
    }
    public function setAnio($nuevoAnio)
    {
        $this->anio = $nuevoAnio;
    }

    public function fechaAbreviada()
    {
        $fechaAbreviada = $this->getDia() . "/" . $this->getMes() . "/" . $this->getAnio();
        return $fechaAbreviada;
    }

    public function fechaExtendida()
    {
        $mesDado = $this->getMes();

        switch ($mesDado) {
            case 1:
                $mesEscrito = "enero";
                break;
            case 2:
                $mesEscrito = "febrero";
                break;
            case 3:
                $mesEscrito = "marzo";
                break;
            case 4:
                $mesEscrito = "abril";
                break;
            case 5:
                $mesEscrito = "mayo";
                break;
            case 6:
                $mesEscrito = "junio";
                break;
            case 7:
                $mesEscrito = "julio";
                break;
            case 8:
                $mesEscrito = "agosto";
                break;
            case 9:
                $mesEscrito = "septiembre";
                break;
            case 10:
                $mesEscrito = "octubre";
                break;
            case 11:
                $mesEscrito = "noviembre";
                break;
            case 12:
                $mesEscrito = "diciembre";
                break;
        }
        $fechaExtendida = $this->getDia() . " de " . $mesEscrito . " de " . $this->getAnio();
        return $fechaExtendida;
    }

    public function incrementa_un_dia()
    {
        $this->setDia($this->dia + 1);
    }

    public function esBisiesto($fecha)
    {
        $bisiesto = false;

        if ($fecha->anio % 4 == 0 && $fecha->anio % 100 != 0) {
            $bisiesto = true;
        } elseif ($fecha->anio % 400 == 0 && $fecha->anio % 4 == 0) {
            $bisiesto = true;
        }
        return $bisiesto;
    }

    public function incremento($fechaDada, $incrementoFecha)
    {
        for ($i = 1; $i <= $incrementoFecha; $i++) {

            $this->incrementa_un_dia();

            if ($this->esBisiesto($fechaDada)) {
                if ($fechaDada->mes == 2) {
                    if ($this->getDia() > 29) {
                        $this->setMes($this->getMes() + 1);
                        $this->setDia($this->getDia() - 29);
                    }
                }
            } else {
                if ($fechaDada->mes == 2) {
                    if ($this->getDia() > 28) {
                        $this->setMes($this->getMes() + 1);
                        $this->setDia($this->getDia() - 28);
                    }
                }
            }

            if ($fechaDada->mes == 1 || $fechaDada->mes == 3 || $fechaDada->mes == 5 || $fechaDada->mes == 7 || $fechaDada->mes == 8 || $fechaDada->mes == 10 || $fechaDada->mes == 12) {
                if ($this->getDia() > 31) {
                    $this->setMes($this->getMes() + 1);
                    if ($this->getMes() > 12) {
                        $this->setAnio($this->getAnio() + 1);
                        $this->setMes($this->getMes() - 12);
                    }
                    $this->setDia($this->getDia() - 31);
                }
            } elseif ($fechaDada->mes == 4 || $fechaDada->mes == 6 || $fechaDada->mes == 9 || $fechaDada->mes == 11) {
                if ($this->getDia() > 30) {
                    $this->setMes($this->getMes() + 1);
                    $this->setDia($this->getDia() - 30);
                }
            }
        }
        return $this->fechaExtendida($fechaDada->anio, $this->getMes(), $this->getDia());
    }

    public function __toString()
    {
        return $this->getDia() . "-" . $this->getMes() . "-"  . $this->getAnio();
    }
}
