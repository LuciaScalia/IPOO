<?php

class ResponsableV {
    
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;

    public function __construct($numEmpleado, $numLicencia, $nombre, $apellido)
    {
        $this->numEmpleado = $numEmpleado;
        $this->numLicencia = $numLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function getNumEmpleado() {
        return $this->numEmpleado;
    }
    public function getNumLicencia() {
        return $this->numLicencia;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }

    public function setNumEmpleado($num){
        $this->numEmpleado = $num;
    }
    public function setNumLicencia($num){
        $this->numLicencia = $num;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function __toString()
    {
        return "Núm. empleado: ".$this->getNumEmpleado().
        " Núm licencia: ".$this->getNumLicencia().
        " Nombre: ".$this->getNombre().
        " Apellido: ".$this->getApellido()."\n";
    }
}