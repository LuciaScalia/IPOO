<?php

include_once "BaseDatos2.php";

class Pasajero
{
    private $numDoc;
    private $nombre;
    private $apellido;
    private $telefono;
    private $idviaje;
    private $mensajeOperacion;

    public function get_pnombre()
    {
        return $this->nombre;
    }
    public function get_papellido()
    {
        return $this->apellido;
    }
    public function get_pdocumento()
    {
        return $this->numDoc;
    }
    public function get_ptelefono()
    {
        return $this->telefono;
    }
    public function get_idviaje()
    {
        return $this->idviaje;
    }
    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    public function set_pnombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function set_papellido($apellido)
    {
        $this->apellido = $apellido;
    }
    public function set_pdocumento($numDoc)
    {
        $this->numDoc = $numDoc;
    }
    public function set_ptelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    public function set_idviaje($idviaje)
    {
        $this->idviaje = $idviaje;
    }
    public function setMensajeOperacion($mensajeOperacion)
    {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function __construct()
    {
        $this->numDoc = "";
        $this->nombre = "";
        $this->apellido = "";
        $this->idviaje = "";
        $this->telefono = "";
    }

    public function Cargar($nombre, $apellido, $numDoc, $telefono, $idviaje)
    {
        $this->set_pdocumento($numDoc);
        $this->set_pnombre($nombre);
        $this->set_papellido($apellido);
        $this->set_ptelefono($telefono);
        $this->set_idviaje($idviaje);
    }

    public function Buscar($numDoc)
    {
        $baseDatos = new BaseDatos();
        $consultaPasajero = "Select * from pasajero where pdocumento=" . $numDoc;
        $resp = false;
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaPasajero)) {
                if ($row2 = $baseDatos->Registro()) {
                    $this->set_pdocumento($numDoc);
                    $this->set_pnombre($row2['pnombre']);
                    $this->set_papellido($row2['papellido']);
                    $this->set_ptelefono($row2['ptelefono']);
                    $resp = true;
                }
            } else {
                $this->setMensajeOperacion($baseDatos->getError());
            }
        } else {
            $this->setMensajeOperacion($baseDatos->getError());
        }
        return $resp;
    }

    public function Listar($condicion = "") {
        $arregloPasajeros = null;
        $baseDatos = new BaseDatos();
        $consultaPasajeros = "Select * from pasajero";
        if ($condicion != "") {
            $consultaPasajeros = $consultaPasajeros . ' where ' . $condicion;
        }
        $consultaPasajeros.= " order by pdocumento ";
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaPasajeros)) {
                $arregloPasajeros = [];
                while ($row2 = $baseDatos->Registro()) {
                    $numDoc=$row2['pdocumento'];
                    $nombre=$row2['pnombre'];
					$apellido=$row2['papellido'];
					$telefono=$row2['ptelefono'];
                    $idviaje=$row2['idviaje'];
                    $pasajero = new Pasajero();
                    $pasajero->Cargar($nombre, $apellido, $numDoc, $telefono, $idviaje);
                    array_push($arregloPasajeros, $pasajero);
                }
            } else {
                $this->setMensajeOperacion($baseDatos->getError());
            }
        } else {
            $this->setMensajeOperacion($baseDatos->getError());
        }
        return $arregloPasajeros;
    }

    public function Insertar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO pasajero(pdocumento, pnombre, papellido, ptelefono, idviaje)
                            VALUES (".$this->get_pdocumento().",'".$this->get_pnombre()."','".$this->get_papellido()."','".$this->get_ptelefono()."','".$this->get_idviaje()."')";
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaInsertar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($baseDatos->getError());
            }
        } else {
            $this->setMensajeOperacion($baseDatos->getError());
        }
        return $resp;
    }
    
    public function Modificar() {
        $resp = false;
        $baseDatos = new BaseDatos();
        $consultaModificar = "UPDATE pasajero SET pnombre='".$this->get_pnombre()."',papellido='".$this->get_papellido()."',ptelefono='".$this->get_ptelefono()."',idviaje='".$this->get_idviaje()."' WHERE pdocumento=".$this->get_pdocumento();
        if($baseDatos->Iniciar()) {
            if($baseDatos->Ejecutar($consultaModificar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($baseDatos->getError());
            }
        } else {
            $this->setMensajeOperacion($baseDatos->getError());
        }
        return $resp;
    }

    public function Eliminar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        if ($baseDatos->Iniciar()) {
            $consultaBorrar = "DELETE FROM pasajero WHERE pdocumento=" . $this->get_pdocumento();
            if ($baseDatos->Ejecutar($consultaBorrar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($baseDatos->getError());
            }
        } else {
            $this->setMensajeOperacion($baseDatos->getError());
        }
        return $resp;
    }

    public function __toString()
    {
        return "Numero de documento: " . $this->get_pdocumento() .
            " Nombre: " . $this->get_pnombre() .
            " Apellido: " . $this->get_papellido() .
            " Teléfono: " . $this->get_ptelefono() .
            " ID viaje: " . $this->get_idviaje();
    }
}
