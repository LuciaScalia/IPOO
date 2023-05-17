<?php

class Viaje
{
    private $codigoViaje;
    private $destino;
    private $maxPasajeros;
    private $responsableV;
    private $coleccionPasajeros;
    private $precio;
    private $costosAbonados;

    public function __construct($codigoViaje, $destino, $responsableV, $maxPasajeros, $coleccionPasajeros, $precio)
    {
        $this->codigoViaje = $codigoViaje;
        $this->destino = $destino;
        $this->maxPasajeros = $maxPasajeros;
        $this->responsableV = $responsableV;
        $this->coleccionPasajeros = $coleccionPasajeros;
        $this->precio = $precio;
        $this->costosAbonados = 0;
    }

    public function getCodigoViaje()
    {
        return $this->codigoViaje;
    }
    public function getDestinoViaje()
    {
        return $this->destino;
    }
    public function getMaxPasajeros()
    {
        return $this->maxPasajeros;
    }
    public function getResponsableV()
    {
        return $this->responsableV;
    }
    public function getColeccionPasajeros()
    {
        return $this->coleccionPasajeros;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getCostosAbonados()
    {
        return $this->costosAbonados;
    }

    public function setCodigoViaje($codigo)
    {
        $this->codigoViaje = $codigo;
    }
    public function setDestinoViaje($destino)
    {
        $this->destino = $destino;
    }
    public function setMaxPasajeros($maxPasajeros)
    {
        $this->maxPasajeros = $maxPasajeros;
    }
    public function setResponsableV($responsableV)
    {
        $this->responsableV = $responsableV;
    }
    public function setColeccionPasajeros($coleccion)
    {
        $this->coleccionPasajeros = $coleccion;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function setCostosAbonados($costosAbonados)
    {
        $this->costosAbonados = $costosAbonados;
    }

    public function mostrarPasajeros()
    {
        $todosLosPasajeros = $this->getColeccionPasajeros();
        $cadena = "";
        foreach ($todosLosPasajeros as $i => $unPasajero) {
            $cadena = $cadena . $i + 1 . ")\n" . $unPasajero->__toString() . "\n";
        }
        return $cadena;
    }

    public function buscarPasajero($numDoc) {
        $encontro = null;
        $i = 0;
        $pasajeros = $this->getColeccionPasajeros();
        while ($i < count($pasajeros) && !$encontro) {
            if ($pasajeros[$i]->get_numDoc() == $numDoc) {
                $encontro = $i;
            }
            $i++;
        }
        return $encontro;
    }

    public function ventaValida($numDoc, $numAsiento, $numTicket)
    {
        $todosLosPasajeros = $this->getColeccionPasajeros();
        $disponible = true;
        $i = 0;
        while ($i < count($this->coleccionPasajeros) && $disponible) {
            if ($todosLosPasajeros[$i]->get_numDoc() == $numDoc || 
                $todosLosPasajeros[$i]->get_numAsiento() == $numAsiento || 
                $todosLosPasajeros[$i]->get_numTicket() == $numTicket) {
                $disponible = false;
            }
            $i++;
        }
        return $disponible;
    }

    public function hayPasajesDisponibles() {
        $hayDisponible = false;
        if (count($this->getColeccionPasajeros()) < $this->getMaxPasajeros()) {
            $hayDisponible = true;
        }
        return $hayDisponible;
    }

    public function venderPasaje($objPasajero)
    {
        $costoFinal = null;
        if ($this->hayPasajesDisponibles() && $this->ventaValida($objPasajero->get_numDoc(), $objPasajero->get_numAsiento(), $objPasajero->get_numTicket())) {
            $todosLosPasajeros = $this->getColeccionPasajeros();
            array_push($todosLosPasajeros, $objPasajero);
            $this->setColeccionPasajeros($todosLosPasajeros);
            $costoFinal = $this->getPrecio() + $this->getPrecio() * $objPasajero->darPorcentajeIncremento() / 100;
            $this->setCostosAbonados($this->getCostosAbonados() + $costoFinal);
        }
        return $costoFinal;
    }

    public function __toString()
    {
        return "Código: " . $this->getCodigoViaje()."\n". 
        "Destino: " . $this->destino."\n". 
        "Cantidad máxima de pasajeros: " . $this->getMaxPasajeros()."\n". 
        "Precio: $".$this->getPrecio()."\n".
        "Costos abonados: $".$this->getCostosAbonados()."\n".
        "-Responsable del viaje: " . $this->getResponsableV().
        "-Pasajeros:\n" . $this->mostrarPasajeros();
    }
}
