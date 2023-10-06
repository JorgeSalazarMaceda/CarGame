<?php

//Definimos la clase bomba

class Bomba{
    //Atributos
    protected $posicionX;
    protected $posicionY;

    function __construct($posX, $posY) {
        $this->posicionX = $posX;
        $this->posicionY = $posY;
    }

    //Métodos getter y setter
    // Con el operador $this le decimos que busque el atributo color en esta clase
    public function getPosicionX(){
    return $this->posicionX;
        }
    public function setPosicionX($PosicionX){
        $this->posicionX =$PosicionX;
        }

    public function getPosicionY(){
    return $this->posicionY;
        }
    public function setPosicionY($PosicionY){
            $this->posicionY =$PosicionY;
        }    
}


?>