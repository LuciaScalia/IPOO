<?php
include_once "Pasajero.php";
class NecesidadEspecial extends Pasajero {
    private $colServicios;

    public function __construct($nombre, $apellido, $numDoc, $telefono, $numAsiento, $numTicket, $colServicios)
    {
        parent::__construct($nombre, $apellido, $numDoc, $telefono, $numAsiento, $numTicket);
        $this->colServicios = $colServicios;
    }

    public function get_colServicios() {
        return $this->colServicios;
    }

    public function set_servicios($colServicios) {
        $this->colServicios = $colServicios;
    }

    public function mostrarServiciosRequeridos() {
        $servicios = $this->get_colServicios();
        $cadena = "";
        foreach ($servicios as $unServicio) {
            $cadena = $cadena . "-" . $unServicio . "\n";
        }
        return $cadena;
    }

    public function __toString()
    {
        $cadena =  parent::__toString().
        "\nServicios requeridos:\n".$this->mostrarServiciosRequeridos();
        return $cadena;
    }

    public function darPorcentajeIncremento() {
        $incremento = 15;
        if (count($this->get_colServicios()) > 1) {
            $incremento = 30;
        }
        return $incremento;
    }
}