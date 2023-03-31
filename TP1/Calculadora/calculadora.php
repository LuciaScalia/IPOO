<?php

class Calculadora {
    //atributos

    private $num1;
    private $num2;

    //método constructor

    public function __construct($num1, $num2) {
        $this-> num1 = $num1;
        $this-> num2 = $num2;
    }

    //métodos de acceso
    public function getNum1(){
        return $this-> num1;
    }
    public function getNum2(){
        return $this-> num2;
    }
    public function setNum1($num) {
        $this->num1 = $num;
    }
    public function setNu2($num) {
        $this->num2 = $num;
    }

    //métodos - comportamiento
    public function sumar(){
        return $this-> getNum1() + $this-> getNum2();
    }

    public function restar(){
        return $this-> getNum1() - $this-> getNum2();
    }

    public function multiplicar(){
        return $this-> getNum1() * $this-> getNum2();
    }

    public function dividir(){
        return $this-> getNum1() / $this-> getNum2();
    }

    //método toString
    public function __toString() {
        return $this-> getNum1() . ", " . $this-> getNum2();
    }
}