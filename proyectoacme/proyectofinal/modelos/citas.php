<?php

class Citas {

    public $identificador;
    public $fecha;
    public $tipoIdentificacionProfesional;
    public $identificacionProfesional;
    public $tipoIdentificacionCliente;
    public $identificacionCliente;

    function __construct($identificador = '', $fecha = '', $tipoIdentificacionProfesional ='',$identificacionProfesional = '', $tipoIdentificacionCliente = '',$identificacionCliente = ''
    ){
        $this->identificador = $identificador;
        $this->fecha = $fecha;
        $this->tipoIdentificacionProfesional = $tipoIdentificacionProfesional;
        $this->identificacionProfesional = $identificacionProfesional;
        $this->tipoIdentificacionCliente = $tipoIdentificacionCliente;
        $this->identificacionCliente = $identificacionCliente;
    }
}