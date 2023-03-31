<?php

class Teatro
{
    //atributos

    private $nombre;
    private $direccion;
    private $funciones;

    //métodos

    public function __construct($teatro, $direccionT)
    {
        $this->nombre = $teatro;
        $this->direccion = $direccionT;
        $this->funciones [0]= ["nombre" => "Sin función", "precio" => 0];
        $this->funciones [1]= ["nombre" => "Sin función", "precio" => 0];
        $this->funciones [2]= ["nombre" => "Sin función", "precio" => 0];
        $this->funciones [3]= ["nombre" => "Sin función", "precio" => 0];
    }

    public function getNombre() {
        return $this-> nombre;
    }
    public function getDireccion() {
        return $this-> direccion;
    }
    public function getFunciones() {
        return $this-> funciones;
    }
    public function getFuncion1() {
        return $this->funciones[0];
    }
    public function getFuncion2() {
        return $this->funciones[1];
    }
    public function getFuncion3() {
        return $this->funciones[2];
    }
    public function getFuncion4() {
        return $this->funciones[3];
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setFuncionNombre($indice, $nombreFuncion) {
        $this-> funciones[$indice - 1]["nombre"]= $nombreFuncion;
    }
    public function setFuncionPrecio($indice, $precio) {
        $this-> funciones[$indice - 1]["precio"]= $precio;
    }

    public function mostrarFunciones() {
        for($i = 0; $i < 4; $i++) {
           $funciones[$i] = $i+1 . "- Nombre: " . $this-> funciones[$i]["nombre"] . " Precio: "  . $this-> funciones[$i]["precio"] . "\n";
        }
        return $funciones;
    }

    public function cambiarFuncion($nombreFuncion, $precioFuncion, $numFuncion)
    {
        $this->setFuncionNombre($numFuncion, $nombreFuncion);
        $this->setFuncionPrecio($numFuncion, $precioFuncion);
    }

    public function cambiarPrecio($numFuncion, $cantidad) {
        $this->setFuncionPrecio($numFuncion, $cantidad);
    }

    public function cambiarNombre($numFuncion, $nuevoNombre) {
        $this-> setFuncionNombre($numFuncion, $nuevoNombre);
    }

    public function __toString()
    {
        return $this-> getNombre() . ", " . $this-> getDireccion() . ", " . print_r($this-> getFunciones());
    }
}
