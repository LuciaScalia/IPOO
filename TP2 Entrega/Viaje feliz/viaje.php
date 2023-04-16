<?php

class Viaje
{
    private $codigoViaje;
    private $destino;
    private $cantPasajeros;
    private $responsableV;
    private $coleccionPasajeros;

    public function __construct($codigoViaje, $destino, $responsableV, $cantPasajeros)
    {
        $this->codigoViaje = $codigoViaje;
        $this->destino = $destino;
        $this->cantPasajeros = $cantPasajeros;
        $this->responsableV = $responsableV;
        $this->coleccionPasajeros = [];
    }

    public function getCodigoViaje()
    {
        return $this->codigoViaje;
    }
    public function getDestinoViaje()
    {
        return $this->destino;
    }
    public function getCantPasajeros()
    {
        return $this->cantPasajeros;
    }
    public function getResponsableV()
    {
        return $this->responsableV;
    }
    public function getColeccionPasajeros()
    {
        return $this->coleccionPasajeros;
    }

    public function setCodigoViaje($codigo)
    {
        $this->codigoViaje = $codigo;
    }
    public function setDestinoViaje($destino)
    {
        $this->destino = $destino;
    }
    public function setCantPasajeros($cant)
    {
        $this->cantPasajeros = $cant;
    }
    public function setResponsableV($responsableV)
    {
        $this->responsableV = $responsableV;
    }
    public function setColeccionPasajeros($coleccion)
    {
        $this->coleccionPasajeros = $coleccion;
    }

    public function mostrarPasajeros()
    {
        $cantidadPasajeros = count($this->coleccionPasajeros);
        $todosLosPasajeros = $this->getColeccionPasajeros();
        $cadena = "";
        for ($i = 0; $i < $cantidadPasajeros; $i++) {
            $pasajero = $todosLosPasajeros[$i];
            $nombre = $pasajero->getNombre();
            $apellido = $pasajero->getApellido();
            $dni = $pasajero->getNumDoc();
            $telefono = $pasajero->getTelefono();
            $cadena = $cadena . $i + 1 . "- Nombre: $nombre Apellido: $apellido DNI: $dni Teléfono: $telefono\n";
        }
        return $cadena;
    }

    public function buscarPasajero($dni)
    {
        $todosLosPasajeros = $this->getColeccionPasajeros();
        $nuevo = true;
        $i = 0;

        while ($i < count($this->coleccionPasajeros) && $nuevo) {
            if ($todosLosPasajeros[$i]->getNumDoc() == $dni) {
                $nuevo = false;
            }
            $i++;
        }
        return $nuevo;
    }

    public function agregarPasajero($objPasajero)
    {
        $todosLosPasajeros = $this->getColeccionPasajeros();
        array_push($todosLosPasajeros, $objPasajero);
        $this->setColeccionPasajeros($todosLosPasajeros);
    }

    public function __toString()
    {
        return "-Viaje: Código: " . $this->getCodigoViaje() . 
        " Destino: " . $this->destino . 
        " Cant pasajeros: " . $this->getCantPasajeros() . "\n" . 
        "-Responsable del viaje: " . $this->getResponsableV() .
        "-Pasajeros:\n" . $this->mostrarPasajeros();
    }
}
