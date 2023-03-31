<?php 

class Cuadrado {
    //atributos

    private $verticeA;
    private $verticeB;
    private $verticeC;
    private $verticeD;

    //métodos

    public function __construct($A1, $A2, $B1, $B2, $C1, $C2, $D1, $D2) 
    {
      $this-> verticeA = ["A1" => $A1, "A2" => $A2];
      $this-> verticeB = ["B1" => $B1, "B2" => $B2];
      $this-> verticeC = ["C1" => $C1, "C2" => $C2];
      $this-> verticeD = ["D1" => $D1, "D2" => $D2];      
    }

    public function getVerticeA1() {
        return $this-> verticeA["A1"];
    }
    public function getVerticeA2() {
        return $this-> verticeA["A2"];
    }

    public function getVerticeB1() {
        return $this-> verticeB["B1"];
    }
    public function getVerticeB2() {
        return $this-> verticeB["B2"];
    }

    public function getVerticeC1() {
        return $this-> verticeC["C1"];
    }
    public function getVerticeC2() {
        return $this-> verticeC["C2"];
    }

    public function getVerticeD1() {
        return $this-> verticeD["D1"];
    }
    public function getVerticeD2() {
        return $this-> verticeD["D2"];
    }
    
    public function setVerticeA1($num) {
        $this-> verticeA["A1"] = $num;
    }
    public function setVerticeA2($num) {
        $this-> verticeA["A2"] = $num;
    }

    public function setVerticeB1($num) {
        $this-> verticeB["B1"] = $num;
    }
    public function setVerticeB2($num) {
        $this-> verticeB["B2"] = $num;
    }

    public function setVerticeC1($num) {
        $this-> verticeC["C1"] = $num;
    }
    public function setVerticeC2($num) {
        $this-> verticeC["C2"] = $num;
    }

    public function setVerticeD1($num) {
        $this-> verticeD["D1"] = $num;
    }
    public function setVerticeD2($num) {
        $this-> verticeD["D2"] = $num;
    }

    public function area() {
        $determinante1 = $this->getVerticeA1() * $this->getVerticeB2() +
                         $this->getVerticeB1() * $this->getVerticeC2() +
                         $this->getVerticeC1() * $this->getVerticeD2() +
                         $this->getVerticeD1() * $this->getVerticeA2();

        $determinante2 = $this->getVerticeA2() * $this->getVerticeB1() +
                         $this->getVerticeB2() * $this->getVerticeC1() +
                         $this->getVerticeC2() * $this->getVerticeD1() +
                         $this->getVerticeD2() * $this->getVerticeA1();

        $area = 0.5 * ($determinante1 - $determinante2);

        return $area;
    }

    public function desplazar($distancia) {
        $this->setVerticeA1($this->getVerticeA1()+$distancia);
        $this->setVerticeA2($this->getVerticeA2()+$distancia);

        $this->setVerticeB1($this->getVerticeB1()+$distancia);
        $this->setVerticeB2($this->getVerticeB2()+$distancia);

        $this->setVerticeC1($this->getVerticeC1()+$distancia);
        $this->setVerticeC2($this->getVerticeC2()+$distancia);

        $this->setVerticeD1($this->getVerticeD1()+$distancia);
        $this->setVerticeD2($this->getVerticeD2()+$distancia);
    }

    public function aumentarTamanio($cantAumento) {
        $this->setVerticeA1($this->getVerticeA1()-$cantAumento);
        $this->setVerticeA2($this->getVerticeA2()-$cantAumento);

        $this->setVerticeB1($this->getVerticeB1()+$cantAumento);
        $this->setVerticeB2($this->getVerticeB2()-$cantAumento);

        $this->setVerticeC1($this->getVerticeC1()+$cantAumento);
        $this->setVerticeC2($this->getVerticeC2()+$cantAumento);

        $this->setVerticeD1($this->getVerticeD1()-$cantAumento);
        $this->setVerticeD2($this->getVerticeD2()+$cantAumento);
    }

    public function __toString()
    {
        return "A: (" . $this->getVerticeA1() . ", " . $this->getVerticeA2() . ") B: (" . $this->getVerticeB1() . ", " . $this->getVerticeB2() . ") C: (" . $this->getVerticeC1() . ", " . $this->getVerticeC2() . ") D: (" . $this->getVerticeD1() . ", " . $this->getVerticeD2() . ")";
    }
}