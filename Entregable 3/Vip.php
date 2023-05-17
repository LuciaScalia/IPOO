<?php

class Vip extends Pasajero {
    private $numViajeroFrecuente;
    private $cantMillas;

    public function __construct($nombre, $apellido, $numDoc, $telefono, $numAsiento, $numTicket, $numViajeroFrecuente, $cantMillas)
    {
        parent::__construct($nombre, $apellido, $numDoc, $telefono, $numAsiento, $numTicket);
        $this->numViajeroFrecuente = $numViajeroFrecuente;
        $this->cantMillas = $cantMillas;
    }

    public function get_numViajeroFrecuente() {
        return $this->numViajeroFrecuente;
    }
    public function get_cantMillas() {
        return $this->cantMillas;
    }

    public function set_numViajeroFrecuente($numViajeroFrecuente) {
        $this->numViajeroFrecuente = $numViajeroFrecuente;
    }
    public function set_cantMillas($cantMillas) {
        $this->cantMillas = $cantMillas;
    }

    public function __toString()
    {
        $cadena = parent::__toString().
        "\nNúmero de viajero frecuente: ".$this->get_numViajeroFrecuente().
        "\nCantidad de millas del pasajero: ".$this->get_cantMillas();
        return $cadena;
    }

    public function darPorcentajeIncremento() {
        $incremento = 35;
        if ($this->get_cantMillas() > 300) {
            $incremento = 30;
        }
        return $incremento;
    }
}