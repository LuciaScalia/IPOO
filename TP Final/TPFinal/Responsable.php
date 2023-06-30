<?php

include_once "BaseDatos2.php";

class Responsable {
    
    private $rnumeroempleado;
    private $rnumerolicencia;
    private $rnombre;
    private $rapellido;
    private $mensajeoperacion;

    public function get_rnumeroempleado() {
        return $this->rnumeroempleado;
    }
    public function get_rnumerolicencia() {
        return $this->rnumerolicencia;
    }
    public function get_rnombre() {
        return $this->rnombre;
    }
    public function get_rapellido() {
        return $this->rapellido;
    }
    public function get_mensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function set_rnumeroempleado($num){
        $this->rnumeroempleado = $num;
    }
    public function set_rnumerolicencia($num){
        $this->rnumerolicencia = $num;
    }
    public function set_rnombre($rnombre){
        $this->rnombre = $rnombre;
    }
    public function set_rapellido($rapellido){
        $this->rapellido = $rapellido;
    }
    public function set_mensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function __construct()
    {
        $this->rnumeroempleado = "";
        $this->rnumerolicencia = "";
        $this->rnombre = "";
        $this->rapellido = "";
    }

    public function Cargar($rnumeroempleado, $rnumerolicencia, $rnombre, $rapellido)
    {
        $this->set_rnumeroempleado($rnumeroempleado);
        $this->set_rnumerolicencia($rnumerolicencia);
        $this->set_rnombre($rnombre);
        $this->set_rapellido($rapellido);
    }

    public function Buscar($rnumeroempleado)
    {
        $baseDatos = new BaseDatos();
        $consultaResponsable = "Select * from responsable where rnumeroempleado=" . $rnumeroempleado;
        $resp = false;
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaResponsable)) {
                if ($row2 = $baseDatos->Registro()) {
                    $this->set_rnumeroempleado($rnumeroempleado);
                    $this->set_rnumerolicencia($row2['rnumerolicencia']);
                    $this->set_rnombre($row2['rnombre']);
                    $this->set_rapellido($row2['rapellido']);
                    $resp = true;
                }
            } else {
                $this->set_mensajeoperacion($baseDatos->getError());
            }
        } else {
            $this->set_mensajeoperacion($baseDatos->getError());
        }
        return $resp;
    }

    public function Listar($condicion = "") {
        $arregloResponsables = null;
        $baseDatos = new BaseDatos();
        $consultaPasajeros = "Select * from responsable";
        if ($condicion != "") {
            $consultaPasajeros = $consultaPasajeros . ' where ' . $condicion;
        }
        $consultaPasajeros.= " order by rnumeroempleado ";
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaPasajeros)) {
                $arregloResponsables = [];
                while ($row2 = $baseDatos->Registro()) {
                    $rnumeroempleado=$row2['rnumeroempleado'];
                    $rnumerolicencia=$row2['rnumerolicencia'];
					$rnombre=$row2['rnombre'];
					$rapellido=$row2['rapellido'];
                    $responsable = new Responsable();
                    $responsable->Cargar($rnumeroempleado, $rnumerolicencia, $rnombre, $rapellido);
                    array_push($arregloResponsables, $responsable);
                }
            } else {
                $this->set_mensajeoperacion($baseDatos->getError());
            }
        } else {
            $this->set_mensajeoperacion($baseDatos->getError());
        }
        return $arregloResponsables;
    }

    public function Insertar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO responsable(rnumeroempleado, rnumerolicencia, rnombre, rapellido)
                            VALUES (".$this->get_rnumeroempleado().",'".$this->get_rnumerolicencia()."','".$this->get_rnombre()."','".$this->get_rapellido()."')";
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaInsertar)) {
                $resp = true;
            } else {
                $this->set_mensajeoperacion($baseDatos->getError());
            }
        } else {
            $this->set_mensajeoperacion($baseDatos->getError());
        }
        return $resp;
    }

    public function Modificar() {
        $resp = false;
        $baseDatos = new BaseDatos();
        $consultaModificar = "UPDATE responsable SET rnumerolicencia='".$this->get_rnumerolicencia()."',rnombre='".$this->get_rnombre()."', rapellido='".$this->get_rapellido()."' WHERE rnumeroempleado=".$this->get_rnumeroempleado();
        if($baseDatos->Iniciar()) {
            if($baseDatos->Ejecutar($consultaModificar)) {
                $resp = true;
            } else {
                $this->set_mensajeoperacion($baseDatos->getError());
            }
        } else {
            $this->set_mensajeoperacion($baseDatos->getError());
        }
        return $resp;
    }

    public function Eliminar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        if ($baseDatos->Iniciar()) {
            $consultaBorrar = "DELETE FROM responsable WHERE rnumeroempleado=".$this->get_rnumeroempleado();
            if ($baseDatos->Ejecutar($consultaBorrar)) {
                $resp = true;
            } else {
                $this->set_mensajeoperacion($baseDatos->getError());
            }
        } else {
            $this->set_mensajeoperacion($baseDatos->getError());
        }
        return $resp;
    }

    public function __toString()
    {
        return "Numero de empleado: ".$this->get_rnumeroempleado().
        " Numero de licencia: ".$this->get_rnumerolicencia().
        " Nombre: ".$this->get_rnombre().
        " Apellido: ".$this->get_rapellido();
    }
}