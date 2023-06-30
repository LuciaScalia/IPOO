<?php 

include_once "BaseDatos2.php";

class Empresa {
    private $idempresa;
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    public function get_idempresa() {
        return $this->idempresa;
    }
    public function get_enombre() {
        return $this->enombre;
    }
    public function get_edireccion() {
        return $this->edireccion;
    }
    public function get_mensajeoperacion() {
        return $this->mensajeoperacion;
    }

    public function set_idempresa($idempresa) {
        $this->idempresa = $idempresa;
    }
    public function set_enombre($enombre) {
        $this->enombre = $enombre;
    }
    public function set_edireccion($edireccion) {
        $this->edireccion = $edireccion;
    }
    public function set_mensajeoperacion($mensajeoperacion) {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function __construct()
    {
        $this->idempresa = "";
        $this->enombre = "";
        $this->edireccion = "";  
    }

    public function Cargar($idempresa, $enombre, $edireccion) {
        $this->set_idempresa($idempresa);
        $this->set_enombre($enombre);
        $this->set_edireccion($edireccion);
    }

    public function Buscar($idempresa)
    {
        $baseDatos = new BaseDatos();
        $consultaEmpresa = "Select * from empresa where idempresa=" . $idempresa;
        $resp = false;
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaEmpresa)) {
                if ($row2 = $baseDatos->Registro()) {
                    $this->set_idempresa($idempresa);
                    $this->set_enombre($row2['enombre']);
                    $this->set_edireccion($row2['edireccion']);
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
        $arregloEmpresas = null;
        $baseDatos = new BaseDatos();
        $consultaEmpresa = "Select * from empresa";
        if ($condicion != "") {
            $consultaEmpresa = $consultaEmpresa . ' where ' . $condicion;
        }
        $consultaEmpresa.= " order by idempresa ";
        if ($baseDatos->Iniciar()) {
            if ($baseDatos->Ejecutar($consultaEmpresa)) {
                $arregloEmpresas = [];
                while ($row2 = $baseDatos->Registro()) {
                    $idempresa=$row2['idempresa'];
                    $enombre=$row2['enombre'];
					$edireccion=$row2['edireccion'];
                    $empresa = new Empresa();
                    $empresa->Cargar($idempresa, $enombre, $edireccion);
                    array_push($arregloEmpresas, $empresa);
                }
            } else {
                $this->set_mensajeoperacion($baseDatos->getError());
            }
        } else {
            $this->set_mensajeoperacion($baseDatos->getError());
        }
        return $arregloEmpresas;
    }

    public function Insertar() {
        $baseDatos = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO empresa(idempresa, enombre, edireccion)
                            VALUES (".$this->get_idempresa().",'".$this->get_enombre()."','".$this->get_edireccion()."')";
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
        $consultaModificar = "UPDATE empresa SET enombre='".$this->get_enombre()."',edireccion='".$this->get_edireccion()."' WHERE idempresa=".$this->get_idempresa();
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
            $consultaBorrar = "DELETE FROM empresa WHERE idempresa=" . $this->get_idempresa();
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
        return "ID: ".$this->get_idempresa().
        " Nombre: ".$this->get_enombre().
        " Direccion: ".$this->get_edireccion();
    }
}