<?php

class Libro {
    private $titulo;
    private $anioEdicion;
    private $editorial;
    private $nombreAutor;
    private $apellidoAutor;

    public function __construct($titulo,$anioEdicion, $editorial, $nombreAutor, $apellidoAutor) 
    {
        $this->titulo = $titulo;
        $this->anioEdicion = $anioEdicion;
        $this->editorial = $editorial;
        $this->nombreAutor = $nombreAutor;
        $this->apellidoAutor = $apellidoAutor;
    }

    public function getTitulo() {
        return $this->titulo;
    }
    public function getAnioEdicion() {
        return $this->anioEdicion;
    }
    public function getEditorial() {
        return $this->editorial;
    }
    public function getNombreAutor() {
        return $this->nombreAutor;
    }
    public function getApellidoAutor() {
        return $this->apellidoAutor;
    }

    public function __toString()
    {
        return $this->getTitulo().", ".$this->getAnioEdicion().", ".$this->getEditorial().", ".$this->getNombreAutor().", ".$this->getApellidoAutor();
    }

    public function perteneceEditorial($editorialDada) {
        $pertenece = false;
        if ($editorialDada == $this->getEditorial()) {
            $pertenece = true;
        }
        return $pertenece;
    }

    public function aniosDesdeEdicion($anioActual){
        $anios = $anioActual - $this->getAnioEdicion();
        return $anios;
    }
}