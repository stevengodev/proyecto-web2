<?php

class Profesionales {

    public $tipoIdentificacion;
    public $identificacion;
    public $nombres;
    public $apellidos;
    public $celular;
    public $estado;


    function __construct($tipoIdentificacion, $identificacion, $nombres = '', $apellidos ='', $celular = '', $estado = ''){

        $this->tipoIdentificacion = $tipoIdentificacion;
        $this->identificacion = $identificacion;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->celular = $celular;
        $this->estado = $estado;
    }
}