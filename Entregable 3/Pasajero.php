<?php

class Pasajero {
    private $nombre;
    private $apellido;
    private $numDoc;
    private $telefono;
    private $numAsiento;
    private $numTicket;

    public function __construct($nombre, $apellido, $numDoc, $telefono, $numAsiento, $numTicket)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->numDoc = $numDoc;
        $this->telefono = $telefono;
        $this->numAsiento = $numAsiento;
        $this->numTicket = $numTicket;
    }

    public function get_nombre() {
        return $this->nombre;
    }
    public function get_apellido() {
        return $this->apellido;
    }
    public function get_numDoc() {
        return $this->numDoc;
    }
    public function getTelefono() {
        return $this->telefono;
    }
    public function get_numAsiento() {
        return $this->numAsiento;
    }
    public function get_numTicket() {
        return $this->numTicket;
    }

    public function set_nombre($nombre){
        $this->nombre = $nombre;
    }
    public function set_apellido($apellido){
        $this->apellido = $apellido;
    }
    public function set_numDoc($numDoc){
        $this->numDoc = $numDoc;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    public function set_numAsiento($numAsiento) {
        $this->numAsiento = $numAsiento;
    }
    public function set_numTicket($numTicket) {
        $this->numTicket = $numTicket;
    }

    public function __toString()
    {
        return "Nombre: ".$this->get_nombre().
        "\nApellido: ".$this->get_apellido().
        "\nNúmero de documento: ".$this->get_numDoc().
        "\nTeléfono: ".$this->getTelefono().
        "\nNúmero de asiento: ".$this->get_numAsiento().
        "\nNúmero de ticket: ".$this->get_numTicket();
    }

    public function darPorcentajeIncremento() {
        return 10;
    }
}