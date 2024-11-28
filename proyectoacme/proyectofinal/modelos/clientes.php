<?php

class Clientes {

    public $tipoIdentificacion;
    public $identificacion;
    public $nombres;
    public $apellidos;
    public $correo;
    public $celular;
    public $fechaNacimiento;
    public $nombresAcompañante;
    public $apellidosAcompañante;
    public $fechaNacimientoAcompañante;
    public $correoAcompañante;


    function __construct($tipoIdentificacion, $identificacion, $nombres, $apellidos, $correo, $celular,$fechaNacimiento, $nombresAcompañante, $apellidosAcompañante, $fechaNacimientoAcompañante, $correoAcompañante ){

        $this->tipoIdentificacion = $tipoIdentificacion;
        $this->identificacion = $identificacion;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->celular = $celular;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->nombresAcompañante = $nombresAcompañante;
        $this->apellidosAcompañante = $apellidosAcompañante;
        $this->fechaNacimientoAcompañante = $fechaNacimientoAcompañante;
        $this->correoAcompañante = $correoAcompañante;
    }
}