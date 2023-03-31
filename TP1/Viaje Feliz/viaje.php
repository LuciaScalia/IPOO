<?php

class Viaje
{
    private $viaje;
    private $pasajero;

    public function __construct($codigoViaje, $destino, $cantPasajeros)
    {
        $this->viaje = [
            "codigo" => $codigoViaje, "destino" => $destino, "cantPasajeros" => $cantPasajeros,
            $this->pasajero = ["pasajeros" => []]
        ];
    }

    public function getViaje()
    {
        return $this->viaje;
    }
    public function getCodigoViaje()
    {
        return $this->viaje["codigo"];
    }
    public function getDestinoViaje()
    {
        return $this->viaje["destino"];
    }
    public function getCantPasajeros()
    {
        return $this->viaje["cantPasajeros"];
    }

    public function getPasajero()
    {
        return $this->pasajero;
    }
    public function getNombre($indice)
    {
        return $this->pasajero[$indice]["pasajeros"]["nombre"];
    }
    public function getApellido($indice)
    {
        return $this->pasajero[$indice]["pasajeros"]["apellido"];
    }
    public function getDocumento($indice)
    {
        return $this->pasajero[$indice]["pasajeros"]["documento"];
    }

    public function setCodigoViaje($codigo)
    {
        $this->viaje["codigo"] = $codigo;
    }
    public function setDestinoViaje($destino)
    {
        $this->viaje["destino"] = $destino;
    }
    public function setCantPasajeros($cant)
    {
        $this->viaje["cantPasajeros"] = $cant;
    }
    public function setViaje($codigo, $destino, $cant)
    {
        $this->setCodigoViaje($codigo);
        $this->setDestinoViaje($destino);
        $this->setCantPasajeros($cant);
    }

    public function __toString()
    {
        return print_r($this->getViaje()) . print_r($this->getPasajero());
    }

    public function setNombre($indice, $nombre)
    {
        $this->pasajero[$indice - 1]["pasajeros"]["nombre"] = $nombre;
    }
    public function setApellido($indice, $apellido)
    {
        $this->pasajero[$indice - 1]["pasajeros"]["apellido"] = $apellido;
    }
    public function setDocumento($indice, $numDocumento)
    {
        $this->pasajero[$indice - 1]["pasajeros"]["documento"] = $numDocumento;
    }
    public function setPasajero($indice, $nombre, $apellido, $numDocumento)
    {
        $i = $indice - 1;
        $this->pasajero[$i]["pasajeros"] = ["nombre" => $nombre, "apellido" => $apellido, "documento" => $numDocumento];
    }

    public function mostrarPasajeros()
    {
        $cantidadPasajeros = count($this->pasajero);
        for ($i = 0; $i < $cantidadPasajeros - 1; $i++) {
            $pasajeros[$i] = $i + 1 . "- Nombre: " . $this->getNombre($i) . " Apellido: " . $this->getApellido($i) . " Documento: " . $this->getDocumento($i) . "\n";
        }
        return $pasajeros;
    }
}
