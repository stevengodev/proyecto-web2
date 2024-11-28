<?php

class Empleados {

    public $tipoIdentificacion;
    public $identificacion;
    public $nombres;
    public $apellidos;
    public $tipo;


    function __construct($tipoIdentificacion, $identificacion, $nombres, $apellidos, $tipo){

        $this->tipoIdentificacion = $tipoIdentificacion;
        $this->identificacion = $identificacion;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->tipo = $tipo;
    }
}