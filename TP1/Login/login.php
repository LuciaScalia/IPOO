<?php

class Login
{
    private $nombreUsuario;
    private $contrasenia;
    private $fraseRecuperarContra;
    private $contraseniaAlmacenadas;

    public function __construct($numbreUsuario, $contrasenia, $fraseRecuperar)
    {
        $this->nombreUsuario = $numbreUsuario;
        $this->contrasenia = $contrasenia;
        $this->fraseRecuperarContra = $fraseRecuperar;
        $this->contraseniaAlmacenadas = [$contrasenia];
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }
    public function getContrasenia()
    {
        return $this->contrasenia;
    }
    public function getFraseRecuperar()
    {
        return $this->fraseRecuperarContra;
    }
    public function getContraAlmacenadas()
    {
        return $this->contraseniaAlmacenadas;
    }

    public function setContrasenia($nuevaContra) {
        $this->contrasenia = $nuevaContra;
    }

    public function validarContrasenia($contra) {
        $contraValida = false;
        if ($contra == $this->getContrasenia()) {
            $contraValida = true;
        }
        return $contraValida;
    }

    public function cambiarContrasenia($contrasenia)
    {
        $cantContra = count($this->contraseniaAlmacenadas);
        $instruccion = 0;
        $i = 0;

        while ($i < $cantContra && $this->contraseniaAlmacenadas[$i] != $contrasenia){
            $i++;
        }

        if ($i != $cantContra) {
            $instruccion = 1;
        } elseif ($cantContra == 4) {
            $this->setContrasenia($contrasenia);
            for ($i = 0; $i < 3; $i++) {
                $this->contraseniaAlmacenadas[$i] = $this->contraseniaAlmacenadas[$i+1];
            }
            $this->contraseniaAlmacenadas[3] = $contrasenia;
        } else {
            $this->setContrasenia($contrasenia);
            array_push($this->contraseniaAlmacenadas, $contrasenia); 
        }
        return $instruccion;
    }

    public function recordarContrasenia($nombre, $usuarios) {
        $cantUsuarios = count($usuarios);
        $i = 0;

        while ($i < $cantUsuarios && $usuarios[$i]->getNombreUsuario() != $nombre) {
            $i++;
        }

        if ($i == $cantUsuarios) {
            $frase = "El usuario no existe";
        } else {
            $frase = $usuarios[$i]->getFraseRecuperar();
        }
        return $frase;
    }

    public function __toString()
    {
       return $this->getNombreUsuario() . ", " . $this->getContrasenia() . ", " . $this->getFraseRecuperar() . print_r($this->getContraAlmacenadas());
    }
}
