<?php

class Viaje
{
    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
    private $objempresa;
    private $objempleado;
    private $vimporte;
    private $vcolpasajeros;
    private $mensajeoperacion;

    public function get_idviaje()
    {
        return $this->idviaje;
    }
    public function get_vdestino()
    {
        return $this->vdestino;
    }
    public function get_vcantmaxpasajeros()
    {
        return $this->vcantmaxpasajeros;
    }
    public function get_objempresa()
    {
        return $this->objempresa;
    }
    public function get_objempleado()
    {
        return $this->objempleado;
    }
    public function get_vimporte()
    {
        return $this->vimporte;
    }
    public function get_vcolpasajeros()
    {
        return $this->vcolpasajeros;
    }
    public function get_mensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function set_idviaje($idviaje)
    {
        $this->idviaje = $idviaje;
    }
    public function set_vdestino($vdestino)
    {
        $this->vdestino = $vdestino;
    }
    public function set_vcantmaxpasajeros($vcantmaxpasajeros)
    {
        $this->vcantmaxpasajeros = $vcantmaxpasajeros;
    }
    public function set_objempresa($objempresa)
    {
        $this->objempresa = $objempresa;
    }
    public function set_objempleado($objempleado)
    {
        $this->objempleado = $objempleado;
    }
    public function set_vimporte($vimporte)
    {
        $this->vimporte = $vimporte;
    }
    public function set_vcolpasajeros($vcolpasajeros)
    {
        $this->vcolpasajeros = $vcolpasajeros;
    }
    public function set_mensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function Cargar($vdestino, $vcantmaxpasajeros, $objempresa, $objempleado, $vimporte, $vcolpasajeros)
    {
        $this->set_vdestino($vdestino);
        $this->set_vcantmaxpasajeros($vcantmaxpasajeros);
        $this->set_objempresa($objempresa);
        $this->set_objempleado($objempleado);
        $this->set_vimporte($vimporte);
        $this->set_vcolpasajeros($vcolpasajeros);
    }

    public function __construct()
    {
        $this->idviaje = 0;
        $this->vdestino = "";
        $this->vcantmaxpasajeros = 0;
        $this->objempresa = null;
        $this->objempleado = null;
        $this->vimporte = 0;
        $this->vcolpasajeros = null;
    }

    public function Buscar($idviaje)
    {
        $base = new BaseDatos();
        $consultaPersona = "Select * from viaje where idviaje=" . $idviaje;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersona)) {
                if ($row2 = $base->Registro()) {
                    $responsable = new Responsable();
                    $empresa = new Empresa();
                    $responsable->Buscar($row2['rnumeroempleado']);
                    $empresa->Buscar($row2['idempresa']);
                    $this->Cargar($row2['vdestino'], $row2['vcantmaxpasajeros'], $empresa, $responsable, $row2['vimporte'], []);
                    $resp = true;
                }
            } else {
                $this->set_mensajeoperacion($base->getError());
            }
        } else {
            $this->set_mensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function Listar($condicion = "")
    {
        $arregloViajes = null;
        $base = new BaseDatos();
        $consultaViajes = "Select * from viaje ";
        if ($condicion != "") {
            $consultaViajes = $consultaViajes . ' where ' . $condicion;
        }
        $consultaViajes .= " order by idviaje ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaViajes)) {
                $arregloViajes = [];
                while ($row2 = $base->Registro()) {
                    $responsable = new Responsable();
                    $empresa = new Empresa();
                    $pasajero = new Pasajero();
                    $viaje = new Viaje();

                    $idviaje = $row2['idviaje'];
                    $empresa->Buscar($row2['idempresa']);
                    $responsable->Buscar(($row2['rnumeroempleado']));
                    $pasajeros = $pasajero->Listar('idviaje=' . $idviaje);
                    $viaje->set_vcolpasajeros($pasajeros);

                    $vdestino = $row2['vdestino'];
                    $vcantmaxpasajeros = $row2['vcantmaxpasajeros'];
                    $vimporte = $row2['vimporte'];

                    $viaje->cargar($vdestino, $vcantmaxpasajeros, $empresa, $responsable, $vimporte, $pasajeros);
                    $viaje->set_idviaje($idviaje);
                    array_push($arregloViajes, $viaje);
                }
            } else {
                $this->set_mensajeoperacion($base->getError());
            }
        } else {
            $this->set_mensajeoperacion($base->getError());
        }
        return $arregloViajes;
    }

    public function Insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO viaje(vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte) 
				VALUES ('" . $this->get_vdestino() . "'," . $this->get_vcantmaxpasajeros() .
                       "," . $this->get_objempresa()->get_idempresa() . "," . $this->get_objempleado()->get_rnumeroempleado() .
                       "," . $this->get_vimporte() . ")";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->set_idviaje($id);
                $resp =  true;
            } else {
                $this->set_mensajeoperacion($base->getError());
            }
        } else {
            $this->set_mensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function Modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE viaje SET vdestino='" . $this->get_vdestino() . "',vcantmaxpasajeros='" . $this->get_vcantmaxpasajeros() .
            "',idempresa='" . $this->get_objempresa()->get_idempresa() . "',rnumeroempleado='" . $this->get_objempleado()->get_rnumeroempleado() .
            "',vimporte='" . $this->get_vimporte() . "' WHERE idviaje = " . $this->get_idviaje();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp =  true;
            } else {
                $this->set_mensajeoperacion($base->getError());
            }
        } else {
            $this->set_mensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function Eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorrar = "DELETE FROM viaje WHERE idviaje=" . $this->get_idviaje();
            if ($base->Ejecutar($consultaBorrar)) {
                $resp =  true;
            } else {
                $this->set_mensajeoperacion($base->getError());
            }
        } else {
            $this->set_mensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function __toString()
    {
        return "ID viaje: " . $this->get_idviaje() .
            " Destino: " . $this->get_vdestino() .
            " Cantidad maxima de pasajeros: " . $this->get_vcantmaxpasajeros() .
            " ID empresa: " . $this->get_objempresa()->get_idempresa() .
            " Numero de empleado: " .  $this->get_objempleado()->get_rnumeroempleado() .
            " Importe: $" . $this->get_vimporte();
    }
}
